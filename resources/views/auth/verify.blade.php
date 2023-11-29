@extends('layouts.template')
@section('title', 'Verifique su correo | Glory Store')
@section('meta_op_title', 'Verifique su correo | Glory Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/verify.css') }}">
<meta name="robots" content="noindex" />
@endsection

@section('guest')
<div class="container">
    <section class="con__verify">
        <div class="header__verify">
            <h1>¡Gracias por registrarse en Glory Store!</h1>
        </div>
        <div class="body__verify">
            <p>Hemos enviado un correo electrónico a tu dirección de correo electrónico. Por favor, verifica tu cuenta haciendo clic en el enlace de verificación que encontrarás en el mensaje.
            </p>
            <p class="small">Si no has recibido el correo electrónico de verificación, por favor verifica tu carpeta de correo no deseado. Si aún no lo encuentras, puedes solicitar otro correo de verificación</p>
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit">{{ __('Reenviar correo de verificación') }}</button>.
            </form>
        </div>
    </section>
</div>
@endsection
