<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/logo_sem_letras.png') }}">

    <!-- Styles -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src={{ asset('js/app.js') }} defer></script>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/popups.css') }}" rel="stylesheet">
    <link href="{{ asset('css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('css/task.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">


    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ asset('js/scripts.js') }} defer></script>

  </head>
  <body>
    <main>
      <header id="header">
        <h1><a href="/users"><img src={{ asset('img/logo.png') }} width="250px"></a></h1>
        @if (Auth::check())
        <section class="buttons">
            <a class= "notification" href="/users/{{Auth::user()->id}}/notifications"><img src={{ asset('img/notification.png') }} width="25px"></a>

            <a href="/users/{{Auth::user()->id}}/profile">
                <?php
                    if (Auth::user()->image_path != "./img/default") {
                        echo '<img src=' . asset(Auth::user()->image_path) . ' class="profilePhoto" >';
                    }
                    else echo '<span class="smallIcon">' . Auth::user()->name[0] . '</span>';
                ?>
            </a>
        </section>
        @elseif (Auth::guard('admin')->check())
          <script>
            document.getElementById("header").style.borderBottom = "6px solid #A1A1A1";
          </script>
          <a class="logout" href="{{ url('/logout') }}">Logout</a>
        @endif
      </header>
      <section id="content">
        @yield('content')
      </section>
      <footer class="footer">
        <section class="footer">Copyright © 2022 toEaseManage, Inc.</section>
      </footer>
    </main>
  </body>
</html>
