<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Agenda Recife</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
            <div class="container">
                <div class="row logo">
                    <a class="navbar-brand text-success align-middle title-navbar" href="{{ url('/') }}">
                        <strong><i>safari</i></strong>
                    </a>
                    <div class="vertical-line"></div>
                    <a class="navbar-brand text-warning align-middle" href="{{ url('/') }}">
                        <strong>Agenda Recife</strong>
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('events') }}"><span><i class="fa fa-calendar"></i></span> {{ __('Eventos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#"><span><i class="fa fa-line-chart"></i></span> {{ __('Publicidades') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#"><span><i class="fa fa-envelope"></i></span> {{ __('Contatos') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownConfiguration" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span><i class="fa fa-gear"></i></span> {{ __('Configurações') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownConfiguration">
                                    <a class="dropdown-item text-white bg-dark" href="#">
                                        <span><i class="fa fa-sliders"></i></span> {{ __('Categorias dos eventos') }}
                                    </a>
                                    <a class="dropdown-item text-white bg-dark" href="{{ route('users') }}">
                                        <span><i class="fa fa-users"></i></span> {{ __('Usuários') }}
                                    </a>
                                    <a class="dropdown-item text-white bg-dark" href="#">
                                        <span><i class="fa fa-unlock-alt"></i></span> {{ __('Permissões') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-danger bg-dark" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span><i class="fa fa-power-off"></i></span> {{ __('Sair') }}
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
            <div class="container">
                <div class="row justify-content-center">
                    <div class="row col-md-12" style="margin-bottom: 10px">
                        @foreach ($errors->all() as $error)
                            <li class="card bg-danger text-white text-center" style="margin-right: 2px">{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
