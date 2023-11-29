<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => ucwords(strtolower($this->name)),
            'description' => $this->description,
            'video' => $this->video,
            'views' => ViewResource::collection($this->whenLoaded('views')),
            // Retornar recursos que podem ter relacionamentos e que desejo otimizar as consultas, evitando assim carregamento desnecessário
        ];
    }
}
