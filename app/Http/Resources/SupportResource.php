<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'description' => $this->description,
            'status' => $this->status,
            'status_label' => $this->statusOptions[$this->status] ? $this->statusOptions[$this->status] : 'Status Not Found',
            'user' => new UserResource($this->user),
            'lesson' => new LessonResource($this->lesson),
        ];
    }
}
