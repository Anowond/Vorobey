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
        // Validation des données
        $validated = $request->validate(
            [
                // nom requis, chaine de caractéres, entre 3 et 255
                'name' => ['required', 'string', 'between:3,255'],
                // email requis, format email, unique dans la table spécifée (users)
                'email' => ['required', 'email', 'unique:users'],
                // mdp requis, chaine de caractéres, minimum 8 caractéres,
                // vérification de correspondance avec un champ {field}_confirmed (password_confirmed)
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[a-z]/', // Doit contenir au moins une minusucle
                    'regex:/[A-Z]/', // Doit contenir au moins une majuscule
                    'regex:/[0-9]/', // Doit contenir au moins un chiffre
                    'regex:/[@$!%*#?&]/', // Doit contenir au moins un caractére spécial
                    'confirmed',
                ],
                // Checkbox consentement requis
                'consent' => ['required'],
            ],
            [
                'consent.required' => 'You must check the consent checkbox to register',
            ],
        );
        // Hashage du mot de passe avant l'inscription en BDD
        $validated['password'] = Hash::make($validated['password']);
        // Inscription en BDD via Mass Assignement
        $user = User::create($validated);
        // Authentfication
        Auth::login($user);
        // Redirection vers /home
        return redirect()->route('home')->withStatus('Inscription Réussie !');
    }

    /**
     * Affiche la vue des Terms of Policies
     */
    public function showTermsOfPolicy(): View
    {
        return view('auth.policy');
    }
}
