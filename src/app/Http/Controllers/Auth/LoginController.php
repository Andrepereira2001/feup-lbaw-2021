<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        return '/users';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function getUser(){
    //     return $request->user();
    // }

    public function authenticate(Request $request){

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            if(Auth::user()->blocked){
                Auth::logout();
                return redirect("/blocked");
            }
            return redirect()->intended('/users');
        }

        if(Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])){
            return redirect()->intended('/admin');
        }

        return redirect('/login')->with('jsAlert', "Invalid credentials");

    }

    public function forgotPassword()
    {
      return view('auth.forgotPassword', []);
    }


    public function recoverPassword(Request $request){
        //You can add validation login here
        $user = User::where('email', '=', $request->email)->first();
        //Check if the user exists

        if (!$user) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }

        //Create Password Reset Token

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => md5(rand()),
            'created_at' => Carbon::now()
        ]);


        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->withErrors(['status' => trans('A reset link has been sent to your email address.')]);
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = User::where('email', $email)->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = URL::to('/') . '/resetPassword/' . $token . '?email=' . urlencode($user->email);


        Mail::to($email)->send(new ResetPasswordMail($user, $link));
    }

    public function showResetPassword($token)
    {
      return view('auth.resetPassword',['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'passwordConfirm' => 'required',
            'token' => 'required' ]);

        //check if payload is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;
        $confirmPassword = $request->passwordConfirm;

        if($password != $confirmPassword){
            return redirect()->back()->withErrors(['email' => "Passwords don't match"]);
        }

        // Validate the token
        $tokenData = DB::table('password_resets')->where('token', $request->token)->first();

        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.forgotPassword');

        $user = User::where('email', $tokenData->email)->first();

        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        //Hash and update the new password
        $user->password = bcrypt($password);
        $user->save(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)->delete();

        return redirect('/users');
    }
}
