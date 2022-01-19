@extends('layouts.app')

@section('content')

<?php
    $projectColor = "{$task->project->color}cc";
?>

<style>

    #task-edit.id-{{$task->id}} .content{
        border-color: {{$projectColor}};
    }

    #task-edit.id-{{$task->id}} .info-created {
        background-color: {{$projectColor}};
    }

</style>

    <section id="task-edit" class="id-{{$task->id}}" data-id={{$task->id}} >
        <form class="edit">
            <div class="info-created">
                <input class="name" type="text" placeholder="Task ..." name="name" size="30" value="{{$task->name}}">
                <div class="box-descript">
                    <input class="description" type="text" placeholder="Add a description..." name="description" value="{{$task->description}}">
                    <div class="config">
                        <div class="due-date">
                            <span>Due Date:</span>
                            <input class="date" type="date" name="date" value="{{$task->due_date}}">
                        </div>
                        <div class="priority">
                            <span>Priority:</span>
                            <input class="number" type="number" name="priority" value="{{$task->priority}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="task assigned">
                <span>Assigned To</span>
                <div class="content">
                  @each('partials.user_remove', $task->user()->get(), 'user')
                </div>
            </div>
            @if (!empty($task->labels()->orderBy('id')->get()[0]))
                <div class="task labels">
                    <span>Labels</span>
                    <div class="content">
                        @each('partials.label_remove', $task->labels()->orderBy('id')->get() , 'label')
                    </div>
                </div>
            @endif

            @if (!empty($task->taskComments()->orderBy('id')->get()[0]))
                <div class="task comments">
                    <span>Comments</span>
                    <div class="content">
                        <ul class="forum">
                            @each('partials.comment', $task->taskComments()->orderBy('id')->get(), 'comment')
                        </ul>
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
