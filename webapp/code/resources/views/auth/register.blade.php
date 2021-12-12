@extends('layouts.app')

@section('content')
<div class="container">

  <h1 class="my-3">Register</h1>
  <hr>
  <section class="pb-3">
    <div class="row d-flex justify-content-center">
      <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="name">Name</label>

          <div>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
              <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" >E-Mail Address</label>

          <div>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
              <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label for="password-confirm" class="control-label">Confirm Password</label>

          <div>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
        </div>

        <div class="form-group">
          <button class="btn btn-primary btn-block" type="submit">Register</button>
          <button class="btn btn-block btn-danger" type="submit">
            <span class="fab fa-google"></span> Register with Google
          </button>
        </div>
      </form>
    </div>
  </section>
</div>
@endsection
