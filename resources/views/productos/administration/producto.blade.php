@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('libs/xZoom/xzoom.min.css')}}">
<link rel="stylesheet" href="{{asset('css/producto.css')}}">
@endsection

@section('content')
<div class="container-product">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a href="{{ route('productos.administration') }}">Productos</a>
            /
            <a>{{$product->name}}</a>
        </div>
        <h2>{{$product->name}}</h2>
    </div>
    <div class="gallery__product">
        <div class="con__main__photo xzoom-container">
            <img class="xzoom3" src="{{ asset('img/products/' . $product->ImagesMain) }}"></a>
        </div>
        <div class="xzoom-thumbs">
            @foreach ($product->images as $image)
                <a><img class="xzoom-gallery3" src="{{ asset('img/products/'.$image->photo) }}"></a>
            @endforeach
        </div>
    </div>
    <section class="section__info__basic__product">
        <div class="con__h_info_product">
            <h3> {{$product->name}} </h3>
            <label>Precio:</label>
            <span class="prices"> {{$product->price}} </span>
        </div>

        <div class="con__b__info__product">
            @if ($product->stock > 0)
            <h4>Stock disponible</h4>
            @else
            <h4>Stock no disponible</h4>
            @endif
            @if ($product->available == 0 || $product->stock > 0)
                <span class="available">Disponibilidad Inmediata</span>
            @endif
            @if ($product->available == 15 && $product->stock <= 0)
            <span class="available available__middle">Disponibilidad 15 días</span>
            @endif
            @if ($product->available == 30 && $product->stock <= 0)
            <span class="available available__long">Disponibilidad 30 días</span>
            @endif
            @if ($product->available == 60 && $product->stock <= 0)
            <span class="available available__long__extra">Disponibilidad 60 días</span>
            @endif

            @if ($product->stock == 1)
            <small>1 Disponible</small>
            @endif
            @if ($product->stock > 1)
            <small>{{$product->stock}} Disponibles</small>
            @endif
        </div>
        <article class="con__actions_vertical">
            @can('edit.products.dash')
            <a href="{{ route('productos.administration.edit', $product->slug) }}" class="btn__edit__model">
                Editar
            </a>
            @endcan
            @can('destroy.products.dash')
                <a onclick="confirmTrash({{ $product->id }}, '{{ $product->name }}')" class="btn-elim-user">Eliminar</a>
            @endcan
        </article>
    </section>
    <section class="section__desc_product">
        <h5>Descripción del producto</h5>
        <div class="body__desc__product">
            {!!  $product->description  !!}
        </div>
    </section>
    <section class="section__aditional__info">
        <h5>Información Adicional</h5>
        <table class="table__aditional__info">
            <tr>
                <td style="width: 130px" class="th__aditional"># de Repuesto:</td>
                <td>{{$product->num_repuesto}}</td>
            </tr>
            <tr class="th__aditional">
                <td>Barras:</td>
                <td>{{$product->barcode}}</td>
            </tr>
            <tr class="th__aditional">
                <td>Precio:</td>
                <td class="prices">{{$product->price}}</td>
            </tr>
            @can('see.cost.product.dash')
            <tr class="th__aditional">
                <td>Costo:</td>
                <td class="prices">{{$product->cost}}</td>
            </tr>
            @endcan
            <tr class="th__aditional">
                <td>Stock:</td>
                <td>{{$product->stock}}</td>
            </tr>
            <tr class="th__aditional">
                <td>Min Stock:</td>
                <td>{{$product->min_stock}}</td>
            </tr>
            <tr class="th__aditional">
                <td>Disponibilidad:</td>
                <td>{{$product->available}} Días</td>
            </tr>
            <tr class="th__aditional">
                <td>Estado:</td>
                @if ($product->is_active == true)
                <td>Activo</td>
                @else
                <td>Inactivo</td>
                @endif
            </tr>
        </table>
    </section>
</div>
@include('productos.administration.modal')
@endsection
@section('scripts')
<script src="{{asset('libs/xZoom/xzoom.min.js')}}"></script>
<script src="{{asset('libs/xZoom/setup.js')}}"></script>
<script src="{{asset('js/products.js')}}"></script>
@endsection
