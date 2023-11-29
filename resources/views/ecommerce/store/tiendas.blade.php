@extends('layouts.guest')
@section('title', 'Nuestras tiendas | Glory Store')
@section('meta_description', 'Te esperamos en nuestra tienda ubicada en la ciudad de Bogotá D.C - Colombia')
@section('meta_op_title', 'Nuestras tiendas | Glory Store')
@section('meta_op_desc', 'Te esperamos en nuestra tienda ubicada en la ciudad de Bogotá D.C - Colombia')

@section('styles')

@endsection

@section('content')
<div class="container_content">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('home') }}">Home</a>
            /
            <a  href="#">Nuestra tienda</a>
        </div>
        <h2>Nuestra tienda</h2>
    </div>
    <div class="container__cards">
        <a class="card mb-3" href="https://maps.app.goo.gl/cyAdNN4gYyi4GEav8" target="__blank">
            <div class="row g-0">
                <div class="col-md-5 con__if">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.427772636579!2d-74.12754092520832!3d4.695499295279495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9ca79a34b449%3A0x81f72add47656b75!2sCl%2064%20%23103a-33%2C%20Bogot%C3%A1!5e0!3m2!1ses!2sco!4v1698737749330!5m2!1ses!2sco"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Ubicación del Taller Glory Store"></iframe>
                </div>
                <div class="col-md-6">
                    <div class="card-body" id="card__store">
                        <h3 class="card-title">Taller Glory Store</h3>
                        <p class="card-text">CL 64 103A-33, Bogotá</p>
                        <p class="card-text">Bogotá D.C</p>
                        <p class="card-text">Engativá</p>
                        <p class="card-text">Villa del mar</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection

@section('scripts')

@endsection
