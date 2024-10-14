<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user), // Ignore the current user's email during validation
            ],
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            /* 'classe_id' => 'required',
            'matiere_id' => 'required' */
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le champ ne doit pas être vide',
            'prenom.required' => 'Le champ ne doit pas être vide',
            //'username.required' => 'Le champ ne doit pas être vide',
            'email.required' => 'Le champ ne doit pas être vide',
            'email.email' => 'Veuillez fournir une adresse email valide',
            'email.unique' => 'Cette adresse email est déjà utilisée par un autre utilisateur',
            'file.image' => 'Le fichier doit être une image',
            'file.mimes' => 'Le fichier doit être au format jpeg, png, jpg ou gif',
            'file.max' => 'Le fichier ne doit pas dépasser 2 Mo',
            /* 'classe_id.required' => 'Le champ ne doit pas être vide', */
            // Add more custom error messages for other fields as needed
        ];
    }
}
