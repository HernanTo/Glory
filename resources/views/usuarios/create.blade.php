@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('libs/selects/select2.min.css') }}">
@endsection

@section('content')
<div class="container-index-user conrtainer-table-d">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a href="{{ route('usuarios') }}">Usuarios</a>
            /
            <a>Nuevo usuario</a>
        </div>
        <h2>Nuevo usuario</h2>
    </div>
    <div class="con-add-users">
        <form action="{{ route('usuarios.store') }}" method="post" class="form__lin__glory" id="form__add__user">
            @csrf
            <div class="divider__form">
                <h2>Información del usuario</h2>
            </div>
            <article class="form__sect">
                <div class="form-group form__group_glory">
                    <label for="cc">NIT / CC</label>
                    <input type="number" class="form-control shadow-none" name="cc" id="cc" placeholder="NIT / CC" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189" value="{{ old('cc') }}">
                    <div class="invalid-feedback">
                        Este campo es requerido
                    </div>
                    @if($errors->has('cc'))
                        <div class="text-danger">{{ $errors->first('cc') }}</div>
                    @endif
                </div>
                <div class="form-group form__group_glory">
                    <label for="ft_name">Primer Nombre</label>
                    <input type="text" class="form-control shadow-none" id="ft_name" name="ft_name" aria-describedby="ft_name" placeholder="Primer Nombre" value="{{ old('ft_name') }}">
                    <div class="invalid-feedback">
                        Este campo es requerido
                    </div>
                    @if($errors->has('ft_name'))
                        <div class="text-danger">{{ $errors->first('ft_name') }}</div>
                    @endif
                    <small id="ft_name" class="form-text text-muted">Primer nombre o nombre de la organización</small>
                </div>
                <div class="form-group form__group_glory">
                    <label for="sc_name">Segundo Nombre - <span>Opcional</span></label>
                    <input type="" class="form-control shadow-none" id="sc_name" name="sc_name" placeholder="Segundo nombre" value="{{ old('sc_name') }}">
                </div>
                <div class="form-group form__group_glory">
                    <label for="ft_lastname">Primer Apellido - <span>Opcional</span></label>
                    <input type="text" class="form-control shadow-none" id="ft_lastname" name="ft_lastname" placeholder="Primer Apellido" value="{{ old('ft_lastname') }}">
                </div>
                <div class="form-group form__group_glory">
                    <label for="sc_lastname">Segundo Apellido - <span>Opcional</span></label>
                    <input type="text" class="form-control shadow-none" id="sc_lastname" name="sc_lastname" placeholder="Segundo Apellido" value="{{ old('sc_lastname') }}">
                </div>
            </article>
            <div class="divider__form">
                <h2>Contacto del usuario</h2>
            </div>
            <article class="form__sect">
                <div class="form-group form__group_glory">
                    <label for="email">Correo electrónico - <span>Opcional</span></label>
                    <input type="email" class="form-control shadow-none" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group form__group_glory">
                    <label for="phone">Número de telefónico</label>
                    <input type="number" class="form-control shadow-none" id="phone" class="phone" name="phone" placeholder="Número de telefónico" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189" value="{{ old('phone') }}">
                    @if($errors->has('phone'))
                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                    @endif
                    <div class="invalid-feedback">
                        Este campo es requerido
                    </div>
                </div>
                <div class="form-group form__group_glory">
                    <label for="phone">Dirección</label>
                    <input type="string" class="form-control shadow-none" id="address" class="address" name="address" placeholder="Dirección" value="{{old('address')}}">
                </div>
            </article>
            @can('create.workers')
                <div class="divider__form">
                    <h2>Tipo de cuenta</h2>
                </div>
                <article class="form__sect">
                    <div class="form-group form__group_glory">
                        <label for="role">Rol</label>
                        <select name="role" id="role">
                            <option value=""></option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Este campo es requerido
                        </div>
                        @if($errors->has('role'))
                            <div class="text-danger">{{ $errors->first('role') }}</div>
                        @endif
                    </div>
                </article>
            @else
                <input type="text" value="Cliente" name="role" style="display: none" id="role">
            @endcan

            <article class="con__two__sub__form">
                <input type="button" value="Crear" class="btn__subm btn" id="subm_user">
                <a href="{{ route('usuarios') }}" class="btn__back">Volver</a>
            </article>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('libs/selects/select2.min.js') }}"></script>
<script src="{{ asset('js/validateUser.js') }}"></script>
@can('create.workers')
<script>
    $(document).ready(function() {
        $('#role').select2({
            placeholder: "Seleccione el rol del usuario",
            allowClear: true
        });
    });

</script>
@endcan
@endsection
