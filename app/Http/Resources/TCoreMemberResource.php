<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TCoreMemberResource extends JsonResource
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
            'member_name' => $this->member_name,
            'member_position' => $this->member_position,
            'member_desc' => $this->member_desc,
            'language' => $this->language,
        ];
    }
}
