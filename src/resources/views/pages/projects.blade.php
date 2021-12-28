@extends('layouts.app')

@section('title', 'Projects')

@section('content')

<section id="projects">
    <!-- Button trigger modal -->

    <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button>


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
            <a href="/projects">
                <article class="project create">
                    <img src={{ asset('img/create_project.png') }}>
                </article>
            </a>
            @each('partials.project', $projects, 'project')
        </div>
    </form>
</section>

@endsection
