<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STILE GENERALE DEI COMPONENTI -->
    <link rel="stylesheet" href="{{ asset('css/components/components.css') }}">
    
    @if(!Route::currentRouteNamed('homepage'))  <!-- MENU DI TUTTE LE PAGINE TRANNE DELLA HOMEPAGE -->
        <link rel="stylesheet" href="{{ asset('css/components/menu-basic.css') }}">
    @endif

    <!-- Styles -->
    @yield('page-css')
    @stack('styles')
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">

        <!-- Page Heading -->
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    @stack('modals')

    <!-- Popper.js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
