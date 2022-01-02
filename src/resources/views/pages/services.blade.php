@extends('layouts.static')

@section('content')

<section id="services">
  <div class="grid-container">
    <a class="item-amarelo"><img src={{ asset('img/yellow_project_box.png') }}></a>
    <a class="item-rosa"><img src={{ asset('img/pink_project_box.png') }}></a>
    <a class="item-azul"><img src={{ asset('img/blue_project_box.png') }}></a>
    <a class="item-verde"><img src={{ asset('img/green_project_box.png') }}></a>
    <h1 class="title">Services</h1>
  </div>
  <div class="line"></div>
  <div class="enumeration">
    <div class="box"><img src={{ asset('img/blue_project_box.png') }} width="65px"><span class="description"> At toEaseManage, all users can create or be part of many projects.</span></div>
    <div class="box"><img src={{ asset('img/blue_project_box.png') }} width="65px"><span class="description"> With the task labeling and assignement system, it’s easy to have a properly organized teamwork.</span></div>
    <div class="box"><img src={{ asset('img/blue_project_box.png') }} width="65px"><span class="description"> Any doubts obout a project can be answered by other members of the project in our forum, a very simple chat room where users can post doubts, thoughts and ideas.</span></div>
  </div>

</section>

@endsection
