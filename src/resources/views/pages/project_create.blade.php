@extends('layouts.app')

@section('content')
    <section id="project-create">
        <form class="create">
            <div class="info">
                <input class="name" type="text" placeholder="Project Name..." name="name">
                <input class="description" type="text" placeholder="Add a description..." name="description">
                <input class="color" type="color" name="color" value="#595656">
            </div>
            <div class="coordinators">
                <span>Coordinators</span>
                <div class="content">
                    @include('partials.user', ['user' => $user])
                </div>
            </div>
            <div class="coordinator-buttons">
                <button class="btn save" type="submit">Save</button>
                <a href="/users" class="btn cancel">Cancel</a>
            </div>
        </form>
    </section>
@endsection
