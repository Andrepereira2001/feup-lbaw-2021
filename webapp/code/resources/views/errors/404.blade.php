@extends('layouts.app')

@section('content')
  <div class="container">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">404</li>
      </ol>
    </nav>
    <h1 class="my-3">404 <span style="color: darkgrey">Page not found</span></h1>
    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron">
          <h1 class="display-4">404</h1>
          <p class="lead">The page you're looking for could not be found.</p>
          <hr class="my-4">
          <p class="lead">
            <a class="btn btn-primary" href="{{ URL::to('/') }}" role="button">Go to home page</a>
          </p>
        </div>
      </div>
    </div>
@endsection