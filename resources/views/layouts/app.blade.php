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

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families":[
                    "Poppins:300,400,500,600,700",
                    "Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });

        let base_url = '{{ url('/') }}';
        let page = '{{ Route::current()->getName() }}';
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ url('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script type="text/javascript">
        var baseUrl = '{{ url('/') }}';
    </script>
    <link rel="stylesheet" href="{{ url('/css/typography.css') }}">
    <link rel="stylesheet" href="{{ url('/css/jquery-confirm.min.css') }}">
    <script src="{{ url('/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <script src="{{ asset('/assets/js/demo6/scripts.bundle.js') }}" type="text/javascript"></script>
    <link href="{{ asset('/assets/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/demo6/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet"/>

</head>
<body>
    <div id="app">
        @guest
        @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container" style="display: contents">
                <div class="row logo col-md-3">
                    <a class="navbar-brand text-success align-middle title-navbar" target="_blank" href="http://www.safari.com.br/">
                        <a href="http://www.safari.com.br/" target="_blank" class="col-md-4"><img style="width: 100%" src="{{ asset('images/icon/logo_safari.png') }}" alt="Safari Agência Digital"></a>
                    </a>
                    <div class="vertical-line"></div>
                    <a class="navbar-brand text-secondary align-middle col-lg-3" href="{{ url('/') }}">
                        <strong class="text-dark">Agenda Recife</strong>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span><i class="fa fa-power-off"></i></span>&nbsp;{{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
        @endguest
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
            <?php echo view("partials/_header-base-mobile")->render(); ?>
            <div class="kt-grid kt-grid--hor kt-grid--root">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                    <?php echo view("partials/_aside-base")->render(); ?>
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                            <!-- begin:: Content -->

                        @yield('content')

                        <!-- end:: Content -->
                        </div>
                        <?php echo view("partials/_footer-base")->render(); ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ url('/js/popper.min.js') }}"></script>
    <script src="{{ url('/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('/js/metisMenu.min.js') }}"></script>
    <script src="{{ url('/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ url('/js/scripts.js') }}"></script>
</body>
</html>
