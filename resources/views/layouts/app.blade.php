<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Glory Store')</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layouts.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel="shortcut icon" href="{{ asset('img/logo_small.svg') }}" />
    @yield('styles')
    <!-- Styles -->
</head>
<body>
    <div class="con-main-general">
        <div class="sidebar">
            <div class="con-sidebar">
                <a class="head-sidebar" href="{{ route('dashboard') }}">
                        <img src="/img/logo_small.svg" alt="Glory Store">
                        <h2>Glory</h2>
                        <p>Administration</p>
                </a>
                <div class="body-sidebar">
                    <a href="{{ route('dashboard') }}" class="items-sidebar">
                        <i class="fi fi-sr-apps"></i>
                        <p style="font-weight: 650;">Dashboard</p>
                    </a>
                    <div class="divisor-sidebar">
                        <h4>GESTIÓN</h4>
                    </div>
                    @can('see.users')
                        <a href="{{ route('usuarios') }}" class="items-sidebar">
                            <i class="fi fi-sr-users-alt"></i>
                            <p>Usuarios</p>
                        </a>
                    @endcan
                    @can('see.products.dash')
                        <a href="{{route('productos.administration')}}" class="items-sidebar">
                            <i class="fi fi-sr-ballot-check"></i>
                            <p>Productos</p>
                        </a>
                    @endcan
                    @can('see.bills')
                        <a href="{{ route('bills') }}" class="items-sidebar">
                            <i class="fi fi-sr-file-invoice-dollar"></i>
                            <p>Facturas</p>
                        </a>
                    @endcan

                    <div class="divisor-sidebar">
                        <h4>ADICIONALES</h4>
                    </div>
                    @can('see.budgets')
                        <a href="{{ route('budgets') }}" class="items-sidebar">
                            <i class="fi fi-sr-person-dolly"></i>
                            <p>Cotizaciones</p>
                        </a>
                    @endcan
                    <a href="../log/" class="items-sidebar">
                        <i class="fi fi-sr-time-past"></i>
                        <p>Logs</p>
                    </a>

                </div>
                <div class="foo-sidebar">
                    <div class="center-help">
                        <img src="{{ asset('img/interrogationw.svg') }}" alt="Help Glory Store" class="img-head-he">
                        <p>Tienes problemas con Lotus. Resuelve tus dudas aquí.</p>
                        <a href="#">
                            <img src="{{ asset('img/interrogationw.svg') }}" alt="Help Glory Store" class="img-center-help">
                            <b>Ir al centro de ayuda</b></a>
                    </div>
                </div>
            </div>
            <div class="under-sidebar" id="under-sidebar"></div>
        </div>
        <div class="navbar">
            <section class="div-navbar-l">
                <div class="btn-menu" id="btn-menu">
                    <i class="fi fi-br-menu-burger"></i>
                </div>
                <a href="../dashboard/" class="icon-hre">
                    <img src="{{ asset('img/logo_small.svg') }}" alt="Menu">
                </a>

                <div class="con-inpt-b item-side-left">
                    <input type="search" name="search" id="search" placeholder="Buscar #, serial, referencia">
                </div>
                <div class="btn-buscador-s item-side-left">
                    <i class="fi fi-rr-search"></i>
                </div>

                <div class="btn-desp-sidebar" id="btn-desp-sidebar">
                    <i class="fi fi-sr-angle-left"></i>
                </div>

            </section>
            <section class="div-navbar-r">
                <div class="con-inpt-b">
                    <input type="search" name="search" id="search" placeholder="Buscar #, serial, referencia">
                </div>
                <div class="btn-buscador-s">
                    <i class="fi fi-rr-search"></i>
                </div>
                <div class="btn-config">
                    <i class="fi fi-sr-settings"></i>
                </div>
                <div class="btn-logs-s" id="btn-logs-s">
                    <i class="fi fi-br-time-past"></i>
                </div>
                <div class="con-profile-s">
                    <div class="info-u-s" id="info-us-na">
                        <div class="con-name-s"><h3> {{auth()->user()->ft_name . ' ' .auth()->user()->fi_lastname}} </h3></div>
                        <div class="con-rol-s"><p>{{ auth()->user()->getRoleNames()->first() }}</div>
                        <div class="con-img-s">
                            <img src="{{ asset("img/profileImages/" . auth()->user()->profile_photo_path) }}" alt="image-profile">
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="dronwdonw-nav-user" id="drown-navbar">
            <a href="../cuenta/">Mi perfil</a>
            <div class="divider-dron"></div>
            <a href="../cuenta/settings.php">Configuraciones</a>
            <form action="{{ route('logout')  }}" method="post">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
        <div class="dronwdonw-logs">
            <div class="header-logs-d">
                <h3>Logs</h3>
                <div id="cross-logs">
                    <i class="fi fi-br-cross-small"></i>
                </div>
            </div>
            <div class="body-logs-d">
                <div class="log-v">
                    <img src="{{ asset('img/empty.png') }}" alt="">
                    <h2>Sin actividad, por ahora.</h2>
                </div>
            </div>
            <div class="con-footer-logs-m">
                <a href="../log/">Ver más <i class="fi fi-sr-angle-circle-right"></i></a>
            </div>
        </div>
        <main class="container-general">
            @yield('content')
        </main>
    </div>
        <!-- Scripts -->
        <script src="{{ asset('libs/jquery/jquery.js') }}" ></script>
        <script src="{{ asset('libs/jquery/jquery-ui.js') }}" ></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/layouts.js') }}" ></script>
    @yield('scripts')
        <!-- Scripts -->
</body>
</html>
