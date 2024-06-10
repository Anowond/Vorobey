<?php

namespace App\Http\Requests;

use App\Enums\Roles;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Récupération des rôles possibles en fonction de l'énumération Roles.
        $roles = collect(Roles::cases())->map(fn($roles) => $roles->value)->implode(',');

        return [
            'name' => ['required', 'string', 'between:2,255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password' => [Rule::requiredIf($this->isMethod('POST')),
                'string',
                'min:8',
                'regex:/[a-z]/', // Doit contenir au moins une minusucle
                'regex:/[A-Z]/', // Doit contenir au moins une majuscule
                'regex:/[0-9]/', // Doit contenir au moins un chiffre
                'regex:/[@$!%*#?&]/', // Doit contenir au moins un caractére spécial
                'confirmed',
            ],
            'role' => ['required', 'in:' . $roles],
        ];
    }
}
