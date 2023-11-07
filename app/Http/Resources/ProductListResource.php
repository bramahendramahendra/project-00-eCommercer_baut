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
        return [
            'id' => $this->id,
            'code' => $this->code,
            'title' => $this->title,
            'image_url' => $this->image,
            // type data db
            'id_type' => $this->type_id ?? null,
            'type_id' => $this->type->id ?? null, 
            'type_code' => $this->type->code ?? null, 
            'type_name' => $this->type->name ?? null, 
            // category data db
            'id_category' => $this->type->category_id ?? null, 
            'category_id' => $this->type->category->id ?? null, // dan ini
            'category_code' => $this->type->category->code ?? null, // dan ini
            'category_name' => $this->type->category->name ?? null, // menambahkan ini
            // Harga 
            'price_retail' => $this->price_retail,
            // kodingan 
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];          
    }
}
