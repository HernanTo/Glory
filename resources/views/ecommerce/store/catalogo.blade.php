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
    @include('layouts.components.section_category')

    @foreach ($categories as $category)
        @if(count($category->products) > 0)
            <section class="con__section_prods">
                <div class="header__section__prods">
                    <h2>{{$category->name}}</h2>
                    <a href="{{ route('category.productos', $category->name) }}">Ver todos</a>
                </div>
                <div class="slider__divs slider__divs__products">
                    <div class="btn__actions__band span__left">
                        <i class="fi fi-br-angle-left"></i>
                    </div>
                    <div class="con__products con__products__band">
                        @foreach ($category->products as $product)
                            @if ($product->is_active)
                                @include('layouts.components.product-basic')
                            @endif
                        @endforeach
                    </div>
                    <div class="btn__actions__band span__right">
                        <i class="fi fi-br-angle-right"></i>
                    </div>
                </div>
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
