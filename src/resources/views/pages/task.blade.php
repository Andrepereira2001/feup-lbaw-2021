@extends('layouts.app')

{{-- @section('title', $project->name) --}}

<style>

    #task-details.id-{{$task->id}} .content{
        border-color: {{$task->project->color}};
    }

    #task-details.id-{{$task->id}} .info{
        background-color: {{$task->project->color}};
    }

</style>

@section('content')

  <section id="task-details" class="id-{{$task->id}}">
    <div class="info">
        <h1>{{ $task->name }}</h1>
        <div class="box-descript">
            <span class="description">{{ $task->description }}</span>
            <span class="priority">Priority: {{ $task->priority }}</span>
        </div>
    </div>
    <div class="coordinators">
      <span>Assigned To</span>
      <div class="content">
          @each('partials.user', $task->user()->get()  , 'user')
      </div>
    </div>
    <div class="members">
        <span>Labels</span>
        <div class="content">
            To be defined
            {{-- @each('partials.label', $task->labels()->orderBy('id')->get() , 'label') --}}
        </div>
    </div>
    <div class="labels">
        <span>Comments</span>
        <div class="content">
            TO BE DEFINED
            {{-- @each('partials.taskComment', $task->taskComments()->orderBy('id')->get(), 'taskComment') --}}
        </div>
    </div>
    <div class="buttons">
        <a href="/tasks/{{$task->id}}/edit/" class="edit">Edit</a>
    </div>
  </section>

@endsection
