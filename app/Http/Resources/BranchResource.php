<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'name' => $this->name,
            'product' => [
                'product_id' => $this->product->id,
                'product_name' => $this->product->name,
            ],
            'quantity' => $this->quantity,
            'price' => $this->price,
            'summ' => $this->quantity * $this->price,
        ];
    }
}
