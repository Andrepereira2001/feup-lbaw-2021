@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="my-3">Welcome to MediaLibrary</h1>
    <hr>
    <section class="pb-3">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="fa fa-fw fa-book"></i> Items library
                </h4>
              </div>
              <div class="card-text">
                <p>Collections are physically distributed across multiple locations and the system will aggregate all items in a virtual library accessible to all users.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="fa fa-fw fa-handshake"></i> Loans management
                </h4>
              </div>
              <div class="card-text">
                <p>This is a information system available through the web for the management of collections of books, films, music albums, slides and their users.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h4>
                  <i class="fa fa-fw fa-compass"></i> Easy to use
                </h4>
              </div>
              <div class="card-text">
                <p>Strong site navigation makes it easy for visitors to quickly find the information that interests them, sans a potentially frustrating “hunt.”</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="pb-3">
      <h2 class="my-3">MediaLibrary Features</h2>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <p>The MediaLibrary includes:</p>
          <ul>
            <li>Search</li>
            <li>Statistics</li>
            <li>Rate</li>
            <li>Comment</li>
            <li>Lend item</li>
          </ul>
          <p>There must be administration usage profiles, with all the privileges of access and modification, operation with privileges to enter information, requests and returns of individual items and registered users that can consult the information and register comments for the items or reply of other users comments, as well as evaluate the items they ordered.</p>
        </div>
        <div class="col-md-6">
          <img src="img/res/index.jpg" class="img-fluid" alt="MediaLib">
        </div>
      </div>
    </section>
  </div>
@endsection
