@extends('layouts.guest')
@section('title',  $category->name  . ' | Glory Store')

@section('styles')
<link rel="stylesheet" href="{{asset('css/producto.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/product-list.css')}}"> --}}
@endsection

@section('content')
<div class="container_content">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('home') }}">Home</a>
            /
            <a>{{$category->name}}</a>
        </div>
        <h2>{{$category->name}}</h2>
    </div>
    @if (count($category->products) > 0)
        <article class="con__filter__list">
            <form action="" method="get" id="search_filter">
                <label for="">Ordernar por</label>
                <select name="" id="" class="order__select">
                    <option value="asc">Relevancia</option>
                    <option value="asc">Mayor precio</option>
                    <option value="asc">Menor precio</option>
                </select>
            </form>
        </article>
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
    @else
        <section class="products__not__found">
            <i class="fi fi-ss-binoculars"></i>
            <div class="con__list__ps">
                <h2>No se encontraron repuestos</h2>
                <ul>
                    <li>Verifique su busqueda</li>
                    <li>Refresque la página</li>
                    <li>La página ya no existe</li>
                    <li>Ingresaste una URL incorrecta</li>
                </ul>
            </div>
        </section>
    @endif
</div>
@endsection
@section('scripts')
<script src="{{asset('js/products.js')}}"></script>
@endsection
