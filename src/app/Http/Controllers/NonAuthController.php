<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
     *
     */
    public function sendEmail(Request $request){

      $name = $request->input('name');
      $from = $request->input('email');
      $message = $request->input('message');
      $to = "ricky.ferreira.305@gmail.com";
      $subject = "Form submission";
      $message = $name . "wrote the following:" . "\n\n" . $message;

      $header = "From:" . $from;
      mail($to,$subject,$message,$header);
      return view('pages.about');
    }
}
