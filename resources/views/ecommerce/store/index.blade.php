
@extends('layouts.guest')
@section('title', 'Taller Glory Store')

@section('styles')
<link rel="canonical" href="https://tallerglory.store/" />
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="banner">
    <x-store.components.carousel :content="$pictures" />
</section>
<div class="container_content">

    <x-store.components.section-category :categories="$allCategories"/>

    <section class="con__section_prods con__section_prods__bg">
        <div class="header__section__prods">
            <h2>Nuevos Productos</h2>
        </div>
        <x-store.components.product-band :products="$latestProducts"/>
    </section>
</div>
@endsection

@section('sections_width')
<section class="container__benefits">
    <span>
        <figure>
            <img src="{{asset('img/original.webp')}}" alt="Repuestos originales" title="Repuestos originales">
        </figure>
        <p>Repuestos originales</p>
    </span>
    <span>
        <figure>
            <img src="{{asset('img/badge.webp')}}" alt="Garantía a los repuestos" title="Garantía">
        </figure>
        <p>Garantía</p>
    </span>
    <span>
        <figure>
            <img src="{{asset('img/protection.webp')}}" alt="Calidad garantizada" title="Calidad garantizada">
        </figure>
        <p>Calidad garantizada</p>
    </span>
    <span>
        <figure>
            <img src="{{asset('img/payu.webp')}}" alt="PayU" title="PayU">
        </figure>
        <p>Pagos seguros</p>
    </span>
</section>
<div class="con__section_prods__min">
    <div class="grid__section__prods">
        <section class="con__section_prods section__width con__section_prods__bg">
            <div class="header__section__prods">
                <h2>Te podría interesar</h2>
            </div>
            <x-store.components.product-band :products="$productsRandom"/>
        </section>
        <section class="con__section_prods section__width con__section_prods__bg">
            <div class="header__section__prods">
                <h2>En tendencia</h2>
            </div>
            <div>
                <x-store.components.product-basic  :product="$productRandom"/>
            </div>
        </section>
    </div>
</div>
<section class="section__width section__posts">
    <article class="con__articles">
        <div class="con_left">
            <video autoplay loop muted>
                <source src="{{asset('videos/glory.mp4')}}" type="video/mp4">
            </video>
        </div>
        <div class="con_right">
            <div class="header__card">
                <h2>Articulos</h2>
                <small>Articulos recientes</small>
                <a href="{{route('blog')}}">Ver todos</a>
            </div>
            <div class="body__card">
                @foreach ($posts as $post)
                    <div class="post__rec">
                        <img src="{{asset('img/blog/' . $post->path)}}" alt="{{$post->title}}">
                        <h3>{{$post->title}}</h3>
                        <a href="{{route('blog.show', $post->slug)}}" class="btn__post">Ver más</a>
                    </div>
                @endforeach
            </div>
        </div>
    </article>
</section>
@endsection

@section('scripts')
<script src="{{asset('js/products.js')}}"></script>
<script src="{{asset('js/categories.js')}}"></script>
<script src="{{asset('js/bandProducs.js')}}"></script>
@endsection
