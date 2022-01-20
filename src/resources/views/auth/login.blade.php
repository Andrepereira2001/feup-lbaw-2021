@extends('layouts.static')

@section('content')

{{-- @if(session()->has('jsAlert'))
     <script>
    var msg = '{{Session::get('jsAlert')}}';
    var exist = '{{Session::has('jsAlert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endif --}}

<div class="logo1">
    <img alt="Logo" src={{"./img/logo_sem_letras.png"}} class="logo" >
    <form id="login" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="loginPhoto1">
            <img alt="Logo" src={{"./img/loginPhoto.png"}} class="loginPhoto" >
        </div>
        <div class="loginEmail">
            <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            <label for="email"><img alt="User" src={{"./img/loginUser.png"}} class="loginUser" ></label>


            @if ($errors->has('email'))
                <span class="error">
                {{ $errors->first('email') }}
                </span>
            @endif
        </div>

        <div class="loginPassword">
            <div>
                <input id="password" type="password" name="password" placeholder="Password" required>
                <label for="password"><img alt="Password" src={{"./img/loginPassword.png"}} class="loginPasswordImg" ></label>

                @if ($errors->has('password'))
                    <span class="error">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            @if(session()->has('jsAlert'))
                <span class="credentials error-messages">
                    {{Session::get('jsAlert')}}
                </span>
            @endif
        </div>


        <div class="loginArea">
            <button type="submit" class="loginButton">
                Login
            </button>
            <div class="underLoginButton">
                <label class="remeberMe">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                </label>
                <a class="forgotPassword" href="/recoverPassword"> Forgot password?</a>
            </div>
        </div>

        <span class="registerHereSpan"> Don't have an account? <a class="registerHere" href="{{ route('register') }}"> Register here</a></span>
    </form>
</div>
@endsection
