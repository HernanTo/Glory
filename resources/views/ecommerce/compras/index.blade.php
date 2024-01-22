
@extends('layouts.guest')
@section('title', 'Compras | Glory Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="con__settings conrtainer-table-d">
    @include('ecommerce.profile.sidebar')
    <div class="body__settigs">
        <div class="con__head_sect con__head_sect__flex">
            <h2>Compras</h2>
        </div>
        <section>
            @if (count($orders) > 0)
                aaaaaaaaa
            @else
                <div class="box__shop">
                    <h2>Aún no cuentas con compras realizadas</h2>
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
