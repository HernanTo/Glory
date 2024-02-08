@extends('layouts.app')
@section('title', 'Factura | Glory Store')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}">
@endsection

@section('content')
<div class="container-index-user conrtainer-table-d">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a href="{{ route('bills') }}">Facturas</a>
            /
            <a>{{$bill->reference}}</a>
        </div>
        <h2>Resumen factura</h2>
    </div>
    <div class="con-bill-summary">
        <div class="con-items-bill-s con-items-fact">
            <div class="header-items-s">
                <h2>Factura</h2>
                <i class="fi fi-sr-receipt"></i>
            </div>
            <div class="body-items-sum body-items-fact">
                <span>
                    <label>Número de factura</label>
                    <h3> {{$bill->reference}} </h3>
                    <i class="fi fi-br-hastag"></i>
                </span>

                <span>
                    <label>Fecha</label>
                    <h3> {{$bill->created_at}} </h3>
                    <i class="fi fi-sr-calendar-day"></i>
                </span>

                <span>
                    <label>Estado de pago</label>
                    <h3>{{$bill->state}}</h3>
                    <i class="fi fi-sr-hand-holding-usd"></i>
                </span>

                <span>
                    <label>IVA</label>

                    <h3>{{$bill->haveIVA}}</h3>
                    <i class="fi fi-sr-badge-percent"></i>
                </span>
                @if ($bill->is_paid == 1)
                    <span>
                        <label>Tipo de pago</label>
                        <h3> {{$bill->typePay->name}} </h3>
                        <i class="fi fi-sr-wallet"></i>
                    </span>
                @else
                    <span>
                        <label>Subtotal</label>
                        <h3 class="prices"> {{$bill->subtotal}} </h3>
                        <i class="fi fi-br-plus-minus"></i>
                    </span>
                @endif


                <span>
                    <label>Total</label>
                    <h3 class="prices"> {{$bill->total}} </h3>
                    <i class="fi fi-sr-usd-circle"></i>
                </span>
            </div>
        </div>
        <div class="actions-bill">
            <a href="{{ route('bills.export', $bill->id) }}" class="export-document" target="_blank" rel="noopener noreferrer" title="Generar PDF">
                <i class="fi fi-sr-file-pdf"></i>
            </a>

            <a href="{{ route('bills.edit', $bill->id) }}" class="edit-bill" title="Editar Factura">
                <i class="fi fi-sr-file-edit"></i>
            </a>

            <button class="delete-bill" title="Eliminar factura" onclick="confirmTrash({{ $bill->id }}, '{{$bill->reference}}')"><i class="fi fi-sr-trash-xmark"></i></button>
        </div>

        <div class="con-items-bill-s con-items-min con-items-cli">
            <div class="header-items-s">
                <h2>Cliente</h2>
                <i class="fi fi-ss-user-crown"></i>
            </div>
            <div class="body-items-sum body-clien-sum">
                <p> {{$bill->customer->nameLast}} </p>
                <p>NIT / CC: {{$bill->customer->cc}}</p>
                <p>Tel: {{$bill->customer->phone_number}}</p>
                <a href="{{ route('clientes.cliente', $bill->customer->cc) }}" class="action-user-sum">Ver Cliente</a>
            </div>
        </div>
        <div class="con-items-bill-s con-items-min con-items-seller">
            <div class="header-items-s">
                <h2>Vendedor</h2>
                <i class="fi fi-sr-user-gear"></i>
            </div>
            <div class="body-items-sum body-seller-sum">
                <img src="{{ asset("img/profileImages/" . $bill->seller->profile_photo_path) }}" alt="Profile">
                <h2>{{$bill->seller->nameLast}}</h2>
                <a href="{{ route('usuarios.usuario', $bill->seller->cc) }}" class="action-user-sum">Ver Más</a>
            </div>
        </div>

        <div class="con-items-bill-s con-item-order-s">
            <div class="header-items-s">
                <h2>Orden</h2>
                <i class="fi fi-sr-box-open"></i>
            </div>
            <div class="body-items-sum body-order-sum">
                <h2 class="hed__prod_or">Productos</h2>

                @if (count($bill->products) >= 1)
                    @foreach ($bill->products as $product)
                        <div class="product-su">
                            <img src="{{ asset('img/products/' . $product->ImagesMain) }}" alt="product">
                            <h2> {{$product->NameFor}} </h2>
                            <h4 class="prices">{{$product->price}}</h4>

                            <p class="cantidad-prod-s">Cantidad: <i> {{$product->pivot->stock}} </i></p>
                            <p class="mano-obra-su">Descuento: <i class="prices"> {{$product->priceDiscount}} </i></p>

                            <h1 class="prices prices-pro"> {{$product->pivot->total_prices}} </h1>
                        </div>
                    @endforeach
                @else
                    <div class="product_no">
                        <h2 class="h2_not_product">Esta factura no cuenta con productos adjuntos</h2>
                    </div>
                @endif

                <div class="con__sum__services">
                    <h2>Servicios</h2>
                    @if (count($bill->services) >= 1)
                        @foreach ($bill->services as $service)
                            <div class="serv">
                                <h3> {{ $service->name }} </h3>
                                <h5 class="prices prices-pro"> {{ $service->price }} </h5>
                            </div>
                        @endforeach
                    @else
                        <div class="serv serv_no">
                            <h2>Esta factura no cuenta con servicios adjuntos</h2>
                        </div>
                    @endif
                </div>

                <div class="con-sum-prices">
                    <p>Subtotal</p>
                    <h2 class="prices"> {{$bill->subtotal}} </h2>

                    <p>IVA</p>
                    @if ($bill->IVA == 1)
                        <h2 class="prices"> {{ $bill->subtotal * 0.19 }} </h2>
                    @else
                        <h2>No aplica</h2>
                    @endif

                    <p>Total:</p>
                    <h2 class="prices"> {{$bill->total}} </h2>
                </div>
            </div>
        </div>
    </div>

</div>
@include('facturas.modal')
@endsection
@section('scripts')
<script src="{{ asset('js/products.js') }}"></script>
@endsection
