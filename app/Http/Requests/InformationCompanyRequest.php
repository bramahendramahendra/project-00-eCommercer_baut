<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformationCompanyRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'max:20'],
            'operating_days' => ['required', 'string', 'max:50'],
            'operating_hours' => ['required', 'string', 'max:50'],
            'address' => ['required'],
            'city' =>['required'],
            'state' =>['required'],
            'zipcode' =>['required'],
            'country' =>['required'],
        ];
    }
}
