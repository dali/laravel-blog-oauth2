<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>
    <meta name="description" content="@yield('description')">
    <!-- Scripts -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
    
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
      </div>

      @include('layouts.navigation')
      @include('layouts.aside')

        <div class="content-wrapper">
                @yield('content')
        </div>
    
     @include('layouts.footer')
     
     <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
    </div>

   

    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ mix('js/popper.js') }}"></script> --}}
    @yield('script')

    

    
</body>
</html>
