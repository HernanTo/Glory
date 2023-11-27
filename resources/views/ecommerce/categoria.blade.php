@extends('layouts.guest')
@section('title',  $category->name  . ' | Glory Store')
@section('meta_description',  "Explora nuestra selección de $category->name para carros. Encuentra los complementos perfectos para personalizar y mejorar el rendimiento de tu vehículo.")
@section('meta_op_title', $category->name  . ' | Glory Store')
@section('meta_op_desc', "Explora nuestra selección de $category->name para carros. Encuentra los complementos perfectos para personalizar y mejorar el rendimiento de tu vehículo.")

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
        @foreach ($category->products as $product)
            @php
                $state = false;
                if($product->is_active == 1){
                    $state = true;
                }
            @endphp
        @endforeach
        @if ($state)
            <article class="con__filter__list">
                <form action="{{route('category.productos', "$category->name")}}" method="get" id="search_filter">
                    <label for="order__select">Ordernar por</label>
                    <select name="order" id="order__select" class="order__select">
                        <option value="">Relevancia</option>
                        @if (request('order') == 'desc')
                            <option value="desc" selected>Mayor precio</option>
                        @else
                            <option value="desc">Mayor precio</option>
                        @endif
                        @if (request('order') == 'asc')
                            <option value="asc" selected>Menor precio</option>
                        @else
                            <option value="asc">Menor precio</option>
                        @endif
                    </select>
                </form>
            </article>
            <div class="con__products">
                @foreach ($productsCategory as $product)
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
<script>
    document.getElementById('order__select').addEventListener('change', event =>{
        document.getElementById('search_filter').submit();
    });
    </script>
@endsection
