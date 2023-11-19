<x-app-layout>
    <div x-data="{
            flashMessage: '{{\Illuminate\Support\Facades\Session::get('flash_message')}}',
            init() {
                if (this.flashMessage) {
                    setTimeout(() => this.$dispatch('notify', {message: this.flashMessage}), 200)
                }
            }
        }">
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 lg:py-20 pb-6 pt-24">
            <form x-data="{
                    billingAddress: {{ json_encode([
                        'address1' => old('billing.address1', $billingAddress->address1),
                        'address2' => old('billing.address2', $billingAddress->address2),
                        'city' => old('billing.city', $billingAddress->city),
                        'state' => old('billing.state', $billingAddress->state),
                        'country' => old('billing.country', $billingAddress->country),
                        'zipcode' => old('billing.zipcode', $billingAddress->zipcode),
                    ])}},
                    shippingAddress: {{ json_encode([
                        'address1' => old('shipping.address1', $shippingAddress->address1),
                        'address2' => old('shipping.address2', $shippingAddress->address2),
                        'city' => old('shipping.city', $shippingAddress->city),
                        'state' => old('shipping.state', $shippingAddress->state),
                        'country' => old('shipping.country', $shippingAddress->country),
                        'zipcode' => old('shipping.zipcode', $shippingAddress->zipcode),
                    ])}},
                }" action="{{ route('profile.update') }}" method="post">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">{{ __('Profile Information') }}</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">{{ __("Update profil informasi akun anda dan alamat email.") }}</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <x-input-label for="first_name" :value="__('Nama depan')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="text" 
                                        name="first_name" 
                                        id="first_name"
                                        value="{{old('first_name', $customer->first_name)}}"
                                        autocomplete="first_name" />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <x-input-label for="last_name" :value="__('Nama belakang')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="text" 
                                        name="last_name" 
                                        id="last_name" 
                                        value="{{old('last_name', $customer->last_name)}}"
                                        autocomplete="last_name" />
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        value="{{old('email', $user->email)}}"
                                        autocomplete="email" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <x-input-label for="phone" :value="__('Nomor Handphone')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="text" 
                                        name="phone" 
                                        id="phone" 
                                        value="{{old('phone', $customer->phone)}}"
                                        autocomplete="phone" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Alamat Anda</h2>
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <x-input-label for="billing_country" :value="__('Negara')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="text" 
                                        name="billing[country]" 
                                        value="Indonesia" 
                                        id="billing_country" 
                                        autocomplete="billing_country" 
                                        readonly />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <x-input-label for="billing_address_1" :value="__('Alamat 1')" />
                                <div class="mt-2">
                                    <x-text-input  
                                        type="text" 
                                        name="billing[address1]" 
                                        id="billing_address_1" 
                                        x-model="billingAddress.address1" 
                                        autocomplete="billing_address_1" />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <x-input-label for="billing_address_2" :value="__('Alamat 2')" />
                                <div class="mt-2">
                                    <x-text-input  
                                        type="text" 
                                        name="billing[address2]" 
                                        id="billing_address_2" 
                                        x-model="billingAddress.address2" 
                                        autocomplete="billing_address_2" />
                                </div>
                            </div>

                            <div class="sm:col-span-2 sm:col-start-1">
                                <x-input-label for="billing_city" :value="__('Kota / Kabupaten')" />
                                <div class="mt-2">
                                    <x-text-input  
                                        type="text" 
                                        name="billing[city]" 
                                        id="billing_city" 
                                        x-model="billingAddress.city" 
                                        autocomplete="billing_city" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <x-input-label for="billing_state" :value="__('Provinsi')" />
                                <div class="mt-2">
                                    <x-text-input   
                                        type="text" 
                                        name="billing[state]" 
                                        id="billing_state" 
                                        x-model="billingAddress.state" 
                                        autocomplete="billing_state" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <x-input-label for="zipcode" :value="__('Kode Pos')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="text" 
                                        name="billing[zipcode]" 
                                        id="zipcode" 
                                        x-model="billingAddress.zipcode" 
                                        autocomplete="zipcode" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Alamat Pengiriman</h2>
                        <div class="relative flex gap-x-3">
                            <div class="flex h-6 items-center">
                                <input @change="$event.target.checked ? shippingAddress = {...billingAddress} : ''" id="sameAsBillingAddress" name="sameAsBillingAddress" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-baut-color-red-300 focus:ring-baut-color-red-200">
                            </div>
                            <div class="text-sm leading-6">
                                <label for="sameAsBillingAddress" class="font-medium text-gray-900">
                                    Sama dengan Alamat Utama
                                </label>
                            </div>
                        </div>
                         <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <x-input-label for="shipping_country" :value="__('Negara')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="text" 
                                        name="shipping[country]" 
                                        value="Indonesia" 
                                        id="shipping_country" 
                                        autocomplete="shipping_country" 
                                        readonly />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <x-input-label for="shipping_address_1" :value="__('Alamat 1')" />
                                <div class="mt-2">
                                    <x-text-input  
                                        type="text" 
                                        name="shipping[address1]" 
                                        id="shipping_address_1" 
                                        x-model="shippingAddress.address1" 
                                        autocomplete="shipping_address_1" />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <x-input-label for="shipping_address_2" :value="__('Alamat 2')" />
                                <div class="mt-2">
                                    <x-text-input  
                                        type="text" 
                                        name="shipping[address2]" 
                                        id="shipping_address_2" 
                                        x-model="shippingAddress.address2" 
                                        autocomplete="shipping_address_2" />
                                </div>
                            </div>

                            <div class="sm:col-span-2 sm:col-start-1">
                                <x-input-label for="shipping_city" :value="__('Kota / Kabupaten')" />
                                <div class="mt-2">
                                    <x-text-input  
                                        type="text" 
                                        name="shipping[city]" 
                                        id="shipping_city" 
                                        x-model="shippingAddress.city" 
                                        autocomplete="shipping_city" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <x-input-label for="shipping_state" :value="__('Provinsi')" />
                                <div class="mt-2">
                                    <x-text-input   
                                        type="text" 
                                        name="shipping[state]" 
                                        id="shipping_state" 
                                        x-model="shippingAddress.state" 
                                        autocomplete="shipping_state" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <x-input-label for="zipcode" :value="__('Kode Pos')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="text" 
                                        name="shipping[zipcode]" 
                                        id="zipcode" 
                                        x-model="shippingAddress.zipcode" 
                                        autocomplete="zipcode" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button type="submit" class="rounded-md bg-baut-color-red-100 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-baut-color-red-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-baut-color-red-100">Save</button>
                </div>
            </form>
        </main> 
        <hr class="mx-auto max-w-7xl">
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 lg:py-20 pb-6 pt-24">
            <form action="{{ route('profile_password.update') }}" method="post">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">{{ __('Update Password') }}</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">{{ __("Update Password anda.") }}</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <x-input-label for="old_password" :value="__('Password Anda')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="password" 
                                        name="old_password"
                                        id="old_password"
                                        autocomplete="old_password" />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <x-input-label for="new_password" :value="__('Password Baru')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="password" 
                                        name="new_password" 
                                        id="new_password" 
                                        autocomplete="new_password" />
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <x-input-label for="new_password_confirmation" :value="__('Konfirmasi Password Baru')" />
                                <div class="mt-2">
                                    <x-text-input 
                                        type="password" 
                                        name="new_password_confirmation" 
                                        id="new_password_confirmation" 
                                        autocomplete="new_password_confirmation" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button type="submit" class="rounded-md bg-baut-color-red-100 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-baut-color-red-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-baut-color-red-100">Save</button>
                </div>
            </form>
        </main> 
    </div>
</x-app-layout>