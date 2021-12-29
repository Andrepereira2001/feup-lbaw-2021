@extends('layouts.app')

@section('content')
    <section id="task-create">
        <form class="create">
            <div class="info">
                <input class="project-id" name="project-id" value={{ $project->id }}>
                <input class="name" type="text" placeholder="Task Name..." name="name">
                <div class="box-descript">
                    <input class="description" type="text" placeholder="Add a description..." name="description">
                    <div class="priority">
                        <span>Priority:<span>
                        <input class="number" type="number" name="priority" value=3>
                    </div>
                </div>
                {{--priority--}}
            </div>
            <div class="coordinators">
                <span>Assigned To</span>
                <div class="content">
                    {{-- @include('partials.user', ['user' => $user]) --}}
                </div>
            </div>
            <div class="buttons">
                <button class="save" type="submit">Save</button>
                <a href="/projects/{{ $project->id }}" class="cancel">Cancel</a>
            </div>
        </form>
    </section>
@endsection
