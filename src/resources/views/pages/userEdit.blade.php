@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user-edit">
    @include('partials.popup_logout',['name' => "logout", 'title' => "Are you sure you want to logout?"])
    @include('partials.popup_delete',['name' => "delete", 'title' => "Are you sure you want to delete your profile?", 'message' => "Once you delete it, you can't go back", 'id' => $user->id])
    @include('partials.popup_photo',['name' => "photo", 'title' => "Are you sure you want to logout?", 'id' => $user->id])
    <article class="user" data-id="{{$user->id}}">
        <div id="sidenav" class="sidenav">
            <div id="sidenavleft" class="{{$selected}}">
                <a  href="/users/{{$user->id}}/profile" id="view">{{$view}} Profile
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
        <div class="userInfo" id="edit">
            <form class="info">
                <a class="userIcon">
                    <?php
                        if ($user->image_path != "./img/default") {
                        echo '<img src=' . asset($user->image_path) . ' class="profilePhoto" >';
                        }
                        else echo '<span class="profilePhoto"></span>';
                    ?>
                    <img src={{ asset('img/editBlue.png') }} data-toggle="modal" data-target="#photo" class="editIconBlue">
                </a>
                <section class="writtenInfo">
                    <div>
                        <label for="name">Name</label>
                        <input class="focusName" id="name" type="text" name="name" value="{{$user->name}}"/>
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
                <div class="submitEdit">
                    <span id="error">Error, change the data and try again</span>
                    <div class="editButtons">
                        <button class="save" type="submit">Save</button>
                        <a class="cancel" href="/users/{{$user->id}}/profile">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </article>
</section>

@endsection
