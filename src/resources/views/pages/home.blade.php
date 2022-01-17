@extends('layouts.static')

@section('content')

<section id="home">
    <div class="logo">
        <img alt="Logo" src={{ asset('img/logo.png') }} width="500px">
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
    <div class="opinion">
        <img alt="Maria Beatriz Russo Lopes dos Santos Image" src={{ asset('img/beatriz.png') }}>
        <span class=opinion-text> “Discovering toEaseManage was the best thing that happened to me! Now I don’t have to memorize every task that I need to do and can discuss with my collegues about the project in an easy way!” - Beatriz Lopes dos Santos</span>
</section>

@endsection
