@extends('layouts.static')

@section('content')

<section id="contact">
<div class="grid">
    <div class="grid-container">
      <a class="item-amarelo"><img src={{ asset('img/yellow_project_box.png') }}></a>
      <a class="item-rosa"><img src={{ asset('img/pink_project_box.png') }}></a>
      <a class="item-azul"><img src={{ asset('img/blue_project_box.png') }}></a>
      <a class="item-verde"><img src={{ asset('img/green_project_box.png') }}></a>
      <h1 class="title">Contact Us</h1>
    </div>
  </div>
  <div class="line"></div>
  <div class="form">
    <form  method="POST" action="{{ action('NonAuthController@sendEmail') }}" id="contact-form">
      <div class="name-email">
        <div class="name">
          <p><label for="name">Name</label></p>
          <input type="text" class="name-textbox" id="name" name="name">
        </div>
        <div class="email">
          <p><label for="email">Email</label></p>
          <input type="email" class="email-textbox" id="email" name="email">
        </div>
      </div>
      <div class="message">
        <p><label for="message">Message</label></p>
        <textarea type="text" class="message-textbox" id="message" name="message"  maxlength="1000" form="contact-form"></textarea>
      </div>
      <div class="submit">
        <input class="submit-button" type="submit" name="submit" value="Send">
      </div>
    </div>
  </form>

</section>



@endsection
