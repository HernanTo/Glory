<section class="con__cards__post">
    <div class="header__cards__post">
        <h2>Últimos artículos</h2>
    </div>
    @foreach ($postsR as $post)
    <a class="recintly__post" href="{{route('blog.show', $post->slug)}}">
        <h3>{{$post->title}}</h3>
        <figure>
            <img src="{{asset('img/blog/' . $post->path)}}" alt="{{$post->title}}">
        </figure>
        <small>{{$post->created_at}}</small>
    </a>
    @endforeach
</section>
