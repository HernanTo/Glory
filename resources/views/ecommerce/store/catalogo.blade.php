@extends('layouts.guest')
@section('title', 'Catálogo | Glory Store')
@section('meta_description', 'Explora nuestro amplio catálogo de repuestos. Encuentra accesorios, piezas originales, suspension para carros, exteriores y mucho más para tu vehículo')
@section('meta_op_title', 'Catálogo | Glory Store')
@section('meta_op_desc', 'Explora nuestro amplio catálogo de repuestos. Encuentra accesorios, piezas originales, suspension para carros, exteriores y mucho más para tu vehículo')

@section('styles')
<link rel="stylesheet" href="{{asset('libs/xZoom/xzoom.min.css')}}">
<link rel="stylesheet" href="{{asset('css/producto.css')}}">
@endsection

@section('content')
<div class="container_content">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('home') }}">Home</a>
            /
            <a href="#">Catálogo</a>
        </div>
        <h2>Catálogo</h2>
    </div>
    <x-store.components.section-category :categories="$allCategories"/>

    @foreach ($categories as $category)
        @if(count($category->products) > 0)
            <section class="con__section_prods con__section_prods__bg" style="margin-top: 30px; width;">
                <div class="header__section__prods">
                    <h2>{{$category->name}}</h2>
                    <a href="{{ route('category.productos', $category->name) }}">Ver todos</a>
                </div>
                <x-store.components.product-band :products="$category->products"/>
            </section>
        @endif
    @endforeach
</div>
@endsection
@section('scripts')
<script src="{{asset('js/products.js')}}"></script>
<script src="{{asset('js/categories.js')}}"></script>
<script src="{{asset('js/bandProducs.js')}}"></script>
@endsection
