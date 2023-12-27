@extends('layouts.guest')
@section('title', 'Blog | Glory Store')
@section('meta_op_title', 'Blog | Glory Store')
@section('meta_description', 'Encuentra artículos que te pueden ayudar con el correcto cuidado de tu automovil con Glory Store. Explora nuestro amplio catálogo de repuestos. Encuentra accesorios, piezas originales, suspension para carros, exteriores y mucho más para tu vehículo')
@section('meta_op_desc', 'Encuentra artículos que te pueden ayudar con el correcto cuidado de tu automovil con Glory Store. Explora nuestro amplio catálogo de repuestos. Encuentra accesorios, piezas originales, suspension para carros, exteriores y mucho más para tu vehículo')

@section('styles')
<link rel="stylesheet" href="{{asset('css/blog.css')}}">
@endsection

@section('content')
<div class="container_content">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('home') }}">Home</a>
            /
            <a href="#">Blog</a>
        </div>
        <h2>Blog </h2>
    </div>
    <div class="container__blog">
        <section class="con__posts">
            @foreach ($posts as $post)
                <a class="card_post" href="{{route('blog.show', $post->slug)}}">
                    <figure>
                        <img src="{{asset('img/blog/' . $post->path )}}" alt="{{$post->title}}">
                    </figure>
                    <h2>{{$post->title}}</h2>
                    <p>
                        {!! $post->descSmall !!}
                    </p>
                </a>
            @endforeach
            <div class="pagination">
                {{ $posts->appends(['p' => $post])->links() }}
            </div>
        </section>
        @include('blog.guest.latest-post')
    </div>
</div>
@endsection
@section('scripts')

@endsection
