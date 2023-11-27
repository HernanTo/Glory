<div class="con__profil">
    <a href="" class="btn__profile__set">
        <figure>
            <img src="{{ asset('img/profileImages/' . auth()->user()->profile_photo_path) }}" alt="{{auth()->user()->fullName}}">
        </figure>
        <h2>{{auth()->user()->NameLast}}</h2>
        <small>Tu cuenta personal</small>
    </a>
</div>
<div class="asidebar">
    <a href="{{route('settings')}}">
        <i class="fi fi-sr-user"></i>
        Editar perfil
    </a>
    <a href="">
        <i class="fi fi-sr-time-past"></i>
        Logs
    </a>
    <section class="sect__asidebar">
        <h3>Configuración</h3>
    </section>
    <a href="">
        <i class="fi fi-sr-users-alt"></i>
        Usuarios
    </a>
    <a href="">
        <i class="fi fi-sr-ballot-check"></i>
        Productos
    </a>
    <a href="{{route('settings.category')}}">
        <i class="fi fi-sr-box-open-full"></i>
        Categorias
    </a>
    <section class="sect__asidebar">
        <h3>Adicional</h3>
    </section>
    <a href="">
        Cerrar sesión
        <i class="fi fi-sr-exit"></i>
    </a>
</div>
