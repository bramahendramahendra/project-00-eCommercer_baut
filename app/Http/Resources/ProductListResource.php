<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $type = $this->type;
        $category = $type->category;

        return [
            'id' => $this->id,
            'code' => $this->code,
            'title' => $this->title,
            'image_url' => $this->image,
            'type' => [
                // 'id' => $type->id, 
                // 'code' => $type->code, 
                'name' => $type?->name??'', 
                'category' => [
                    // 'id' => $category->id, 
                    // 'code' => $category->code,
                    'name' => $category?->name??'', 
                ]
            ],
            'price_retail' => $this->price_retail,
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];          
    }
}
