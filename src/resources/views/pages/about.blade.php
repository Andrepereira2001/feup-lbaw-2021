@extends('layouts.static')

@section('content')

<section id="about">
  <div class="grid-container">
    <a class="item-amarelo"><img src={{ asset('img/yellow_project_box.png') }}></a>
    <a class="item-rosa"><img src={{ asset('img/pink_project_box.png') }}></a>
    <a class="item-azul"><img src={{ asset('img/blue_project_box.png') }}></a>
    <a class="item-verde"><img src={{ asset('img/green_project_box.png') }}></a>
    <h1 class="title">About Us</h1>
  </div>
  <div class="line"></div>
  <div class="title2"> Project Management has never been easier </div>
  <div class="text">At toEaseManage we belive that there is a better way to manage your life and work projects.
A more valuable, secure way where our customers are earned rather than bought. We’re obssessively passionated about it, and our mission is to help YOU achieve your desired organization. We focus on keeping every thing simple for you. It’s one of the least understood and least transparent aspects of great management,  and we see that as an opportunity. We’re excited to simplify the life of everyone through our website, organization and community.</div>
</section>



@endsection
