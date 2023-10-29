@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
<link rel="stylesheet" href="{{ asset('libs/selects/select2.min.css') }}">
@endsection

@section('content')
@foreach ($user as $item)
<div class="container-index-user con-acount-general">
        <div class="header-table header__table__left">
            <div class="bread-cump">
                <a href="{{ route('dashboard') }}">Home</a>
                /
                <a href="{{ route('usuarios') }}">Usuarios</a>
                /
                <a href="{{ route('clientes.cliente', $item->cc)}}">{{ $item->nameLast }}</a>
                /
                <a>Editar</a>
            </div>
            <h2> {{$item->nameLast}} - {{$item->cc}} - Editar</h2>
        </div>

        <div class="content-account content__edit">
            <div class="info-general-u">
                <div class="con-picture-profi">
                    <img src="{{ asset('img/profileImages/' . $item->profileImg) }}" alt="image-profile">
                </div>
                <div class="con-info-u-b">
                    <h2> {{$item->fullName}} </h2>
                    <p><i class="fi fi-sr-briefcase"></i> Cliente</p>
                    <p><i class="fi fi-sr-phone-call"></i> {{$item->phone_number}}</p>
                    <p><i class="fi fi-sr-envelope"></i> {{$item->emailV}} </p>
                </div>
                <div class="acti-acco">
                    {{-- <a href="{{route('usuarios.edit', $item->cc)}}">Editar</a> --}}
                    <a onclick="confirmTrash({{ $item->id }}, '{{ $item->full_name }}', 2)" class="btn-elim-user">Eliminar</a>
                </div>
                <div class="con-src-accounts">
                    <a href="{{route('clientes.cliente', $item->cc)}}">Detalle</a>
                    <a href="{{route('clientes.edit', $item->cc)}}" class="acco-active">Editar</a>
                    <a href="">Vehículos</a>
                </div>
            </div>

            <div class="main-sec-acco" id="sec__data">
                <div class="header-sec-ac header-ac">
                    <i class="fi fi-sr-id-badge"></i>
                    <h2>Editar</h2>
                    <div class="divider"></div>
                </div>
                <div class="content-sec-ac">
                    <form action="{{ route('clientes.update', $item) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="con-detail-us-f">
                            <section class="edit-two-c-ac">
                                <label>Avatar</label>
                                <div class="con-img-prof-e">
                                    <img src="{{ asset('img/profileImages/' . $item->profileImg) }}" alt="foto-profile" class="edit-profile-img" id="edit-profile-img">

                                    <div class="trash-pic" id="trash-pic" title="Eliminar avatar"> <i class="fi fi-sr-broom"></i> </div>

                                    <label for="img-profil-c" class="edit-picture-profi"  title="Editar avatar"><i class="fi fi-ss-pencil"></i></label>


                                    <input type="file" name="imgeProfile" id="img-profil-c" style="display: none" accept="image/png,image/jpeg">
                                    <input type="number" name="changepicturestate" value="0" id="changepicturestate" style="display: none;">
                                    @if($errors->has('img-profil-c'))
                                        <div class="text-danger">{{ $errors->first('ft_name') }}</div>
                                    @endif
                                </div>
                            </section>
                            <section class="edit-two-c-ac form__group_glory">
                                <label>NIT / CC</label>
                                <input type="number" name="cc" id="cc" value="{{$item->cc}}" required placeholder="NIT / CC" class="form-control shadow-none">
                                @if($errors->has('cc'))
                                    <span>-</span>
                                    <div class="text-danger">{{ $errors->first('cc') }}</div>
                                @endif
                            </section>
                            <section class="edit-two-c-ac form__group_glory">
                                <label>Nombres</label>
                                <span>
                                    <input type="text" name="ft_name" id="ft_name" value="{{$item->ft_name}}" placeholder="Primer Nombre" class="form-control shadow-none" required>
                                    @if($errors->has('ft_name'))
                                        <div class="text-danger">{{ $errors->first('ft_name') }}</div>
                                    @endif
                                    <input type="text" name="sc_name" id="sd_name" value="{{$item->sc_name}}" placeholder="Segundo Nombre" class="form-control shadow-none">
                                </span>
                            </section>
                            <section class="edit-two-c-ac form__group_glory">
                                <label>Apellidos</label>
                                <span>
                                    <input type="text" name="fi_lastname" id="fi_lastname" value="{{$item->fi_lastname}}" placeholder="Primer Apellido" class="form-control shadow-none">
                                    <input type="text" name="sc_lastname" id="sc_lastname" value="{{$item->sc_lastname}}" placeholder="Segundo Apellido" class="form-control shadow-none">
                                </span>
                            </section>
                            <section class="edit-two-c-ac form__group_glory">
                                <label>Email</label>
                                <input type="email" name="email" id="email" value="{{$item->email}}" placeholder="Email" class="form-control shadow-none">
                                @if($errors->has('email'))
                                    <span>-</span>
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </section>
                            <section class="edit-two-c-ac form__group_glory">
                                <label>Teléfono</label>
                                <input type="number" name="phone" id="phone" value="{{$item->phone_number}}" required placeholder="Teléfono" class="form-control shadow-none">
                                @if($errors->has('phone'))
                                    <span>-</span>
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </section>
                            <section class="edit-two-c-ac form__group_glory">
                                <label>Dirección</label>
                                <input type="text" name="address" id="address" value="{{$item->address}}" placeholder="Dirección" class="form-control shadow-none">
                            </section>
                            <section class="con-sub-edi-p">
                                <input type="submit" value="Actualizar datos" class="btn__subm btn">
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endforeach

@include('usuarios.modal')

@endsection

@section('scripts')
<script>
    var asset_global='{{asset("/")}}';
    var asset_user_global='{{asset("/img/profileImages")}}';
</script>

<script src="{{ asset('libs/selects/select2.min.js') }}"></script>
<script src="{{ asset('js/editUser.js') }}"></script>
<script src="{{ asset('js/user.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#role').select2({
            placeholder: "Seleccione el rol del usuario",
            allowClear: true
        });
    });

</script>
@endsection
