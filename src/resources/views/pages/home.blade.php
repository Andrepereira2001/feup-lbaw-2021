@extends('layouts.static')

@section('content')

<section id="home">
    <div class="logo">
        <img src={{ asset('img/logo.png') }} width="500px">
    </div>
    <div class="title">
        <span>Project Management has never been easier</span>
    </div>
    <div class="buttons">
        <a class="login-button" href="/login">
            <div class="name">
                <span>Login</span>
            </div>
        </a>
        <a class="register-button" href="/register">
            <div class="name">
                <span>Register</span>
            </div>
        </a>
    </div>
    <div class="line"></div>
</section>

@endsection
