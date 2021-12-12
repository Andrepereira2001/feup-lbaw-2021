@extends('layouts.app')

@section('content')
<div class="container">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item"><a href="items.html">Items</a></li>
      <li class="breadcrumb-item active">Cars</li>
    </ol>
  </nav>
  <h1 class="mt-3">Cars</h1>
  <hr>

  <section class="row px-2 pb-3">
    <div class="col-md-6">
      <img class="img-fluid" src="img/items/dvd.jpg" alt="">
    </div>
    <div class="col-md-6">
      <h3>Item description</h3>
      <p><b>Name:</b> Cars</p>
      <p><b>Year:</b> 2006</p>
      <p><b>Owner:</b> <a href="profile.html">John Doe</a></p>
      <p><b>Type:</b> DVD</p>
      <p><b>Notes:</b> some notes about the item.</p>
      <p><b>Votes:</b>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star-o" aria-hidden="true"></i>
        <i class="fa fa-star-o" aria-hidden="true"></i>
      </p>
    </div>
  </section>

  <section class="pb-3">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#loan-history" role="tab">Loan history</a>
      </li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active px-3 py-3" id="description" role="tabpanel">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus vulputate elit quis feugiat. Cras quam lorem, mollis a ante quis, fringilla elementum lacus. Maecenas lectus augue, cursus et mattis non, condimentum a turpis. Nam luctus nunc vitae nulla commodo, in fermentum est consectetur. Etiam condimentum posuere velit, eget tincidunt est facilisis accumsan. Mauris suscipit ex sed ipsum finibus aliquet. Integer vestibulum augue eros, ac tempor velit pharetra ut. Morbi vitae diam nec justo blandit tempus. Cras a risus pharetra, lobortis purus auctor, ornare ante. Cras lacus enim, molestie sed nulla ac, mattis imperdiet augue. Integer eu vulputate ipsum. Curabitur suscipit, est ac accumsan interdum, lacus lorem lobortis eros, non convallis ante massa vitae neque. Etiam odio eros, porttitor at fringilla vel, consequat id leo. Nam ut urna sit amet urna vehicula facilisis euismod sit amet diam.
        </p>
      </div>
      <div class="tab-pane table-responsive py-3 px-3" id="loan-history" role="tabpanel">
        <table class="table">
          <thead>
          <tr>
            <th>User</th>
            <th>Start</th>
            <th>End</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><a href="profile.html">Pedro Silva</a></td>
            <td>14th March 2016</td>
            <td></td>
            <td><a href="#">Record return</a></td>
          </tr>
          <tr>
            <td><a href="profile.html">Joana Monteiro</a></td>
            <td>10th March 2010</td>
            <td>10th April 2010</td>
            <td><a href="#"></a></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
@endsection