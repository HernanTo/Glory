
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
    @include('layouts.section_category')
    <section class="con__section_prods">
        <div class="header__section__prods">
            <h2>Nuevos Productos</h2>
        </div>
        <div class="con__products">
            @foreach ($latestProducts as $product)
                @include('layouts.product-basic')
            @endforeach
        </div>
    </section>

    {{-- <section class="con__section_prods">
        <div class="header__section__prods">
            <h2>Motor</h2>
            <a href="{{ route('category.productos', 'Motor') }}">Ver todos</a>
        </div>
        <div class="con__products">
            @foreach ($productsCategory as $product)
                <a href="{{route('producto.producto', $product->slug)}}" class="product">
                    <figure class="con__img_prod">
                        <img src="{{asset('img/products/' . $product->imagesMain)}}" alt="{{$product->slug}}">
                    </figure>
                    <div class="info__prod">
                        <div class="con__name_prod">
                            <h3>{{ $product->nameFor }}</h3>
                        </div>
                        <div class="con_bottom_prod">
                            <span class="prices">{{ $product->price }} </span>
                            <button class="btn__add__car"><i class="fi fi-sr-shopping-cart-add"></i></button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section> --}}

    {{-- <section class="con__section_prods section_benefitcs">
        <div class="header__section__prods">
            <h2>Beneficios de comprar en Glory Store</h2>
        </div>
        <div class="cotent_sect">
            <div class="card mb-3" style="max-width: 575px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="" class="img-fluid rounded-start" alt="">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card mb-3" style="max-width: 575px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="" class="img-fluid rounded-start" alt="">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section> --}}
</div>
@endsection
@section('scripts')
<script src="{{asset('js/products.js')}}"></script>
@endsection
