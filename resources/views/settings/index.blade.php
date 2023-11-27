@extends('layouts.app')
@section('title', 'Perfil | Glory Store')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endsection

@section('content')
<div class="con__settings conrtainer-table-d">
    @include('settings.sidebar')
    <div class="body__settigs">
        <div class="con__head_sect">
            <h2>Editar perfil</h2>
        </div>
        <form action="{{route('settings.profile.update')}}" method="post" enctype="multipart/form-data" id="form__edit__prof">
            @csrf
            @method('PUT')
            <div class="con-detail-us-f">
                <section class="edit-two-c-ac">
                    <label>Avatar</label>
                    <div class="con-img-prof-e">
                        <img src="{{ asset('img/profileImages/' . $profile->profileImg) }}" alt="foto-profile" class="edit-profile-img" id="edit-profile-img">

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
                    <input type="submit" value="Actualizar datos" class="btn__subm btn">
                </section>
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var asset_global='{{asset("/")}}';
    var asset_user_global='{{asset("/img/profileImages")}}';
</script>
<script src="{{ asset('js/editUser.js') }}"></script>
<script src="{{ asset('js/user.js') }}"></script>
@endsection
