@extends('layouts.app')

@section('content')
  <div class="container">

    <h1 class="mt-3">Users</h1>
    <hr>

    <section class="pb-3">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="input-group">
            <label for="userName" class="sr-only">Search Users</label>
            <input type="text" id="userName" class="form-control" placeholder="Search for users" required="" autofocus="">
            <div class="input-group-append">
              <button class="btn btn-outline-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <div class="row px-3 py-3 table-responsive">
        <table class="table">
          <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <th scope="row">1</th>
            <td>António Silva</td>
            <td>antonio@mail.com</td>
            <td>
              <button class="btn btn-danger" type="submit"><i class="fas fa-ban"></i></button>
              <button class="btn btn-warning" type="submit"><i class="fas fa-edit" style="color: white"></i></button>
            </td>        </tr>
          <tr>
            <th scope="row">2</th>
            <td>Joana Lima</td>
            <td>joana@mail.com</td>
            <td>
              <button class="btn btn-danger" type="submit"><i class="fas fa-ban"></i></button>
              <button class="btn btn-warning" type="submit"><i class="fas fa-edit" style="color: white"></i></button>
            </td>        </tr>
          <tr>
            <th scope="row">3</th>
            <td>Paulo Teixeira</td>
            <td>paulo@mail.com</td>
            <td>
              <button class="btn btn-danger" type="submit"><i class="fas fa-ban"></i></button>
              <button class="btn btn-warning" type="submit"><i class="fas fa-edit" style="color: white"></i></button>
            </td>        </tr>
          <tr>
            <th scope="row">4</th>
            <td>Rita Alberto</td>
            <td>rita@mail.com</td>
            <td>
              <button class="btn btn-danger" type="submit"><i class="fas fa-ban"></i></button>
              <button class="btn btn-warning" type="submit"><i class="fas fa-edit" style="color: white"></i></button>
            </td>        </tr>
          <tr>
            <th scope="row">5</th>
            <td>Joaquim Santos</td>
            <td>joaquim@mail.com</td>
            <td>
              <button class="btn btn-danger" type="submit"><i class="fas fa-ban"></i></button>
              <button class="btn btn-warning" type="submit"><i class="fas fa-edit" style="color: white"></i></button>
            </td>        </tr>
          <tr>
            <th scope="row">6</th>
            <td>Manuel Teixeira</td>
            <td>manuel@mail.com</td>
            <td>
              <button class="btn btn-danger" type="submit"><i class="fas fa-ban"></i></button>
              <button class="btn btn-warning" type="submit"><i class="fas fa-edit" style="color: white"></i></button>
            </td>        </tr>
          <tr>
            <th scope="row">7</th>
            <td>Rita Abreu</td>
            <td>abreu@mail.com</td>
            <td>
              <button class="btn btn-danger" type="submit"><i class="fas fa-ban"></i></button>
              <button class="btn btn-warning" type="submit"><i class="fas fa-edit" style="color: white"></i></button>
            </td>        </tr>
          <tr>
            <th scope="row">8</th>
            <td>Paulo Pedrosa</td>
            <td>pedrosa@mail.com</td>
            <td>
              <button class="btn btn-danger" type="submit"><i class="fas fa-ban"></i></button>
              <button class="btn btn-warning" type="submit"><i class="fas fa-edit" style="color: white"></i></button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>

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
    </section>
  </div>
@endsection