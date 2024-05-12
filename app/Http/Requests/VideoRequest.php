<?php

namespace App\Http\Requests;

use App\Enums\Roles;
use App\Enums\videostatus;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VideoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Récupération des status possibles en fonction de l'énumération Roles.
        $status = collect(videostatus::cases())->map(fn($status) => $status->value)->implode(',');

        return [
            'name' => ['required','string','between:3,255'],
            'slug' => ['required', 'string', 'between:3,255', Rule::unique('videos')->ignore($this->video)],
            'url' => ['required','url'],
            'description' => ['required','string'],
            'thumbnail' => ['required'],
            'status' => ['required', 'in:' . $status],
            'tags' => ['array', 'exists:tags,id'],
        ];
    }

    // Applique de la logique avant les régles de validations
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?? $this->title),
        ]);
    }
}
