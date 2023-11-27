<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:7'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'status' => ['required', 'boolean'],

            'shipping.address1' => ['required'],
            'shipping.address2' => ['required'],
            'shipping.city' => ['required'],
            'shipping.state' => ['required'],
            'shipping.zipcode' => ['required'],
            'shipping.country' => ['required'],

            'billing.address1' => ['required'],
            'billing.address2' => ['required'],
            'billing.city' => ['required'],
            'billing.state' => ['required'],
            'billing.zipcode' => ['required'],
            'billing.country' => ['required'],
        ];
    }

     public function attributes() 
    {
        return [
            'billing.address1' => 'address1',
            'billing.address2' => 'address2',
            'billing.city' => 'city',
            'billing.state' => 'state',
            'billing.zipcode' => 'zipcode',
            'billing.country' => 'country',
            'shipping.address1' => 'address1',
            'shipping.address2' => 'address2',
            'shipping.city' => 'city',
            'shipping.state' => 'state',
            'shipping.zipcode' => 'zipcode',
            'shipping.country' => 'country',
        ];
    }
}
