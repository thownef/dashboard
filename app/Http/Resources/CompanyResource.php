<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'user_id' => $this->user_id,
            'area_id' => $this->area_id,
            'category_id' => $this->category_id,
            'country' => $this->country,
            'company_logo' => $this->company_logo,
            'establishment' => $this->establishment,
            'employer' => $this->employer,
            'capital' => $this->capital,
            'languages' => json_decode($this->languages),
            'referral_code' => $this->referral_code,
            'highlight' => $this->highlight,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => new CategoryResource($this->category),
            'area' => new AreaResource($this->area),
            'translate' => TCompanyResource::collection($this->translate),
        ];
    }
}
