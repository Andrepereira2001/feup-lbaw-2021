@extends('layouts.app')

@section('content')
  <div class="container">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About</li>
      </ol>
    </nav>
    <h1 class="mt-3">About</h1>
    <hr>

    <section class="py-3">
      <div class="row">
        <div class="col-md-6">
          <h2>About MediaLibrary</h2>
          <p>This is a information system available through the web for the management of collections of books, films, music albums, slides and their users.</p>
          <p>Collections are physically distributed across multiple locations and the system will aggregate all items in a virtual library accessible to all users.</p>
          <p>This system have operations to enter information, request and return individual items, consult the information, register comments for the items, reply other users comments and evaluate the ordered items.</p>
        </div>
        <div class="col-md-6">
          <img class="img-fluid" src="img/res/about.jpg" alt="MediaLib">
        </div>
      </div>
    </section>

    <section class="pb-3">
      <h2 class="my-3">Our Team</h2>
      <hr>
      <div class="row text-center py-3">
        <div class="col-md-4 d-flex justify-content-center">
          <div class="card text-center" style="width: 14rem;">
            <img class="card-img-top img-fluid" src="img/res/jcl.jpg" alt="jcl">
            <div class="card-body">
              <h5 class="card-title">João Correia Lopes</h5>
              <p class="card-text">Lectures and Laboratory Practice</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
          <div class="card" style="width: 14rem;">
            <img class="card-img-top img-fluid" src="img/res/ssn.jpg" alt="ssn">
            <div class="card-body">
              <h5 class="card-title">Sérgio Nunes</h5>
              <p class="card-text">Lectures and Laboratory Practice</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
          <div class="card" style="width: 14rem;">
            <img class="card-img-top img-fluid" src="img/res/tbs.jpg" alt="tbs">
            <div class="card-body">
              <h5 class="card-title">Tiago Boldt</h5>
              <p class="card-text">Laboratory Practice</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-center pb-3">
        <div class="col-md-4 d-flex justify-content-center">
          <div class="card text-center" style="width: 14rem;">
            <img class="card-img-top img-fluid" src="img/res/dfg.png" alt="dfg">
            <div class="card-body">
              <h5 class="card-title">Daniel Fernandes Gomes</h5>
              <p class="card-text">Laboratory Practice</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
          <div class="card" style="width: 14rem;">
            <img class="card-img-top img-fluid" src="img/res/fcm.png" alt="fcm">
            <div class="card-body">
              <h5 class="card-title">Fernando Cassola</h5>
              <p class="card-text">Laboratory Practice</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
          <div class="card text-center" style="width: 14rem;">
            <img class="card-img-top img-fluid" src="img/res/rm.png" alt="dfg">
            <div class="card-body">
              <h5 class="card-title">Ricardo Melo</h5>
              <p class="card-text">Laboratory Practice</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-center pb-3">
        <div class="col-md-12 d-flex justify-content-center">
          <div class="card" style="width: 14rem;">
            <img class="card-img-top img-fluid" src="img/res/rsa.png" alt="fcm">
            <div class="card-body">
              <h5 class="card-title">Renato Abreu</h5>
              <p class="card-text">Monitor</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection