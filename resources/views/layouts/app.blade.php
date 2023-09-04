<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'LaraSnap') }}</title>
      <!-- Styles -->
      <link rel="stylesheet" type="text/css" href="{{ asset('vendor/larasnap-auth/vendor/bootstrap/css/bootstrap.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('vendor/larasnap-auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('vendor/larasnap-auth/css/util.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('vendor/larasnap-auth/css/main.css') }}">
   </head>
   <body class="larasnap {{ $class ?? '' }}">
      <div class="limiter">
         @auth
        
         @endauth
         <div class="container-login100">
            @yield('content')
         </div>
      </div>
      <!-- Scripts -->
      <script src="{{ asset('vendor/larasnap-auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('vendor/larasnap-auth/vendor/bootstrap/js/popper.js') }}"></script>
      <script src="{{ asset('vendor/larasnap-auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('vendor/larasnap-auth/vendor/tilt/tilt.jquery.min.js') }}"></script>
      <script >
         $('.js-tilt').tilt({
         	scale: 1.1
         })
      </script>
      <script src="{{ asset('vendor/larasnap-auth/js/main.js') }}"></script>
   </body>
</html>