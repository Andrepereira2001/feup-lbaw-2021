@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="notifications">
    @include('partials.popup_logout',['name' => "logout", 'title' => "Are you sure you want to logout?"])
    @include('partials.popup_delete',['name' => "delete", 'title' => "Are you sure you want to delete your profile?", 'message' => "Once you delete it, you can't go back", 'id' => $user->id])
    <article class="user" data-id="{{$user->id}}">
        <div id="sidenav" class="sidenav">
            <div id="sidenavleft" class="sidenavleft">
                <a  href="/users/{{$user->id}}/profile" id="view">{{$view}} Profile
                <img alt="Profile" src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
            <div id="sidenavleft" class="{{$selected}}">
                <a href="/users/{{$user->id}}/notifications" id="notification">Notifications
                <img alt="Notifications" src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
            <div id="sidenavleft" class="sidenavleft">
                <a data-toggle="modal" data-target="#delete">Delete Profile
                <img alt="Delete" src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
            <div id="sidenavleft" class="sidenavleft">
                <a data-toggle="modal" data-target="#logout">Logout
                <img alt="Logout" src={{ asset('img/arrow.png') }} class="arrow"></a>
            </div>
        </div>
        <div class="notifications-info">
            <header><span>Notifications</span></header>
            @each('partials.notification', $notifications, 'notification')
        </div>
    </article>
</section>

@endsection
