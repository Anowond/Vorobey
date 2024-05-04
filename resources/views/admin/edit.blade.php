<x-default-layout title="Editing">
    <form action="{{ route('admin.video.update', ['video' => $video]) }}" method="post" enctype="multipart/form-data">
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
                <x-input name='name' label='name' value='{{ $video->name }}' />
                <x-input name='slug' label='slug' value='{{ $video->slug }}' />
                <x-input name='url' label='url' value='{{ $video->url }}' />
                <x-textarea name='description' label='description'>
                    {{ $video->description }}
                </x-textarea>
                <x-thumbnail name='thumbnail' label='thumbnail' value='{{ $video->thumbnail }}' />
                <x-select name="status" label="Status" :list="$status" :value="$video->status" />
                <x-select name="tags" label="Tags" :list="$tags" multiple :value="$video->tags" />
            </div>
            <div class="col-12 text-center my-3">
                <button type="submit" class="btn btn-form">Update</button>
            </div>
        </div>
    </form>
</x-default-layout>
