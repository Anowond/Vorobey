<x-default-layout title='Videos'>
    <section class="container my-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach ($videos as $video)
                @if ($video->status == 1)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $video->thumbnail }}" class="card-img-top" alt="{{ $video->name }}">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title py-3 text-center">{{ $video->name }}</h5>
                                @if ($video->tags->isNotEmpty())
                                    <div>
                                        @foreach ($video->tags as $tag)
                                            <div class="video-list btn btn-card rounded-pill my-1"><a
                                                    href="{{ route('videos.byTag', ['tag' => $tag]) }}">{{ $tag->name }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                    <a href="{{ route('videos.show', ['video' => $video]) }}" style="text-decoration: none; color: var(--bs-gray-800)" class="btn btn-form mt-2">WATCH</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <div class="container">
        {{ $videos->links() }}
    </div>

</x-default-layout>
