@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('/css/add-product.css')}}">
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
            <a>Nuevo producto</a>
        </div>
        <h2>Nuevo producto</h2>
    </div>
    <div class="container-forr">
        <form action="{{ route('productos.administration.store') }}" method="post" class="con-sect-a-p" enctype="multipart/form-data">
            @csrf
            <div class="divider__form divider__form_icon">
                <h2>Información básica del producto</h2>
                <i class="fi fi-sr-comment-info"></i>
            </div>
            <section class="sect__form__p">
                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Nombre producto" name="name" required value="{{old('name')}}">
                    <label for="floatingInput">Nombre del producto</label>
                    <i class="fi fi-sr-box-open-full ico-in"></i>
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="con-categ">
                    <select class="form-select" id="category" name="category[]" multiple="multiple" required>
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"> {{$category->name}} </option>
                        @endforeach
                    </select>
                    @if($errors->has('category'))
                        <div class="text-danger">{{ $errors->first('category') }}</div>
                    @endif
                </div>

                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Número de repuesto" name="num_repuesto" required value="{{old('num_repuesto')}}">
                    <label for="floatingInput">Número de repuesto</label>
                    <i class="fi fi-br-hastag ico-in"></i>
                    @if($errors->has('num_repuesto'))
                        <div class="text-danger">{{ $errors->first('num_repuesto') }}</div>
                    @endif
                </div>

                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Código de barras" name="barcode" required value="{{old('barcode')}}">
                    <label for="floatingInput">Código de barras</label>
                    <i class="fi fi-rr-barcode-read ico-in"></i>
                    @if($errors->has('barcode'))
                        <div class="text-danger">{{ $errors->first('barcode') }}</div>
                    @endif
                </div>
            </section>

            <div class="divider__form divider__form_icon">
                <h2>Información de inventario</h2>
                <i class="fi fi-sr-boxes"></i>
            </div>
            <section class="sect__form__p">
                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Precio por unidad" name="price"  required value="{{old('price')}}" data-type='currency'>
                    <label for="floatingInput">Precio por unidad</label>
                    <i class="fi fi-ss-tags ico-in"></i>
                    @if($errors->has('price'))
                        <div class="text-danger">{{ $errors->first('price') }}</div>
                    @endif
                </div>
                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Precio por unidad" name="cost" required value="{{old('cost')}}" data-type='currency'>
                    <label for="floatingInput">Costo por unidad</label>
                    <i class="fi fi-ss-sack-dollar ico-in"></i>
                    @if($errors->has('cost'))
                        <div class="text-danger">{{ $errors->first('cost') }}</div>
                    @endif
                </div>
                <div class="form-floating form__floating__glory">
                    <input type="number" class="form-control shadow-none" id="floatingInput" placeholder="Cantidad de stock"  name="stock" onkeydown="return event.keyCode !== 69" required value="{{old('stock')}}">
                    <label for="floatingInput">Cantidad de stock</label>
                    <i class="fi fi-sr-warehouse-alt ico-in"></i>
                    @if($errors->has('stock'))
                        <div class="text-danger">{{ $errors->first('stock') }}</div>
                    @endif
                </div>
                <div class="form-floating form__floating__glory">
                    <input type="number" class="form-control shadow-none" id="floatingInput" placeholder="Cantidad de stock"  name="min_stock" onkeydown="return event.keyCode !== 69" required value="{{old('min_stock')}}">
                    <label for="floatingInput">Cantidad minima de stock</label>
                    <i class="fi fi-br-water-lower ico-in"></i>
                    @if($errors->has('min_stock'))
                        <div class="text-danger">{{ $errors->first('min_stock') }}</div>
                    @endif
                </div>
                <div class="form-floating form__floating__glory">
                    <select name="available" id="available" class="form-select" aria-label="Floating label select example" required>
                        <option value="0">Inmediata</option>
                        <option value="15">15 días</option>
                        <option value="30">30 días</option>
                        <option value="60">60 días</option>
                    </select>
                    <label for="floatingInput">Disponinilidad</label>
                </div>
            </section>

            <div class="divider__form divider__form_icon">
                <h2>Información sobre el producto</h2>
                <i class="fi fi-sr-store-alt"></i>
            </div>
            <section class="sect__form__p">
                <div class="form-group">
                    <label for="pictures_product" class="form-label">Seleccione fotografias del producto</label>
                    <input class="form-control" type="file" id="pictures_product" name="pictures_product[]" accept="image/png,image/jpeg" multiple value="{{old('pictures_product')}}">
                </div>
                <div class="form-group">
                    <label for="desc">Descripción del producto</label>
                    <textarea name="desc" id="desc" class="form-control">{{old('desc')}}</textarea>
                </div>
            </section>

            <section class="foo-add-u con__two__sub__form">
                <button type="submit" onclick="tinyMCE.triggerSave()">Crear</button>
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
    <script src="{{asset('libs/tinymce/tinymce.min.js')}}"></script>
    <script>
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
