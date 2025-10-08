<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlatResource extends JsonResource
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
            'flat_number' => $this->flat_number,
            'note' => $this->note,
            'rooms' => $this->rooms,
            'floor' => $this->floor,
            'building' => BuildingResource::make($this->whenLoaded('building')),
            'tenant' => TenantResource::make($this->whenLoaded('tenant')),
            'bills' => BillResource::collection($this->whenLoaded('bills')),
            'owner_id' => $this->owner_id,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
