@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/dahsboard.css')}}">
@endsection

@section('content')
<div class="container-index-user conrtainer-table-d">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <h2>Glory Store</h2>
    </div>
    <div class="con__quick__access">
        <small>Accesos rápidos</small>
        <div class="con__src">
            <a href="">Añadir Usuario</a>
            <a href="">Añadir productos</a>
            <a href="">Generar facturas</a>
            <a href="">Nuevo Post</a>
            <a href="">Configuraciones</a>
        </div>
    </div>
    <div class="con__charts">
        <section class="cards__chart">
            <div class="h__card__chart">
                <h2><span>$</span>1000</h2>
                <h4>Ganancias de los últimos 30 días.</h4>
                <small>27/11/2023 - 27/12/2023</small>
            </div>
            <div class="body__card_chart">
                <canvas id="chartCategories" class="charts_dash"></canvas> 
            </div>
        </section>
    </div>
</div>
@endsection
