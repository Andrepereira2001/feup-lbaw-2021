@extends('layouts.app')

@section('title', $project->name)
<?php
    $projectColor = "{$project->color}40";
?>
<style>

    #project.id-{{$project->id}} .todo-box{
        background-color: {{$projectColor}};
    }

    #project.id-{{$project->id}} .done-box{
        background-color: {{$projectColor}};
    }

    #project.id-{{$project->id}} .forum-box{
        background-color: {{$projectColor}};
    }

</style>

@section('content')

  <section id="project" class="id-{{$project->id}}" data-id={{$project->id}}>
    <div class="title-box">
      <h1><span>{{ $project->name }}</span></h1>
      <a href="/projects/{{$project->id}}/details">View Project Details</a>
    </div>
    <div class="todo-box">
      <div class="todo-search">
        <h2>TO-DO</h2>
        <form>
          <label for="task-search"> <img src={{ asset('img/lupa.png') }}> </label>
          <input type="text" id="task-search" name="search" placeholder="Search for Task"/>
        </form>
      </div>
      <ul class="tasksToDo">
        @each('partials.task', $tasksTodo, 'task')
      </ul>
      @if(Auth::user())
        <a href="/projects/{{$project->id}}/tasks" class="add-task"><img src={{ asset('img/add.png') }}></a>
      @endif
    </div>
    <div class="done-box">
      <h2>DONE</h2>
      <ul class="tasksDone">
        {{-- !!! to change to Done --}}
        @each('partials.taskDone', $tasksDone, 'task')
      </ul>
    </div>
    <div class="forum-box">
      <h2>FORUM</h2>
      <div class="forum-messages">
        <ul class="forum">
        @each('partials.forumMessage', $forumMessages, 'forumMessage')
        </ul>
        <form class="new-message" data-id={{ Auth::user()->id}}>
            <input type="text" name="content" placeholder="Message">
            <button class="submit" type="submit"><img src={{ asset('img/send.png') }}></button>
        </form>
      </div>
    </div>
  </section>

@endsection
