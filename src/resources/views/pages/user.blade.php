@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <article class="user">
        <div class="sidebar">
            <div id="mySidenav" class="sidenav">
                <a href="/users/profile/{{$user->id}}/update" id="view">View Profile
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
                <a href="#" id="notification">Notification
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
                <a href="delete" id="delete">Delete Profile
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
                <a href="{{ url('/logout') }}">Logout
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
        </div>
        <div class="userInfo" id="view">
            <form class="info" method="POST" action="{{ url('users/profile/' . $user->id . '/update') }}">
                {{ csrf_field() }}
                <?php
                    if ($user->image_path != "./img/default") {
                       echo '<img src=' . asset($user->image_path) . ' class="profilePhoto" >';
                    }
                    else echo '<span class="profilePhoto"></span>';
                ?>
                <section>
                    <div class="full">
                        <label for="fname">First Name</label>
                        <input id="fname" type="text" name="fname" value="{{$fname}}" disabled>
                    </div>
                    <div class="full" id="lname">
                        <label for="lName">Last Name</label>
                        <input id="lName" type="text" name="lName" value="{{$lname}}" disabled>
                    </div>
                </section>
                <section>
                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email" value="{{$user->email}}" disabled>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" value="{{$user->password}}" disabled>
                    </div>
                    <div>
                        <img src={{ asset('img/edit.png') }} class="editIcon">
                    </div>
                </section>
            </form>
        </div>
        <div class="userInfo" id="edit">
            <form name="message" class="info" method="POST" action="{{ url('users/profile/' . $user->id . '/update') }}">
                {{ csrf_field() }}
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
                    <button class="editButtons cancel" type="button">Cancel</button>
                </div>
            </form>
        </div>
    </article>
</section>

@endsection
