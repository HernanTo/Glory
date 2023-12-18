@extends('layouts.app')
@section('title', 'Editar Post | Glory Store')

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
            <a href="{{ route('blog.administration') }}">Blog</a>
            /
            <a href="{{ route('blog.administration.show', $post->slug) }}">{{$post->title}}</a>
            /
            <a>Editar</a>
        </div>
        <h2>Editar post</h2>
    </div>
    <div class="container-forr">
        <form action="{{ route('blog.administration.update', $post->slug) }}" method="post" class="con-sect-a-p" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="divider__form divider__form_icon">
                <h2>Editar información del post</h2>
                <i class="fi fi-sr-comment-info"></i>
            </div>
            <section class="sect__form__p">
                <div class="form-floating form__floating__glory">
                    <input type="text" class="form-control shadow-none" id="floatingInput" placeholder="Nombre producto" name="name" required value="{{old('name', $post->title)}}">
                    <label for="floatingInput">Nombre del titulo</label>
                    <i class="fi fi-sr-box-open-full ico-in"></i>
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </section>

            <section class="sect__form__p">
                <div class="form-group">
                    <label for="pictures_product" class="form-label">Seleccione una fotografia que represense el post</label>
                    <input class="form-control" type="file" id="pictures" name="pictures" accept="image/png,image/jpeg">
                </div>
                <div class="form-group">
                    <label for="desc">Texto del post</label>
                    <textarea name="desc" id="desc" class="form-control" required>{{old('desc', $post->body)}}</textarea>
                </div>
            </section>

            <section class="foo-add-u con__two__sub__form">
                <button type="submit" onclick="tinyMCE.triggerSave()">Editar</button>
                <a href="{{ route('blog.administration.show', $post->slug)}}">Volver</a>
            </section>
        </form>
    </div>
</div>
@include('blog.administration.modal')

@endsection
@section('scripts')
    <script src="{{asset('libs/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            language : 'es',
            selector: 'textarea#desc', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'lists table help link',
            menubar: 'edit view insert help',
            toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table | link',
        });

        document.getElementById('pictures').addEventListener('change', event => {
            var filesInput = document.getElementById('pictures');
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
        });
    </script>
@endsection
