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
            {{-- <i class="fi fi-sr-settings"></i> --}}
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
    <a href="{{ route('settings') }}">Configuraciones</a>
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
