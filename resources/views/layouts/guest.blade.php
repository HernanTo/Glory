<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Glory Store') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-brands/css/uicons-brands.css'>
    <link rel="shortcut icon" href="{{ asset('img/logo_small.svg') }}" />
    @yield('styles')
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a class="con__ico" href="{{route('home')}}">
                <img src="{{ asset('img/logo_small.svg') }}" alt="Glory Store" class="logo__small">
                <img src="{{ asset('img/logoc.svg') }}" alt="Glory Store" class="logo__full">
            </a>
            <div class="con__search">
                <form action="">
                    <input type="text" name="search" id="search" class="search" placeholder="Buscar repuestos, marcas y más...">
                    <button class="btn__search"><i class="fi fi-rr-search"></i></button>
                </form>
            </div>
            <div class="nav__car"><i class="fi fi-rr-shopping-cart"></i></div>
            <div class="con__btn__login">
                <a href="">Inicie sesión</a>
            </div>
            <div class="con__link__bot">
                <a href="">Nuestra tienda</a>
                <a href="">Catálago</a>
                <a href="">Motor</a>
                <a href="">Caja</a>
                <a href="">Suspensión</a>
                <a href="">Exteriores</a>
                <a href="">Ayuda / PQR</a>
            </div>
        </nav>
    </header>

    <main class="container__main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container__footer">
            <a class="con__logo_footer" href="">
                <img src="{{ asset('img/logoc.svg') }}" alt="Glory Store" class="logo__full">
            </a>
            <div class="con__red__footer">
                <h4>Siguenos en</h4>
                <a href="">
                    <i class="fi fi-brands-facebook"></i>
                </a>
                <a href="">
                    <i class="fi fi-brands-instagram"></i>
                </a>
                <a href="">
                    <i class="fi fi-brands-tik-tok"></i>
                </a>
                UIcons by <a href="https://www.flaticon.com/uicons">Flaticon</a>
            </div>
            <section class="sect__footer">
                <h3>SOBRE NOSOTROS</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo fugiat repellat molestiae harum sunt, libero voluptates quae voluptatum? Enim odit recusandae quaerat facere necessitatibus quae suscipit fuga officia quo aliquam!</p>
            </section>
            <section class="sect__footer footer__list">
                <h3>CATEGORIAS</h3>
                    <p>Caja</p>
                    <p>Exteriores</p>
                    <p>Motor</p>
                    <p>Suspensión</p>
            </section>
            <section class="sect__footer footer__list">
                <h3>SERVICIOS</h3>
                    <p>Mantenimiento</p>
                    <p>Reparación</p>
                    <p>Modificaciones</p>
                    <p>Revisiones</p>
            </section>
            <section class="sect__footer sect__footer__map">
                <h3>UBICACIÓN</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.427772636579!2d-74.12754092520832!3d4.695499295279495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9ca79a34b449%3A0x81f72add47656b75!2sCl%2064%20%23103a-33%2C%20Bogot%C3%A1!5e0!3m2!1ses!2sco!4v1698737749330!5m2!1ses!2sco" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>
        </div>
    </footer>
    <!-- Scripts -->
        <script src="{{ asset('libs/jquery/jquery.js') }}" ></script>
        <script src="{{ asset('libs/jquery/jquery-ui.js') }}" ></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/layout.js') }}"></script>
    @yield('scripts')
    <!-- Scripts -->
</body>
</html>
