@extends('layouts.static')

@section('content')

<div class="logo1">
    <img src={{"./img/logo_sem_letras.png"}} class="logo" >
    <form id="forgotPassword" method="POST" action="{{ route('recoverPassword') }}">
        {{ csrf_field() }}
        <div class="loginPhoto1">
            <img src={{"./img/loginPhoto.png"}} class="loginPhoto" >
        </div>
        <span class="textRecover">Insert the email associated<br/>to your account</span>
        <div class="sendEmail">
            <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
             <button type="submit">Send</button>

        @if ($errors->has('email'))
            <span class="error">
            {{ $errors->first('email') }}
            </span>
        @endif
        </div>


        <span class="registerHereSpan"> Don't have an account? <a class="registerHere" href="{{ route('register') }}"> Register here</a></span>
        <span class="loginHereSpan"> Already have an account? <a class="loginHere" href="{{ route('login') }}"> Login here</a></span>
    </form>
</div>
@endsection
