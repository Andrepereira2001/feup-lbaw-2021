@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user">
    @include('partials.popup_logout',['name' => "logout", 'title' => "Are you sure you want to logout?"])
    @include('partials.popup_delete',['name' => "delete-user", 'title' => "Are you sure you want to delete the profile?", 'message' => "Once you delete it, you can't go back", 'id' => $user->id])
    <article class="user">
        @if (Auth::user() && Auth::user()->id == $user->id)
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
                    <a data-toggle="modal" data-target="#delete-user">Delete Profile
                    <img alt="Delete Account" src={{ asset('img/arrow.png') }} class="arrow"></a>
                </div>
                <div class="sidenavleft">
                    <a data-toggle="modal" data-target="#logout">Logout
                    <img alt="Logout" src={{ asset('img/arrow.png') }} class="arrow"></a>
                </div>
            </div>
        @elseif (Auth::guard('admin')->user())
            <div id="sidenav" class="sidenav">
                <div class="sidenavleft">
                    <a data-toggle="modal" data-target="#delete-user">Delete Profile
                    <img alt="Delete" src={{ asset('img/arrow.png') }} class="arrow"></a>
                </div>
            </div>

        @endif
        <div class="userInfo" id="view">
            <form class="info">
                @if($user->image_path != "./img/default")
                    <img alt="User Image" src="{{asset($user->image_path)}}" width="55" class="profilePhoto" >
                @else
                    <span class="span profilePhoto">{{$user->name[0]}}</span>
                @endif
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
                    @if (Auth::user() && Auth::user()->id == $user->id)
                        <div>
                            <a href="/users/{{$user->id}}/update"><img alt="Edit" src={{ asset('img/edit.png') }} class="editIcon"></a>
                        </div>

                    @endif
                </div>
            </form>
        </div>
    </article>
</section>

@endsection
