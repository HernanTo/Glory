@extends('layouts.app')
@section('title', 'Editar factura | Glory Store')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}">
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
            <a href="{{route('bills.bill', $bill->id)}}">{{$bill->reference}}</a>
            /
            <a>Editar</a>
        </div>
        <h2>Editar factura</h2>
    </div>
    <div class="con_child">
        <div class="alert alert-secondary" role="alert">
            Puede editar el estado de la factura y si contiene o no IVA.
        </div>
        <form action="{{ route('bills.update', $bill->id) }}" method="post">
            @csrf
            @method('PUT')
            <section class="sect__form__p sect__setings">
                <article>
                    <h4>Preferencias Factura</h4>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="iva__check" name="iva__check" {{$bill->IVA ? 'checked' : ''}}>
                        <label class="form-check-label" for="iva">Incluir IVA</label>
                    </div>
                </article>

                <article>
                    <h4>Estado de la factura</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_paid" name="is_paid" {{$bill->is_paid ? 'checked' : ''}}>
                        <label class="form-check-label" for="is_paid">
                          Pagada
                        </label>
                    </div>
                </article>
                <article id="con__type__pay" class="{{!$bill->is_paid ? 'hide_in_form' : ''}}">
                    <h4>Tipo de pago</h4>
                    <select name="type_pay" id=""  class="form-select">
                        @foreach ($typePays as $pay)
                            @if ($bill->is_paid)
                                @if ($bill->id_type_pay == $pay->id)
                                    <option value="{{$pay->id}}" selected>{{$pay->name}}</option>
                                @else
                                    <option value="{{$pay->id}}">{{$pay->name}}</option>
                                @endif
                            @else
                                <option value="{{$pay->id}}">{{$pay->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </article>
            </section>
            <section class="con__two__sub__form">
                <button type="submit" class="btn__subm btn">Actualizar</button>
                <a href="{{ route('productos.administration')}}" class="btn__back">Volver</a>
            </section>
        </form>
    </div>

</div>
@include('facturas.modal')
@endsection
@section('scripts')
<script src="{{ asset('js/products.js') }}"></script>
<script>
    document.getElementById('is_paid').addEventListener('change', event=>{
    document.getElementById('con__type__pay').classList.toggle('hide_in_form');
})
</script>
@endsection
