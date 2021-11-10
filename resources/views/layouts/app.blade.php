<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Consigsa') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/consig_icon.png')}}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom Styles Consig-site -->
    <link href="{{ asset('css/consig-site.css') }}" rel="stylesheet">
    <!-- Custom Styles Consig-sistema -->
    <link href="{{ asset('css/consig-sistema.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid w-100% mx-5">
                <a class="navbar-brand consig-logo" href="{{ url('/') }}">
                    {{ config('app.name', 'Consigsa') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('site.sobre') }}">{{ __('Sobre') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('site.servicos') }}">{{ __('Serviços') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('site.blog') }}">{{ __('Blog') }}</a>
                        </li>

                        <!--
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('site.contato') }}">{{ __('Contato') }}</a>
                        </li>
                        -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link icone-midia-social" href="#"><i class="bi bi-linkedin"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link icone-midia-social" href="#"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li class="nav-item mr-2">
                            <a class="nav-link icone-midia-social" href="#"><i class="bi bi-instagram"></i></a>
                        </li>

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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (!!Auth::user()->admin)
                                        <a class="dropdown-item" href="/app/projeto">
                                            {{ __('Projetos') }}
                                        </a>
                                        <a class="dropdown-item" href="/app/arquivo">
                                            {{ __('Arquivos') }}
                                        </a>
                                        <a class="dropdown-item" href="/app/geometria">
                                            {{ __('Geometrias') }}
                                        </a>
                                        <a class="dropdown-item" href="/app/usuario">
                                            {{ __('Usuários') }}
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="/dashboard/meus-mapas">
                                            {{ __('Meus Mapas') }}
                                        </a>
                                        <a class="dropdown-item" href="/app/arquivo">
                                            {{ __('Arquivos') }}
                                        </a>
                                        <a class="dropdown-item" href="/app/usuario">
                                            {{ __('Dados Pessoais') }}
                                        </a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="py-0">

            <div id="spinner-sistema" class="spinner-grow text-info" role="status">
                <span class="sr-only" >Loading...</span>
            </div>

            @yield('content')

        </main>

        <footer>
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col col-md-8 footer-col-1">
                        <label class="footer-title">Consig Soluções Ambientais</label>
                        <label class="footer-text">Rua Carumbé, 11</label>
                        <label class="footer-text">Rio de Janeiro, RJ 21.755-140</label>
                        <label class="footer-text text-primary">(11) 5555-5555</label>
                    </div>
                    <div class="col col-md-2 footer-col-2">
                        <label class="footer-title">Nosso trabalho</label>
                        <label class="footer-text"><a href="#">Sobre</a></label>
                        <label class="footer-text"><a href="#">Iniciativas</a></label>
                        <label class="footer-text"><a href="#">Entre em ação</a></label>
                    </div>
                    <div class="col col-md-2 footer-col-3">
                        <label class="footer-title"><a>Siga-nos</label>
                        <label class="footer-text"><a href="#">Twitter</a></label>
                        <label class="footer-text"><a href="#">LinkedIn</a></label>
                        <label class="footer-text"><a href="#">Facebook</a></label>
                    </div>
                </div>
        </footer>
    </div>
</body>
</html>
