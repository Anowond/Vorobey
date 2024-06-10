<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;

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
    public function store(UserRequest $request): RedirectResponse
    {
        // Validation des données
        $validated = $request->validated();
        // Création de l'utilisateur
        $user = User::create($validated);
        // Redirection vers la page d'administration avec une variable de session flash
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
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        // Validation des données
        $validated = $request->validated();
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
