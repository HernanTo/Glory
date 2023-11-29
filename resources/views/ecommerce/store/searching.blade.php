@extends('layouts.guest')
@section('title',  "{$search} | Glory Store")
@section('search', $search)

@section('styles')
<link rel="stylesheet" href="{{asset('css/product-list.css')}}">
@endsection

@section('content')
<div class="container_content">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('home') }}">Home</a>
            /
            <a>{{$search}}</a>
        </div>
        <h2>{{$search}}</h2>
    </div>
    @if (count($products) > 0)
        <div class="con__filters">
            <small><b>{{$total}}</b> Resultados</small>
        </div>
        <article class="con__filter__list">
            <form action="{{route('search.products.eco')}}" method="get" id="search_filter">
                <label for="order__select">Ordernar por</label>
                <input type="text" name="p" style="display: none" value="{{$search}}">
                <select name="order" id="order__select" class="order__select">
                    <option value="">Relevancia</option>
                    @if (request('order') == 'desc')
                        <option value="desc" selected>Mayor precio</option>
                    @else
                        <option value="desc">Mayor precio</option>
                    @endif
                    @if (request('order') == 'asc')
                        <option value="asc" selected>Menor precio</option>
                    @else
                        <option value="asc">Menor precio</option>
                    @endif
                </select>
            </form>
        </article>
        <div class="con__products__list">
            @foreach ($products as $product)
                <a href="{{route('producto.producto', $product->slug)}}" class="product__list">
                    <figure class="con__img_prod">
                        <img src="{{asset('img/products/' . $product->imagesMain)}}" alt="{{$product->slug}}">
                    </figure>
                    <div class="con_info_product">
                            <h3>{{ $product->name }}</h3>
                            <h5 class="prices">{{ $product->price }} </h5>
                            <span class="category__product">{{$product->categories->first()->name}}</span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="pagination">
            {{ $products->appends(['p' => $search])->links() }}
        </div>
    @else
        <section class="products__not__found">
            <i class="fi fi-ss-binoculars"></i>
            <div class="con__list__ps">
                <h2>No se encontraron repuestos</h2>
                <ul>
                    <li>Verifique su busqueda</li>
                    <li>Refresque la página</li>
                    <li>La página ya no existe</li>
                    <li>Ingresaste una URL incorrecta</li>
                </ul>
            </div>
        </section>
    @endif
</div>
@endsection

@section('scripts')
<script src="{{asset('js/products.js')}}"></script>
<script>
document.getElementById('order__select').addEventListener('change', event =>{
    document.getElementById('search_filter').submit();
});
</script>
@endsection
