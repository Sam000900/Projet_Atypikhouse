<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'phone' => ['required', 'string', 'max:20', Rule::unique('users', 'phone')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthdate' => 'required|date',
            'role' => ['required', Rule::in(['tenant', 'owner'])],
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'Le prénom de l\'utilisateur est requis.',
            'firstname.string' => 'Le prénom de l\'utilisateur doit être une chaîne de caractères.',
            'firstname.max' => 'Le prénom de l\'utilisateur ne peut pas dépasser :max caractères.',

            'lastname.required' => 'Le nom de l\'utilisateur est requis.',
            'lastname.string' => 'Le nom de l\'utilisateur doit être une chaîne de caractères.',
            'lastname.max' => 'Le nom de l\'utilisateur ne peut pas dépasser :max caractères.',

            'email.required' => 'L\'email est requis.',
            'email.string' => 'L\'email doit être une chaîne de caractères.',
            'email.lowercase' => 'L\'email doit être en minuscules.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.max' => 'L\'email ne peut pas dépasser :max caractères.',
            'email.unique' => 'Cet email est déjà utilisé.',

            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'phone.max' => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',

            'password.required' => 'Le mot de passe est requis.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.mixed' => 'Le mot de passe doit contenir au moins une majuscule et une minuscule.',
            'password.numbers' => 'Le mot de passe doit contenir au moins un chiffre.',
            'password.symbols' => 'Le mot de passe doit contenir au moins un symbole.',
            'password.uncompromised' => 'Ce mot de passe a été compromis, veuillez en choisir un autre.',

            'birthdate.required' => 'La date de naissance est requise.',
            'birthdate.date' => 'La date de naissance doit être une date valide.',

            'role.required' => 'Le type de compte est requis.',
            'role.in' => 'Le type de compte sélectionné est invalide.',
        ];
    }
}
