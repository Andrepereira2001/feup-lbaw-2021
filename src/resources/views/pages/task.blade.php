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
    @include('partials.label_assign_popup',['name' => "assign-label", 'title' => "Add label",'project_id' => $project->id, 'notAssigned' => $notAssigned])

    <div id="sidenav" class="sidenav">
        <div id="sidenavleft" class="{{$selected}}">
            <a  href="/tasks/{{$task->id}}" id="view">Task Details
            <img alt="Task Details" src={{ asset('img/arrow.png') }} class="arrow"></a>
        </div>
        <div id="sidenavleft" class="sidenavleft">
            <a href="/projects/{{$task->id_project}}" id="notification">Project Page
            <img alt="Project" src={{ asset('img/arrow.png') }} class="arrow"></a>
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
          @if ($task->finished_at == null && !Auth::guard('admin')->user())
            <button type="button" class="add" data-toggle="modal" data-target="#assign-member"><img src={{ asset('img/add.png') }} width="30px"></button>
          @endif
      </div>
    </div>
    <div class="labels">
        <span>Labels</span>
        <div class="content">
            @each('partials.label', $task->labels()->orderBy('id')->get() , 'label')
            @if ($task->finished_at == null && !Auth::guard('admin')->user())
                <button type="button" class="add" data-toggle="modal" data-target="#assign-label"><img src={{ asset('img/add.png') }} width="30px"></button>
            @endif
        </div>
    </div>
    <div class="comments">
        <span>Comments</span>
        <div class="content">
            <ul class="forum">
                @each('partials.comment', $comments, 'comment')
            </ul>
            <form class="new-message" data-id={{ Auth::user()->id}}>
                <input type="text" name="content" placeholder="New Comment">
                <button class="submit" type="submit"><img src={{ asset('img/send.png') }}></button>
            </form>
        </div>
    </div>
    <div class="coordinator-buttons">
        @if($task->finished_at === null  && !Auth::guard('admin')->user())
            <a href="/tasks/{{$task->id}}/edit/" class="edit">Edit</a>
            <button type="button" class="complete">Complete</a>
        @endif
    </div>
  </section>

@endsection
