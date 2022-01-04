<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ababu') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ababu.css') }}" rel="stylesheet">

    @stack('scripts')
    @stack('styles')
</head>
<body>
    <div id="app">
        @include('layouts.partials.header')

        <main class="py-4">
            @if  (Auth::check())
                @include('layouts.partials.contact')
            @endif

            @include('layouts.partials.alerts')
            @yield('content')
        </main>
    </div>
</body>
</html>
