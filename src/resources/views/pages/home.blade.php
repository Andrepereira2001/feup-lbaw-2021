@extends('layouts.static')

@section('content')

<section id="home">
    <div class="logo">
        <img src={{ asset('img/logo.png') }}>
    </div>
    <div class="title">
        <span>Project Management has never been easier</span>
    </div>
    <div class="buttons">
        <a class="login-button" href="/login">
            <span class="bar"></span>
            <span> Login </span>
        </a>
        <a class="register-button" href="/register">
            <span class="bar"></span>
            <span> Register </span>
        </a>
    </div>
    <div class="line"></div>
</section>

@endsection
