@extends('layouts.app')

@section('content')
    <section id="task-create">
        @include('partials.add_popup',['name' => "assign-member", 'title' => "Assign member",'project_id' => $project->id, 'users' => $project->users()->get()])
        <form class="create">
            <div class="info">
                <input class="project-id" name="project-id" value={{ $project->id }}>
                <input class="name" type="text" placeholder="Task Name..." name="name">
                <div class="box-descript">
                    <input class="description" type="text" placeholder="Add a description..." name="description">
                    <div class="config">
                        <div class="due-date">
                            <span>Due Date:</span>
                            <input class="date" type="date" name="date" value="">
                        </div>
                        <div class="priority">
                            <span>Priority:
                            <input class="number" type="number" name="priority" min="1" max="5" value=3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="coordinators">
                <span>Assigned To</span>
                <input type="hidden" name="user-id">
                <div class="content">
                    {{-- @include('partials.user', ['user' => $user]) --}}
                    <button type="button" class="add" data-toggle="modal" data-target="#assign-member"><img src={{ asset('img/add.png') }}></button>
                </div>
            </div>
            <div class="buttons">
                <button class="save" type="submit">Save</button>
                <a href="/projects/{{ $project->id }}" class="cancel">Cancel</a>
            </div>
        </form>
    </section>
@endsection
