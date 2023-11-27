@extends('layouts.app')
@section('title', 'Categorías | Glory Store')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('css/add-product.css') }}">
@endsection

@section('content')
<div class="con__settings conrtainer-table-d">
    @include('settings.sidebar')
    <div class="body__settigs">
        <div class="con__head_sect">
            <h2>Nueva categoría</h2>
        </div>
        <div class="desct">
            <p>En este módulo podrá crear nuevas categorias para clasificar los respectivos productos, para la creación de una categoría es necesario el nombre y una imagen que represente la categoria.</p>
        </div>
        <div class="con_info">
            <form action="{{ route('category.store') }}" method="post" class="form__one__col">
                @csrf
                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Nombre categoría" name="name" required>
                    <label for="floatingInput">Nombre categoría</label>
                    <i class="fi fi-sr-box-open-full ico-in"></i>
                </div>
                <div class="form-group">
                    <label for="pictures_product" class="form-label">Seleccione imagén fotografia  - <span>Opcional</span></label>
                    <input class="form-control" type="file" id="pictures_category" name="category_photo" accept="image/png,image/jpeg">
                </div>
                <article class="con__two__sub__form">
                    <input type="submit" value="Crear" class="btn__subm btn" id="subm_user">
                </article>
            </form>
        </div>

        <div class="con__head_sect">
            <h2>Categorías</h2>
        </div>
        <div class="desct">
            <p>En esta sección se enlistarán las categorias deshabilitadas.</p>
        </div>
        <div class="con_info con_info_data">
            <div class="header_sectt">
                <a href="{{route('settings.category')}}">
                    Categorias
                </a>
                <a href="{{route('settings.category.des')}}" class="active">
                    Categorias deshabilitadas
                </a>
            </div>
            <div class="con__obej">
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        <div class="category">
                            <a href="" class="name__object">{{ $category->name }}</a>

                            <form action="{{ route('category.enable') }}" method="post">
                                @csrf
                                <input type="text" name="id" style="display: none" value="{{ $category->id }}">
                                <button type="submit" class="btn_trash btn_habi">Habilitar</button>
                            </form>

                        </div>
                    @endforeach
                @else
                    <div class="category">
                        <p>No hay categorias registradas</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@endsection
