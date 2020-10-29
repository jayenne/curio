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

        <link rel="apple-touch-icon" sizes="180x180" href="/storage/images/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/storage/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/storage/images/favicons/favicon-16x16.png">
        <link rel="manifest" href="/storage/images/favicons/site.webmanifest">
        <link rel="mask-icon" href="/storage/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        @auth
            <!--script
                src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"
                defer></script-->

            <!-- ISOTOPE -->
            <!-- <script
                src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"
                defer></script>
            <script src="https://unpkg.com/isotope-packery@2/packery-mode.pkgd.js" defer></script>
            <script src="https://unpkg.com/draggabilly@2/dist/draggabilly.pkgd.js" defer></script>   -->   
            <!-- OR PACKERY ALT-->
            <script src="https://unpkg.com/packery@2/dist/packery.pkgd.min.js" defer></script>
            <script src="https://unpkg.com/draggabilly@2/dist/draggabilly.pkgd.min.js"></script>
            <!-- INFINITE SCROLL-->
            <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js" defer></script>
            <script src="{{ asset('js/grids.js') }}" defer></script>
            <script src="{{ asset('js/poc.js') }}" defer></script>       
            @yield('scripts')
        @endauth
        
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
        <div id="app" @guest class="guest" @endguest >
            @auth
                @include("navigation.main")
                @yield('jumbotron')
            @endauth
            <main id="main" role="main" class="d-flex align-items-center">
                
                <div class="container-fluid px-0 ">   
                    @yield('content')
                    @include("partials.modal.settings")
                </div>
            </main>
            
        </div>
        @yield('footer')
    </body>
     
</html>
