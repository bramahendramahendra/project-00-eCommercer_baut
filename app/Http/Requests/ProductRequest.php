<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_id' => ['required', 'numeric'],
            'code' => ['required', 'numeric'],
            'title' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image'],
            'description' => ['nullable', 'string'],
            'price_retail' => ['required', 'numeric'],
            'quantity_limit' => ['required', 'numeric'],
            'price_wholesale' => ['required', 'numeric'],
            'unit_id' => ['required', 'numeric'],
            'material_id' =>['required', 'numeric'],
            'weight' =>['nullable', 'numeric'],
            'unit_weight_id' =>['nullable', 'numeric'],
            'contents_per_box' =>['nullable', 'numeric'],
            'unit_contents_per_box_id' =>['nullable', 'numeric'],
            'grade' =>['nullable', 'numeric'],
            'thread_direction_id' =>['nullable', 'numeric'],
            'thread_density_id' =>['nullable', 'numeric'],
            'diameter' =>['nullable', 'numeric'],
            'inner_diameter' =>['nullable', 'numeric'],
            'outer_diameter' =>['nullable', 'numeric'],
            'unit_diameter_id' =>['nullable', 'numeric'],
            'length' =>['nullable', 'numeric'],
            'unit_length_id' =>['nullable', 'numeric'],
            'thick_head' =>['nullable', 'numeric'],
            'unit_thick_head_id' =>['nullable', 'numeric'],
            'drat_length' =>['nullable', 'numeric'],
            'unit_drat_length_id' =>['nullable', 'numeric'],
            'drat_size' =>['nullable', 'string'],
            'dimensional_standart' =>['nullable', 'string'],
            'head_style' =>['nullable', 'string'],
            'drive_type' =>['nullable', 'string'],
            'across_flats' =>['nullable', 'string'],
            'drat_type' =>['nullable', 'string'],
            'color_id' =>['nullable', 'numeric'],
            'published' => ['nullable', 'boolean'],
        ];
    }
}
