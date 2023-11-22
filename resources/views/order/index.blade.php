<?php
/** @var \Illuminate\Database\Eloquent\Collection $orders */
?>

<x-app-layout>
    <div>
        <div class="bg-white">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:pb-24">
                <div class="max-w-xl">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Order history</h1>
                    <p class="mt-2 text-sm text-gray-500">
                        Check the status of recent orders, manage returns, and download invoices.
                    </p>
                </div>

                <div class="mt-16">
                    <h2 class="sr-only">Recent orders</h2>
                    <div class="space-y-20">
                        @foreach ($orders as $order)
                            <div>
                                <h3 class="sr-only">
                                    {{ $order->created_at }}
                                    Order placed on <time datetime="{{ $order->created_at->format('Y-m-d') }}">{{ $order->created_at->format('F d, Y') }}</time>
                                </h3>
                                <div
                                    class="rounded-lg bg-gray-50 px-4 py-6 sm:flex sm:items-center sm:justify-between sm:space-x-6 sm:px-6 lg:space-x-8">
                                    <dl
                                        class="flex-auto space-y-6 divide-y divide-gray-200 text-sm text-gray-600 sm:grid sm:grid-cols-3 sm:gap-x-6 sm:space-y-0 sm:divide-y-0 lg:w-1/2 lg:flex-none lg:gap-x-8">
                                        <div class="flex justify-between sm:block">
                                            <dt class="font-medium text-gray-900">{{ __('Date placed') }}</dt>
                                            <dd class="sm:mt-1">
                                                <time datetime="2021-01-22">{{ $order->created_at->format('F d, Y') }}</time>
                                            </dd>
                                        </div>
                                        <div class="flex justify-between pt-6 sm:block sm:pt-0">
                                            <dt class="font-medium text-gray-900">{{ __('Order number') }}</dt>
                                            <dd class="sm:mt-1">{{ $order->id }}</dd>
                                        </div>
                                        <div
                                            class="flex justify-between pt-6 font-medium text-gray-900 sm:block sm:pt-0">
                                            <dt>Total amount</dt>
                                            <dd class="sm:mt-1">{{ $order->total_price }}</dd>
                                        </div>
                                    </dl>
                                    <a href="#" class="mt-6 flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-baut-color-red-200 focus:ring-offset-2 sm:mt-0 sm:w-auto">
                                        {{ __('View Invoice') }}
                                        <span class="sr-only">{{ __('for order') }} {{ $order->id }}</span>
                                    </a>
                                </div>
                                {{-- New Modal Invoice  --}}
                                <table class="mt-4 w-full text-gray-500 sm:mt-6">
                                    <caption class="sr-only">
                                        Products
                                    </caption>
                                    <thead class="sr-only text-left text-sm text-gray-500 sm:not-sr-only">
                                        <tr>
                                            <th scope="col" class="py-3 pr-8 font-normal sm:w-2/5 lg:w-1/3">
                                                {{ __('Produk') }}
                                            </th>
                                            <th scope="col" class="hidden w-1/5 py-3 pr-8 font-normal sm:table-cell">
                                                {{ __('Harga') }}
                                            </th>
                                            <th scope="col" class="hidden py-3 pr-8 font-normal sm:table-cell">
                                                {{ __('Status') }}
                                            </th>
                                            <th scope="col" class="w-0 py-3 text-right font-normal">
                                                {{ __('Info') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 border-b border-gray-200 text-sm sm:border-t">
                                        @foreach ($order->items as $item)
                                            {{-- {{ dump($item->product) }} --}}
                                            <tr>
                                                <td class="py-6 pr-8">
                                                    <div class="flex items-center">
                                                        <img 
                                                            src="{{ $item->product->image }}"
                                                            alt="{{ $item->product->slug }}"
                                                            class="mr-6 h-16 w-16 rounded object-cover object-center">
                                                        <div>
                                                            <div class="font-medium text-gray-900">
                                                                {{ $item->product->title }}
                                                            </div>
                                                            <div class="mt-1 sm:hidden">Rp {{ $item->unit_price * $item->quantity }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-6 pr-8 sm:table-cell">{{ __('Rp ') }}{{ $item->unit_price * $item->quantity }}</td>
                                                <td class="hidden py-6 pr-8 sm:table-cell"> <span class="{{ $order->isPaid() ? 'text-emerald-500' : 'text-yellow-600' }}">{{ ucfirst($order->status) }}</span> {{ $order->created_at->format('F d, Y') }}</td>
                                                <td class="whitespace-nowrap py-6 text-right font-medium">
                                                    <div x-data="{openModal: false}">
                                                        <a @click="openModal = true" 
                                                            href="#" class="text-baut-color-red-200">
                                                            {{ __('View') }}
                                                            <span class="hidden lg:inline">{{ __('Produk') }}</span>
                                                            <span class="sr-only">{{ __(', ') }}{{ $item->product->title }}</span>
                                                        </a>
                                                        <template x-teleport="body">
                                                            <div x-show="openModal" x-transition class="relative z-50"
                                                                aria-labelledby="modal-title" role="dialog"
                                                                aria-modal="true">
                                                                <div x-transition:enter="ease-out duration-300"
                                                                    x-transition:enter-start="opacity-0"
                                                                    x-transition:enter-end="opacity-100"
                                                                    x-transition:leave="ease-in duration-200"
                                                                    x-transition:leave-start="opacity-100"
                                                                    x-transition:leave-end="opacity-0"
                                                                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
                                                                </div>

                                                                <div class="fixed inset-0 z-50 w-screen overflow-y-auto">
                                                                    <div
                                                                        class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                                        <div x-transition:enter="ease-out duration-300"
                                                                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave="ease-in duration-200"
                                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-auto sm:max-w-5xl sm:p-6">
                                                                            <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                                                                                <button @click = "openModal = false"
                                                                                    type="button"
                                                                                    class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-baut-color-red-200 focus:ring-offset-2">
                                                                                    <span class="sr-only">{{ __('Keluar') }}</span>
                                                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                                    </svg>
                                                                                </button>
                                                                            </div>
                                                                            <div class="sm:flex sm:items-start">
                                                                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                                                    </svg>
                                                                                </div>
                                                                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Title</h3>
                                                                                    <div class="mt-2">
                                                                                        <main
                                                                                            class="bg-white px-2 pb-5 pt-5 sm:px-3 sm:pt-24 lg:px-5 lg:py-10">
                                                                                            <div class="mx-auto max-w-3xl">
                                                                                                <div class="max-w-xl">
                                                                                                    <h1 class="text-base font-medium {{ $order->isPaid() ? 'text-emerald-500' : 'text-yellow-600' }}">{{ ucfirst($order->status) }}</h1>
                                                                                                    <p class="mt-2 text-4xl font-bold tracking-tight">
                                                                                                        {{ __('Invoice Produk!') }}
                                                                                                    </p>
                                                                                                    <p class="mt-2 text-base text-gray-500">{{ __('Pesanan produk ') }}{{ $item->order_id }}{{ $order->isPaid()?' sudah selasai pembayaran.':' masih dalam proses.' }}</p>
                                                                                                </div>

                                                                                                <section aria-labelledby="order-heading" class="mt-10 border-t border-gray-200">
                                                                                                    <h2 id="order-heading" class="sr-only">{{ __('Pesanan anda') }}</h2>
                                                                                                    <h3 class="sr-only">{{ __('Produk') }}</h3>
                                                                                                    <div
                                                                                                        class="flex space-x-6 border-b border-gray-200 py-10">
                                                                                                        <img src="{{ $item->product->image }}" alt="{{ $item->product->slug }}" class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40">
                                                                                                        <div class="flex flex-auto flex-col">
                                                                                                            <div>
                                                                                                                <h4 class="font-medium text-gray-900"><a href="#">{{ $item->product->title }}</a></h4>
                                                                                                                <p class="mt-2 text-sm text-gray-600">{{ $item->product->description }}</p>
                                                                                                            </div>
                                                                                                            <div class="mt-6 flex flex-1 items-end">
                                                                                                                <dl class="flex space-x-4 divide-x divide-gray-200 text-sm sm:space-x-6">
                                                                                                                    <div class="flex">
                                                                                                                        <dt class="font-medium text-gray-900">{{ __('Kuantitas') }}</dt>
                                                                                                                        <dd class="ml-2 text-gray-700">{{ $item->quantity }}</dd>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="flex pl-4 sm:pl-6">
                                                                                                                        <dt class="font-medium text-gray-900">{{ __('Harga') }}</dt>
                                                                                                                        <dd class="ml-2 text-gray-700">{{ $item->unit_price }}</dd>
                                                                                                                    </div>
                                                                                                                </dl>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </section>
                                                                                            </div>
                                                                                        </main>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                                                <button @click="openModal = false"
                                                                                    type="button"
                                                                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                                                    {{ __('Keluar') }}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </template>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                       

                                        <!-- More products... -->
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                        <!-- More orders... -->
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>