<?php

namespace App\Http\Controllers;

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
}
