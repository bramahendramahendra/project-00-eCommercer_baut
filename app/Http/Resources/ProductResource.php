<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\TypeResource; 

class ProductResource extends JsonResource
{
    public static $wrap = false;

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
            'slug' => $this->slug,
            'description' => $this->description,
            'price_retail' => $this->price_retail,
            'price_wholesale' => $this->price_wholesale,
            'quantity_limit' => $this->quantity_limit,
            'id_type' => $this->type_id,
            // type data db
            'type_id' => $this->type->id ?? null,
            'type_code' => $this->type->code ?? null, 
            'type_name' => $this->type->name ?? null, 
            'type_description' => $this->type->description ?? null, 
            // category data db
            'category_id' => $this->type->category_id ?? null, 
            'category_code' => $this->type->category->code ?? null, // dan ini
            'category_name' => $this->type->category->name ?? null, // menambahkan ini
            'category_description' => $this->type->category->description ?? null, // menambahkan ini
            // unit 
            'id_unit' => $this->unit_id,
            'unit_id' => $this->unit->id,
            'type_short_name' => $this->unit->short_name ?? null, 
            'type_full_name' => $this->unit->full_name ?? null, 
            'type_symbol' => $this->unit->symbol ?? null, 
            // material 
            'id_material' => $this->material_id,
            'material_id' => $this->unit->id ?? null,
            'type_short_name' => $this->unit->name ?? null, 
            // weight 
            
            // 'category' => new CategoryResource($this->whenLoaded('category')),
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
        ];
    }
}
