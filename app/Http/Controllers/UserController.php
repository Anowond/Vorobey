<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('admin.userEdit', [
            'user' => $user,
            'roles' => collect(Roles::cases())->map(function ($roles) {
                return (object) ['id' => $roles->value, 'name' => ucfirst($roles->name)];
            }),
        ]);
    }
}
