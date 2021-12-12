@extends('layouts.app')

@section('content')
<div class="container">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item"><a href="items.html">Items</a></li>
      <li class="breadcrumb-item active">Add item</li>
    </ol>
  </nav>
  <h1 class="mt-3">Add new item</h1>
  <hr>

  <section class="pb-3 row">
    <div class="col-md-6 offset-md-3">
      <form class="form-signin">
        <div class="form-group">
          <label for="itemName" class="sr-only">Name</label>
          <input type="text" id="itemName" class="form-control" placeholder="Name" required="" autofocus="">
        </div>

        <div class="form-group">
          <label for="itemCategory" class="sr-only">Item category</label>
          <select class="custom-select" id="itemCategory">
            <option value="all"> All</option>
            <option value="book" selected> Book</option>
            <option value="cd"> CD</option>
            <option value="dvd"> DVD</option>
            <option value="mp3"> MP3</option>
            <option value="photos"> Photos</option>
            <option value="slides"> Slides</option>
            <option value="vhs"> VHS</option>
          </select>
        </div>

        <div class="form-group">
          <label for="itemEdition" class="sr-only">Edition</label>
          <input type="text" id="itemEdition" class="form-control" placeholder="Edition" required="" autofocus="">
        </div>

        <div class="form-group">
          <label for="itemISBN" class="sr-only">ISBN</label>
          <input type="text" id="itemISBN" class="form-control" placeholder="ISBN" required="" autofocus="">
        </div>

        <div class="form-group">
          <label for="itemPublisher" class="sr-only">Publiser</label>
          <input type="text" id="itemPublisher" class="form-control" placeholder="Publisher" required="" autofocus="">
        </div>

        <button class="btn btn-primary btn-block" type="submit">Add item</button>
      </form>
    </div>
  </section>
</div>
@endsection