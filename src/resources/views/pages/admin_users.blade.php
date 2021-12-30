@extends('layouts.app')

@section('title', 'Admin')

@section('content')

<section id="admin">
    <!-- Button trigger modal -->
    <div class="users-display">
        @each('partials.user', $users, 'user')
    </div>
</section>

@endsection
