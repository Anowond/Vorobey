<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // nom requis, chaine de caractéres, entre 3 et 255
            'name' => ['required', 'string', 'between:3,255'],
            // email requis, format email, unique dans la table spécifée (users)
            'email' => ['required', 'email', 'unique:users'],
            // mdp requis, chaine de caractéres, minimum 8 caractéres, vérification de correspondance avec un champ {field}_confirmed (password_confirmed)
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('home')->withStatus('Inscription Réussie !');
    }
}