<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserFullResource;

class ArticleFullResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image_path' => $this->image_path,
            'name' => $this->name,
            'text' => $this->text,
            'conclusion' => $this->conclusion,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserFullResource($this->whenLoaded('user'))
        ];
    }
}
