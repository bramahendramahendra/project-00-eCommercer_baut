<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Rule;

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
            'phone' => ['required', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'status' => ['required', 'boolean'],

            'shippingAddress.address1' => ['required'],
            'shippingAddress.address2' => ['required'],
            'shippingAddress.city' => ['required'],
            'shippingAddress.state' => ['required'],
            'shippingAddress.zipcode' => ['required'],
            'shippingAddress.country' => ['required'],

            'billingAddress.address1' => ['required'],
            'billingAddress.address2' => ['required'],
            'billingAddress.city' => ['required'],
            'billingAddress.state' => ['required'],
            'billingAddress.zipcode' => ['required'],
            'billingAddress.country' => ['required'],
        ];
    }

     public function attributes() 
    {
        return [
            'billingAddress.address1' => 'address1',
            'billingAddress.address2' => 'address2',
            'billingAddress.city' => 'city',
            'billingAddress.state' => 'state',
            'billingAddress.zipcode' => 'zipcode',
            'billingAddress.country' => 'country',
            'shippingAddress.address1' => 'address1',
            'shippingAddress.address2' => 'address2',
            'shippingAddress.city' => 'city',
            'shippingAddress.state' => 'state',
            'shippingAddress.zipcode' => 'zipcode',
            'shippingAddress.country' => 'country',
        ];
    }
}
