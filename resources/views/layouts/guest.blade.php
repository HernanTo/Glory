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
    <link rel="stylesheet" href="{{asset('css/modal-cart.css')}}">
    @yield('styles')
    <!-- Styles -->
</head>
<body id="body__main">
    @include('layouts.components.navbar')

    <main class="container__main">
        @yield('content')
    </main>
    @yield('sections_width')

    @include('layouts.components.shopping-cart')
    @include('layouts.components.footer')

    <x-toast-general/>
    <!-- Scripts -->
        <script>
            var asset_global='{{asset("/")}}';
            var asset_products_global='{{asset("/img/products")}}';
            var route_global='{{url("/")}}';
        </script>
        <script src="{{ asset('libs/jquery/jquery.js') }}" ></script>
        <script src="{{ asset('libs/jquery-ui/jquery-ui.min.js') }}" ></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/layout.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
        @if (auth()->user())
            <script src="{{ asset('js/dropdrown.js') }}"></script>
        @endif
        @yield('scripts')

        @include('ecommerce.search.search')
        {{-- @include('ecommerce.carrito.add') --}}
    <!-- Scripts -->
</body>
</html>
