@extends('layouts.app')

@section('title', 'Admin')

@section('content')

<section id="projects">
    <!-- Button trigger modal -->

    <form class="search">
        <div class="order">
            <div>
                <input type="text" id = "search" name="search" placeholder="project name"/>
                <label for = "search"> <img alt="Search"  src={{ asset('img/lupa.png') }} width="30px"> </label>
            </div>

            <div>
                <input type="radio" id = "alphabetic" name="order" value="name" {{$name}}/>
                <label for= "alphabetic"> <img alt="Alphabetic sort" src={{ asset('img/sort-az.png') }} width="30px" height="30px"> </label>
            </div>

            <div>
                <input type="radio" id = "creation" name="order" value="created_at" {{$created_at}}/>
                <label for= "creation"> <img alt="Date sort" src={{ asset('img/recent.png') }} width="30px" height="30px"> </label>
            </div>

            <button type="submit" >Search</button>
        </div>
        <div class="projets-display">
            @each('partials.project', $projects, 'project')
        </div>
    </form>
</section>

@endsection
