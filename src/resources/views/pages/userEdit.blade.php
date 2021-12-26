@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user-edit">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <article class="user" data-id="{{$user->id}}">
        <div class="sidebar">
            <div id="mySidenav" class="sidenav">
                <a class="{{$selected}}" href="/users/profile/{{$user->id}}" id="view">{{$view}} Profile
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
                <a href="#" id="notification">Notification
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
                <a href="/users/profile/{{$user->id}}/delete" id="delete">Delete Profile
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
                <a href="{{ url('/logout') }}">Logout
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
        </div>
        <div class="userInfo" id="edit">
            <form class="info">
                <a><?php
                    if ($user->image_path != "./img/default") {
                    echo '<img src=' . asset($user->image_path) . ' class="profilePhoto" >';
                    }
                    else echo '<span class="profilePhoto"></span>';
                ?>
                <img src={{ asset('img/editBlue.png') }} class="editIconBlue"></a>
                <section>
                    <div>
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" value="{{$user->name}}"/>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email" value="{{$user->email}}">
                    </div>
                    <div class="pass">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" value="{{$user->password}}">
                        <i class="far fa-eye" id="togglePassword"></i>
                    </div>
                    <div class="pass">
                        <label for="cPassword">Confirm Password</label>
                        <input id="cPassword" type="password" name="cPassword" value="{{$user->password}}">
                        <i class="far fa-eye" id="togglePassword"></i>
                    </div>
                </section>
                <div>
                    <button class="editButtons save" type="submit">Save</button>
                    <a class="editButtons cancel" href="/users/profile/{{$user->id}}">Cancel</a>
                </div>
                <span id="error">Error</span>
            </form>
        </div>
    </article>
</section>

@endsection
