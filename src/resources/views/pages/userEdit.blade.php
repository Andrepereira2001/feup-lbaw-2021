@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user-edit">
    @include('partials.popup_logout',['name' => "logout", 'title' => "Are you sure you want to logout?"])
    @include('partials.popup_delete',['name' => "delete", 'title' => "Are you sure you want to delete your profile?", 'message' => "Once you delete it, you can't go back", 'id' => $user->id])
    @include('partials.popup_photo',['name' => "photo", 'title' => "Are you sure you want to logout?", 'id' => $user->id])
    <article class="user" data-id="{{$user->id}}">
        <div id="sidenav" class="sidenav">
            <div class="sidenavleft {{$selected}}">
                <a  href="/users/{{$user->id}}/profile" id="view">{{$view}} Profile
                <img alt="Profile" src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
            <div class="sidenavleft">
                <a href="/users/{{$user->id}}/notifications" id="notification">Notifications
                <img alt="Notifications" src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
            <div class="sidenavleft">
                <a data-toggle="modal" data-target="#delete">Delete Profile
                <img alt="Delete Account" src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
            <div class="sidenavleft">
                <a data-toggle="modal" data-target="#logout">Logout
                <img alt="Logout" src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
        </div>
        <div class="userInfo">
            <form class="info">
                <a class="userIcon">
                    @if($user->image_path != "./img/default")
                        <img src="{{asset($user->image_path)}}" alt="User image" width="55" class="profilePhoto" >
                    @else
                        <span class="span profilePhoto">{{$user->name[0]}}</span>
                    @endif
                    <img alt="Edit image" src={{ asset('img/editBlue.png') }} data-toggle="modal" data-target="#photo" class="editIconBlue">
                </a>
                <section class="writtenInfo">
                    <div class="full">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" value="{{$user->name}}"/>
                    </div>
                    <div class="full">
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email" value="{{$user->email}}">
                        @if ($errors->has('email'))
                            <span class="error">
                            {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <div class="full pass">
                        <label for="password">Password</label>
                        <div class="eye">
                            <input class="full" id="password" type="password" name="password">
                            <img class="password eye-img" src={{ asset('img/eye.png') }} width="25" onmousedown ="document.getElementById('password').type='text'" onmouseup="document.getElementById('password').type='password'"/>
                        </div>

                    </div>
                    <div class="full pass">
                        <label for="cPassword">Confirm Password</label>
                        <div class="eye">
                            <input class="full" id="cPassword" type="password" name="cPassword">
                            <img class="cPassword eye-img" src={{ asset('img/eye.png') }} width="25" onmousedown ="document.getElementById('cPassword').type='text'" onmouseup="document.getElementById('cPassword').type='password'"/>
                        </div>
                    </div>
                </section>
                <div class="submitEdit">
                    <span class="error-messages">Error, change the data and try again</span>
                    <div class="editButtons">
                        <button class="btn save" type="submit">Save</button>
                        <a class="btn cancel" href="/users/{{$user->id}}/profile">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </article>
</section>

@endsection
