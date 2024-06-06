<x-default-layout title="Administration">
    <div class="my-3 d-flex justify-content-center">
        <button id="adminButton" class="btn btn-form">Switch to Users</button>
    </div>
    <div id="tabContent1">
        <div class="my-4 container text-center" style="color: var(--bs-gray-800)">
            <h1>Videos</h1>
            <p>Administration videos inteface, here, admins can modify and publish/unpublish videos.</p>
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
                        <th scope="row" style="color: var(--bs-gray-800)" class="text-center">{{ $video->name }}
                        </th>
                        <th scope="row" class="text-center" style="color: var(--bs-gray-800)">
                            <a href="{{ route('videos.show', ['video' => $video]) }}"
                                style="text-decoration: none; color: var(--bs-gray-800)" class="btn btn-form"
                                target="_blank">Watch</a>
                        </th>
                        <th scope="row" class="text-center" style="color: var(--bs-gray-800)">
                            <a href="{{ route('admin.edit.video', ['video' => $video]) }}"
                                style="text-decoration: none; color: var(--bs-gray-800)" class="btn btn-form">Edit</a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container">
            {{ $videos->links() }}
        </div>
    </div>
    <div id="tabContent2" class="hidden">
        <div class="my-4 container text-center" style="color: var(--bs-gray-800)">
            <h1>Users</h1>
            <p>Users administration inteface, here, admins can modify users.</p>
            <div class="my-3">
                <a href="{{ route('admin.user.showForm') }}" class="btn btn-form">Make a new user</a>
            </div>
        </div>
        <table class="table container table-responsive table-bordered table-striped table-primary my-5">
            <thead>
                <tr>
                    <th scope="col" class="text-center" style="color: var(--bs-gray-800)">Title</th>
                    <th scope="col" class="text-center" style="color: var(--bs-gray-800)">Roles</th>
                    <th scope="col" colspan="3" class="text-center" style="color: var(--bs-gray-800)">Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($users as $user)
                    <tr>
                        <th scope="row" style="color: var(--bs-gray-800)" class="text-center">
                            {{ $user->name }}
                        </th>
                        <th scope="row" style="color: var(--bs-gray-800)" class="text-center">
                            {{ $user->role }}
                        </th>
                        <th scope="row" class="text-center" style="color: var(--bs-gray-800)">
                            <a href="{{ route('admin.user.edit', ['user' => $user]) }}"
                                style="text-decoration: none; color: var(--bs-gray-800)" class="btn btn-form">Edit</a>
                        </th>
                        <th scope="row" class="text-center" style="color: var(--bs-gray-800)">
                            {{-- Boutton de la fenêtre modale --}}
                            <button type="button" class="btn btn-form" data-bs-toggle="modal"
                                data-bs-target="#deleteUserModal-{{ $user->id }}">
                               Delete
                            </button>
                            {{-- Fenêtre modale --}}
                            <div class="modal fade" id="deleteUserModal-{{ $user->id }}" tabindex="-1"
                                aria-labelledby="deleteUserModal-{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Confirm delete</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this user ?</br>
                                                This action is irreversible !</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button x-data type="button" class="btn btn-danger"
                                                onclick="
                                                event.preventDefault();
                                                document.getElementById('deleteForm-{{ $user->id }}').submit();">Delete
                                                User</button>
                                            {{-- Formulaire d'envoi de la supression --}}
                                            <form id="deleteForm-{{ $user->id }}"
                                                action="{{ route('admin.user.destroy', ['user' => $user]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container">
            {{ $users->links() }}
        </div>
    </div>
</x-default-layout>
