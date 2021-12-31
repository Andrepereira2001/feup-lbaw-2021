@extends('layouts.app')

<style>

    #task-details.id-{{$task->id}} .content{
        border-color: {{$task->project->color}};
    }

    #task-details.id-{{$task->id}} .info{
        background-color: {{$task->project->color}};
    }

</style>

@section('content')

<?php
    $date = "";
    if($task->due_date != null)
        $date =substr($task->due_date, 0, 10);

?>
  <section id="task-details" class="id-{{$task->id}}" data-id={{$task->id}}>
    @include('partials.add_popup',['name' => "assign-member", 'title' => "Assign member",'project_id' => $task->project->id, 'users' => $task->project->users()->get()])

    <div id="sidenav" class="sidenav">
        <div id="sidenavleft" class="{{$selected}}">
            <a  href="/tasks/{{$task->id}}" id="view">Task Details
            <img src={{ asset('img/arrow.png') }} class="arrow"></a>
        </div>
        <div id="sidenavleft" class="sidenavleft">
            <a href="/projects/{{$task->id_project}}" id="notification">Project Page
            <img src={{ asset('img/arrow.png') }} class="arrow"></a>
        </div>
    </div>

    <div class="info">
        <h1>{{ $task->name }}</h1>
        <div class="box-descript">
            <span class="description">{{ $task->description }}</span>
            <div class="config">
                <span class="date" type="date">Due Date: {{$date }}</span>
                <span class="priority">Priority: {{ $task->priority }}</span>
            </div>
        </div>
    </div>
    <div class="assigned">
      <span>Assigned To</span>
      <div class="content">
          @each('partials.user', $task->user()->get()  , 'user')
          @if ($task->finished_at == null)
          <button type="button" class="add" data-toggle="modal" data-target="#assign-member"><img src={{ asset('img/add.png') }}></button>
          @endif
      </div>
    </div>
    <div class="labels">
        <span>Labels</span>
        <div class="content">
            To be defined
            {{-- @each('partials.label', $task->labels()->orderBy('id')->get() , 'label') --}}
        </div>
    </div>
    <div class="comments">
        <span>Comments</span>
        <div class="content">
            TO BE DEFINED
            {{-- @each('partials.taskComment', $task->taskComments()->orderBy('id')->get(), 'taskComment') --}}
        </div>
    </div>
    <div class="buttons">
        @if($task->finished_at === null)
            <a href="/tasks/{{$task->id}}/edit/" class="edit">Edit</a>
            <button type="button" class="complete">Complete</a>
        @endif
    </div>
  </section>

@endsection
