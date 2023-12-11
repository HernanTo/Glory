<div class="con__section_prods">
    <div class="header__section__prods">
        <h2>Categorias</h2>
    </div>
    <section class="slider__divs">
        <div class="btn__actions__band span__left" id="leftButtonC">
            <i class="fi fi-br-angle-left"></i>
        </div>
        <section class="con__categories">
            <a href="{{ route('catalogo') }}" class="category_btn" title="Catálogo">
                <figure>
                    <img src="{{ asset('img/categories/catalogo.webp') }}" alt="Todos los productos de Taller Glory Store" class="ico__category" title="Catálogo Glory Store, Imagen de Freepink">
                </figure>
                <h3>Catálogo</h3>
            </a>
            @foreach ($allCategories as $category)
                <a href="{{ route('category.productos', "$category->name") }}" class="category_btn" title="{{$category->name}}">
                    <figure>
                        <img src="{{ asset('img/categories/' . $category->photo_category) }}" alt="Repuestos relacionados con {{$category->name}}" class="ico__category" title="{{$category->name}}, Imagen de Freepink">
                    </figure>
                    <h3>{{$category->name}}</h3>
                </a>
            @endforeach
        </section>
        <div class="btn__actions__band span__right" id="rightButtonC">
            <i class="fi fi-br-angle-right"></i>
        </div>
    </section>
</div>
