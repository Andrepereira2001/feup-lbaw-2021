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
                <input class="name" type="text" placeholder="Project Name..." name="name" size="30" value={{$project->name}}>
                <input type="text" placeholder="Add a description..." name="description" value={{$project->description}}>
                <input class="color" type="color" name="color" value={{$project->color}}>
            </div>
            <div class="coordinators">
                <span>Coordinators</span>
                <div class="content">
                  @each('partials.user', $project->users()->wherePivot("role","Coordinator")->orderBy('id')->get()  , 'user')
                </div>
            </div>
            <div class="members">
                <span>Members</span>
                <div class="content">
                    @each('partials.user', $project->users()->wherePivot("role","Member")->orderBy('id')->get() , 'user')
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
                <a href="/projects/{{$project->id}}/details" class="cancel">Cancel</a>
            </div>
        </form>
    </section>
@endsection
