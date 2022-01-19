@extends('layouts.app')

@section('content')

<?php
    $projectColor = "{$task->project->color}cc";
?>

<?php
    $date = "";
    if($task->due_date != null)
        $date =substr($task->due_date, 0, 10);
?>

<style>

    #task-edit.id-{{$task->id}} .content-inside {
        border-color: {{$projectColor}};
    }

    #task-edit.id-{{$task->id}} .info-created {
        background-color: {{$projectColor}};
    }

</style>

    <section id="task-edit" class="id-{{$task->id}}" data-id={{$task->id}} >
        <form class="edit">
            <div class="info-created">
                <div class="title-input">
                    <input class="name-proj" type="text" placeholder="Task ..." name="name" size="30" value="{{$task->name}}">
                </div>
                <div class="box-descript">
                    <input class="description-proj" type="text" placeholder="Add a description..." name="description" value="{{$task->description}}">
                    <div class="config">
                        <div class="due-date">
                            <span>Due Date:</span>
                            <input class="date" type="date" name="date" value="{{$date}}">
                        </div>
                        <div class="priority">
                            <span>Priority:</span>
                            <input class="number" type="number" name="priority" value="{{$task->priority}}">
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($task->user()->get()[0]) != null)
                <div class="task assigned">
                    <span class="section-title">Assigned To</span>
                    <div class="content-inside">
                        @each('partials.user_remove', $task->user()->get(), 'user')
                    </div>
                </div>
            @endif
            @if (!empty($task->labels()->orderBy('id')->get()[0]))
                <div class="labels">
                    <span class="section-title">Labels</span>
                    <div class="content-inside">
                        <div class="list">
                            @each('partials.label_remove', $task->labels()->orderBy('id')->get() , 'label')
                        </div>
                    </div>
                </div>
            @endif

            <div class="coordinator-buttons">
                <button class="btn save" type="submit">Save</button>
                <a href="/tasks/{{$task->id}}" class="btn cancel">Cancel</a>
            </div>
        </form>
    </section>
@endsection
