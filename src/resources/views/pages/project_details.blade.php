@extends('layouts.app')

@section('title', $project->name)
<?php
    $projectColor = "{$project->color}cc";
?>

<style>

    #project-details.id-{{$project->id}} .content-inside {
        border-color: {{$projectColor}};
    }

    #project-details.id-{{$project->id}} .info-created {
        background-color: {{$projectColor}};
    }

</style>

@section('content')

<section id="project-details" class="id-{{$project->id}}" data-id={{$project->id}}>
    @if (!Auth::guard('admin')->user())
    @include('partials.popup',['name' => "leave-project", 'title' => "Are you sure you want to leave project?",'project_id' => Auth::user()->id])
    @include('partials.add_popup',['name' => "add-coordinator", 'title' => "Add Coordinator",'project_id' => $project->id, 'users' => $project->users()->wherePivot("role","Member")->get()])
    @include('partials.add_popup',['name' => "invite-member", 'title' => "Invite user",'project_id' => $project->id, 'users' => $noMembers])
    @include('partials.label_create_popup',['name' => "add-label", 'title' => "Add label",'project_id' => $project->id, 'users' => $noMembers])
    @endif
    @include('partials.popup',['name' => "delete-project", 'title' => "Are you sure you want to delete project?",'project_id' => $project->id])

    <div id="sidenav" class="sidenav">
        <div id="sidenavleft" class="{{$selected}}">
            <a  href="/projects/{{$project->id}}/details" id="view">Project Details
            <img src={{ asset('img/arrow.png') }} class="arrow"></a>
        </div>
        <div id="sidenavleft" class="sidenavleft">
            <a href="/projects/{{$project->id}}" id="notification">Project Page
            <img src={{ asset('img/arrow.png') }} class="arrow"></a>
        </div>
    </div>

    <div class="info-created">
        <h1 class="name-proj">{{ $project->name }}</h1>
        <span>{{ $project->description }}</span>
    </div>

    <div class="coordinators">
      <span class="section-title">Coordinators</span>
      <div class="content-inside">
        @each('partials.user', $project->users()->wherePivot("role","Coordinator")->orderBy('id')->get()  , 'user')
        @if ($isCoordinator && $project->archived_at == null)
            <button type="button" class="add" data-toggle="modal" data-target="#add-coordinator"><img src={{ asset('img/add.png') }} width="30px"></button>
        @endif
      </div>
    </div>

    @if ((!$isCoordinator && !empty($project->users()->wherePivot("role","Member")->get()[0])) || $isCoordinator)
        <div class="members">
            <span class="section-title">Members</span>
            <div class="content-inside">
                @each('partials.user', $project->users()->wherePivot("role","Member")->orderBy('id')->get() , 'user')
                @if($isCoordinator && $project->archived_at == null)
                    <button type="button" class="add" data-toggle="modal" data-target="#invite-member"><img src={{ asset('img/add.png') }} width="30px"></button>
                @endif
            </div>
        </div>
    @endif

    @if ((!$isCoordinator && !empty($project->labels()->orderBy('id')->get()[0])) || $isCoordinator)
        <div class="labels">
            <span class="section-title">Labels</span>
            <div class="content-inside">
                @each('partials.label', $project->labels()->orderBy('id')->get(), 'label')
                @if($isCoordinator && $project->archived_at == null)
                    <button type="button" class="add" data-toggle="modal" data-target="#add-label"><img src={{ asset('img/add.png') }} width="30px"></button>
                @endif
            </div>
        </div>
    @endif

    <div class="coordinator-buttons">
        @if ($isCoordinator && $project->archived_at == null)
            <a href="/projects/{{$project->id}}/edit/" class="btn edit">Edit</a>
            <button type="button" class="btn delete" data-toggle="modal" data-target="#delete-project">Delete</button>
            <button type="button" class="btn leave" data-toggle="modal" data-target="#leave-project">Leave</button>
        @elseif (Auth::guard('admin')->user())
            <button type="button" class="btn delete" data-toggle="modal" data-target="#delete-project">Delete</button>
        @else
            @if($project->archived_at == null)
                <button type="button" class="btn leave" data-toggle="modal" data-target="#leave-project">Leave</button>
            @endif
        @endif


    </div>

  </section>

@endsection
