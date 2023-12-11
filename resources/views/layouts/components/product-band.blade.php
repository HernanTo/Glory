<a href="{{route('producto.producto', $product->slug)}}" class="product">
    <figure class="con__img_prod">
        <img src="{{asset('img/products/' . $product->imagesMain)}}" alt="{{$product->name}}" title="{{$product->name}}">
    </figure>
    <div class="info__prod">
        <div class="con__name_prod">
            <h3>{{ $product->nameFor }}</h3>
        </div>
        <div class="con_bottom_prod">
            <span class="prices" aria-label="Precio en Pesos Colombianos">{{ $product->price }}</span>
            <button class="btn__add__car" aria-label="Añadir al carrito"><i class="fi fi-sr-shopping-cart-add"></i></button>
        </div>
    </div>
</a>
