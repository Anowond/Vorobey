<x-default-layout title="Home">
    <form action="{{ route('updatePassword') }}" method="post">
        @csrf
        @method('patch')
        <div class="border my-2 container p-2 rounded">
            <h1 style="color: var(--bs-gray-800)" class="fs-2">
                Change Password
            </h1>
            <p class="mt-2 text-sm" style="color: var(--bs-gray-800)">
                You can modify your password here for futures connexions
            </p>
            <div class="mt-4" style="color: var(--bs-gray-800)">
                <x-input type="password" name="current_password" label="current password" />
                <x-input type="password" name="password" label="New password" />
                <x-input type="password" name="password_confirmation" label="new password confirmation" />
            </div>
            <div class="col-12 text-center my-3">
                <button type="submit" class="btn btn-form">Submit</button>
            </div>
        </div>
    </form>
</x-default-layout>
