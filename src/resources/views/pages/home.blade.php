@extends('layouts.static')

@section('content')

<section id="home">
    <div class="logo">
        <img alt="Logo" src={{ asset('img/logo.png') }}>
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
    <div class="opinion">
        <div class="bibs">
            <img alt="Maria Beatriz Russo Lopes dos Santos Image" src={{ asset('img/beatriz.png') }}>
            <span class=opinion-text> “Discovering toEaseManage was the best thing that happened to me! Now I don’t have to memorize every task that I need to do and can discuss with my collegues about the project in an easy way!” - Beatriz Lopes dos Santos</span>
        </div>
        <div class="mati">
            <span class=opinion-text> “I have improved my project manager skills thanks to the organization of toEaseManage. It really is a platform that allows us to evolve and change our working methods!” - Matilde Oliveira</span>
            <img alt="Matilde Jacinto Oliveira" src={{ asset('img/matilde.png') }}>
        </div>
    </div>
</section>

@endsection
