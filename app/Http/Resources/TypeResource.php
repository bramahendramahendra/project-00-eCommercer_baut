<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\CategoryResource; 

class TypeResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'category_id' => $this->category_id,
            // 'category' => new CategoryResource($this->whenLoaded('category')),
            'id_category' => $this->category->id ?? null, 
            'category_code' => $this->category->code ?? null, 
            'category_name' => $this->category->name ?? null, 
            'category_slug' => $this->category->slug ?? null, 
            'category_description' => $this->category->description ?? null, 
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];
    }
}
