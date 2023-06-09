<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CarUPO</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>

<body class="vh-100 container-fluid g-0 bg-light">
    <header class="fixed-top" style="font-size: x-large;">
        <nav id="azul" class="navbar navbar-expand-lg navbar-dark ">
            <div class="container-fluid px-4">
                <a class="navbar-brand me-auto" href="{{route('inicio')}}">
                    <img src={{ asset('logo.png') }} alt="Logo" style="width: 100px; font-size: x-large;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#elementos" aria-controls="elementos" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="elementos">
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest

                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('messages.registro') }}</a>
                        </li>
                        @endif
                        @else
                        {{ app()->setLocale('es') }}
                        @if (Auth::user()->language == 'es')
                        {{ app()->setLocale('es') }}
                        @else
                        {{ app()->setLocale('en') }}
                        @endif

                        @if (Auth::user()->isAdmin())
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{route('mostrarCoches')}}">{{ __('messages.coches') }}</a>
                        </li>
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{route('mostrarAccesorios')}}">{{ __('messages.accesorios') }}</a>
                        </li>
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{route('mostrarUsuarios')}}">{{ __('messages.usuarios') }}</a>
                        </li>
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{route('mostrarCompras')}}">{{ __('messages.compras') }}</a>
                        </li>
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{route('mostrarRankingFavoritos')}}">{{ __('messages.favoritos') }}</a>
                        </li>
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{route('verCategorias')}}">{{ __('messages.categorias') }}</a>
                        </li>
                        @else
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{route('mostrarProductos')}}">{{ __('messages.productos') }}</a>
                        </li>
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{route('misCompras')}}">{{ __('messages.misCompras') }}</a>
                        </li>                        
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{ route('misFavoritos') }}">{{ __('messages.misFavs') }}</a>
                        </li>
                        <li class="nav-item justify-content-center d-flex">
                            <a class="nav-link text-white" href="{{route('mostrarCarrito')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                                </svg>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="dropdown justify-content-center d-flex mx-4">
                    <button class="buttonP btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="{{route('miPerfil')}}">{{ __('messages.perfil') }}</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('messages.logout') }}</a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                @endguest

            </div>
        </nav>
    </header>
    <main id="main" class="min-vh-100 py-5 my-5">
        <div class="container-fluid col-12 fs-5">
            @yield('contenido')
        </div>
    </main>
    <footer id="azul" class="fixed-sticked">
        <div class=" bg-grey p-4 py-3 text-white">
            <p class="justify-content-center d-flex">{{ __('messages.derechos') }}</p>
        </div>
    </footer>
</body>

</html>