@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user-edit">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <article class="user" data-id="{{$user->id}}">
        <div id="sidenav" class="sidenav">
            <div id="sidenavleft" class="{{$selected}}">
                <a  href="/users/profile/{{$user->id}}" id="view">{{$view}} Profile
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
            <div id="sidenavleft" class="sidenavleft">
                <a href="#" id="notification">Notification
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
            <div id="sidenavleft" class="sidenavleft">
                <a href="/users/profile/{{$user->id}}/delete" id="delete">Delete Profile
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
            <div id="sidenavleft" class="sidenavleft">
                <a href="{{ url('/logout') }}">Logout
                <img src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
        </div>
        <div class="userInfo" id="edit">
            <form class="info">
                <a class="userIcon"><?php
                    if ($user->image_path != "./img/default") {
                    echo '<img src=' . asset($user->image_path) . ' class="profilePhoto" >';
                    }
                    else echo '<span class="profilePhoto"></span>';
                ?>
                <img src={{ asset('img/editBlue.png') }} class="editIconBlue"></a>
                <section class="writtenInfo">
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
                        <div class="eye">
                            <input id="password" type="password" name="password">
                            <i class="far fa-eye" id="togglePassword" onmousedown ="document.getElementById('password').type='text';" onmouseup="document.getElementById('password').type='password';"></i>
                        </div>
                    </div>
                    <div class="pass">
                        <label for="cPassword">Confirm Password</label>
                        <div class="eye">
                            <input id="cPassword" type="password" name="cPassword">
                            <i class="far fa-eye" id="togglePassword"  onmousedown ="document.getElementById('cPassword').type='text';" onmouseup="document.getElementById('cPassword').type='password';" ></i>
                        </div>
                    </div>
                </section>
                <div class="editButtons">
                    <button class="save" type="submit">Save</button>
                    <a class="cancel" href="/users/profile/{{$user->id}}">Cancel</a>
                </div>
                <span id="error">Error</span>
            </form>
        </div>
    </article>
</section>

@endsection
