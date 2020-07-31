<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ (!empty(config('app.name')) ? config('app.name') : 'DarkCrown Dashboard') }}</title>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('img/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('img/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    @yield('plugins_css')
    <!-- Page plugins -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    @yield('inline_css')
 </head>
 
 <body>
    <!-- Sidenav -->
    @include('layouts.admin.sidebar')
    <!-- Main content -->
    <div class="main-content" id="panel">
      <!-- Topnav -->
      @include('layouts.admin.navbar')
      <!-- Header -->
      <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
                @yield('content_alert')
                <div class="col-lg-6 col-7">
                  <h6 class="h2 text-white d-inline-block mb-0">{{ $title }}</h6>
                  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        @if(!empty($first_title) && !empty($second_title) && !empty($third_title))
                          <li class="breadcrumb-item"><a href="{{ $first_link }}">{{ $first_title }}</a></li>
                          <li class="breadcrumb-item"><a href="{{ $second_link }}">{{ $second_title}}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ $third_title}}</li>
                        @elseif(!empty($first_title) && !empty($second_title))
                          <li class="breadcrumb-item"><a href="{{ $first_link }}">{{ $first_title }}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ $second_title}}</li>
                        @else
                          <li class="breadcrumb-item"><a href="{{ $first_link }}">{{ $first_title }}</a></li>
                        @endif
                    </ol>
                  </nav>
                </div>
                @if(!empty($link_new))
                  <div class="col-lg-6 col-5 text-right">
                    <a href="{{ $link_new }}" class="btn btn-sm btn-neutral">New</a>
                  </div>
                @endif
            </div>
          </div>
        </div>
      </div>
     
      <!-- Page content -->
      <div class="container-fluid mt--6">
        @yield('content_body')
        <!-- Footer -->
        @include('layouts.admin.footer')
      </div>
    </div>
    <!-- Core -->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <!-- Optional JS -->
    @yield('plugins_js')
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('inline_js')
  </body>
</html>