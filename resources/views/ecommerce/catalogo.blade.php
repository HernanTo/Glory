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
            <a>Catálogo</a>
        </div>
        <h2>Catálogo</h2>
    </div>
    @include('layouts.section_category')

    @foreach ($categories as $category)
        @if(count($category->products) > 0)
            <section class="con__section_prods">
                <div class="header__section__prods">
                    <h2>{{$category->name}}</h2>
                    <a href="{{ route('category.productos', $category->name) }}">Ver todos</a>
                </div>
                <div class="con__products">
                @foreach ($category->products as $product)
                    @if ($product->is_active)
                        <a href="{{route('producto.producto', $product->slug)}}" class="product">
                            <figure class="con__img_prod">
                                <img src="{{asset('img/products/' . $product->imagesMain)}}" alt="{{$product->slug}}">
                            </figure>
                            <div class="info__prod">
                                <div class="con__name_prod">
                                    <h3>{{ $product->nameFor }}</h3>
                                </div>
                                <div class="con_bottom_prod">
                                    <span class="prices">{{ $product->price }} </span>
                                    <button class="btn__add__car"><i class="fi fi-sr-shopping-cart-add"></i></button>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
                </div>
            </section>
        @endif
    @endforeach
</div>
@endsection
@section('scripts')
<script src="{{asset('js/products.js')}}"></script>
@endsection
