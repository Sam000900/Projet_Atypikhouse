<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'max_number_persons' => 'required|integer|min:1',
            'service_duration' => 'required|date_format:H:i',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'price' => 'required|decimal:0,2|min:0',
            'additional_information'  => 'required|string|max:65535',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de l\'expérience est requis.',
            'name.string' => 'Le nom de l\'expérience doit être une chaîne de caractères.',
            'name.max' => 'Le nom de l\'expérience ne peut pas dépasser :max caractères.',

            'type.required' => 'Le type d\'expérience est requis.',
            'type.string' => 'Le type d\'expérience doit être une chaîne de caractères.',
            'type.max' => 'Le type d\'expérience ne peut pas dépasser :max caractères.',

            'location.required' => 'Le lieu de l\'expérience est requis.',
            'location.string' => 'Le lieu doit être une chaîne de caractères.',
            'location.max' => 'Le lieu ne peut pas dépasser :max caractères.',

            'address.required' => 'L\'adresse est requise.',
            'address.string' => 'L\'adresse doit être une chaîne de caractères.',
            'address.max' => 'L\'adresse ne peut pas dépasser :max caractères.',

            'max_number_persons.required' => 'Le nombre maximal de personnes est requis.',
            'max_number_persons.integer' => 'Le nombre maximal de personnes doit être un nombre entier.',
            'max_number_persons.min' => 'Le nombre maximal de personnes doit être au moins :min.',

            'service_duration.required' => 'La durée du service est requise.',
            'service_duration.date_format' => 'La durée du service doit être au format HH:MM.',

            'latitude.required' => 'La latitude est requise.',
            'latitude.numeric' => 'La latitude doit être un nombre.',
            'latitude.min' => 'La latitude doit être comprise entre -90 et 90.',
            'latitude.max' => 'La latitude doit être comprise entre -90 et 90.',

            'longitude.required' => 'La longitude est requise.',
            'longitude.numeric' => 'La longitude doit être un nombre.',
            'longitude.min' => 'La longitude doit être comprise entre -180 et 180.',
            'longitude.max' => 'La longitude doit être comprise entre -180 et 180.',

            'price.required' => 'Le prix est requis.',
            'price.decimal' => 'Le prix doit être un nombre avec jusqu\'à deux décimales.',
            'price.min' => 'Le prix doit être au minimum :min.',

            'additional_information.required' => 'Les informations complémentaires sont requises.',
            'additional_information.string' => 'Les informations complémentaires doivent être une chaîne de caractères.',
            'additional_information.max' => 'Les informations complémentaires ne peuvent pas dépasser :max caractères.',

            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg, png ou jpg.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}
