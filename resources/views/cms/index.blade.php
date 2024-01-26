@extends('layouts.app')
@section('title', 'Gestor de Contenido | Glory Store')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cms.css') }}">
    <link rel="stylesheet" href="{{asset('/css/add-product.css')}}">
@endsection

@section('content')
<div class="container-index-user conrtainer-table-d">
    <div class="header-table">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a>Gestor de contenido</a>
        </div>
        <h2>Gestor de contenido</h2>
    </div>
    <section class="sect__content">
        <h3>Carrousel <span>(Max 5 img)</span></h3>
        <h5>Previsualización:</h5>
        <x-store.components.carousel :content="$pictures" />
        <br>
        <hr>
        <h5>Lista de imágenes</h5>
            @foreach ($pictures as $img)
                <div class="item__carousel">
                    <img src="{{ asset('img/content/' . $img->path) }}" alt="Glory Store">
                    <p>{{$img->created_at}}</p>
                    <form action="{{route('cms.delete')}}" method="post">
                        <input type="number" name="id" value="{{$img->id}}" style="display: none">
                        @method('delete')
                        @csrf
                        <button class="btn btn-outline-danger btn-small">
                            <i class="fi fi-sr-trash"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        <hr>
        <form action="{{route('cms.create')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <h5>Añadir imágenes</h5>
            <input class="form-control" type="file" id="img" name="img" accept="image/png,image/jpeg" required>
            <button type="submit" class="btn btn-small btn-primary" style="margin-top: 10px">Añadir</button>
        </form>
    </section>
</div>

<x-administration.components.modal-error-img />
@endsection
@section('scripts')
<script>
    document.getElementById('img').addEventListener('change', event => {
        var filesInput = document.getElementById('img');
        var filesPath = filesInput.files;
        var allowedExtensions = /(.jpg|.jpeg|.png)$/i;

        let validation = true;

        for (let i = 0; i < filesPath.length; i++) {
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
