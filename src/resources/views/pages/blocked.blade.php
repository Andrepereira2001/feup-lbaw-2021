@extends('layouts.static')

@section('content')

<section id="blocked">
  <div class="grid">
    <div class="grid-container">
      <a class="item-amarelo"><img alt="Yellow box" src={{ asset('img/yellow_project_box.png') }}></a>
      <a class="item-rosa"><img alt="Pink box" src={{ asset('img/pink_project_box.png') }}></a>
      <a class="item-azul"><img alt="Blue box" src={{ asset('img/blue_project_box.png') }}></a>
      <a class="item-verde"><img alt="Green box" src={{ asset('img/green_project_box.png') }}></a>
      <h1 class="title">Account Blocked</h1>
    </div>
  </div>
  <div class="line"></div>
  <div class="text">Due to your actions your account have been blocked</div>
</section>

@endsection
