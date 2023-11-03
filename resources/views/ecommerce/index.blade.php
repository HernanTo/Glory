
@extends('layouts.guest')

@section('styles')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="banner">
    <div id="carousel__desk" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="5000">
            <img src="https://http2.mlstatic.com/storage/splinter-admin/o:f_webp,q_auto:best/1698758912009-36771393571295374437642243481875204789839902n.png" class="d-block w-100" alt="">
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <img src="https://http2.mlstatic.com/storage/splinter-admin/o:f_webp,q_auto:best/1698250402561-msdesktopahorraapptucarro1.jpg" class="d-block w-100" alt="">
          </div>
          <div class="carousel-item">
            <img src="https://http2.mlstatic.com/storage/splinter-admin/o:f_webp,q_auto:best/1698759403758-mscarreradesktop1.png" class="d-block w-100" alt="">
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
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
              <img src="https://http2.mlstatic.com/storage/splinter-admin/o:f_webp,q_auto:low/1698758927583-mobikemarcalli.png" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
              <img src="https://http2.mlstatic.com/storage/splinter-admin/o:f_webp,q_auto:low/1689195521155-mobile.bancos1.png" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item">
              <img src="https://http2.mlstatic.com/storage/splinter-admin/o:f_webp,q_auto:low/1698759379494-mscarreramobile1.png" class="d-block" alt="">
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
    <section class="con__categories">
        <a href="{{ route('catalogo') }}" class="category_btn">
            <i class="fi fi-ss-box-open-full"></i>
            <h3>Catálogo</h3>
        </a>
        <a href="{{ route('category.productos', 'Caja') }}" class="category_btn">
            <figure>
                <img src="{{ asset('img/gearbox.png') }}" alt="" class="ico__category">
            </figure>
            <h3>Caja</h3>
        </a>
        <a href="{{ route('category.productos', 'Exteriores') }}" class="category_btn">
            <figure>
                <img src="{{ asset('img/car.png') }}" alt="" class="ico__category">
            </figure>
            <h3>Exteriores</h3>
        </a>
        <a href="{{ route('category.productos', 'Motor') }}" class="category_btn">
            <figure>
                <img src="{{ asset('img/car-engine.png') }}" alt="" class="ico__category">
            </figure>
            <h3>Motor</h3>
        </a>
        <a href="{{ route('category.productos', 'Suspension') }}" class="category_btn">
            <figure>
                <img src="{{ asset('img/suspension.png') }}" alt="" class="ico__category">
            </figure>
            <h3>Supensión</h3>
        </a>
    </section>
    <section class="con__section_prods">
        <div class="header__section__prods">
            <h2>Nuevos Productos</h2>
        </div>
        <div class="con__products">
            @foreach ($latestProducts as $product)
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
    </section>

    <section class="con__section_prods">
        <div class="header__section__prods">
            <h2>Motor</h2>
            <a href="">Ver todos</a>
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
    </section>

    <section class="con__section_prods section_benefitcs">
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
    </section>

    <section class="con__section_prods">
        <div class="header__section__prods">
            <h2>Aliados</h2>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/products.js')}}"></script>
@endsection
