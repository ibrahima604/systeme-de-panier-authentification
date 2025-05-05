<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'], // Validation pour le champ "Nom"
            'prenom' => ['required', 'string', 'max:255'], // Validation pour le champ "Prenom"
            'tel' => ['required', 'string', 'max:20'], // Validation pour le champ "Tel", par exemple, un maximum de 20 caractères
            'sexe' => ['required', 'in:M,F'], // Validation pour le champ "Sexe" (M ou F)
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)], // Validation pour le champ "Email"
        ];
    }
}
