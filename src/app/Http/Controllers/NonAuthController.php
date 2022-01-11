<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;


class NonAuthController extends Controller
{

    /**
     * Shows the home page
     *
     * @return Response
     */
    public function showHome()
  {
    return view('pages.home');
  }

  /**
     * Shows the About Us page
     *
     * @return Response
     */
    public function showAbout()
  {
    return view('pages.about');
  }

  /**
     * Shows the Contact Us page
     *
     * @return Response
     */
    public function showContact()
  {
    return view('pages.contact');
  }

  /**
     * Shows the Services page
     *
     * @return Response
     */
    public function showService()
  {
    return view('pages.services');
  }

  /**
     * Shows the Blocked page
     *
     * @return Response
     */
    public function showBlocked()
  {
    return view('pages.blocked');
  }


  /**
     *
     */
    public function sendEmail(Request $request){
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        Mail::to("toEaseManage@gmail.com")->send(new ContactMail($name, $email, $message));
        return new ContactMail($name, $email, $message);
    }
}
