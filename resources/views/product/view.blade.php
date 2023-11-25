<x-app-layout>
    <div>
        <main class="mx-auto max-w-7xl sm:px-6 sm:pt-16 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-none">
                <!-- Product -->
                <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
                    <!-- Image gallery -->
                    <div x-data="{ selectedTab: 1, images: [
                        { id: 1, src: '{{ $product->image }}', alt: '{{ $product->slug }}' },
                        {{-- { id: 2, src: '{{ $product->image }}', alt: '{{ $product->slug }}' }, --}}
                        {{-- { id: 3, src: '{{ $product->image }}', alt: '{{ $product->slug }}' }, --}}
                    ]}" class="flex flex-col-reverse"
                    >
                        <!-- Image selector -->
                        <div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
                            <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                                <template x-for="image in images" :key="image.id">
                                    <button @click="selectedTab = image.id" :id="'tabs-2-tab-' + image.id"
                                        class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4 focus:ring-baut-color-red-300"
                                        :aria-controls="'tabs-2-panel-' + image.id" role="tab" type="button">
                                        <span class="sr-only" x-text="image.alt">Angled view</span>
                                        <span class="absolute inset-0 overflow-hidden rounded-md">
                                            <img :src="image.src" :alt="image.alt" class="h-full w-full object-cover object-center">
                                        </span>
                                        <span :class="{'ring-baut-color-red-200': selectedTab === image.id, 'ring-transparent': selectedTab !== image.id}"
                                            class="ring-transparent pointer-events-none absolute inset-0 rounded-md ring-2 ring-offset-2"
                                            aria-hidden="true"></span>
                                    </button>
                               </template>
                            </div>
                        </div>

                        <div class="aspect-h-1 aspect-w-1 w-full">
                            <template x-for="image in images" :key="image.id">
                                <div 
                                    x-show="selectedTab === image.id" 
                                    :id="'tabs-2-panel-' + image.id" 
                                    :aria-labelledby="'tabs-2-tab-' + image.id"
                                    role="tabpanel" tabindex="0">
                                    <img :src="image.src" :alt="image.alt" class="h-full w-full object-cover object-center sm:rounded-lg">
                                </div>
                            </template>
                        </div>
                    </div>

                    <div x-data="productItem({{ json_encode (
                            [
                                'id' => $product->id, 
                                'slug' => $product->slug,
                                'image' =>  $product->image,
                                'title' => $product->title,
                                // 'price' => $product->price_retail,
                                // 'quantity' => $product->quantity,
                                'price_retail' => $product->price_retail,
                                'price_wholesale' => $product->price_wholesale,
                                'max_retail' => 600,
                                'addToCartUrl' => route('cart.add', $product)
                            ]
                        ) }})" class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">

                        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $product->title }}</h1>

                        <div class="sm:flex sm:justify-between mt-3">
                            <h2 class="sr-only">{{ __('Informasi Produk') }}</h2>
                            <fieldset>
                                <legend class="block text-sm font-medium text-gray-700">
                                    {{ __('Daftar Harga per Kuantitas') }}
                                </legend>
                                <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div
                                        class="relative block cursor-pointer rounded-lg border border-gray-300 p-4 focus:outline-none">
                                        <p id="size-choice-0-label" class="text-3xl tracking-tight font-medium text-gray-900">
                                            {{ __('Rp. ') }}{{ $product->price_retail }}
                                        </p>
                                        <p id="size-choice-0-description" class="mt-1 text-sm text-gray-500">
                                            {{ __('Eceran = 1 - 599.') }}
                                        </p>
                                        <div class="pointer-events-none absolute -inset-px rounded-lg border-2" aria-hidden="true"></div>
                                    </div>
                                    <div
                                        class="relative block cursor-pointer rounded-lg border border-gray-300 p-4 focus:outline-none">
                                        <p id="size-choice-1-label" class="text-3xl tracking-tight font-medium text-gray-900">
                                            {{ __('Rp. ') }}{{ $product->price_wholesale }}
                                        </p>
                                        <p id="size-choice-1-description" class="mt-1 text-sm text-gray-500">
                                            {{ __('Agen = 600 ++') }}
                                        </p>
                                        <div class="pointer-events-none absolute -inset-px rounded-lg border-2" aria-hidden="true"></div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6">
                            <h3 class="sr-only">{{ __('Description') }}</h3>
                            <div class="space-y-6 text-base text-gray-700">
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>

                        <form class="mt-6">
                            <div class="mt-5 flex items-center space-x-14">
                                <label for="quantity" class="block font-bold">{{ __('Kuantitas') }}</label>
                                <input type="number" name="quantity" 
                                    x-ref="quantityEl" 
                                    value="1" min="1" class="w-32 text-baut-color-red-200 focus:border-baut-color-red-200 focus:outline-none focus:ring-baut-color-red-200 rounded">
                            </div>
                            <div class="mt-10 flex">
                                <button type="button" @click="addToCart($refs.quantityEl.value)" class="flex max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-baut-color-red-100 px-8 py-3 text-base font-medium text-white hover:bg-baut-color-red-200 focus:outline-none focus:ring-2 focus:ring-baut-color-red-200 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">
                                    {{ __('Tambahkan Keranjang') }}
                                </button>
                            </div>
                        </form>
                        <section aria-labelledby="details-heading" class="mt-12">
                            <h2 id="details-heading" class="sr-only">Additional details</h2>
                            <div class="divide-y divide-gray-200 border-t">
                                <div x-data="{ isOpen: true }">
                                    <h3>
                                        <button type="button" @click="isOpen = !isOpen" class="group relative flex w-full items-center justify-between py-6 text-left"
                                            x-bind:aria-expanded="isOpen.toString()" aria-controls="disclosure-1" aria-expanded="false">
                                            <span :class="isOpen ? 'text-baut-color-red-100' : 'text-gray-900' " class="text-sm font-medium">{{ __('Detail Produk') }}</span>
                                            <span class="ml-6 flex items-center">
                                                <svg x-show="!isOpen" class=" h-6 w-6 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                                <svg x-show="isOpen" class=" h-6 w-6 text-baut-color-red-100 group-hover:text-baut-color-red-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                                </svg>
                                            </span>
                                        </button>
                                    </h3>
                                    {{-- {{ dump($product->unit) }} --}}
                                    <div x-show="isOpen" class="prose prose-sm" id="disclosure-1">
                                        <table class="min-w-full border-separate border-spacing-0">
                                            <tbody>
                                                @if ($product->unit->full_name)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Unit') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->unit->full_name }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->material->name)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Material') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->material->name }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->weight)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Berat') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ rtrim(rtrim(sprintf('%.2f', $product->weight), '0'), '.').' '.($product->weightUnit->short_name?$product->weightUnit->short_name:'') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->contents_per_box)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Isi Per Kotak') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->contents_per_box.' '.($product->contentsPerBoxUnit->short_name?$product->contentsPerBoxUnit->short_name:'') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->grade)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Grade') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ rtrim(rtrim(sprintf('%.2f', $product->grade), '0'), '.') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->threadDirection->name)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Thread Direction') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->threadDirection->name }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->threadDensity->name)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Thread Density') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->threadDensity->name }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                 @if ($product->diameter)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Diameter') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->diameter.' '.($product->diameterUnit->symbol?$product->diameterUnit->symbol:'') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->inner_diameter)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Diameter Dalam') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->inner_diameter.' '.($product->diameterUnit->symbol?$product->diameterUnit->symbol:'') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->outer_diameter)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Diameter Luar') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->outer_diameter.' '.($product->diameterUnit->symbol?$product->diameterUnit->symbol:'') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->length)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Panjang') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ rtrim(rtrim(sprintf('%.2f', $product->length), '0'), '.').' '.($product->lengthUnit->symbol?$product->lengthUnit->symbol:'') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->dimensional_standart)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Dimensional Standart') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->dimensional_standart }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->head_style)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Head Style') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->head_style }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->drive_type)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Drive Type') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->drive_type }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->thick_head)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Tebal Kepala') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ rtrim(rtrim(sprintf('%.2f', $product->thick_head), '0'), '.').' '.($product->thickHeadUnit->symbol?$product->thickHeadUnit->symbol:'') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->across_flats)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Kunci Kepala') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->across_flats }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->drat_size)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Ukuran Drat') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->drat_size }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->drat_type)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Tipe drat') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->drat_type }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->drat_length)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Tebal Kepala') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ rtrim(rtrim(sprintf('%.2f', $product->drat_length), '0'), '.').' '.($product->dratLengthUnit->symbol?$product->dratLengthUnit->symbol:'') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($product->color->name)
                                                    <tr>
                                                        <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                                            {{ __('Warna') }}
                                                        </td>
                                                        <td class="whitespace-nowrap border-b border-gray-200 hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                            {{ $product->color->name }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <section aria-labelledby="related-heading"
                    class=" mt-16 border-t border-gray-200 px-4 py-16 sm:mt-24">
                    <h2 id="related-heading" class="text-lg font-medium text-gray-900">Customers also purchased</h2>

                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        <div class="group relative">
                            <div
                                class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md lg:aspect-none group-hover:opacity-75 lg:h-80">
                                <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-02.jpg"
                                    alt="Front of men&#039;s Basic Tee in white."
                                    class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <a href="#">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            Basic Tee
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">Aspen White</p>
                                </div>
                                <p class="text-sm font-medium text-gray-900">$35</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-app-layout>