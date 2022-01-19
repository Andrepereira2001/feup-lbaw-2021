@extends('layouts.app')

@section('content')

<?php
$projectColor = "{$project->color}cc";
?>

<style>
#project-edit.id-{{$project->id}} .content-inside {
    border-color: {{$projectColor}};
}

#project-edit.id-{{$project->id}} .info-created {
    background-color: {{$projectColor}};
}
</style>

    <section id="project-edit" class="id-{{$project->id}}" data-id={{$project->id}} >
        <form class="edit">

            <div class="info-created">
                <div class="title-input">
                    <input class="name-proj" type="text" placeholder="Project Name..." name="name" value="{{$project->name}}">
                </div>
                <input class="description-proj" type="text" placeholder="Add a description..." name="description" value="{{$project->description}}">
                <input class="color" type="color" name="color" value={{$project->color}}>
            </div>

            <div class="coordinators">
                <span class="section-title">Coordinators</span>
                <div class="content-inside">
                    <div class="list">
                        @each('partials.user_decrease', $project->users()->wherePivot("role","Coordinator")->orderBy('id')->get()  , 'user')
                    </div>
                </div>
            </div>

            @if (!empty($project->users()->wherePivot("role","Member")->get()[0]))
                <div class="members">
                    <span class="section-title">Members</span>
                    <div class="content-inside">
                        <div class="list">
                            @each('partials.user_remove', $project->users()->wherePivot("role","Member")->orderBy('id')->get() , 'user')
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($project->labels()->orderBy('id')->get()[0]))
                <div class="labels">
                    <span class="section-title">Labels</span>
                    <div class="content-inside">
                        <div class="list">
                            @each('partials.label_remove', $project->labels()->orderBy('id')->get(), 'label')
                        </div>
                    </div>
                </div>
            @endif

            <div class="coordinator-buttons">
                <button class="btn save" type="submit">Save</button>
                <a href="/projects/{{$project->id}}/details" class="btn cancel">Cancel</a>
            </div>
        </form>
    </section>
@endsection
