<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category' => [
                'name' => $this->category->name,
                'id' => $this->category->id
            ],
            'code' => $this->code,
            'name' => $this->name,
            'unit' => $this->unit,
            'stock' => $this->stock,
            'price' => $this->price,
            'expired_date' => $this->expired_date,
        ];
    }
}
