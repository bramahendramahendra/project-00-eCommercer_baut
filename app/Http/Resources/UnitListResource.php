<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitListResource extends JsonResource
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
            'short_name' => $this->short_name,
            'full_name' => $this->full_name,
            'symbol' => $this->symbol,
            'updated_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
        ];
    }
}
