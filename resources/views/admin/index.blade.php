<x-default-layout title="Administration">
    <div class="my-4 container text-center" style="color: var(--bs-gray-800)">
        <h1>Videos</h1>
        <p>Administration videos inteface, here, admins can modify and publish/publish videos.</p>
    </div>
    <table class="table container table-responsive table-bordered table-striped table-primary my-5">
        <thead>
            <tr>
                <th scope="col" class="text-center" style="color: var(--bs-gray-800)">Title</th>
                <th scope="col" colspan="3" class="text-center" style="color: var(--bs-gray-800)">Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($videos as $video)
                <tr>
                    <th scope="row" style="color: var(--bs-gray-800)">{{ $video->name }}</th>
                    <th scope="row" class="text-center" style="color: var(--bs-gray-800)">
                        <a href="{{ route('videos.show', ['video' => $video]) }}"
                            style="text-decoration: none; color: var(--bs-gray-800)" class="btn btn-form mt-2"
                            target="_blank">Watch</a>
                    </th>
                    <th scope="row" class="text-center" style="color: var(--bs-gray-800)">
                        <a href="{{ route('admin.video.edit', ['video' => $video]) }}"
                            style="text-decoration: none; color: var(--bs-gray-800)" class="btn btn-form mt-2">Edit</a>
                    </th>
                    <th scope="row" class="text-center" style="color: var(--bs-gray-800)">
                        <a href="{{ route('admin.video.destroy', ['video' => $video]) }}"
                            style="text-decoration: none; color: var(--bs-gray-800)" class="btn btn-form mt-2"
                            @click.prevent="$refs.deleteForm.submit()">Delete</a>
                        <form x-ref="deleteForm" action="{{ route('admin.video.destroy', ['video' => $video]) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container">
        {{ $videos->links() }}
    </div>
</x-default-layout>
