<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ababu') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- toastr -->
    <!--
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link href="{{ asset('/css/toastr.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    -->

</head>

<body>
    <div id="app">
        @include('layouts.partials.alert')
        @include('layouts.partials.header')


        <div class="container-fluid">
            <div class="row">
                <div class="col-auto min-vh-100 bg-dark">
                    <div class="pt-4 pb-1 px-2">
                        <a href="#">
                                <span class="d-none d-sm-inline text-white">Sidebar</span>
                        </a>
                    </div>
                    <hr class="text-white">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                          <a href="#" class="nav-link active" aria-current="page">
                            <i class="bi-house me-2"></i>
                            Home
                          </a>
                        </li>
                        <li>
                          <a href="#" class="nav-link text-white">
                            <i class="bi-speedometer2 me-2"></i>
                            Dashboard
                          </a>
                        </li>
                        <li>
                          <a href="#" class="nav-link text-white">
                            <i class="bi-table me-2"></i>
                            Orders
                          </a>
                        </li>
                        <li>
                          <a href="#" class="nav-link text-white">
                            <i class="bi-grid me-2"></i>
                            Products
                          </a>
                        </li>
                        <li>
                          <a href="#" class="nav-link text-white">
                            <i class="bi-people me-2"></i>
                            Customers
                          </a>
                        </li>
                      </ul>
                </div>
                <div class="col">
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>

        </div>


    </div>
</body>

</html>
