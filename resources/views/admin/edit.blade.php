<x-default-layout title="Editing">
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="border my-2 container p-2 rounded">
            <div class="px-3 my-3">
                <h1 style="color: var(--bs-gray-800)" class="fs-2">
                    Edit video
                </h1>
                <p class="mt-2 text-sm" style="color: var(--bs-gray-800)">
                    Here, you can modify the video attributes.
                </p>
            </div>
            <div class="mt-4" style="color: var(--bs-gray-800)">
                <x-input name='title' label='title' value='{{ $video->name }}' />
                <x-input name='slug' label='slug' value='{{ $video->slug }}' />
                <x-input name='url' label='url' value='{{ $video->url }}' />
                <x-textarea name='description' label='description'>
                    {{ $video->description }}
                </x-textarea>
                <x-input name='thumbnail' label='thumbnail' type='file' />
                {{-- input des state, champ enum ? --}}
                <x-select name="tags" label="Tags" :list="$tags" multiple />
            </div>
            <div class="col-12 text-center my-3">
                <button type="submit" class="btn btn-form">Update</button>
            </div>
        </div>
    </form>
</x-default-layout>
