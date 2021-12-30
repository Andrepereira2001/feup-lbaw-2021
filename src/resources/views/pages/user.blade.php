@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user">
    @include('partials.popupLogout',['name' => "logout", 'title' => "Are you sure you want to logout?"])
    @include('partials.popupDelete',['name' => "delete", 'title' => "Are you sure you want to delete your profile?", 'message' => "Once you delete it, you can't go back", 'id' => $user->id])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <article class="user">
        @if (Auth::user()->id == $user->id)
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
                    <a data-toggle="modal" data-target="#delete">Delete Profile
                    <img src={{ asset('img/arrow.png') }} class="arrow"></a>
                </div>
                <div id="sidenavleft" class="sidenavleft">
                    <a data-toggle="modal" data-target="#logout">Logout
                    <img src={{ asset('img/arrow.png') }} class="arrow"></a>
                </div>
            </div>
        @endif
        <div class="userInfo" id="view">
            <form class="info">
                <?php
                    if ($user->image_path != "./img/default") {
                       echo '<img src=' . asset($user->image_path) . ' class="profilePhoto" >';
                    }
                    else echo '<span class="profilePhoto"></span>';
                ?>
                <div class="writtenInfo">
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
                    <div class="full1">
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email" value="{{$user->email}}" disabled>
                    </div>
                    @if (Auth::user()->id == $user->id)
                        <div>
                            <a href="/users/profile/{{$user->id}}/update"><img src={{ asset('img/edit.png') }} class="editIcon"></a>
                        </div>

                    @endif
                </div>
            </form>
        </div>
    </article>
</section>

@endsection
