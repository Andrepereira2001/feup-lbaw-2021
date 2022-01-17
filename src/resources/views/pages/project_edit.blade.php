@extends('layouts.app')

<style>
    #project-edit.id-{{$project->id}} .content{
        border-color: {{$project->color}};
    }

    #project-edit.id-{{$project->id}} .info{
        background-color: {{$project->color}};
    }
</style>
@section('content')
    <section id="project-edit" class="id-{{$project->id}}" data-id={{$project->id}} >
        <form class="edit">

            <div class="info">
                <input class="name" type="text" placeholder="Project Name..." name="name" value="{{$project->name}}">
                <input class="description" type="text" placeholder="Add a description..." name="description" value="{{$project->description}}">
                <input class="color" type="color" name="color" value={{$project->color}}>
            </div>

            <div class="coordinators">
                <span>Coordinators</span>
                <div class="content">
                  @each('partials.user_decrease', $project->users()->wherePivot("role","Coordinator")->orderBy('id')->get()  , 'user')
                </div>
            </div>

            @if (!empty($project->users()->wherePivot("role","Member")->get()[0]))
                <div class="members">
                    <span>Members</span>
                    <div class="content">
                        @each('partials.user_remove', $project->users()->wherePivot("role","Member")->orderBy('id')->get() , 'user')
                    </div>
                </div>
            @endif

            @if (!empty($project->labels()->orderBy('id')->get()[0]))
                <div class="labels">
                    <span>Labels</span>
                    <div class="content">
                        @each('partials.label_remove', $project->labels()->orderBy('id')->get(), 'label')
                    </div>
                </div>
            @endif

            <div class="buttons">
                <button class="save" type="submit">Save</button>
                <a href="/projects/{{$project->id}}/details" class="cancel">Cancel</a>
            </div>
        </form>
    </section>
@endsection
