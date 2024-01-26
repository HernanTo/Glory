<!doctype html>

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
        <x-administration.layout.sidebar />
        <x-administration.layout.navbar />

        <main class="container-general">
            @yield('content')
        </main>
    </div>
        <!-- Scripts -->
        <script src="{{ asset('libs/jquery/jquery.js') }}" ></script>
        <script src="{{ asset('libs/jquery-ui/jquery-ui.min.js') }}" ></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/layouts.js') }}" ></script>
    @yield('scripts')
        <!-- Scripts -->
</body>
</html>
