@extends('layouts.app')

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
            <a href="{{ route('bills') }}">Facturas</a>
            /
            <a>Nueva Factura</a>
        </div>
        <h2>Nueva Factura</h2>
    </div>
    <div class="container-forr">
        <form action="{{route('bills.store')}}" method="post" id="form-bill">
            @csrf
            <div class="divider__form divider__form_icon">
                <h2>Información básica de la factura</h2>
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
                <h2>Servicios de la factura</h2>
                <i class="fi fi-sr-settings-sliders"></i>
            </div>
            <section class="sect__form__p con__servs">
                <div class="con__insert__serv">
                    <div class="inserts-serv">
                        <label>Ingresar</label>
                        <input type="number" class="form-control" id="can_serv_insert" placeholder="Cantidad Servicios" style="margin-bottom: 20px">

                        <button type="button" id="btn-inser-serv">Insertar</button>
                    </div>
                    <div class="insert__serv">
                        <button id="add-serv" type="button"><i class="fi fi-br-plus-small"></i>Insertar servicio</button>
                    </div>
                </div>
                <div class="con-serv" id="con-serv">
                    <div class="not-pro-ord not-serv-ord" id="not-serv-ord">
                        <h5>Aún no se han agregado servicios</h5>
                    </div>
                </div>
            </section>
            <div class="divider__form divider__form_icon">
                <h2>Configuración Factura</h2>
                <i class="fi fi-sr-settings-sliders"></i>
            </div>
            <section class="sect__form__p sect__setings">
                <article>
                    <h4>Preferencias Factura</h4>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="iva__check" name="iva__check" checked>
                        <label class="form-check-label" for="iva">Incluir IVA</label>
                    </div>
                </article>

                <article>
                    <h4>Estado de la factura</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_paid" name="is_paid" checked>
                        <label class="form-check-label" for="is_paid">
                          Pagada
                        </label>
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
                    <h3>Estado: </h3>
                    <p id="estado__pago">Pagada</p>
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

@include('productos.administration.modal')
@endsection
@section('scripts')
<script>
    var asset_global='{{asset("/")}}';
    var asset_products_global='{{asset("/img/products")}}';
</script>

<script src="{{ asset('libs/selects/select2.min.js') }}"></script>
<script src="{{ asset('js/currencyPrice.js') }}"></script>
<script src="{{ asset('js/add-bill.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#customers').select2({
            placeholder: "Seleccione un cliente",
            allowClear: true
        });
        $('#sellers').select2({
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
@endsection


