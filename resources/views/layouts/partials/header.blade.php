<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        @if (Request::is('clinics/*'))
            <a href="#" id="sidebar-toggle" data-bs-target="#sidebar" data-bs-toggle="collapse" aria-expanded="true"
                aria-controls="sidebar" class="border rounded-3 p-1 text-decoration-none"><i
                    class="bi bi-list bi-lg py-2 p-1"></i></a>
        @endif

        <a class="navbar-brand" href="{{ url('/') }}">
            🐾 {{ config('app.name', 'Ababu') }} 🌻 🐢
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @if (Request::is('clinics/*'))
                    @include('clinics.partials.menu')
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                {{ __('translate.profile') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('password.edit') }}">
                                {{ __('translate.password') }}
                            </a>


                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('translate.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@if (Request::is('clinics/*'))
    <script type="module">
        $(function() {

            console.log('init ' + sidebar_status);
            // var sidebar_status = 'visible' ?? localStorage.getItem('sidebar_status');
            var sidebar_status = localStorage.getItem('sidebar_status');

            if (sidebar_status == null) {
                sidebar_status = 'visible';
                console.log("The value is either undefined or null");
            } else {
                console.log("The value is neither undefined nor null");
            }



            console.log('init2 ' + sidebar_status);


            if (sidebar_status === 'visible') {
                $('#sidebar').addClass('show');
            } else {
                $('#sidebar').removeClass('show');
            };
            console.log('boot ' + sidebar_status);

            $('#sidebar-toggle').on('click', function() {

                if (sidebar_status == 'visible') {
                    sidebar_status = 'hidden';
                } else {
                    sidebar_status = 'visible';
                }

                console.log('click ' + sidebar_status);
                localStorage.setItem('sidebar_status', sidebar_status);
            })
        });
    </script>
@endif
