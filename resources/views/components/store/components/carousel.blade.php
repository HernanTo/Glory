<div class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @php
            $i = 1;
        @endphp
        @foreach ($content as $img)
            @if ($i)
                <div class="carousel-item active" data-bs-interval="4000">
                    <img loading="lazy" src="{{ asset('img/content/' . $img->path) }}" class="d-block w-100" alt="Glory Store">
                </div>
            @else
                <div class="carousel-item " data-bs-interval="4000">
                    <img loading="lazy" src="{{ asset('img/content/' . $img->path) }}" class="d-block w-100" alt="Glory Store" >
                </div>
            @endif
            @php
                $i = 0;
            @endphp
        @endforeach
    </div>
    <div class="gradient__carousel">

    </div>
</div>
