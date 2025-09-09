<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:20', Rule::unique('users', 'phone')->ignore($this->user()->id)],
            'birthdate' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            // Firstname
            'firstname.required' => 'Le prénom est requis.',
            'firstname.string' => 'Le prénom doit être une chaîne de caractères.',
            'firstname.max' => 'Le prénom ne peut pas dépasser 255 caractères.',

            // Lastname
            'lastname.required' => 'Le nom est requis.',
            'lastname.string' => 'Le nom doit être une chaîne de caractères.',
            'lastname.max' => 'Le nom ne peut pas dépasser 255 caractères.',

            // Phone
            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'phone.max' => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',

            // Birthdate
            'birthdate.required' => 'La date de naissance est requise.',
            'birthdate.date' => 'La date de naissance doit être une date valide.',

            // Image
            'image.image' => 'Le fichier sélectionné doit être une image.',
            'image.mimes' => 'L\'image doit être au format JPEG, PNG ou JPG.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}
