<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mr-auto" href="{{ URL::to('/') }}">MediaLibrary</a>
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('services') }}">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('faq') }}">FAQ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('contact') }}">Contact</a>
        </li>
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ URL::to('/items/' . Auth::user()->id) }}">Items</a>
              <a class="dropdown-item" href="{{ URL::to('/users/' . Auth::user()->id) }}">My Profile</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>
        @endauth
        @guest
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Auth
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('login') }}">Login</a>
              <a class="dropdown-item" href="{{ route('register') }}">Register</a>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
