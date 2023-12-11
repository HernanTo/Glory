
@extends('layouts.guest')
@section('title', 'Editar perfil | Glory Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="con__settings conrtainer-table-d">
    @include('ecommerce.profile.sidebar')
    <div class="body__settigs">
        <div class="con__head_sect">
            <h2>Editar información Personal</h2>
        </div>
        <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data" id="form__edit__prof">
            @csrf
            @method('PUT')
            <div class="con-detail-us-f">
                <section class="edit-two-c-ac form__group_glory">
                    <label>Nombres</label>
                    <span>
                        <input type="text" name="ft_name" id="ft_name" value="{{$profile->ft_name}}" placeholder="Primer Nombre" class="form-control shadow-none" required>
                        @if($errors->has('ft_name'))
                            <div class="text-danger">{{ $errors->first('ft_name') }}</div>
                        @endif
                        <input type="text" name="sc_name" id="sd_name" value="{{$profile->sc_name}}" placeholder="Segundo Nombre" class="form-control shadow-none">
                    </span>
                </section>
                <section class="edit-two-c-ac form__group_glory">
                    <label>Apellidos</label>
                    <span>
                        <input type="text" name="fi_lastname" id="fi_lastname" value="{{$profile->fi_lastname}}" placeholder="Primer Apellido" class="form-control shadow-none">
                        <input type="text" name="sc_lastname" id="sc_lastname" value="{{$profile->sc_lastname}}" placeholder="Segundo Apellido" class="form-control shadow-none">
                    </span>
                </section>
                <section class="edit-two-c-ac form__group_glory">
                    <label>Dirección</label>
                    <input type="text" name="address" id="address" value="{{$profile->address}}" placeholder="Dirección" class="form-control shadow-none">
                </section>
                <section class="con-sub-edi-p">
                    <input type="submit" value="Actualizar datos" class="btn btn__subm">
                </section>
            </div>
        </form>
        <div class="con__head_sect">
            <h2>Cambiar contraseña</h2>
        </div>
        @if (auth()->user()->pass_change == 0)
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">¡Debe cambiar su contraseña!</h4>
            </div>
        @endif
        <form action="{{ route('profile.password') }}" method="post" id="form-change-password">
            @method('PUT')
            @csrf
            <section class="group__password">
                <div class="form-group form__group_glory">
                    <label for="password_currently">Contraseña Actual</label>
                    <input type="password" class="form-control shadow-none" id="password_currently" name="password_currently" aria-describedby="Contraseña actual" placeholder="Contraseña actual" value="{{ old('password_currently') }}">
                    <div class="invalid-feedback" id="current-pasw-inv">Ingrese una contraseña válida</div>
                    @if($errors->any())
                        <div class="text-danger">{{ $errors->first() }}</div>
                    @endif
                </div>
                <div class="form-group form__group_glory">
                    <label for="new_password">Nueva contraseña</label>
                    <input type="password" class="form-control shadow-none" id="new_password" name="new_password" aria-describedby="Nueva contraseña" placeholder="Nueva contraseña" value="{{ old('new_password') }}">
                    <div class="invalid-feedback" id="new-pass-chang">Contraseña no válida, asegurese de que la nueva contraseña cumpla con los siguientes requisitos: mínimo 8 caracteres, al menos un número y una letra mayúscula.</div>
                    @if($errors->has('new_password'))
                        <div class="text-danger">{{ $errors->first('new_password') }}</div>
                    @endif
                </div>
                <div class="form-group form__group_glory">
                    <label for="confirm_new_password">Confirmar nueva contraseña</label>
                    <input type="password" class="form-control shadow-none" id="confirm_new_password" name="confirm_new_password" aria-describedby="Confirmar nueva contraseña" placeholder="Confirmar nueva contraseña" value="{{ old('confirm_new_password') }}">
                    <div class="invalid-feedback">Las contraseñas no coinciden. Por favor, inténtalo de nuevo.</div>
                    @if($errors->has('confirm_new_password'))
                        <div class="text-danger">{{ $errors->first('confirm_new_password') }}</div>
                    @endif
                </div>
            </section>

            <section class="con-sub-edi-p">
                <input type="button" value="Actualizar datos" class="btn btn__subm" id="btn-passw">
            </section>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/password.js')}}"></script>
@endsection
