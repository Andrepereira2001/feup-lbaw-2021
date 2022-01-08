@extends('layouts.static')

@section('content')

<section id="blocked">
  <div class="grid">
    <div class="grid-container">
      <a class="item-amarelo"><img src={{ asset('img/yellow_project_box.png') }}></a>
      <a class="item-rosa"><img src={{ asset('img/pink_project_box.png') }}></a>
      <a class="item-azul"><img src={{ asset('img/blue_project_box.png') }}></a>
      <a class="item-verde"><img src={{ asset('img/green_project_box.png') }}></a>
      <h1 class="title">Account Blocked</h1>
    </div>
  </div>
  <div class="line"></div>
  <div class="text">Due to your actions your account have been blocked</div>
</section>

@endsection
