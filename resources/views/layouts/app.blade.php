<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'salesSys') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSS files -->
    <link href="{{asset('dist/libs/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/demo.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/mycustom.css')}}" rel="stylesheet"/>
    <link href="{{asset('dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('dist/libs/tail-select/tail.select-default.min.css')}}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    salesSys
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-3 mr-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('ventas/venta/create') }}" class="nav-link">Vender</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Libs JS -->
    <script src="{{asset('dist/libs/jquery/dist/jquery.slim.min.js')}}"></script>
    <script src="{{asset('dist/libs/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('dist/libs/popper/popper.js')}}"></script>
    <script src="{{asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dist/libs/tail-select/tail.select-full.min.js')}}"></script>
    {{--<script src="{{asset('dist/js/bootstrap-select.min.js')}}"></script>--}}
    <!-- Tabler Core -->
    <script src="{{asset('dist/js/tabler.min.js')}}"></script>
</body>
</html>
