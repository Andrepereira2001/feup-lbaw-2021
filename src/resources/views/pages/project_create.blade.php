@extends('layouts.app')

@section('content')
    <section id="project-create">
        <form class="new_project">
            <div class="info">
                <input class="name" type="text" placeholder="Project Name..." name="name">
                <input type="text" placeholder="Add a description..." name="description">
                <div class="color">
                    <label form="project-color">Project color:</label>
                    <input id="project-color" type="color" name="color" value="#e66465">
                </div>
            </div>
            <div class="coordinators">
            <span>Coordinators</span>
            <div class="content">
                @include('partials.user', ['user' => $user])
            </div>
            </div>
            <div class="members">
                <span>Members</span>
                <div class="content">
                    {{-- @each('partials.user', $project->users()->wherePivot("role","Member")->orderBy('id')->get() , 'user') --}}
                </div>
            </div>
            <div class="labels">
                <span>Labels</span>
                <div class="content">
                    TO BE DEFINED
                    {{-- @each('partials.label', $project->labels()->orderBy('id')->get(), 'label') --}}
                </div>
            </div>
            <div class="buttons">
                <button class="save" type="submit">Save</button>
                <button class="cancel" type="submit">Cancel</button>
            </div>
        </form>
    </section>
@endsection
