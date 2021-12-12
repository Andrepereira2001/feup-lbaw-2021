@extends('layouts.app')

@section('content')
<div class="container">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Items</li>
    </ol>
  </nav>

  <h1 class="mt-3">
    <span>Items</span>
    <a href="{!! route('items.create') !!}" class="btn btn-outline-primary float-right" role="button" aria-disabled="true" style="height: 50%">Add new item</a>
  </h1>
  <hr>

  <section class="pb-3">
    <div class="row">
      <div class="col-sm-6 col-md-4 img-portfolio">
        <a href="item.html">
          <img class="img-fluid img-hover" src="img/items/photo2.jpg" alt="">
        </a>
        <h4>
          <a href="item.html">Landscape</a>
        </h4>
        <p>Photo | António Silva | 2016</p>
      </div>
      <div class="col-sm-6 col-md-4 img-portfolio">
        <a href="item.html">
          <img class="img-fluid img-hover" src="img/items/music1.jpg" alt="">
        </a>
        <h4>
          <a href="item.html">Rihanna - Unapologetic</a>
        </h4>
        <p>MP3 | Joana Lima | 2012</p>
      </div>
      <div class="col-sm-6 col-md-4 img-portfolio">
        <a href="item.html">
          <img class="img-fluid img-hover" src="img/items/photo1.jpg" alt="">
        </a>
        <h4>
          <a href="item.html">Polar bear</a>
        </h4>
        <p>Photo | Paulo Teixeira | 2010</p>
      </div>

      <div class="col-sm-6 col-md-4 img-portfolio">
        <a href="item.html">
          <img class="img-fluid img-hover" src="img/items/slides1.jpg" alt="">
        </a>
        <h4>
          <a href="item.html">HTML / CSS / JS</a>
        </h4>
        <p>Slides | Rita Alberto | 2017</p>
      </div>
      <div class="col-sm-6 col-md-4 img-portfolio">
        <a href="item.html">
          <img class="img-fluid img-hover" src="img/items/book1.jpg" alt="">
        </a>
        <h4>
          <a href="item.html">Os Maias</a>
        </h4>
        <p>Book | Joaquim Santos | 1888</p>
      </div>
      <div class="col-sm-6 col-md-4 img-portfolio">
        <a href="item.html">
          <img class="img-fluid img-hover" src="img/items/dvd1.jpg" alt="">
        </a>
        <h4>
          <a href="item.html">Mr. Bean</a>
        </h4>
        <p>Photo | Manuel Teixeira | 1995</p>
      </div>

      <div class="col-sm-6 col-md-4 img-portfolio">
        <a href="item.html">
          <img class="img-fluid img-hover" src="img/items/book2.jpg" alt="">
        </a>
        <h4>
          <a href="item.html">Os Lusiadas</a>
        </h4>
        <p>Book | Joana Lima | 1572</p>
      </div>
      <div class="col-sm-6 col-md-4 img-portfolio">
        <a href="item.html">
          <img class="img-fluid img-hover" src="img/items/music2.jpg" alt="">
        </a>
        <h4>
          <a href="item.html">Shakira - Shakira</a>
        </h4>
        <p>MP3 | Rita Abreu | 2014</p>
      </div>
      <div class="col-sm-6 col-md-4 img-portfolio">
        <a href="item.html">
          <img class="img-fluid img-hover" src="img/items/vhs1.png" alt="">
        </a>
        <h4>
          <a href="item.html">A pequena sereia</a>
        </h4>
        <p>VHS | Paulo Teixeira | 1989</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 offset-md-3 d-flex justify-content-center">
        <nav aria-label="Table navigation">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </section>
</div>
@endsection

