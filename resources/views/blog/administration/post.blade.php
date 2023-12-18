@extends('layouts.app')
@section('title', 'Publicaciones | Glory Store')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/post_admin.css') }}">
@endsection

@section('content')
<div class="container-index-user conrtainer-table-d">
    <div class="container__port">
        <figure>
            <img src="{{asset('img/blog/' . $post->path)}}" alt="{{$post->title}}">
        </figure>
    </div>
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a href="{{route('blog.administration')}}">Blog</a>
            /
            <a>{{$post->title}}</a>
        </div>
        <h2>{{$post->title}}</h2>
    </div>
    <div class="container_body_post">
        <section class="articleInner">
            {!!  $post->body  !!}
        </section>
        <aside class="actions__post">
            <a href="{{route('blog.administration.edit', ['slug' => $post->slug])}}">Editar Post</a>
            <form action="" method="post">
                <button type="submit" class="btn-elim-user">Eliminar Post</button>
            </form>
        </aside>
    </div>
</div>

@include('blog.administration.modal')

@endsection
@section('scripts')

@endsection
