<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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

    public function recoverPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        error_log($request->email);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

}
