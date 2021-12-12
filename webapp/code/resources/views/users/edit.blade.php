@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a>Users</a></li>
        <li class="breadcrumb-item"><a href="{!! route('users.show', $user) !!}">{{ $user->name }}</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
    <h1 class="mt-3">Edit Profile</h1>
    <hr>
    <div class="row d-flex justify-content-center">
        {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
            @include('users.fields')
        {!! Form::close() !!}
    </div>
</div>
@endsection