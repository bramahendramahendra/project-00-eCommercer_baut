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
        $type = $this->type;
        $category = $type->category;
        $unit = $this->unit;
        $material = $this->material;
        $weightUnit = $this->weightUnit;
        $contentsPerBoxUnit = $this->contentsPerBoxUnit;
        $threadDirection = $this->threadDirection;
        $threadDensity = $this->threadDensity;
        $diameterUnit = $this->diameterUnit;
        $lengthUnit = $this->lengthUnit;
        $thickHeadUnit = $this->thickHeadUnit;
        $dratLengthUnit = $this->dratLengthUnit;
        $color = $this->color;

        return [
            'id' => $this->id,
            'code' => $this->code,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'image_url' => $this->image,
            'image_mime' => $this->image_mime,
            'image_size' => $this->image_size,
            'price_retail' => $this->price_retail,
            'price_wholesale' => $this->price_wholesale,
            'quantity_limit' => $this->quantity_limit,
            'type' => [
                // 'id' => $type->id,
                'code' => $type->code, 
                'name' => $type->name, 
                // 'description' => $type->description, 
                'category' => [
                    // 'id' => $category->id, 
                    'code' => $category->code,
                    'name' => $category->name,
                    // 'description' => $category->description,
                ]
            ],
            'unit' => [
                // 'id' => $unit->id,
                // 'short_name' => $unit->short_name, 
                'full_name' => $unit->full_name, 
                // 'symbol' => $unit->symbol, 
            ],
            'material' => [
                // 'id' => $material->id,
                'name' => $material->name, 
            ],
            'weight' => $this->weight,
            'weight_unit' => [
                // 'id' => $weightUnit->id,
                'short_name' => $weightUnit->short_name, 
                // 'full_name' => $weightUnit->full_name, 
                // 'symbol' => $weightUnit->symbol, 
            ],
            'contents_per_box' => $this->contents_per_box,
            'contents_per_box_unit' => [
                // 'id' => $contentsPerBoxUnit->id,
                'short_name' => $contentsPerBoxUnit->short_name, 
                // 'full_name' => $contentsPerBoxUnit->full_name, 
                // 'symbol' => $contentsPerBoxUnit->symbol, 
            ],
            'grade' => $this->grade,
            'thread_direction' => [
                // 'id' => $threadDirection->id,
                'name' => $threadDirection->name, 
            ],
            'thread_density' => [
                // 'id' => $threadDensity->id,
                'name' => $threadDensity->name, 
            ],
            'diameter' => $this->diameter,
            'inner_diameter' => $this->inner_diameter,
            'outer_diameter' => $this->outer_diameter,
            'diameter_unit' => [
                // 'id' => $diameterUnit->id,
                // 'short_name' => $diameterUnit->short_name, 
                // 'full_name' => $diameterUnit->full_name, 
                'symbol' => $diameterUnit->symbol, 
            ],
            'length' => $this->length,
            'length_unit' => [
                // 'id' => $lengthUnit->id,
                // 'short_name' => $lengthUnit->short_name, 
                // 'full_name' => $lengthUnit->full_name, 
                'symbol' => $lengthUnit->symbol, 
            ],
            'thick_head' => $this->thick_head,
            'thick_head_unit' => [
                // 'id' => $thickHeadUnit->id,
                // 'short_name' => $thickHeadUnit->short_name, 
                // 'full_name' => $thickHeadUnit->full_name, 
                'symbol' => $thickHeadUnit->symbol, 
            ],
            'drat_length' => $this->drat_length,
            'drat_length_unit' => [
                // 'id' => $dratLengthUnit->id,
                // 'short_name' => $dratLengthUnit->short_name, 
                // 'full_name' => $dratLengthUnit->full_name, 
                'symbol' => $dratLengthUnit->symbol, 
            ],
            'dimensional_standart' => $this->dimensional_standart,
            'head_style' => $this->head_style,
            'drive_type' => $this->drive_type,
            'across_flats' => $this->across_flats,
            'drat_size' => $this->drat_size,
            'drat_type' => $this->drat_type,
            // color 
            'color' => [
                // 'color_id' => $this->color->id,
                'name' => $color->name, 
            ],
            // 'category' => new CategoryResource($this->whenLoaded('category')),
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
        ];
    }
}
