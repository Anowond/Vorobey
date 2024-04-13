<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home.index');
    }

    public function updatePassword(Request $request): RedirectResponse
    {

        // Récupérer l'utilisateur connécté dans la variable $user
        $user = Auth::user();

        // Validation des champs du formulaire
        $validated = $request->validate([
            'current_password' => ['required', 'string',
                // Régle de validation personnalisée pour vérifier la correspondance du mot de passe hashé avec le mot de passe de l'utilisateur authentifié
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('The :attribue is invalid.');
                    }
                }],
            'password' => ['required','string','min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('home')->withStatus('Password successfully updated !');
    }
}
