@extends('layouts.app')



@section('content')

<?php
    $projectColor = "{$task->project->color}cc";
?>

<style>

    #task-details.id-{{$task->id}} .content {
        border-color: {{$projectColor}};
    }

    #task-details.id-{{$task->id}} .info-created {
        background-color: {{$projectColor}};
    }

</style>

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

    <div class="info-created">
        <h1>{{ $task->name }}</h1>
        <div class="box-descript">
            <span class="description">{{ $task->description }}</span>
            <div class="config">
                <span class="date">Due Date: {{$date }}</span>
                <span class="priority">Priority: {{ $task->priority }}</span>
            </div>
        </div>
    </div>
    <div class="task assigned">
      <span>Assigned To</span>
      <div class="content-inside">
          @each('partials.user', $task->user()->get()  , 'user')
          @if ($task->finished_at == null && !Auth::guard('admin')->user())
            <button type="button" class="add" data-toggle="modal" data-target="#assign-member"><img alt="Assign member" src={{ asset('img/add.png') }} width="30"></button>
          @endif
      </div>
    </div>
    {{-- @if ($task->finished_at != null && !empty($task->labels()->get()[0])) --}}
        <div class="task labels">
            <span>Labels</span>
            <div class="content-inside">
                @each('partials.label', $task->labels()->orderBy('id')->get() , 'label')
                @if ($task->finished_at == null && !Auth::guard('admin')->user())
                    <button type="button" class="add" data-toggle="modal" data-target="#assign-label"><img alt="Assing label" src={{ asset('img/add.png') }} width="30"></button>
                @endif
            </div>
        </div>
    {{-- @endif
    @elseif  --}}
    <div class="task comments">
        <span>Comments</span>
        <div class="content-inside">
            <ul class="forum">
                @each('partials.comment', $comments, 'comment')
            </ul>
            <form class="new-message" data-id={{ Auth::user()->id}}>
                <input class="message-input" type="text" name="content" placeholder="New Comment">
                <button class="submit" type="submit"><img alt="Send Comment" src={{ asset('img/send.png') }}></button>
            </form>
        </div>
    </div>
    <div class="coordinator-buttons">
        @if($task->finished_at === null  && !Auth::guard('admin')->user())
            <a href="/tasks/{{$task->id}}/edit/" class="btn edit">Edit</a>
            <button type="button" class="btn complete">Complete</button>
        @endif
    </div>
  </section>

@endsection
