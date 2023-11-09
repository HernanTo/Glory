@extends('layouts.app')
@section('title', 'Cotización | Glory Store')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}">
@endsection

@section('content')
<div class="container-index-user conrtainer-table-d">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a href="{{ route('bills') }}">Cotización</a>
            /
            <a>{{$budget->reference}}</a>
        </div>
        <h2>Resumen Cotización</h2>
    </div>
    <div class="con-bill-summary">
        <div class="con-items-bill-s con-items-fact">
            <div class="header-items-s">
                <h2>Cotización</h2>
                <i class="fi fi-sr-receipt"></i>
            </div>
            <div class="body-items-sum body-items-fact">
                <span>
                    <label>Número de cotización</label>
                    <h3> {{$budget->reference}} </h3>
                    <i class="fi fi-br-hastag"></i>
                </span>

                <span>
                    <label>Fecha</label>
                    <h3> {{$budget->created_at}} </h3>
                    <i class="fi fi-sr-calendar-day"></i>
                </span>

                <span>
                    <label>IVA</label>

                    <h3>{{$budget->haveIVA}}</h3>
                    <i class="fi fi-sr-badge-percent"></i>
                </span>

                <span>
                    <label>Subtotal</label>
                    <h3 class="prices"> {{$budget->subtotal}} </h3>
                    <i class="fi fi-br-plus-minus"></i>
                </span>

                <span>
                    <label>Total</label>
                    <h3 class="prices"> {{$budget->total}} </h3>
                    <i class="fi fi-sr-usd-circle"></i>
                </span>
            </div>
        </div>
        <div class="actions-bill">
            <a href="{{ route('budgets.export', $budget->id) }}" class="export-document" target="_blank" rel="noopener noreferrer" title="Generar PDF">
                <i class="fi fi-sr-file-pdf"></i>
            </a>

            <a href="{{ route('budgets.edit', $budget->id) }}" class="edit-bill" title="Editar cotización">
                <i class="fi fi-sr-file-edit"></i>
            </a>

            <button class="delete-bill" title="Eliminar cotización" onclick="confirmTrash({{ $budget->id }}, '{{$budget->reference}}')"><i class="fi fi-sr-trash-xmark"></i></button>
        </div>

        <div class="con-items-bill-s con-items-min con-items-cli">
            <div class="header-items-s">
                <h2>Cliente</h2>
                <i class="fi fi-ss-user-crown"></i>
            </div>
            <div class="body-items-sum body-clien-sum">
                <p> {{$budget->customer->nameLast}} </p>
                <p>NIT / CC: {{$budget->customer->cc}}</p>
                <p>Tel: {{$budget->customer->phone_number}}</p>
                <a href="{{ route('clientes.cliente', $budget->customer->cc) }}" class="action-user-sum">Ver Cliente</a>
            </div>
        </div>
        <div class="con-items-bill-s con-items-min con-items-seller">
            <div class="header-items-s">
                <h2>Vendedor</h2>
                <i class="fi fi-sr-user-gear"></i>
            </div>
            <div class="body-items-sum body-seller-sum">
                <img src="{{ asset("img/profileImages/" . $budget->seller->profile_photo_path) }}" alt="Profile">
                <h2>{{$budget->seller->nameLast}}</h2>
                <a href="{{ route('usuarios.usuario', $budget->seller->cc) }}" class="action-user-sum">Ver Más</a>
            </div>
        </div>

        <div class="con-items-bill-s con-item-order-s">
            <div class="header-items-s">
                <h2>Orden</h2>
                <i class="fi fi-sr-box-open"></i>
            </div>
            <div class="body-items-sum body-order-sum">
                <h2 class="hed__prod_or">Productos</h2>

                @if (count($budget->products) >= 1)
                    @foreach ($budget->products as $product)
                        <div class="product-su">
                            <img src="{{ asset('img/products/' . $product->ImagesMain) }}" alt="product">
                            <h2> {{$product->NameFor}} </h2>
                            <h4 class="prices">{{$product->price}}</h4>

                            <p class="cantidad-prod-s">Cantidad: <i> {{$product->pivot->stock}} </i></p>
                            <p class="mano-obra-su">Descuento: <i class="prices"> {{$product->pivot->discount}} </i></p>

                            <h1 class="prices prices-pro"> {{$product->pivot->total_prices}} </h1>
                        </div>
                    @endforeach
                @else
                    <div class="product_no">
                        <h2 class="h2_not_product">Esta Cotización no cuenta con productos adjuntos</h2>
                    </div>
                @endif

                <div class="con-sum-prices">
                    <p>Subtotal</p>
                    <h2 class="prices"> {{$budget->subtotal}} </h2>

                    <p>IVA</p>
                    @if ($budget->IVA == 1)
                        <h2 class="prices"> {{ $budget->subtotal * 0.19 }} </h2>
                    @else
                        <h2>No aplica</h2>
                    @endif

                    <p>Total:</p>
                    <h2 class="prices"> {{$budget->total}} </h2>
                </div>
            </div>
        </div>
    </div>

</div>
@include('cotizaciones.modal')
@endsection
@section('scripts')
<script src="{{ asset('js/products.js') }}"></script>
@endsection
