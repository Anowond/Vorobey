<x-layout title='{{$video->name}}'>

    <section class="my-5 container">
        <h1 class="text-center py-3">{{$video->name}}</h1>
        <div class="row">
            <div class="col-12 col-md-6 pt-3 p-4">
                <iframe width="100%" style="aspect-ratio:16/9" src="{{ $video->url }}" title="{{ $video->name }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <div class="my-3 text-center text-muted">
                        <time datetime="{{$video->created_at}}">@datetime($video->created_at)</time>
                    </div>
            </div>
            <div class="col-12 col-md-6 p-4 show_description">
                <p>{!! nl2br(e($video->description)) !!}</p>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <div class="row">

        </div>
    </section>

</x-layout>
