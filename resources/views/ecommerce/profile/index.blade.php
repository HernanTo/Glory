
@extends('layouts.guest')
@section('title', 'Perfil | Glory Store')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endsection

@section('content')
<div class="con__settings conrtainer-table-d">
    @include('settings.sidebar')
    <div class="body__settigs">

    </div>
</div>
@endsection
@section('scripts')
@endsection
