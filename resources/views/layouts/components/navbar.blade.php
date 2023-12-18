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
            <i class="fi fi-rr-shopping-cart"></i>
        </div>
        <div class="con__link__bot">
            <a href="{{ route('tiendas') }}">Nuestra tienda</a>
            <a href="{{ route('catalogo') }}">Catálago</a>
            <a href="{{ route('category.productos', 'Motor') }}">Motor</a>
            <a href="{{ route('category.productos', 'Caja') }}">Caja</a>
            <a href="{{ route('category.productos', 'Suspensión') }}">Suspensión</a>
            <a href="{{ route('category.productos', 'Exteriores') }}">Exteriores</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="#">Ayuda</a>
            <div class="space"></div>
            @if (auth()->user())
                <div class="con__user_nav" aria-label="Ver más usuario" id="con__user_nav">
                    <figure><img src="{{asset('img/profileImages/' . auth()->user()->profile_photo_path )}}" alt="Foto {{auth()->user()->fullName}}" title="{{auth()->user()->fullName}}"></figure>
                    <p class="name__user__nav"> {{auth()->user()->nameLast}} <i class="fi fi-sr-caret-down"></i></p>
                    <nav class="user__nav" id="user__nav">
                        <a href="{{route('profileGeneral')}}" class="btn__profile__nav">
                            <figure><img src="{{asset('img/profileImages/' . auth()->user()->profile_photo_path )}}" alt="Foto {{auth()->user()->fullName}}" title="{{auth()->user()->fullName}}"></figure>
                            <p> {{auth()->user()->nameLast}}</p>
                            <small>Ver perfil</small>
                        </a>
                        @can('getInto.administration')
                            <div class="src__user__nav">
                                <a href="{{ route('dashboard') }}">Ir panel administrativo</a>
                                <a href="{{ route('productos.administration') }}">Productos</a>
                                <a href="{{ route('usuarios') }}">Usuarios</a>
                            </div>
                        @endcan
                        @can('getIntoViews.User')
                            <div class="src__user__nav">
                                <a href="">Compras</a>
                                <a href="">Carrito</a>
                                <a href="{{ route('catalogo') }}">Cátalogo</a>
                            </div>
                        @endcan
                        <form action="{{ route('logout')  }}" method="post" id="form__log__out">
                            @csrf
                            <button type="submit">Cerrar sesión</button>
                        </form>
                    </nav>
                </div>
            @else
                <div class="con__btn__login">
                    <a href="{{route('login')}}">Inicie sesión</a>
                </div>
            @endif
        </div>
    </nav>
</header>
