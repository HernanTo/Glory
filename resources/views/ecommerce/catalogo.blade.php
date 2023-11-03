@extends('layouts.guest')

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
    <section class="con__categories">
        <a href="{{ route('catalogo') }}" class="category_btn">
            <i class="fi fi-ss-box-open-full"></i>
            <h3>Catálogo</h3>
        </a>
        <a href="{{ route('category.productos', 'Caja') }}" class="category_btn">
            <figure>
                <img src="{{ asset('img/gearbox.png') }}" alt="" class="ico__category">
            </figure>
            <h3>Caja</h3>
        </a>
        <a href="{{ route('category.productos', 'Exteriores') }}" class="category_btn">
            <figure>
                <img src="{{ asset('img/car.png') }}" alt="" class="ico__category">
            </figure>
            <h3>Exteriores</h3>
        </a>
        <a href="{{ route('category.productos', 'Motor') }}" class="category_btn">
            <figure>
                <img src="{{ asset('img/car-engine.png') }}" alt="" class="ico__category">
            </figure>
            <h3>Motor</h3>
        </a>
        <a href="{{ route('category.productos', 'Suspension') }}" class="category_btn">
            <figure>
                <img src="{{ asset('img/suspension.png') }}" alt="" class="ico__category">
            </figure>
            <h3>Supensión</h3>
        </a>
    </section>

    @foreach ($categories as $category)
        @if(count($category->products) > 0)
            <section class="con__section_prods">
                <div class="header__section__prods">
                    <h2>{{$category->name}}</h2>
                    <a href="{{ route('category.productos', $category->name) }}">Ver todos</a>
                </div>
                <div class="con__products">
                @foreach ($category->products as $product)
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
