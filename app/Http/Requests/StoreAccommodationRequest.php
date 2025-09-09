<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccommodationRequest extends FormRequest
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
            'area' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:0',
            'bedrooms' => 'required|integer|min:0',
            'department' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'description' => 'required|string|max:65535',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'wifi' => 'boolean',
            'air_conditioning' => 'boolean',
            'parking' => 'boolean',
            'spa' => 'boolean',
            'equipped_kitchen' => 'boolean',
            'household_linen_provided' => 'boolean',
            'bathroom' => 'boolean',
            'price_night' => 'required|decimal:0,2|min:0',
            'min_number_nights' => 'required|integer|min:0',
            'security_deposit' => 'required|decimal:0,2|min:0',
            'cleaning_charges' => 'required|decimal:0,2|min:0',
            'arrival_time' => 'required|date_format:H:i',
            'departure_time' => 'required|date_format:H:i',
            'smokers_allowed' => 'boolean',
            'pets_allowed' => 'boolean',
            'events_allowed' => 'boolean',
            'minimum_age' => 'integer|min:0',
            'additional_rules' => 'string|max:65535',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne peut pas dépasser :max caractères.',

            'type.required' => 'Le type est requis.',
            'type.string' => 'Le type doit être une chaîne de caractères.',
            'type.max' => 'Le type ne peut pas dépasser :max caractères.',

            'area.required' => 'La superficie est requise.',
            'area.integer' => 'La superficie doit être un nombre entier.',
            'area.min' => 'La superficie doit être au minimum :min.',

            'capacity.required' => 'La capacité est requise.',
            'capacity.integer' => 'La capacité doit être un nombre entier.',
            'capacity.min' => 'La capacité doit être au minimum :min.',

            'bedrooms.required' => 'Le nombre de chambres est requis.',
            'bedrooms.integer' => 'Le nombre de chambres doit être un nombre entier.',
            'bedrooms.min' => 'Le nombre de chambres doit être au minimum :min.',

            'department.required' => 'Le département est requis.',
            'department.string' => 'Le département doit être une chaîne de caractères.',
            'department.max' => 'Le département ne peut pas dépasser :max caractères.',

            'municipality.required' => 'La commune est requise.',
            'municipality.string' => 'La commune doit être une chaîne de caractères.',
            'municipality.max' => 'La commune ne peut pas dépasser :max caractères.',

            'address.required' => 'L\'adresse est requise.',
            'address.string' => 'L\'adresse doit être une chaîne de caractères.',
            'address.max' => 'L\'adresse ne peut pas dépasser :max caractères.',

            'description.required' => 'La description est requise.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser :max caractères.',

            'latitude.required' => 'La latitude est requise.',
            'latitude.numeric' => 'La latitude doit être un nombre.',
            'latitude.min' => 'La latitude doit être comprise entre -90 et 90.',
            'latitude.max' => 'La latitude doit être comprise entre -90 et 90.',

            'longitude.required' => 'La longitude est requise.',
            'longitude.numeric' => 'La longitude doit être un nombre.',
            'longitude.min' => 'La longitude doit être comprise entre -180 et 180.',
            'longitude.max' => 'La longitude doit être comprise entre -180 et 180.',

            'wifi.boolean' => 'Le champ Wi-Fi doit être vrai ou faux.',
            'air_conditioning.boolean' => 'Le champ climatisation doit être vrai ou faux.',
            'parking.boolean' => 'Le champ parking doit être vrai ou faux.',
            'spa.boolean' => 'Le champ spa doit être vrai ou faux.',
            'equipped_kitchen.boolean' => 'Le champ cuisine équipée doit être vrai ou faux.',
            'household_linen_provided.boolean' => 'Le champ linge de maison fourni doit être vrai ou faux.',
            'bathroom.boolean' => 'Le champ salle de bain doit être vrai ou faux.',

            'price_night.required' => 'Le prix par nuit est requis.',
            'price_night.decimal' => 'Le prix par nuit doit être un nombre avec deux décimales maximum.',
            'price_night.min' => 'Le prix par nuit doit être au minimum :min.',

            'min_number_nights.required' => 'Le nombre minimum de nuits est requis.',
            'min_number_nights.integer' => 'Le nombre minimum de nuits doit être un nombre entier.',
            'min_number_nights.min' => 'Le nombre minimum de nuits doit être au minimum :min.',

            'security_deposit.required' => 'Le dépôt de garantie est requis.',
            'security_deposit.decimal' => 'Le dépôt de garantie doit être un nombre avec deux décimales maximum.',
            'security_deposit.min' => 'Le dépôt de garantie doit être au minimum :min.',

            'cleaning_charges.required' => 'Les frais de ménage sont requis.',
            'cleaning_charges.decimal' => 'Les frais de ménage doivent être un nombre avec deux décimales maximum.',
            'cleaning_charges.min' => 'Les frais de ménage doivent être au minimum :min.',

            'arrival_time.required' => 'L\'heure d\'arrivée est requise.',
            'arrival_time.date_format' => 'L\'heure d\'arrivée doit être au format HH:MM.',

            'departure_time.required' => 'L\'heure de départ est requise.',
            'departure_time.date_format' => 'L\'heure de départ doit être au format HH:MM.',

            'smokers_allowed.boolean' => 'Le champ fumeurs autorisés doit être vrai ou faux.',
            'pets_allowed.boolean' => 'Le champ animaux autorisés doit être vrai ou faux.',
            'events_allowed.boolean' => 'Le champ événements autorisés doit être vrai ou faux.',

            'minimum_age.integer' => 'L\'âge minimum doit être un nombre entier.',
            'minimum_age.min' => 'L\'âge minimum doit être au minimum :min.',

            'additional_rules.string' => 'Les règles supplémentaires doivent être une chaîne de caractères.',
            'additional_rules.max' => 'Les règles supplémentaires ne peuvent pas dépasser :max caractères.',

            'images.array' => 'Les images doivent être envoyées sous forme de tableau.',
            'images.*.image' => 'Chaque fichier doit être une image.',
            'images.*.mimes' => 'Chaque image doit être au format jpeg, png ou jpg.',
            'images.*.max' => 'Chaque image ne doit pas dépasser 2 Mo.',
        ];
    }
}
