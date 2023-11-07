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
            'image_url' => $this->image,
            'price_retail' => $this->price_retail,
            'price_wholesale' => $this->price_wholesale,
            'quantity_limit' => $this->quantity_limit,
            // type data db
            'id_type' => $this->type_id,
            'type_id' => $this->type->id ?? null,
            'type_code' => $this->type->code ?? null, 
            'type_name' => $this->type->name ?? null, 
            'type_description' => $this->type->description ?? null, 
            // category data db
            'id_category' => $this->type->category_id ?? null, 
            'category_id' => $this->type->category_id ?? null, 
            'category_code' => $this->type->category->code ?? null, // dan ini
            'category_name' => $this->type->category->name ?? null, // menambahkan ini
            'category_description' => $this->type->category->description ?? null, // menambahkan ini
            // unit 
            'id_unit' => $this->unit_id ?? null,
            'unit_id' => $this->unit->id ?? null,
            'unit_short_name' => $this->unit->short_name ?? null, 
            'unit_full_name' => $this->unit->full_name ?? null, 
            'unit_symbol' => $this->unit->symbol ?? null, 
            // material 
            'id_material' => $this->material_id ?? null,
            'material_id' => $this->material->id ?? null,
            'material_name' => $this->material->name ?? null, 
            // weight 
            'weight' => $this->weight ?? null,
            'id_weight_unit' => $this->unit_weight_id ?? null,
            'weight_unit_id' => $this->weightUnit->id ?? null,
            'weight_unit_short_name' => $this->weightUnit->short_name ?? null, 
            'weight_unit_full_name' => $this->weightUnit->full_name ?? null, 
            'weight_unit_symbol' => $this->weightUnit->symbol ?? null, 
            // contents_per_box
            'contents_per_box' => $this->contents_per_box ?? null,
            'id_contents_per_box_unit' => $this->unit_contents_per_box_id ?? null,
            'contents_per_box_unit_id' => $this->contentsPerBoxUnit->id ?? null,
            'contents_per_box_unit_unit_short_name' => $this->contentsPerBoxUnit->short_name ?? null, 
            'contents_per_box_unit_unit_full_name' => $this->contentsPerBoxUnit->full_name ?? null, 
            'contents_per_box_unit_unit_symbol' => $this->contentsPerBoxUnit->symbol ?? null, 
            // grade / thread_direction /  thread_density
            'grade' => $this->grade ?? null,
            'id_thread_direction' => $this->thread_direction_id ?? null,
            'thread_direction_id' => $this->threadDirection->id ?? null,
            'thread_direction_name' => $this->threadDirection->name ?? null, 
            'id_thread_density' => $this->thread_density_id ?? null,
            'thread_density_id' => $this->threadDensity->id ?? null,
            'thread_density_name' => $this->threadDensity->name ?? null, 
            // diameter
            'diameter' => $this->diameter ?? null,
            'inner_diameter' => $this->inner_diameter ?? null,
            'outer_diameter' => $this->outer_diameter ?? null,
            'id_diameter_unit' => $this->unit_diameter_id ?? null,
            'diameter_unit_id' => $this->diameterUnit->id ?? null,
            'diameter_unit_short_name' => $this->diameterUnit->short_name ?? null, 
            'diameter_unit_full_name' => $this->diameterUnit->full_name ?? null, 
            'diameter_unit_symbol' => $this->diameterUnit->symbol ?? null, 
            // length 
            'length' => $this->length ?? null,
            'id_length_unit' => $this->unit_length_id ?? null,
            'length_unit_id' => $this->lengthUnit->id ?? null,
            'length_unit_unit_short_name' => $this->lengthUnit->short_name ?? null, 
            'length_unit_unit_full_name' => $this->lengthUnit->full_name ?? null, 
            'length_unit_unit_symbol' => $this->lengthUnit->symbol ?? null, 
            // thick_head
            'thick_head' => $this->thick_head ?? null,
            'id_thick_head_unit' => $this->unit_thick_head_id ?? null,
            'thick_head_unit_id' => $this->thickHeadUnit->id ?? null,
            'thick_head_unit_unit_short_name' => $this->thickHeadUnit->short_name ?? null, 
            'thick_head_unit_unit_full_name' => $this->thickHeadUnit->full_name ?? null, 
            'thick_head_unit_unit_symbol' => $this->thickHeadUnit->symbol ?? null, 
            // drat_length
            'drat_length' => $this->drat_length ?? null,
            'id_drat_length_unit' => $this->unit_drat_length_id ?? null,
            'drat_length_unit_id' => $this->dratLengthUnit->id ?? null,
            'drat_length_unit_unit_short_name' => $this->dratLengthUnit->short_name ?? null, 
            'drat_length_unit_unit_full_name' => $this->dratLengthUnit->full_name ?? null, 
            'drat_length_unit_unit_symbol' => $this->dratLengthUnit->symbol ?? null, 
            // others 
            'drat_size' => $this->drat_size ?? null,
            'dimensional_standart' => $this->dimensional_standart ?? null,
            'head_style' => $this->head_style ?? null,
            'drive_type' => $this->drive_type ?? null,
            'across_flats' => $this->across_flats ?? null,
            'drat_type' => $this->drat_type ?? null,
            // color 
            'id_color' => $this->color_id ?? null,
            'id_color_id' => $this->color->id ?? null,
            'id_color_name' => $this->color->name ?? null, 
            
            // 'category' => new CategoryResource($this->whenLoaded('category')),
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
        ];
    }
}
