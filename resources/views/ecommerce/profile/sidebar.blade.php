<div class="con__profil">
    <a href="{{route('profile')}}" class="btn__profile__set">
        <figure>
            <img src="{{ asset('img/profileImages/' . auth()->user()->profile_photo_path) }}" alt="{{auth()->user()->fullName}}">
        </figure>
        <h2>{{auth()->user()->NameLast}}</h2>
        <small>Tu cuenta personal</small>
    </a>
</div>
<div class="asidebar">
    <a href="{{route('profile.edit')}}">
        <i class="fi fi-sr-user"></i>
        Editar perfil
    </a>
    <section class="sect__asidebar">
    </section>
    <a href="{{route('compras')}}">
        <i class="fi fi-sr-users-alt"></i>
        Compras
    </a>
    <a href="{{route('carrito')}}">
        <i class="fi fi-sr-ballot-check"></i>
        Carrito
    </a>
    <a href="">
        <i class="fi fi-sr-box-open-full"></i>
        Cotizaciones
    </a>
</div>
