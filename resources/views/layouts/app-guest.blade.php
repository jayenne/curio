<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <title>{{ config('app.name', '') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
     
        <link rel="apple-touch-icon" sizes="57x57" href="/storage/images/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/storage/images/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/storage/images/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/storage/images/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/storage/images/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/storage/images/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/storage/images/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/storage/images/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/storage/images/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/storage/images/favicons/android-chrome-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/storage/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/storage/images/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/storage/images/favicons/favicon-16x16.png">
        <link rel="manifest" href="/storage/images/favicons/manifest.json">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
  
        @yield('scripts')
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,600&display=swap" rel="stylesheet"-->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400&display=swap" rel="stylesheet"> 
        @yield('fonts')

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- to be converter to scss and removed-->
        <link href="{{ asset('css/poc.css') }}" rel="stylesheet">
        @yield('styles')

    </head>
    <body>
        <div id="app" class="guest" >

            <main id="main" role="main" class="d-flex align-items-center">
                <div class="container-fluid px-0 ">
                    @yield('content')
                </div>
            </main>
        
        </div>
    </body>
     
</html>
