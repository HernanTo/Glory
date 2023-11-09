@extends('layouts.template')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('guest')
    <div class="container__login">
        <section class="con__login">
            <div class="header__con__login">
                <a href="">
                    <img src="{{ asset('img/logoc.svg') }}" alt="Glory Store" class="header__logo__login">
                </a>
                <h2>Iniciar sesión</h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        - {{$error}} <br>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-floating form__floating__glory">
                    <input type="number" class="form-control" id="floatingPassword" placeholder="Identificación" name="ide">
                    <label for="floatingPassword">Identificación</label>
                </div>
                <div class="form-floating form__floating__glory">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>
                <a href="{{ route('password.request') }}" class="link__forg">¿Ólvido su contraseña?</a>
                <div class="con_btn">
                    <input type="submit" value="Iniciar" class="btn btn-primary btn__login">
                </div>
            </form>
            <div class="con__aler_login">
                <p>
                    ¿No tiene una cuenta?
                    <a href="{{route('register')}}">Registrese</a>
                </p>

            </div>
        </section>
        <article class="aside__login">

        </article>
        <footer class="footer__login">

        </footer>
    </div>
@endsection
