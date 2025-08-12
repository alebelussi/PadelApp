<!DOCTYPE html> <!-- Layout per le operazioni di autenticazione -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Padel App'))</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth/loginLayout.css') }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Styles -->
    @yield('page-css')
    @stack('styles')
    @livewireStyles
</head>

<body class="font-sans antialiased">

    <!-- Sfondo immagine -->
    <div class="background-image"></div>

    <!-- Overlay opzionale -->
    <div class="background-overlay"></div>

    <!-- Contenitore centrale con contenuto dinamico -->
    <div class="auth-container">
        <div class="auth-content">
            {{ $slot }}
        </div>
    </div>

    <!-- Popper.js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @livewireScripts
</body>
</html>

