
@extends('layouts.guest')
@section('title', 'Perfil | Glory Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="con__settings conrtainer-table-d">
    @include('ecommerce.profile.sidebar')
    <div class="body__settigs">
        <div class="con__head_sect con__head_sect__flex">
            <h2>Información Personal</h2>
            <a href="{{ route('profile.edit') }}">Editar perfil</a>
        </div>
        <section class="group__info__cus">
            <article class="group">
                <label>DOCUMENTO / NIT</label>
                <h3>{{$profile->cc}}</h3>
            </article>
            <article class="group">
                <label>NOMBRE COMPLETO</label>
                <h3>{{$profile->fullName}}</h3>
            </article>
            <article class="group">
                <label>TELÉFONO</label>
                <h3>{{$profile->phone_number}}</h3>
            </article>
            <article class="group">
                <label>EMAIL</label>
                <h3>{{ $profile->email }}</h3>
            </article>
            <article class="group">
                <label for="">DIRECCIÓN</label>
                <h3> {{$profile->addressCustomer}} </h3>
            </article>
        </section>
        @if (auth()->user()->pass_change == 0)
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">¡Cambie la contraseña!</h4>
                <hr>
                <p>Su cuenta se encuentra usando la contraseña predeterminada, por su seguridad actualice su contraseña. Puede hacerlo en el siguiente enlace: <a href="{{ route('profile.edit') }}">Editar perfil</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
