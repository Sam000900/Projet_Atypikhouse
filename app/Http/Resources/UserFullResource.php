<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AccommodationFullResource;
use App\Http\Resources\ExperienceFullResource;
use App\Http\Resources\ArticleFullResource;

class UserFullResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'phone' => $this->phone,
            'birthdate' => $this->birthdate,
            'image_path' => $this->image_path,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'accommodations' => AccommodationFullResource::collection($this->whenLoaded('accommodations')),
            'experiences' => ExperienceFullResource::collection($this->whenLoaded('experiences')),
            'articles' => ArticleFullResource::collection($this->whenLoaded('articles'))
        ];
    }
}
