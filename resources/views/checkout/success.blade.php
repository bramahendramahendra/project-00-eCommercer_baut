<?php
/** @var \Illuminate\Database\Eloquent\Collection $invoice */
?>
<x-app-layout>
    <div class="w-[400px] mx-auto bg-emerald-500 py-2 px-3 text-white rounded">
        {{$customer->first_name}} {{$customer->last_name}}, Order anda selesai!!
    </div>
    <main class="bg-white px-4 pb-24 pt-16 sm:px-6 sm:pt-24 lg:px-8 lg:py-32">
        <div class="mx-auto max-w-3xl">
            <div class="max-w-xl">
                <h1 class="text-base font-medium text-baut-color-red-200">{{ __('Terima Kasih!') }}</h1>
                <p class="mt-2 text-4xl font-bold tracking-tight">{{ __('Invoice Produk!') }}</p>
                <p class="mt-2 text-base text-gray-500">{{ __('Pesanan produk ') }} <span class="{{ $invoice->isPaid() ? 'text-emerald-500' : 'text-yellow-600' }}">{{ ucfirst($invoice->status) }}</span></p>

                {{-- <dl class="mt-12 text-sm font-medium">
                    <dt class="text-gray-900">Tracking number</dt>
                    <dd class="mt-2 text-indigo-600">51547878755545848512</dd>
                </dl> --}}
            </div>

            <section aria-labelledby="order-heading" class="mt-10 border-t border-gray-200">
                <h2 id="order-heading" class="sr-only">{{ __('Pesanan Anda') }}</h2>

                <h3 class="sr-only">{{ __('Produk') }}</h3>
                {{-- @dd($invoice->items) --}}
                @foreach ($invoice->items as $item)
                    <div class="flex space-x-6 border-b border-gray-200 py-10">
                        <img src="{{ $item->product->image }}" alt="{{ $item->product->slug }}" class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40">
                        <div class="flex flex-auto flex-col">
                            <div>
                                <h4 class="font-medium text-gray-900">
                                    <a href="#">{{ $item->product->title }}</a>
                                </h4>
                                <p class="mt-2 text-sm text-gray-600">{{ $item->product->description }}</p>
                            </div>
                            <div class="mt-6 flex flex-1 items-end">
                                <dl class="flex space-x-4 divide-x divide-gray-200 text-sm sm:space-x-6">
                                    <div class="flex">
                                        <dt class="font-medium text-gray-900">{{ __('Kuantitas') }}</dt>
                                        <dd class="ml-2 text-gray-700">{{ $item->quantity }}</dd>
                                    </div>
                                    <div class="flex pl-4 sm:pl-6">
                                        <dt class="font-medium text-gray-900">{{ __('Harga') }}</dt>
                                        <dd class="ml-2 text-gray-700">{{ $item->unit_price }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- @dd($invoice->user->customer->shippingAddress) --}}
                <div class="sm:ml-40 sm:pl-6">
                    <h3 class="sr-only">{{ __('Informasi') }}</h3>

                    <h4 class="sr-only">{{ __('Alamat') }}</h4>
                    <dl class="grid grid-cols-2 gap-x-6 py-10 text-sm">
                    <div>
                        <dt class="font-medium text-gray-900">{{ __('Alamat Pengiriman') }}</dt>
                        <dd class="mt-2 text-gray-700">
                        <address class="not-italic">
                            <span class="block">{{$invoice->user->customer->shippingAddress->address1}} {{$invoice->user->customer->shippingAddress->address2}}</span>
                            <span class="block">{{$invoice->user->customer->shippingAddress->city}}, {{$invoice->user->customer->shippingAddress->state}}</span>
                            <span class="block">{{$invoice->user->customer->shippingAddress->country}}, {{$invoice->user->customer->shippingAddress->zipcode}}</span>
                        </address>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-900">{{ __('Alamat Anda') }}</dt>
                        <dd class="mt-2 text-gray-700">
                        <address class="not-italic">
                            <span class="block">{{$invoice->user->customer->billingAddress->address1}} {{$invoice->user->customer->billingAddress->address2}}</span>
                            <span class="block">{{$invoice->user->customer->billingAddress->city}}, {{$invoice->user->customer->billingAddress->state}}</span>
                            <span class="block">{{$invoice->user->customer->billingAddress->country}}, {{$invoice->user->customer->billingAddress->zipcode}}</span>
                        </address>
                        </dd>
                    </div>
                    </dl>

                    <h3 class="sr-only">{{ __('Ringkasan') }}</h3>
                    <div x-data="invoiceData({{ $invoice->items->toJson() }})" x-init="init">
                        <dl  class="space-y-6 border-t border-gray-200 pt-10 text-sm">
                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-900">{{ __('Subtotal') }}</dt>
                                <dd class="text-gray-700" x-text="'Rp. ' + Number(subtotal).toFixed(2)"></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="flex font-medium text-gray-900">{{ __('Estimasi Perngiriman') }}</dt>
                                <dd class="text-gray-700" x-text="'Rp. ' + Number(jumlahOngkir).toFixed(2)"></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-900">{{ __('Estimasi Pajak') }}</dt>
                                <dd class="text-gray-700" x-text="'Rp. ' + Number(jumlahpajak).toFixed(2)"></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-900">{{ __('Total') }}</dt>
                                <dd class="text-gray-900" x-text="'Rp. ' + Number(total).toFixed(2)"></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </section>
        </div>
    </main>

</x-app-layout>