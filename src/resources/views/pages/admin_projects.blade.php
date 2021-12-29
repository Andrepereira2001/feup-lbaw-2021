@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

<section id="projects">
    <!-- Button trigger modal -->

    <form class="search">
        <div class="order">
            <div>
                <input type="text" id = "search" name="search" placeholder="project name"/>
                <label for = "search"> <img src={{ asset('img/lupa.png') }} width="30px"> </label>
            </div>

            <div>
                <input type="radio" id = "alphabetic" name="order" value="name" {{$name}}/>
                <label for= "alphabetic"> <img src={{ asset('img/sort-az.png') }} width="30px" height="30px"> </label>
            </div>

            <div>
                <input type="radio" id = "creation" name="order" value="created_at" {{$created_at}}/>
                <label for= "creation"> <img src={{ asset('img/recent.png') }} width="30px" height="30px"> </label>
            </div>
        </div>
        <div class="projets-display">
            @each('partials.project', $projects, 'project')
        </div>
    </form>
</section>

@endsection
