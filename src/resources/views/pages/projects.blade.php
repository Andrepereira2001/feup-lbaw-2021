@extends('layouts.app')

@section('title', 'Projects')

@section('content')

<section id="projects">
    <form class="search">
        <div class="order">
            <div>
                <label for = "search"> <img src={{ asset('img/lupa.png') }} width="20px"> </label>
                <input type="text" id = "search" name="search" placeholder="Search for Project" value="{{$search}}"/>
            </div>

            <div>
                <input type="radio" id = "alphabetic" name="order" value="name" {{$name}}/>
                <label for= "alphabetic" class="button_projects"> <img src={{ asset('img/sort-az.png') }} width="20px"> </label>
            </div>

            <div>
                <input type="radio" id = "creation" name="order" value="created_at" {{$created_at}}/>
                <label for= "creation" class="button_projects"> <img src={{ asset('img/recent.png') }} width="20px"> </label>
            </div>

            <button type="submit" >Search</button>
        </div>
        <div class="filters">
            <div>
                <input type = "checkbox" id = "favourite" name = "filters[]" class="favourite" value = "favourite" {{$favourite}}/>
                <label for = "favourite"> Favourite </label>
            </div>
            <div>
                <input type = "checkbox" id = "coordinator" name = "filters[]" value = "coordinator" {{$coordinator}} />
                <label for = "coordinator"> Coordinator </label>
            </div>
            <div>
                <input type = "checkbox" id = "member" name = "filters[]" value = "member" {{$member}}/>
                <label for = "member"> Member </label>
            </div>
            <div>
                <input type = "checkbox" id = "archived" name = "filters[]" value = "archived" {{$archived}}/>
                <label for = "archived"> Archived </label>
            </div>
        </div>
        <div class="projets-display">
            <a href="/projects">
                <article class="project create">
                    <img src={{ asset('img/add.png') }}>
                </article>
            </a>
            @each('partials.project', $projects, 'project')
        </div>
        {{-- <div class="width_white">
            <span>white</span>
        </div> --}}
    </form>
</section>

@endsection
