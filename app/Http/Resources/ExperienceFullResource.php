<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserFullResource;

class ExperienceFullResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'additional_information' => $this->additional_information,
            'image_path' => $this->image_path,
            'location' => $this->location,
            'address' => $this->address,
            'max_number_persons' => $this->max_number_persons,
            'service_duration' => $this->service_duration,
            'price' => $this->price,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserFullResource($this->whenLoaded('user'))
        ];
    }
}
