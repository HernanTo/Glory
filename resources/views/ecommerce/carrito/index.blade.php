
@extends('layouts.guest')
@section('title', 'Carrito de Compras | Glory Store')

@section('styles')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@section('content')
<div class="container_content">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a  href="{{ route('home') }}">Continuar comprando</a>
            /
            <a>Carrito de Compras</a>
        </div>
        <h2>Carrito de compras</h2>
    </div>
    @if (count($mix) > 0)
        <div class="container__carrito">
            <section class="products">
                <table>
                    <thead>
                        <tr class="th__prod">
                            <th style="width: 150px">Producto</th>
                            <th></th>
                            <th style="width: 100px">Cantidad</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mix as $product)
                            <tr class="producto__cart">
                                <td>
                                    <figure>
                                        <img src="{{asset('img/products/' . $product['img'])}}" alt="">
                                    </figure>
                                </td>
                                <td class="info__prod__cart">
                                    <h4>{{$product['name']}}</h4>
                                    <h5 class="prices">{{$product['priceU']}}</h5>
                                </td>
                                <td class="quantity__prod">
                                    <form action="{{ route('carrito.update') }}" method="post" id="form__update__cart__{{$product['id']}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="product" value="{{$product['id']}}" style="display: none">

                                        <select name="quantity" class="quantity" id="quantity__{{$product['id']}}" data-product="{{$product['id']}}">
                                            @if ($product['stockCurrently'] > 0)
                                                @for ($i = 1; $i <= $product['stockCurrently']; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            @else
                                                <option value="delete">Sin Stock</option>
                                            @endif
                                                <option value="delete">Eliminar</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <h6 class="prices">{{$product['priceTodo']}}</h6>
                                </td>
                                <td>
                                    <form action="{{route('carrito.destroy.c')}}" method="post" id="delete__prod_cart__{{$product['id']}}">
                                        @csrf
                                        <input type="number" name="product" value="{{$product['id']}}" style="display: none">
                                        <button class="trash"><i class="fi fi-sr-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @if ($product['stockCurrently'] <= 0)
                                <tr class="exception">
                                    <td colspan="5">
                                        <div class="alert alert-info alert__low_stock" role="alert">
                                            <b> Stock limitado: Quedan {{$product['stockCurrently']}} unidades. </b>Si necesita más, realice un encargo del producto y <b>cancele el 50% del total</b>, si quiere continuar aún así agreguelo al carrito.
                                        </div>
                                    </td>
                                </tr>
                            @elseif(($product['stockCart'] + 1) == $product['stockCurrently'])
                                <tr class="exception">
                                    <td colspan="5">
                                        <div class="alert alert-info alert__low_stock alert__hide" role="alert" id="alert__low__stock__cart">
                                            Estás a punto de superar la cantidad disponible en stock para este producto en tu carrito. Para adquirir más unidades, realiza un encargo y <b>cubre el 50% del total de los productos faltantes como pago inicial</b>.
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </section>
            <section class="resumen__cart">
                <article class="section__pay__resume">
                    <p>Subtotal: <span class="prices">{{$cart['']}}</span></p>
                    <p>Gastos de envío: <span>Por definir</span></p>
                </article>
                <article class="con__pay">
                    <h2 class="title__total__cart">Total <span class="prices">{{$cart['']}}</span></h2>
                    <form action="" method="get">
                        <div class="form-group group__privacy">
                            <input type="checkbox" name="privacy" id="privacy">
                            <label for="privacy">Acepto <a href="#"><b>los Términos de uso</b></a> y <a href="#"><b>la política de privacidad</b></a></label>
                        </div>
                        <div class="form-group group__submit">
                            <button type="submit" disabled id="btn__pay">Ir a pagar</button>
                        </div>
                    </form>
                </article>
            </section>
        </div>
        @else
        <section class="products__empty">
            <h3>Su carrito esta vacio</h3>
            <a href="{{route('home')}}">Buscar productos</a>
        </section>
        @endif
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/products.js')}}"></script>
    <script src="{{asset('js/cart-shop.js')}}"></script>
@endsection
