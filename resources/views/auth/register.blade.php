@extends('layouts.template')
@section('title', 'Regístrese | Glory Store')
@section('meta_description',  "Regístrate en Glory Store y forma parte de la comunidad de amantes de los repuestos de calidad. Crea tu cuenta de forma rápida y segura para acceder a precios increíbles en piezas originales.")
@section('meta_op_title', 'Regístrese | Glory Store')
@section('meta_op_desc', "Regístrate en Glory Store y forma parte de la comunidad de amantes de los repuestos de calidad. Crea tu cuenta de forma rápida y segura para acceder a precios increíbles en piezas originales.")

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('guest')
<div class="container__login container__register">
    <article class="aside__login">
        <h2>Glory Store</h2>
        <p>Solicita tus repuestos de manera ágil y segura, y descubre precios increíbles en repuestos. Garantizamos la autenticidad y calidad de nuestros productos, brindándote solo repuestos originales.</p>
    </article>
    <section class="con__register">
        <div class="header__con__register">
            <a href="{{route('home')}}" class="con__logo">
                <img src="{{ asset('img/logoc.svg') }}" alt="Glory Store" class="header__logo__login">
            </a>
            <h2>Crear una cuenta</h2>
        </div>
        <form action="{{ route('register') }}" method="post" id="form__register">
            @csrf
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
            <div class="inpts__groups">
                <div class="form-group form__group_glory">
                    <label for="ft_name">Primer Nombre</label>
                    <input type="text" class="form-control shadow-none" id="ft_name" name="ft_name" aria-describedby="ft_name" placeholder="Primer Nombre" value="{{ old('ft_name') }}">
                    <div class="invalid-feedback">
                        Este campo es requerido
                    </div>
                    @if($errors->has('ft_name'))
                        <div class="text-danger">{{ $errors->first('ft_name') }}</div>
                    @endif
                </div>
                <div class="form-group form__group_glory">
                    <label for="sc_name">Segundo Nombre - <span>Opcional</span></label>
                    <input type="" class="form-control shadow-none" id="sc_name" name="sc_name" placeholder="Segundo nombre" value="{{ old('sc_name') }}">
                </div>
            </div>
            <div class="inpts__groups">
                <div class="form-group form__group_glory">
                    <label for="ft_lastname">Primer Apellido</label>
                    <input type="text" class="form-control shadow-none" id="ft_lastname" name="ft_lastname" placeholder="Primer Apellido" value="{{ old('ft_lastname') }}" required>
                </div>
                <div class="form-group form__group_glory">
                    <label for="sc_lastname">Segundo Apellido - <span>Opcional</span></label>
                    <input type="text" class="form-control shadow-none" id="sc_lastname" name="sc_lastname" placeholder="Segundo Apellido" value="{{ old('sc_lastname') }}">
                </div>
            </div>
            <div class="form-group form__group_glory">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control shadow-none" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
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
                <label for="phone">Dirección <span>- Opcional</span></label>
                <input type="string" class="form-control shadow-none" id="address" class="address" name="address" placeholder="Dirección" value="{{old('address')}}">
            </div>
            <div class="con__alert">
                <p>Al continuar, aceptas <a href="#"><b>los Términos de uso</b></a> y <a href="#"><b>la política de privacidad</b></a></p>
            </div>
            <div class="con_btn">
                <input type="submit" value="Crear cuenta" class="btn btn-primary btn__login">
            </div>
        </form>
        <div class="con__aler_login">
            <p>
                ¿Ya tienes cuenta?
                <a href="{{route('login')}}">Inicie sesión</a>
            </p>

        </div>
    </section>
    <footer class="footer__login">

    </footer>
</div>
@endsection
