@extends('layouts.static')

@section('content')

<section id="contact">
  <div class="grid-container">
    <a class="item-amarelo"><img src={{ asset('img/yellow_project_box.png') }}></a>
    <a class="item-rosa"><img src={{ asset('img/pink_project_box.png') }}></a>
    <a class="item-azul"><img src={{ asset('img/blue_project_box.png') }}></a>
    <a class="item-verde"><img src={{ asset('img/green_project_box.png') }}></a>
    <h1 class="title">Contact Us</h1>
  </div>
  <div class="line"></div>
  <form method="post" action="/contact">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="message">Message:</label>
    <input type="text" id="message" name="message"><br><br>
    <input type="submit" name="submit" value="Send">
  </form>

</section>



@endsection
