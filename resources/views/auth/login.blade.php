<x-auth-layout title="Connexion" :action="route('login')" submitMessage="Connexion">

    <x-input name="email" label="Email" type="email" />
    <x-input name="password" label="password" type="password" />
        @if ($cookie && $cookie->remember_me)
            <div class="mb-3 form-check col-8 offset-2">
                <input type="checkbox" class="form-check-input custom-checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
        @endif

</x-auth-layout>
