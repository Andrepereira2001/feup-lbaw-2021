@extends('layouts.app')

@section('title', 'Projects')

@section('content')


<section id="projects">
    <form class="search">
        <div class="order">
            <div>
                <input type="text" id = "search" name="search" placeholder="project name"/>
                <label for = "search"> <img src={{ asset('img/lupa.png') }} width="30px"> </label>
            </div>

            <div>
                <input type="radio" id = "alphabetic" name="order" value="name"/>
                <label for= "alphabetic"> <img src={{ asset('img/sort-az.png') }} width="30px" height="30px"> </label>
            </div>

            <div>
                <input type="radio" id = "creation" name="order" value="created_at" checked/>
                <label for= "creation"> <img src={{ asset('img/recent.png') }} width="30px" height="30px"> </label>
            </div>
        </div>
        <div class="filters">
            <div>
                <input type = "checkbox" id = "favourite" name = "filters[]" value = "favourite" {{$favourite}}/>
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
            <article class="project create">
                <a href="/projects"><img src={{ asset('img/create_project.png') }}></a>
            </article>
            @each('partials.project', $projects, 'project')
        </div>
    </form>
</section>

@endsection
