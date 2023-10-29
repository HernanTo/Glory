@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('/css/add-product.css')}}">
<link rel="stylesheet" href="{{asset('/css/editproduct.css')}}">
<link rel="stylesheet" href="{{asset('/libs/selects/select2.min.css')}}">
@endsection

@section('content')
<div class="container-index-user conrtainer-table-d">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a href="{{ route('productos.administration') }}">Productos</a>
            /
            <a href="{{route('productos.administration.show', $product->slug)}}"> {{$product->name}} </a>
            /
            <a>Editar</a>
        </div>
        <h2>Editar producto</h2>
    </div>
    <div class="container-forr">
        <form action="{{ route('productos.administration.update', $product) }}" method="post" class="con-sect-a-p" id="form__edit__product" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="divider__form divider__form_icon">
                <h2>Editar información básica del producto</h2>
                <i class="fi fi-sr-comment-info"></i>
            </div>
            <section class="sect__form__p">
                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Nombre producto" name="name" required value="{{$product->name}}">
                    <label for="floatingInput">Nombre del producto</label>
                    <i class="fi fi-sr-box-open-full ico-in"></i>
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="con-categ">
                    @foreach ($product->categories as $categoryP)
                    <select class="form-select" id="category" name="category[]" multiple="multiple" required>
                        <option value=""></option>
                        @foreach ($categories as $category)
                            @if ($categoryP->id == $category->id)
                                <option value="{{$category->id}}" selected> {{$category->name}} </option>
                            @else
                                <option value="{{$category->id}}"> {{$category->name}} </option>
                            @endif
                        @endforeach
                    @endforeach
                    </select>
                    @if($errors->has('category'))
                        <div class="text-danger">{{ $errors->first('category') }}</div>
                    @endif
                </div>

                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Número de repuesto" name="num_repuesto" required value="{{$product->num_repuesto}}">
                    <label for="floatingInput">Número de repuesto</label>
                    <i class="fi fi-br-hastag ico-in"></i>
                    @if($errors->has('num_repuesto'))
                        <div class="text-danger">{{ $errors->first('num_repuesto') }}</div>
                    @endif
                </div>

                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Código de barras" name="barcode" required value="{{$product->barcode}}">
                    <label for="floatingInput">Código de barras</label>
                    <i class="fi fi-rr-barcode-read ico-in"></i>
                    @if($errors->has('barcode'))
                        <div class="text-danger">{{ $errors->first('barcode') }}</div>
                    @endif
                </div>
            </section>

            <div class="divider__form divider__form_icon">
                <h2>Editar información de inventario</h2>
                <i class="fi fi-sr-boxes"></i>
            </div>
            <section class="sect__form__p">
                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Precio por unidad" name="price"  required value="{{$product->price}}" data-type='currency'>
                    <label for="floatingInput">Precio por unidad</label>
                    <i class="fi fi-ss-tags ico-in"></i>
                    @if($errors->has('price'))
                        <div class="text-danger">{{ $errors->first('price') }}</div>
                    @endif
                </div>
                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Precio por unidad" name="cost" required value="{{$product->cost}}" data-type='currency'>
                    <label for="floatingInput">Costo por unidad</label>
                    <i class="fi fi-ss-sack-dollar ico-in"></i>
                    @if($errors->has('cost'))
                        <div class="text-danger">{{ $errors->first('cost') }}</div>
                    @endif
                </div>
                <div class="form-floating form__floating__glory">
                    <input type="number" class="form-control shadow-none" id="floatingInput" placeholder="Cantidad de stock"  name="stock" onkeydown="return event.keyCode !== 69" required value="{{$product->stock}}">
                    <label for="floatingInput">Cantidad de stock</label>
                    <i class="fi fi-sr-warehouse-alt ico-in"></i>
                    @if($errors->has('stock'))
                        <div class="text-danger">{{ $errors->first('stock') }}</div>
                    @endif
                </div>
                <div class="form-floating form__floating__glory">
                    <input type="number" class="form-control shadow-none" id="floatingInput" placeholder="Cantidad de stock"  name="min_stock" onkeydown="return event.keyCode !== 69" required value="{{$product->min_stock}}">
                    <label for="floatingInput">Cantidad minima de stock</label>
                    <i class="fi fi-br-water-lower ico-in"></i>
                    @if($errors->has('min_stock'))
                        <div class="text-danger">{{ $errors->first('min_stock') }}</div>
                    @endif
                </div>
                <div class="form-floating form__floating__glory">
                    <select name="available" id="available" class="form-select" aria-label="Floating label select example" required>
                        @for ($i = 0; ($i * 15) <= 60; $i++)
                            @if ($product->available == ($i * 15))
                                @if (($i) == 0)
                                    <option value="0" selected>Inmediata</option>
                                @else
                                    <option value="{{$i * 15}}" selected>{{$i * 15}} días</option>
                                @endif
                            @elseif(($i) == 0)
                                <option value="0">Inmediata</option>
                            @elseif(($i * 15) != 45)
                                <option value="{{$i * 15}}">{{$i * 15}} días</option>
                            @endif
                        @endfor
                    </select>
                    <label for="floatingInput">Disponinilidad</label>
                </div>
            </section>

            <div class="divider__form divider__form_icon">
                <h2>Editar información sobre el producto</h2>
                <i class="fi fi-sr-store-alt"></i>
            </div>
            <section class="sect__form__p">
                <div class="form-group">
                    <label for="pictures_product" class="form-label">Seleccione fotografias del producto</label>
                    <input class="form-control" type="file" id="pictures_product" name="pictures_product[]" accept="image/png,image/jpeg" multiple>
                </div>
                <h2>Registro de imagenes actuales</h2>
                @if (count($images) > 0)
                    <div class="con__currently__images" id="con__currently__images">
                        @foreach ($images as $image)
                            <div class="image" id="con-image-{{$image->id}}">
                                <img src="{{asset('img/products/' . $image->photo)}}" alt="{{$product->name}}" class="img__prod">
                                <span id="image-{{$image->id}}"><i class="fi fi-ss-cross-circle"></i></span>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-danger" id="text-img">Click sobre la imagen para eliminar</small>
                        @else
                        <small>No existen imagenes registradas</small>
                    @endif
                <hr>
                <div class="form-group">
                    <label for="desc">Descripción del producto</label>
                    <textarea name="desc" id="desc" class="form-control">{{$product->description}}</textarea>
                </div>
            </section>

            <section class="foo-add-u con__two__sub__form">
                <button type="submit" onclick="savePictures()">Crear</button>
                <a href="{{ route('productos.administration')}}">Volver</a>
            </section>
        </form>
    </div>
</div>

@include('productos.administration.modal')

@endsection
@section('scripts')
    <script src="{{ asset('libs/selects/select2.min.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
    <script src="{{ asset('js/currencyPrice.js') }}"></script>
    <script src="{{ asset('js/editProduct.js') }}"></script>
    <script src="{{asset('libs/tinymce/tinymce.min.js')}}"></script>
    <script>
        var imagesArray = @json($images);
        imagesProducts(imagesArray);

        $(document).ready(function() {
            $('#category').select2({
                placeholder: "Selecciona una categoria",
                multiple: true,
                maximumSelectionLength: 1,
                allowClear: true
            });
        });
        tinymce.init({
            language : 'es',
            selector: 'textarea#desc', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'lists table help link',
            menubar: 'edit view insert help',
            toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table | link',
        });

        document.getElementById('pictures_product').addEventListener('change', event => {
            var filesInput = document.getElementById('pictures_product');
            var filesPath = filesInput.files;
            var allowedExtensions = /(.jpg|.jpeg|.png)$/i;

            let validation = true;

            for (let i = 0; i < filesPath.length; i++) {
                console.log(filesPath[i]);
                if(!allowedExtensions.exec(filesPath[i].name)){
                    validation = false;
                }
            }
            if(!validation){
                $('#err_img_prod').modal('show');
                filesInput.value = '';
            }
        }
        )
    </script>
@endsection
