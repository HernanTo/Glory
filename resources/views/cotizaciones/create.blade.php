@extends('layouts.app')
@section('title', 'Crear Cotización | Glory Store')

@section('styles')
    <link rel="stylesheet" href="{{asset('/libs/selects/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/add-bill.css')}}">
@endsection

@section('content')
<div class="container-index-user conrtainer-table-d">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a href="{{ route('budgets') }}">Cotizaciones</a>
            /
            <a>Nueva cotización</a>
        </div>
        <h2>Nueva cotización</h2>
    </div>
    <div class="container-forr">
        <form action="{{route('budgets.store')}}" method="post" id="form-bill">
            @csrf
            <div class="divider__form divider__form_icon">
                <h2>Información básica de la cotización</h2>
                <i class="fi fi-sr-comment-info"></i>
            </div>
            <section class="sect__form__p">
                <div class="form-floating form__floating__glory">
                    <input type="date" class="form-control shadow-none date-input" id="date_bill" placeholder="Fecha" name="date_bill" required>
                    <label for="floatingInputValue">Fecha</label>
                </div>
                <div class="con-select-s">
                    <label for="customer">Cliente:</label>
                    <select name="customer" id="customers">
                        <option value=""></option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">({{$customer->cc}}) - {{$customer->fullName}}</option>
                        @endforeach
                    </select>
                    <a class="input__add__user__bill btn-modal-add" id="btn-add-customer" href="{{route('usuarios.create')}}"><i class="fi fi-br-plus-small"></i> Añadir</a>
                </div>
                @can('link.sellers.budgets')
                    <div class="con-select-s">
                        <label for="seller">Vendedor:</label>
                        <select name="seller" id="sellers">
                            <option value=""></option>
                            @foreach ($sellersPer as $seller)
                            <option value="{{ $seller->id }}">({{$seller->cc}}) - {{$seller->fullName}}</option>
                            @endforeach
                            @foreach ($sellersRole as $seller)
                            <option value="{{ $seller->id }}">({{$seller->cc}}) - {{$seller->fullName}}</option>
                            @endforeach
                        </select>
                        <a class="input__add__user__bill btn-modal-add" id="btn-add-customer" href="{{route('usuarios.create')}}"><i class="fi fi-br-plus-small"></i> Añadir</a>
                    </div>
                @else
                    <select name="seller" id="sellers" style="display: none">
                        <option value="{{auth()->user()->id}}"> {{auth()->user()->id}} </option>
                    </select>
                @endcan
                <div class="con-select-s">
                    <label for="products">Lista de productos:</label>
                        <select name="products" id="products">
                            <option value=""></option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}" data-price="{{$product->price}}" data-amount="{{$product->stock}}" data-img="{{$product->imagesMain}}" data-barcode="{{$product->barcode}}">({{$product->barcode}}) {{$product->name}} </option>
                            @endforeach
                        </select>
                        <a href="{{route('productos.administration.create')}}" class="input__add__user__bill btn-modal-add"><i class="fi fi-br-plus-small"></i> Añadir</a>

                        <div class="alert alert-warning" role="alert" style="margin-top: 20px; display: none;" id="alert-prod-ag">
                            El producto seleccionado, ya fue agregado
                        </div>
                    </div>
            </section>
            <div class="divider__form divider__form_icon">
                <h2>Respuestos de la orden</h2>
                <i class="fi fi-sr-shopping-cart"></i>
            </div>
            <div class="sect__form__p con__product__ord" id="con__product__ord">
                <div class="not-pro-ord" id="not-pro-ord">
                    <h5>Aún no se han agregado repuestos</h5>
                </div>
            </div>

            <div class="divider__form divider__form_icon">
                <h2>Configuración cotización</h2>
                <i class="fi fi-sr-settings-sliders"></i>
            </div>
            <section class="sect__form__p sect__setings">
                <article>
                    <h4>Preferencias cotización</h4>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="iva__check" name="iva__check" checked>
                        <label class="form-check-label" for="iva">Incluir IVA</label>
                    </div>
                </article>

            </section>
            <div class="divider__form divider__form_icon">
                <h2>Resumen</h2>
                <i class="fi fi-sr-calculator"></i>
            </div>
            <section class="sect__form__p sect__resume">
                <div class="info-fact">
                    <h3>IVA: </h3>
                    <p id="iva_info" class="prices">0</p>
                </div>
                <div class="info-fact">
                    <h3>Subtotal: </h3>
                    <p class="con-sub-t prices" id="con-sub-t">0</p>
                </div>
                <div class="info-fact">
                    <h3>Total: </h3>
                    <p class="con-t prices" id="con-t">0</p>
                </div>
            </section>
            <section class="con__two__sub__form">
                <button type="button" id="btn__sub_bill" class="btn__subm btn btn-disabled" disabled>Crear</button>
                <a href="{{ route('productos.administration')}}" class="btn__back">Volver</a>
            </section>
        </form>
    </div>
</div>

@include('cotizaciones.modal')
@endsection
@section('scripts')
<script>
    var asset_global='{{asset("/")}}';
    var asset_products_global='{{asset("/img/products")}}';
</script>

<script src="{{ asset('libs/selects/select2.min.js') }}"></script>
<script src="{{ asset('js/currencyPrice.js') }}"></script>
<script src="{{ asset('js/add-cotizacion.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#customers').select2({
            placeholder: "Seleccione un cliente",
            allowClear: true
        });
        $('#products').select2({
            placeholder: "Seleccione los productos",
            allowClear: true
        });
    });

    let prices = document.querySelectorAll('.prices');

    for (let i = 0; i < prices.length; i++) {
    let precio = prices[i].textContent;
        $(prices[i]).empty();
        prices[i].appendChild(document.createTextNode(formatCurrency(precio)));
    }
</script>

@can('link.sellers.budgets')
<script>
    $(document).ready(function() {
        $('#sellers').select2({
            placeholder: "Seleccione un cliente",
            allowClear: true
        });
    });
</script>
@endcan

{{-- <script>
    $(document).ready(function() {
        $('#modal_stock_low').modal('show');
    });
</script> --}}

@if(session('productsError'))
    <script>
        var productsError = @json(session('productsError'));
        $(document).ready(function() {
            errorStock(productsError);
        });
    </script>
@endif

@endsection


