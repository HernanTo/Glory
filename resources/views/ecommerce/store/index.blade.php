
@extends('layouts.guest')
@section('title', 'Taller Glory Store')

@section('styles')
<link rel="canonical" href="https://tallerglory.store/" />
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="banner">
    <div id="carousel__desk" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-current="true" aria-label="Slide2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="5000">
            <img src="{{ asset('img/glory.jpg') }}" class="d-block w-100" alt="">
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <img src="{{ asset('img/glory_sup.jpg') }}" class="d-block w-100" alt="">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
    </div>
    <div id="carousel__mobile" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-current="true" aria-label="Slide2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
              <img src="{{ asset('img/glory.jpg') }}" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
              <img src="{{ asset('img/glory_sup.jpg') }}" class="d-block w-100" alt="">
            </div>
          </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
    </div>
</section>
<div class="container_content">
    <section class="con__section_prods">
        <div class="header__section__prods">
            <h2>Nuevos Productos</h2>
        </div>
        <div class="slider__divs slider__divs__products">
            <div class="btn__actions__band span__left" id="leftButtonP">
                <i class="fi fi-br-angle-left"></i>
            </div>
            <div class="con__products con__products__band">
                @foreach ($latestProducts as $product)
                    @include('layouts.components.product-band')
                @endforeach
            </div>
            <div class="btn__actions__band span__right" id="rightButtonP">
                <i class="fi fi-br-angle-right"></i>
            </div>
        </div>
    </section>
    @include('layouts.components.section_category')
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
<section class="con__section_prods section__width">
    <div class="header__section__prods">
        <h2>Te podría interesar</h2>
    </div>
    <div class="slider__divs slider__divs__products">
        <div class="btn__actions__band span__left" id="leftButtonP">
            <i class="fi fi-br-angle-left"></i>
        </div>
        <div class="con__products con__products__band">
            @foreach ($productsRandom as $product)
                @include('layouts.components.product-band')
            @endforeach
        </div>
        <div class="btn__actions__band span__right" id="rightButtonP">
            <i class="fi fi-br-angle-right"></i>
        </div>
    </div>
</section>
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
                <a href="">Ver todos</a>
            </div>
            <div class="body__card">
                @foreach ($posts as $post)
                    <div class="post__rec">
                        <img src="{{asset('img/blog/' . $post->path)}}" alt="{{$post->title}}">
                        <h3>{{$post->title}}</h3>
                        <a href="" class="btn__post">Ver más</a>
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
