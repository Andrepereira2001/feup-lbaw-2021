@extends('layouts.app')

@section('content')
  <div class="container">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a>Users</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
      </ol>
    </nav>
    <h1 class="mt-3">{{ $user->name }}</h1>
    <hr>

    @include('flash::message')

    <section class="row">
      <div class="col-md-6 text-center pb-3">
        <img class="img-fluid" src={{ URL::asset('img/users/' . ( $user->img ? $user->img : 'default.png')) }} alt="">
      </div>
      <div class="col-md-6">
        <h3>User info</h3>
        <p><b>Name:</b> {{ $user->name }}</p>
        <p><b>Email:</b> {{ $user->email }}</p>
        <p><b>Observations:</b> {{ $user->obs }}</p>
        @if (Auth::id() == $user->id)
        <div class="text-center"> 
          <a href="{!! route('users.edit', $user) !!}" class="btn btn-primary">Edit profile</a>
        </div>
        @endif
      </div>
    </section>

    <section class="row py-3">
      <div class="col-md-6">
        <h3>Loaned items</h3>
        <table class="table">
          <thead>
          <tr>
            <th>User</th>
            <th>Item</th>
            <th>Since</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><a href="profile.html">Pedro Silva</a></td>
            <td><a href="item.html">Book</a></td>
            <td>14th March 2016</td>
            <td><a href="#">Send alert</a></td>
          </tr>
          <tr>
            <td><a href="profile.html">Joaquim Bento</a></td>
            <td><a href="item.html">MP3</a></td>
            <td>8th April 2015</td>
            <td><a href="#">Send alert</a></td>
          </tr>
          </tbody>
        </table>
      </div>

      <div class="col-md-6">
        <h3>Reserved items</h3>
        <table class="table">
          <thead>
          <tr>
            <th>User</th>
            <th>Item</th>
            <th>Since</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><a href="profile.html">Pedro Silva</a></td>
            <td><a href="item.html">Book</a></td>
            <td>14th March 2016</td>
            <td><a href="#">Return</a></td>
          </tr>
          </tbody>
        </table>
      </div>
    </section>
  </div>
@endsection