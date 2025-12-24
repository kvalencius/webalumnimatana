<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title', 'Alumni')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    @stack('styles')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
 <!-- Navbar -->
    @include('layout.layout')
    <style>
        /* Custom styles jika ada */
    </style>
</head>
<body class="bg-gray-50">

    
 
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>