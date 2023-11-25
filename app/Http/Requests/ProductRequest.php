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
            // 'type_id' => ['required'],
            'code' => ['required', 'max:10'],
            'image' => ['nullable', 'image'],
            'title' => ['required', 'max:1000'],
            'description' => ['nullable', 'string'],
            'price_retail' => ['required', 'numeric'],
        ];
    }
}