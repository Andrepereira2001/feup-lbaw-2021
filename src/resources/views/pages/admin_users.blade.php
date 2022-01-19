@extends('layouts.app')

@section('title', 'Admin')

@section('content')

<section id="admin">
    <div class="sidenav">
        <div class="sidenavleft">
            <a href="/admin/projects">Projects
            <img alt="Projects" src={{ asset('img/arrow.png') }} class="arrow"></a>
        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="search-tab">
        <input class= "search" type="text" name="search" placeholder="User name..."/>
        <label for = "search"> <img alt="Search" src={{ asset('img/lupa.png') }} width="30"> </label>
    </div>


    <div class="users-display">
        @each('partials.user_admin', $users, 'user')
    </div>
</section>

@endsection
