<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserFullResource;

class AccommodationFullResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'area' => $this->area,
            'capacity' => $this->capacity,
            'bedrooms' => $this->bedrooms,
            'department' => $this->department,
            'municipality' => $this->municipality,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'wifi' => $this->wifi,
            'air_conditioning' => $this->air_conditioning,
            'parking' => $this->parking,
            'spa' => $this->spa,
            'equipped_kitchen' => $this->equipped_kitchen,
            'household_linen_provided' => $this->household_linen_provided,
            'bathroom' => $this->bathroom,
            'smokers_allowed' => $this->smokers_allowed,
            'pets_allowed' => $this->pets_allowed,
            'events_allowed' => $this->events_allowed,
            'price_night' => $this->price_night,
            'min_number_nights' => $this->min_number_nights,
            'security_deposit' => $this->security_deposit,
            'cleaning_charges' => $this->cleaning_charges,
            'arrival_time' => $this->arrival_time,
            'departure_time' => $this->departure_time,
            'minimum_age' => $this->minimum_age,
            'description' => $this->description,
            'additional_rules' => $this->additional_rules,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserFullResource($this->whenLoaded('user'))
        ];
    }
}
