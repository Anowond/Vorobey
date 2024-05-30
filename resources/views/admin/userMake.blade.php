<x-default-layout title="Editing">
    <form action="{{ route('admin.user.store') }}" method="post">
        @csrf
        <div class="border my-2 container p-2 rounded">
            <div class="px-3 my-3">
                <h1 style="color: var(--bs-gray-800)" class="fs-2">
                    Make a new user
                </h1>
                <p class="mt-2 text-sm" style="color: var(--bs-gray-800)">
                    Here, you register a new user account.
                </p>
            </div>
            <div class="mt-4" style="color: var(--bs-gray-800)">
                <x-input name="name" label="Name" />
                <x-input name="email" label="Email" type="email" />
                <x-input name="password" label="password" type="password" />
                <x-input name="password_confirmation" label="password confirmation" type="password" />
                <x-select name="role" label="Role" :list="$roles" />
            </div>
            <div class="col-12 text-center my-3">
                <button type="submit" class="btn btn-form">Create user</button>
            </div>
        </div>
    </form>
</x-default-layout>
