<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Newsletter;

class StoreNewsletterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|lowercase|email|max:255|unique:'.Newsletter::class,
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'L\'email est requis.',
            'email.string' => 'L\'email doit être une chaîne de caractères.',
            'email.lowercase' => 'L\'email doit être en minuscules.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.max' => 'L\'email ne peut pas dépasser :max caractères.',
            'email.unique' => 'Cet email est déjà utilisé.',
        ];
    }
}
