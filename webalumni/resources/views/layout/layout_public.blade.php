<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Alumni - Matana University</title>    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-chain-app-dev.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    
    <style>
        /* Fixed header styling */
        .header-area, .header-area.header-sticky {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 99999 !important;
            background-color: rgba(255,255,255,0.98) !important;
        }

        .background-header .main-nav .nav li a {
            color: #2a2a2a !important;
        }
        .background-header .main-nav .nav li:hover a,
        .background-header .main-nav .nav li a.active {
            color: #4b8ef1 !important;
        }

        /* Push content down from fixed header */
        body {
            padding-top: 100px;
            background: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        /* Subtle gradient background */
        body {
            background: linear-gradient(180deg, #f0f4ff 0%, #f8f9fa 50%, #ffffff 100%);
        }
    </style>
</head>
<body>
    <!-- Header & Navbar -->
    @include('layout.header')

    <!-- Main Content Area -->
    <main>
        @yield('isiWebsite')
    </main>

    <!-- Footer -->
    <footer class="w-full">
        @include('layout.footer')
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/animation.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('assets/js/popup.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
