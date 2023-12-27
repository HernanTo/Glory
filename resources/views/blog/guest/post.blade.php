@extends('layouts.guest')
@section('title', $post->title . ' | Glory Store')
@section('meta_op_title', 'Blog | Glory Store')
@section('meta_description', $post->title)
@section('meta_op_desc', $post->title)

@section('styles')
<link rel="stylesheet" href="{{asset('css/blog.css')}}">
@endsection

@section('content')
<div class="container_content container__full__page">
    <figure class="con_potraid">
        <img src="{{asset('img/blog/' . $post->path)}}" alt="">
    </figure>
    <div class="header-table header__post">
        <div class="bread-cump">
            <a href="{{ route('home') }}">Home</a>
            /
            <a href="{{route('blog')}}">Blog</a>
            /
            <a>{{$post->title}}</a>
        </div>
        <h2>{{$post->title}}</h2>
    </div>
    <div class="container__blog">
        <section class="con__post">
            {!! $post->body !!}
        </section>
        @include('blog.guest.latest-post')
    </div>
</div>
@endsection
@section('scripts')

@endsection
