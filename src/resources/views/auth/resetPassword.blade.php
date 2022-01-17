@extends('layouts.static')

@section('content')

<div class="logo1">
    <img alt="Logo" src={{asset("./img/logo_sem_letras.png")}} class="logo" >
    <form id="resetPassword" method="POST" action="{{ route('resetPassword') }}">
        {{ csrf_field() }}
        <div class="loginPhoto1">
            <img alt="Logo" src={{asset("./img/loginPhoto.png")}} class="loginPhoto" >
        </div>
        <span class="textRecover">Insert a new password<br/>for your account</span>

        <div class="sendEmail">
            <label for="password" style="display:none">Password</label>
            <input id="password" type="password" name="password" placeholder="Password" required autofocus>
            <label for="passwordConfirm" style="display:none">Password Confirm</label>
            <input id="passwordConfirm" type="password" name="passwordConfirm" placeholder="Confirm password" required autofocus>
            <label for="token" style="display:none">Token</label>
            <input id="token" type="hidden" name="token" value={{$token}}>

        @if ($errors->has('email'))
            <p class="error">
            {{ $errors->first('email') }}
            </p>
        @endif
        </div>
        {{-- <div> --}}
            <button class="resetButton" type="submit">Send</button>
        {{-- </div> --}}
        <span class="registerHereSpan"> Don't have an account? <a class="registerHere" href="{{ route('register') }}"> Register here</a></span>
        <span class="loginHereSpan"> Already have an account? <a class="loginHere" href="{{ route('login') }}"> Login here</a></span>
    </form>
</div>
@endsection
