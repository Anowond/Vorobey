<x-auth-layout title="Registration" :action="route('register')" submitMessage="Sign Up">
    <x-input name="name" label="Name" />
    <x-input name="email" label="Email" type="email" />
    <x-input name="password" label="password" type="password" />
    <x-input name="password_confirmation" label="password confirmation" type="password" />
    <div class="mb-3 form-check col-8 offset-2">
        <input type="checkbox" class="form-check-input custom-checkbox" id="consent" name="consent">
        <label class="form-check-label" for="consent">By checking this box, you agree that your data will be proceded
            and stored for the purpose on this site.</label>
        @error('consent')
            <div class='text-danger fs-6 mt-2'>
                {{ $message }}
            </div>
        @enderror
    </div>
</x-auth-layout>
