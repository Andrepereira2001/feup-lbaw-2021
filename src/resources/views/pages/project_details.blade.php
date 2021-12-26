@extends('layouts.app')

@section('title', $project->name)

<style>

    #project-details.id-{{$project->id}} .content{
        border-color: {{$project->color}};
    }

    #project-details.id-{{$project->id}} .info{
        background-color: {{$project->color}};
    }

</style>

@section('content')

  <section id="project-details" class="id-{{$project->id}}">
    <div class="info">
        <h1>{{ $project->name }}</h1>
        <span>{{ $project->description }}</span>
    </div>
    <div class="coordinators">
      <span>Coordinators</span>
      <div class="content">
        @each('partials.user', $project->users()->wherePivot("role","Coordinator")->orderBy('id')->get()  , 'user')
      </div>
    </div>
    <div class="members">
        <span>Members</span>
        <div class="content">
            @each('partials.user', $project->users()->wherePivot("role","Member")->orderBy('id')->get() , 'user')
        </div>
    </div>
    <div class="labels">
        <span>Labels</span>
        <div class="content">
            TO BE DEFINED
            {{-- @each('partials.label', $project->labels()->orderBy('id')->get(), 'label') --}}
        </div>
    </div>
    <div class="buttons">
        <a href="/projects/{{$project->id}}/edit/" class="edit">Edit</a>
    </div>
  </section>

@endsection
