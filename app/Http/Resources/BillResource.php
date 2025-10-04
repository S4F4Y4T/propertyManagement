<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'month'          => $this->month,
            'amount'         => $this->amount,
            'due_amount'     => $this->due_amount,
            'total_amount'   => $this->total_amount,
            'paid_amount'    => $this->paid_amount,
            'payment_status' => $this->payment_status,
            'category'       => BillCategoryResource::make($this->whenLoaded('category')),
            'flat'           => FlatResource::make($this->whenLoaded('flat')),
            'tenant'         => TenantResource::make($this->whenLoaded('tenant')),
            'owner_id'       => $this->owner_id,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
