@extends('layouts.static')

@section('content')

<div class="logo1">
    <img src={{"./img/logo_sem_letras.png"}} class="logo" >
    <form id="resetPassword" method="POST" action="{{ route('resetPassword') }}">
        {{ csrf_field() }}
        <div class="loginPhoto1">
            <img src={{"./img/loginPhoto.png"}} class="loginPhoto" >
        </div>
        <span class="textRecover">Insert a new password<br/>for your account</span>

        <div class="sendEmail">
            <input id="password" type="password" name="password" placeholder="Password" required autofocus>
            <input id="passwordConfirm" type="password" name="passwordConfirm" placeholder="Confirm password" required autofocus>
            <input id="token" type="hidden" name="token" value={{$token}}>

            <button type="submit">Send</button>

        @if ($errors->has('email'))
            <p class="error">
            {{ $errors->first('email') }}
            </p>
        @endif
        </div>

        <span class="registerHereSpan"> Don't have an account? <a class="registerHere" href="{{ route('register') }}"> Register here</a></span>
        <span class="loginHereSpan"> Already have an account? <a class="loginHere" href="{{ route('login') }}"> Login here</a></span>
    </form>
</div>
@endsection