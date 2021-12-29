<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Laravel') }}</title>

      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <script type="text/javascript">
          // Fix for Firefox autofocus CSS bug
          // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
      </script>
      <script type="text/javascript" src={{ asset('js/app.js') }} defer></script>
      <script type="text/javascript" src={{ asset('js/scripts.js') }} defer></script>

    </head>
  <body>
    <main>
      <section id="static">
        <header>
          <h1><a href="home"><img src={{ asset('img/logo_sem_letras.png') }} width="100px"></a></h1>
          <section class="buttons">
            <a class="button" href="/about"> <span> about</span> </a>
            <a class="button" href="/services"> <span> services </span> </a>
            <a class="button" href="/contact"> <span> contact us</span> </a>
          </section>
        </header>
      </section>
      <section id="content">
        @yield('content')
      </section>
    </main>
  </body>
</html>
