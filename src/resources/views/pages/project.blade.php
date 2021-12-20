@extends('layouts.app')

@section('title', $project->name)

@section('content')

  <section id="project">
    <div class="title-box">
      <h1>{{ $project->name }}</h1>
      <a href="/projects/{{$project->id}}/details">View Project Details</a>
    </div>
    <div class="todo-box">
      <h2>TO-DO</h2>
      <form>
        <input type="text" id="task-search" name="search" placeholder="Task"/>
        <label for="task-search"> <img src={{ asset('img/lupa.png') }} width="30px"> </label>
      </form>
      <ul>
        @each('partials.task', $project->tasks()->orderBy('id')->get(), 'item')
      </ul>
    </div>
    <div class="done-box">
      <h2>DONE</h2>
    </div>
    <div class="forum-box">
      <h2>Forum</h2>
    </div>
  </section>

@endsection
