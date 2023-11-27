<section class="con__categories">
    <a href="{{ route('catalogo') }}" class="category_btn" title="Catálogo">
        <i class="fi fi-ss-box-open-full"></i>
        <h3>Catálogo</h3>
    </a>
    @foreach ($allCategories as $category)
        <a href="{{ route('category.productos', "$category->name") }}" class="category_btn" title="{{$category->name}}">
            <figure>
                <img src="{{ asset('img/categories/' . $category->photo_category) }}" alt="{{$category->name}}" class="ico__category" title="{{$category->name}}">
            </figure>
            <h3>{{$category->name}}</h3>
        </a>
    @endforeach
</section>
