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

<section id="project-details" class="id-{{$project->id}}" data-id={{$project->id}}>
    @include('partials.popup',['name' => "leave-project", 'title' => "Are you sure you want to leave project?",'project_id' => $project->id])
    @include('partials.popup',['name' => "delete-project", 'title' => "Are you sure you want to delete project?",'project_id' => $project->id])
    @include('partials.add_popup',['name' => "add-coordinator", 'title' => "Add Coordinator",'project_id' => $project->id, 'users' => $project->users()->wherePivot("role","Member")->get()])
    @include('partials.add_popup',['name' => "invite-member", 'title' => "Invite user",'project_id' => $project->id, 'users' => $noMembers])
    <div class="info">
        <h1>{{ $project->name }}</h1>
        <span>{{ $project->description }}</span>
    </div>
    <div class="coordinators">
      <span>Coordinators</span>
      <div class="content">
        @each('partials.user', $project->users()->wherePivot("role","Coordinator")->orderBy('id')->get()  , 'user')
        <button type="button" class="add" data-toggle="modal" data-target="#add-coordinator"><img src={{ asset('img/add.png') }}></button>
      </div>
    </div>
    <div class="members">
        <span>Members</span>
        <div class="content">
            @each('partials.user', $project->users()->wherePivot("role","Member")->orderBy('id')->get() , 'user')
            <button type="button" class="add" data-toggle="modal" data-target="#invite-member"><img src={{ asset('img/add.png') }}></button>
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
        @if ($isCoordinator)
        <a href="/projects/{{$project->id}}/edit/" class="edit">Edit</a>
        <button type="button" class="delete" data-toggle="modal" data-target="#delete-project">Delete</button>
        @endif
        <button type="button" class="leave" data-toggle="modal" data-target="#leave-project">Leave</button>

    </div>

  </section>

@endsection
