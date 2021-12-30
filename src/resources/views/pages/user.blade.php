@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <article class="user">
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
        <div class="userInfo" id="view">
            <form class="info">
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
                        <a href="/users/profile/{{$user->id}}/update"><img src={{ asset('img/edit.png') }} class="editIcon"></a>
                    </div>
                </section>
            </form>
        </div>
    </article>
</section>

@endsection
