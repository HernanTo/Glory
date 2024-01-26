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
            <a href="" class="items-sidebar">
                <i class="fi fi-sr-time-past"></i>
                <p>Logs</p>
            </a>
            @can('see.blog.administration')
            <a href="{{route('blog.administration')}}" class="items-sidebar">
                <i class="fi fi-sr-blog-pencil"></i>
                <p>Blog</p>
            </a>
            @endcan
            @can('see.config')
                <a href="{{route('settings')}}" class="items-sidebar">
                    <i class="fi fi-sr-settings"></i>
                    <p>Configuraciones</p>
                </a>
                <a href="{{route('cms')}}" class="items-sidebar">
                    <i class="fi fi-sr-edit"></i>
                    <p>CMS</p>
                </a>
            @endcan

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
