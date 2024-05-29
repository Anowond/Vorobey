<x-default-layout title="Editing">
    <form action=""
        method="post">
        @csrf
        @method('patch')
        <div class="border my-2 container p-2 rounded">
            <div class="px-3 my-3">
                <h1 style="color: var(--bs-gray-800)" class="fs-2">
                    Edit User
                </h1>
                <p class="mt-2 text-sm" style="color: var(--bs-gray-800)">
                    Here, you can modify user account
                </p>
            </div>
            <div class="mt-4" style="color: var(--bs-gray-800)">
                <x-input name='name' label='name' value='{{ $user->name }}' />
                <x-input name='email' label='email' type="email" value='{{ $user->email }}' />
                <x-select name="status" label="Status" :list="$roles" :value="$user->role" />
            </div>
            <div class="col-12 text-center my-3">
                <button type="submit" class="btn btn-form">Update</button>
            </div>
        </div>
    </form>
</x-default-layout>
