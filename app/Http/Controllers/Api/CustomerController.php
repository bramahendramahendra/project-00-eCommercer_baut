<?php

namespace App\Http\Controllers\Api;

use App\Enums\AddressType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerListResource;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Customer::query()
            // ->where('id', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);
        
        return CustomerListResource::collection($query);
    }

     /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $data = $request->validated();
        $data['is_admin'] = true;
        $data['email_verified_at'] = date('Y-m-d H:i:s');
        $data['password'] = Hash::make($data['password']);
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $user = User::create($data);

        return new UserResource($user);
    }

    /**
     * Display the specified resource
     * 
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

     /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Api\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customerData = $request->validated();
        $customerData['updated_by'] = $request->user()->id;

        $shippingData = $customerData['shipping'];
        $billingData = $customerData['billing'];

        $user->update($customerData);

        if($customer->shippingAddress) {
            $customer->shippingAddress->update($shippingData);
        } else {
            $shippingData['customer_id'] = $customer->user_id;
            $shippingData['type'] = AddressType::Shipping->value;
            CustomerAddress::create($shippingData);
        }

        if($customer->billingAddress) {
            $customer->billingAddress->update($billingData);
        } else {
            $billingData['customer_id'] = $customer->user_id;
            $billingData['type'] = AddressType::Billing->value;
            CustomerAddress::create($billingData);
        }

        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param \App\Models\Api\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->noContent();
    }
}
