<x-auth-layout title="Registration" :action="route('register')" submitMessage="Sign Up">
    <x-input name="name" label="Name" />
    <x-input name="email" label="Email" type="email" />
    <x-input name="password" label="password" type="password" />
    <x-input name="password_confirmation" label="password confirmation" type="password" />
</x-auth-layout>
