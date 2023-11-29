<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- Meta --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Compra tus repuestos en línea. Solicita de forma ágil y segura, con precios increíbles en repuestos originales. Accesorios para carros, Cajas para carro, Suspensiones para carro')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Hernán Torres">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="@yield('meta_op_title', 'Glory Store')">
    <meta property="og:description" content="@yield('meta_op_desc', 'Compra tus repuestos en línea. Solicita de forma ágil y segura, con precios increíbles en repuestos originales. Accesorios para carros, Cajas para carro, Suspensiones para carro')">
    <meta property="og:image" content="@yield('meta_op_img', asset('img/logoc.svg'))">
    <title>@yield('title', 'Glory Store')</title>
    {{-- Meta --}}
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-brands/css/uicons-brands.css'>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/logo_small.svg') }}" />
    @yield('styles')
    <!-- Styles -->
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a class="con__ico" href="{{route('home')}}">
                <img src="{{ asset('img/logo_small.svg') }}" alt="Glory Store" class="logo__small" title="Glory Store">
                <img src="{{ asset('img/logoc.svg') }}" alt="Glory Store" class="logo__full" title="Glory Store">
            </a>
            <div class="con__search">
                <form action="{{ route('search.products.eco') }}" method="GET" id="form__search">
                    <input type="text" name="p" id="search" class="search" placeholder="Buscar repuestos, marcas y más..." aria-label="Ingresa lo que quieras buscar"  value="{{ $search ?? '' }}">
                    <button class="btn__search" aria-label="Buscar" type="submit"><i class="fi fi-rr-search"></i></button>
                </form>
            </div>
            <div class="nav__car">
                {{-- <i class="fi fi-rr-shopping-cart"></i> --}}
            </div>
            <div class="con__btn__login">
                {{-- <a href="">Inicie sesión</a> --}}
            </div>
            <div class="con__link__bot">
                <a href="{{ route('tiendas') }}">Nuestra tienda</a>
                <a href="{{ route('catalogo') }}">Catálago</a>
                <a href="{{ route('category.productos', 'Motor') }}">Motor</a>
                <a href="{{ route('category.productos', 'Caja') }}">Caja</a>
                <a href="{{ route('category.productos', 'Suspensión') }}">Suspensión</a>
                <a href="{{ route('category.productos', 'Exteriores') }}">Exteriores</a>
                <a href="#">Ayuda / PQR</a>
            </div>
        </nav>
    </header>

    <main class="container__main">
        @yield('content')
    </main>

    <a class="btn__flot__wh" href="https://wa.link/ujys6j" target="__blank">
        <i class="fi fi-brands-whatsapp"></i>
        <h3>Solicita tu repuesto</h3>
    </a>

    <footer class="footer">
        <div class="container__footer">
            <a class="con__logo_footer" href="{{ route('home') }}">
                <img src="{{ asset('img/logoc.svg') }}" alt="Glory Store" class="logo__full" title="Glory Store">
            </a>
            <div class="con__red__footer">
                <h4>Siguenos en</h4>
                <a href="#" target="__blank" aria-label="Siguenos en Facebook">
                    <i class="fi fi-brands-facebook" ></i>
                </a>
                <a href="#" target="__blank" aria-label="Siguenos en Instagram">
                    <i class="fi fi-brands-instagram"></i>
                </a>
                <a href="#" target="__blank" aria-label="Siguenos en Tiktok">
                    <i class="fi fi-brands-tik-tok"></i>
                </a>
                UIcons by <a href="https://www.flaticon.com/uicons" target="__blank">Flaticon</a>
            </div>
            <section class="sect__footer">
                <h3>Contacto</h3>
                <span id="sect__contact">
                    <a href="{{ route('tiendas') }}" class="src__cont">Nuestra tienda</a>

                    <p>Escríbenos a nuestro <b>WhatsApp</b></p>
                    <a href="https://wa.link/ujys6j" class="src__cont" target="__blank">+57 310 2452756</a>

                    <p>Correo electrónico:</p>
                    <a class="src__cont" href="mailto:soporte@tallerglory.store">soporte@tallerglory.store</a>

                    <p>Dirección</p>
                    <a href="https://www.google.com/maps?ll=4.695499,-74.124966&z=15&t=m&hl=es&gl=CO&mapclient=embed&q=Cl+64+%23103a-33+Bogot%C3%A1" target="__blank" class="src__cont">CL 64 103A-33, Bogotá</a>
                </span>
            </section>
            <section class="sect__footer footer__list">
                <h3>CATEGORIAS</h3>
                    <a href="{{ route('catalogo') }}">Catálago</a>
                    <a href="{{ route('category.productos', 'Caja') }}">Caja</a>
                    <a href="{{ route('category.productos', 'Exteriores') }}">Exteriores</a>
                    <a href="{{ route('category.productos', 'Motor') }}">Motor</a>
                    <a href="{{ route('category.productos', 'Suspension') }}">Suspensión</a>
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.427772636579!2d-74.12754092520832!3d4.695499295279495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9ca79a34b449%3A0x81f72add47656b75!2sCl%2064%20%23103a-33%2C%20Bogot%C3%A1!5e0!3m2!1ses!2sco!4v1698737749330!5m2!1ses!2sco" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Ubicación del Taller Glory Store"></iframe>
            </section>
        </div>
    </footer>
    <!-- Scripts -->
        <script src="{{ asset('libs/jquery/jquery.js') }}" ></script>
        <script src="{{ asset('libs/jquery-ui/jquery-ui.min.js') }}" ></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/layout.js') }}"></script>
    @yield('scripts')
    <!-- Scripts -->
    <script>
        $(document).ready(() => {
            $('#search').autocomplete({
                source: (request, response) =>{
                    $.ajax({
                        url: "{{ route('search.eco') }}",
                        dataType: 'json',
                        data: {
                            term: request.term
                        },
                        success: (data) => {
                            response(data)
                        }
                    });
                },
                select: function(event, ui) {
                    if(ui.item.type == 'products'){
                        url = '{{route("producto.producto", ":slug")}}';
                        url = url.replace(':slug', ui.item.slug);
                    }else if(ui.item.type == 'categories'){
                        url = '{{ route("category.productos",  ":category") }}';
                        url = url.replace(':category', ui.item.label);
                    }

                    window.location.href = url;
                }
            });

            document.getElementById('form__search').addEventListener('submit', event =>{
                value = document.getElementById('search').value;
                if(value.trim().length <= 1){
                    event.preventDefault();
                }
            })
        });
    </script>
</body>
</html>
