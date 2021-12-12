@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="my-3">Login</h1>
    <hr>
    <section class="pb-3">
      <div class="row d-flex justify-content-center">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">E-Mail Address</label>

            <div>
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>

            <div>
              <input id="password" type="password" class="form-control"name="password" required>

              @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div>
              <button class="btn btn-primary btn-block" type="submit">Login</button>
              <button class="btn btn-danger btn-block" type="submit">
                <span class="fab fa-google"></span> Login with Google
              </button>
              <br>
              <a href="{{ route('register') }}">Sign Up</a> | <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
          </div>

        </form>
      </div>
    </section>
  </div>
@endsection
