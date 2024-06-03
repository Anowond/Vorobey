<x-default-layout title='{{ $video->name }}'>

    <div class="container d-flex justify-content-center">
        <a href="{{ route('videos') }}" style="text-decoration: none; color: var(--bs-gray-800)"
            class="btn btn-form mt-3">Back to videos</a>
    </div>

    <section class="my-5 container">
        <h1 class="text-center py-3">{{ $video->name }}</h1>
        <div class="row">
            <div class="col-12 col-md-6 pt-3 p-4">
                <iframe width="100%" style="aspect-ratio:16/9" src="{{ $video->url }}" title="{{ $video->name }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <div class="my-3 text-center text-muted">
                    <time datetime="{{ $video->created_at }}">@datetime($video->created_at)</time>
                </div>
            </div>
            <div class="col-12 col-md-6 p-4 show_description">
                <article>{!! nl2br(e($video->description)) !!}</article>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <div class="row">
            @auth
                <form x-ref="formComment" action="{{ route('comment', ['video' => $video]) }}" method="post">
                    @csrf
                    <div class="d-flex align-items-center">
                        <input type="text" name="comment" class="form-control me-2" placeholder="Something to say ?">
                        <div class="rounded-circle border shadow-lg">
                            <a href="" @click.prevent="$refs.formComment.submit()"><img src="/img/tf2-logo.png"
                                    alt="team fortress 2 logo" style="height: 35px"></a>
                        </div>
                    </div>
                    @error('comment')
                        <p class="text-danger fs-6 mt-2">{{ $message }}</p>
                    @enderror
                </form>
            @endauth
        </div>
            <div class="row my-4 mx-2">
                @foreach ($video->comments as $comment)
                    <div class="d-flex rounded my-2 align-items-center" style="background: var(--bs-gray-500)">
                        <img src="{{ Gravatar::get($comment->user->email) }}"
                            alt="image de profil de {{ $comment->user->name }}" class="img-fluid rounded-circle" style="height: 50px">
                        <div class="ms-3 p-2">
                            <h6>{{ $comment->user->name }}</h6>
                            <time datetime="{{ $comment->created_at }}"
                                class="text-muted fs-6">@datetime($comment->created_at)</time>
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>

</x-default-layout>
