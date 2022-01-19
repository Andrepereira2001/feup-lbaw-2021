@extends('layouts.app')

@section('title', 'Admin')

@section('content')

<section id="projects">
    <!-- Button trigger modal -->

    <form class="search-tab">
        <fieldset class="order">
            <div>
                <label for = "search"> <img alt="Search"  src={{ asset('img/lupa.png') }} width="30"> </label>
                <input type="text" id = "search" name="search" class="search" placeholder="project name"/>
            </div>

            <div>
                <input type="radio" id = "alphabetic" name="order" value="name" {{$name}}/>
                <label for= "alphabetic" class="button_projects" > <img alt="Alphabetic sort" src={{ asset('img/sort-az.png') }} width="30" height="30"> </label>
            </div>

            <div>
                <input type="radio" id = "creation" name="order" value="created_at" {{$created_at}}/>
                <label for= "creation" class="button_projects"> <img alt="Date sort" src={{ asset('img/recent.png') }} width="30" height="30"> </label>
            </div>

            <button type="submit" >Search</button>
        </fieldset>
        <div class="projets-display">
            @each('partials.project', $projects, 'project')
        </div>
    </form>
</section>

@endsection
