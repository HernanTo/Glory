<div class="slider__divs slider__divs__products">
    <div class="btn__slides previosly btn__slides__hide" id="leftButton">
        <i class="fi fi-br-angle-left"></i>
    </div>
    <div class="btn__slides next" id="rightButton">
        <i class="fi fi-br-angle-right"></i>
    </div>
    <div class="con__products con__products__band">
        @foreach ($products as $product)
        @if ($product->is_active)
            <a href="{{route('producto.producto', $product->slug)}}" class="product product__band">
                <figure class="con__img_prod">
                    <img loading="lazy" src="{{asset('img/products/' . $product->imagesMain)}}" alt="{{$product->name}}" title="{{$product->name}}">
                </figure>
                <div class="info__prod">
                    <div class="con__name_prod">
                        <h3>{{ $product->nameFor }}</h3>
                    </div>
                    <div class="con_bottom_prod">
                        <span class="prices" aria-label="Precio en Pesos Colombianos">{{ $product->price }}</span>
                    </div>
                </div>
            </a>
        @endif
        @endforeach
    </div>
</div>
