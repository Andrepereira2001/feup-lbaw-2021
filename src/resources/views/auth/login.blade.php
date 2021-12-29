@extends('layouts.app')

@section('content')

<form id="login" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="loginPhoto1">
        <img src={{"./img/loginPhoto.png"}} class="loginPhoto" >
    </div>
    <div class="loginEmail">
        <input id="email" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
        <img src={{"./img/loginUser.png"}} class="loginUser" >

    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif
    </div>

    <div class="loginPassword">
        <input id="password" type="password" name="password" placeholder="Password" required>
        <img src={{"./img/loginPassword.png"}} class="loginPasswordImg" >

    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif
    </div>

    <button type="submit" class="loginButton">
        Login
    </button>

    <label class="remeberMe">
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>
    <span class="registerHereSpan"> Don't have an account? <a class="registerHere" href="{{ route('register') }}"> Register here</a></span>
</form>
@endsection
