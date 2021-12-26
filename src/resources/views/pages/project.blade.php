@extends('layouts.app')

@section('title', $project->name)

@section('content')

  <section id="project">
    <div class="title-box">
      <h1><span>{{ $project->name }}</span></h1>
      <a href="/projects/{{$project->id}}/details">View Project Details</a>
    </div>
    <div class="todo-box">
      <div class="todo-search">
        <h2>TO-DO</h2>
        <form>
          <input type="text" id="task-search" name="search" placeholder="Task"/>
          <label for="task-search"> <img src={{ asset('img/lupa.png') }} width="30px"> </label>
        </form>
      </div>
      <ul>
        @each('partials.task', $tasksTodo, 'task')
      </ul>
    </div>
    <div class="done-box">
      <h2>DONE</h2>
      <ul class="tasksDone">
        @each('partials.taskDone', $tasksTodo, 'task')
      </ul>
    </div>
    <div class="forum-box">
      <h2>Forum</h2>
    </div>
  </section>

@endsection
