@extends('layouts.static')

@section('content')

<div class="logo1">
    <img alt="Logo" src={{"./img/logo_sem_letras.png"}} class="logo" >
    <form id="register" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="loginPhoto1">
            <img alt="Logo" src={{"./img/loginPhoto.png"}} class="loginPhoto" >
        </div>

        <div class="registerInfo">
            <label for="name" >Name*</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
          @if ($errors->has('name'))
            <span class="error">
                {{ $errors->first('name') }}
            </span>
          @endif

          <label for="email" >Email*</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
          @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
          @endif

          <label for="password" >Password*</label>
          <input id="password" type="password" name="password"  placeholder="Password" required>
          @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
          @endif

          <label for="password-confirm" >Password Confirm*</label>
          <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm password" required>

          <span class="required">* Required</span>
        </div>

        <div class="loginArea">
          <button type="submit" class="registerButton">
            Register
          </button>
        </div>

        <span class="loginHereSpan"> Already have an account? <a class="loginHere" href="{{ route('login') }}"> Login here</a></span>
    </form>
</div>
@endsection
