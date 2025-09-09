<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'text' => 'required|string|max:65535',
            'conclusion' => 'string|max:10000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de l\'article est requis.',
            'name.string' => 'Le nom de l\'article doit être une chaîne de caractères.',
            'name.max' => 'Le nom de l\'article ne peut pas dépasser :max caractères.',

            'text.required' => 'Le contenu de l\'article est requis.',
            'text.string' => 'Le contenu de l\'article doit être une chaîne de caractères.',
            'text.max' => 'Le contenu de l\'article ne peut pas dépasser :max caractères.',

            'conclusion.string' => 'La conclusion doit être une chaîne de caractères.',
            'conclusion.max' => 'La conclusion ne peut pas dépasser :max caractères.',

            'image.required' => 'L\'image de l\'article est requise.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg, png ou jpg.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}
