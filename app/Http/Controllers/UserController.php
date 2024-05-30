<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Afficher le formulaire de création d'un utilisateur
    public function showCreateUserForm(): View
    {
        return view('admin.userMake', [
            'roles' => collect(Roles::cases())->map(function ($roles) {
                return (object) ['id' => $roles->value, 'name' => ucfirst($roles->name)];
            }),
        ]);
    }

    // Créer l'utilisateur
    public function store(Request $request): RedirectResponse
    {
        // Récupération des rôles possibles en fonction de l'énumération Roles.
        $roles = collect(Roles::cases())->map(fn($roles) => $roles->value)->implode(',');
        // Validation des données
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:2,255'],
            'email' => ['required', 'email', Rule::unique('users')],
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
            'role' => ['required', 'in:' . $roles],
        ]);
        // Création de l'utilisateur
        $user = User::create($validated);
        // Redirection vers la page d'administration avec une varariable de session flash
        return redirect()->route('admin')->withStatus("User $user->name created successfully ! ");
    }

    // Editer un utilisateur
    public function edit(User $user): View
    {
        return view('admin.userEdit', [
            'user' => $user,
            'roles' => collect(Roles::cases())->map(function ($roles) {
                return (object) ['id' => $roles->value, 'name' => ucfirst($roles->name)];
            }),
        ]);
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, User $user): RedirectResponse
    {
        // Récupération des rôles possibles en fonction de l'énumération Roles.
        $roles = collect(Roles::cases())->map(fn($roles) => $roles->value)->implode(',');
        // Validation des données
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:2,255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'role' => ['required', 'in:' . $roles],
        ]);
        // Mise à jour des données
        $user->update($validated);
        // Retour à la page d'administration avec une variable de session flash
        return redirect()->route('admin')->withStatus('User updated successfully !');
    }

    // Suppression d'un utilisateur
    public function destroy(User $user): RedirectResponse
    {
        // Supression de l'utilisateur
        $user->delete();
        // Redirection vers la page d'administration avec une variable de session flash
        return redirect()->route('admin')->withStatus("User $user->name deleted successfully !");
    }

}
