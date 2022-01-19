@extends('layouts.app')

@section('title', 'Projects')

@section('content')

<section id="projects">
    <form class="search-tab">
        <fieldset class="order">
            <div>
                <label for = "search"> <img alt="Search" src={{ asset('img/lupa.png') }} > </label>
                <input type="text" id="search" class="search" name="search" placeholder="Search for Project" value="{{$search}}"/>
            </div>

            <div>
                <input type="radio" id = "alphabetic" name="order" value="name" {{$name}}/>
                <label for= "alphabetic" class="button_projects"> <img alt="Alphabetic sort" src={{ asset('img/sort-az.png') }} > </label>
            </div>

            <div>
                <input type="radio" id = "creation" name="order" value="created_at" {{$created_at}}/>
                <label for= "creation" class="button_projects"> <img alt="Date sort" src={{ asset('img/recent.png') }} > </label>
            </div>

            <button type="submit" >Search</button>
        </fieldset>
        <fieldset class="filters">
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
        </fieldset>
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
