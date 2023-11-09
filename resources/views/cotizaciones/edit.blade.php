@extends('layouts.app')
@section('title', 'Editar Cotización | Glory Store')

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
            <a href="{{ route('budgets') }}">Cotización</a>
            /
            <a href="{{route('budgets.budget', $budget->id)}}">{{$budget->reference}}</a>
            /
            <a>Editar</a>
        </div>
        <h2>Editar Cotización</h2>
    </div>
    <div class="con_child">
        <div class="alert alert-secondary" role="alert">
            Puede editar si la cotización incluye IVA
        </div>
        <form action="{{ route('budgets.update', $budget->id) }}" method="post">
            @csrf
            @method('PUT')
            <section class="sect__form__p sect__setings">
                <article>
                    <h4>Preferencias de la cotización</h4>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="iva__check" name="iva__check" {{$budget->IVA ? 'checked' : ''}}>
                        <label class="form-check-label" for="iva">Incluir IVA</label>
                    </div>
                </article>
            </section>
            <section class="con__two__sub__form">
                <button type="submit" class="btn__subm btn">Actualizar</button>
                <a href="{{ route('productos.administration')}}" class="btn__back">Volver</a>
            </section>
        </form>
    </div>

</div>
@include('cotizaciones.modal')
@endsection
@section('scripts')
<script src="{{ asset('js/products.js') }}"></script>
@endsection
