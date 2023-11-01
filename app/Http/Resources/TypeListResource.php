<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryListResource; 

class TypeListResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'category_id' => $this->category_id,
            // 'category' => new CategoryListResource($this->whenLoaded('category')),
            'id_category' => $this->category->id ?? null, 
            'category_code' => $this->category->code ?? null, 
            'category_name' => $this->category->name ?? null, 
            // 'id_category' => $this->category->id ?? null,
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];
    }
}
