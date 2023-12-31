<?php
/** @var \Illuminate\Database\Eloquent\Collection $products */
?>

<x-app-layout>
    <script>
        window.Laravel = {
            routes: {
                filterCheckbox: "{{ route('katalog') }}"
            }
            // Anda dapat menambahkan lebih banyak konfigurasi global jika diperlukan
        };
    </script>
   <div x-data="{ mobileMenuOpen: false }">
        <div x-cloak class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0 " x-transition:enter-end="opacity-100 "
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black bg-opacity-25"></div>

            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0 " x-transition:leave-end="translate-x-full "
                class="fixed inset-0 z-40 flex">
                <div @click.away="mobileMenuOpen = false"
                    class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                    <div class="flex items-center justify-between px-4">
                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                        <button @click="mobileMenuOpen = false" type="button"
                            class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Filters -->
                    <form x-data="filterState" class="mt-4 border-t border-gray-200">
                        <h3 class="sr-only">Filter</h3>
                        <div class="border-t border-gray-200 px-4 py-6">
                            <h3 class="-mx-2 -my-3 flow-root">
                                <button type="button" @click="isOpenMaterial = !isOpenMaterial"
                                    class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                    x-bind:aria-expanded="isOpenMaterial.toString()" aria-controls="filter-section-mobile-0"
                                    aria-expanded="false">
                                    <span class="font-medium text-gray-900">Material</span>
                                    <span class="ml-6 flex items-center">
                                        <svg x-show="!isOpenMaterial" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                        </svg>
                                        <svg x-show="isOpenMaterial" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div x-show="isOpenMaterial" class="pt-6" id="filter-section-mobile-0">
                                <div class="space-y-6">
                                    @foreach ($materials as $material)
                                        <div class="flex items-center">
                                            <input 
                                                id="filter-mobile-material-{{ $material->id }}" 
                                                x-model="materialIds"
                                                :checked="materialIds.includes('{{ $material->id }}')"
                                                @change="submitFilter"
                                                name="material_id[]" 
                                                value="{{ $material->id }}"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-baut-color-red-300 focus:ring-baut-color-red-200">
                                            <label for="filter-mobile-material-{{ $material->id }}" class="ml-3 min-w-0 flex-1 text-gray-500"> 
                                                {{ $material->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-6">
                            <h3 class="-mx-2 -my-3 flow-root">
                                <button type="button" @click="isOpenColor = !isOpenColor"
                                    class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                    x-bind:aria-expanded="isOpenColor.toString()" aria-controls="filter-section-mobile-1"
                                    aria-expanded="false">
                                    <span class="font-medium text-gray-900">Warna</span>
                                    <span class="ml-6 flex items-center">
                                        <svg x-show="!isOpenColor" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                        </svg>
                                        <svg x-show="isOpenColor" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div x-show="isOpenColor" class="pt-6" id="filter-section-mobile-1">
                                <div class="space-y-6">
                                    @foreach ($colors as $color)
                                        <div class="flex items-center">
                                            <input 
                                                id="filter-mobile-color-{{ $color->id }}" 
                                                x-model="colorIds"
                                                :checked="colorIds.includes('{{ $color->id }}')"
                                                @change="submitFilter"
                                                name="color_id[]" 
                                                value="{{ $color->id }}"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-baut-color-red-300 focus:ring-baut-color-red-200">
                                            <label for="filter-mobile-color-{{ $color->id }}" class="ml-3 min-w-0 flex-1 text-gray-500">
                                                {{ $color->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Website  -->
        <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-6">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">Katalog</h1>
                <div class="flex items-center">
                    <div class="relative inline-block text-left"
                        x-data="{ dropdownOpen: false, selectedIndex: null }" @click.away="dropdownOpen = false">
                        <div>
                            <button type="button" @click="dropdownOpen = !dropdownOpen"
                                class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                                id="menu-button" aria-expanded="false" aria-haspopup="true">
                                Sort
                                <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <template
                                    x-for="(item, index) in ['Most Popular', 'Best Rating', 'Newest', 'Price: Low to High', 'Price: High to Low']"
                                    :key="index">
                                    <a :href="'#'" x-text="item"
                                        :class="{ 'font-medium text-gray-900 cursor-pointer': selectedIndex === index, 'text-gray-500 hover:bg-gray-100 cursor-pointer': selectedIndex !== index }"
                                        class="block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                        @click="selectedIndex = index; dropdownOpen=false"
                                        :id="'menu-item-' + index">
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="-m-2 ml-5 p-2 text-gray-400 hover:text-gray-500 sm:ml-7">
                        <span class="sr-only">View grid</span>
                        <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.25 2A2.25 2.25 0 002 4.25v2.5A2.25 2.25 0 004.25 9h2.5A2.25 2.25 0 009 6.75v-2.5A2.25 2.25 0 006.75 2h-2.5zm0 9A2.25 2.25 0 002 13.25v2.5A2.25 2.25 0 004.25 18h2.5A2.25 2.25 0 009 15.75v-2.5A2.25 2.25 0 006.75 11h-2.5zm9-9A2.25 2.25 0 0011 4.25v2.5A2.25 2.25 0 0013.25 9h2.5A2.25 2.25 0 0018 6.75v-2.5A2.25 2.25 0 0015.75 2h-2.5zm0 9A2.25 2.25 0 0011 13.25v2.5A2.25 2.25 0 0013.25 18h2.5A2.25 2.25 0 0018 15.75v-2.5A2.25 2.25 0 0015.75 11h-2.5z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden">
                        <span class="sr-only">Filters</span>
                        <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <section aria-labelledby="products-heading" class=" pt-6">
                <h2 id="products-heading" class="sr-only">Filter</h2>

                <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                    <!-- Filters -->
                    <form x-data="filterState"  class="hidden lg:block">
                        @csrf
                        <h3 class="sr-only">Categories</h3>
                        <div class="border-b border-gray-200 py-6">
                            <h3 class="-my-3 flow-root">
                                <button type="button" @click="isOpenMaterial = !isOpenMaterial"
                                    class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                    x-bind:aria-expanded="isOpenMaterial.toString()" aria-controls="filter-section-0"
                                    aria-expanded="false">
                                    <span class="font-medium text-gray-900">Material</span>
                                    <span class="ml-6 flex items-center">
                                        <svg x-show="!isOpenMaterial" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                        </svg>
                                        <svg x-show="isOpenMaterial" x-cloak class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div x-show="isOpenMaterial" x-cloak class="pt-6" id="filter-section-0">
                                <div class="space-y-4">
                                    @foreach ($materials as $material)
                                        <div class="flex items-center">
                                            <input 
                                                id="filter-material-{{ $material->id }}" 
                                                x-model="materialIds"
                                                :checked="materialIds.includes('{{ $material->id }}')"
                                                @change="submitFilter"
                                                name="material_id[]" 
                                                value="{{ $material->id }}" 
                                                type="checkbox"
                                                class="material-checkbox h-4 w-4 rounded border-gray-300 text-baut-color-red-300 focus:ring-baut-color-red-200"
                                            >
                                            <label for="filter-material-{{ $material->id }}" class="ml-3 text-sm text-gray-600">
                                                {{ $material->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="border-b border-gray-200 py-6">
                            <h3 class="-my-3 flow-root">
                                <button type="button" @click="isOpenColor = !isOpenColor"
                                    class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                    x-bind:aria-expanded="isOpenColor.toString()" aria-controls="filter-section-1"
                                    aria-expanded="false">
                                    <span class="font-medium text-gray-900">Warna</span>
                                    <span class="ml-6 flex items-center">
                                        <svg x-show="!isOpenColor" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                        </svg>
                                        <svg x-show="isOpenColor" x-cloak class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div x-show="isOpenColor" x-cloak class="pt-6" id="filter-section-1">
                                <div class="space-y-4">
                                    @foreach ($colors as $color)
                                        <div class="flex items-center">
                                            <input 
                                                id="filter-color-{{ $color->id }}" 
                                                x-model="colorIds"
                                                :checked="colorIds.includes('{{ $color->id }}')"
                                                @change="submitFilter"
                                                name="color_id[]" 
                                                value="{{ $color->id }}" 
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-baut-color-red-300 focus:ring-baut-color-red-200"
                                            >
                                            <label for="filter-color-{{ $color->id }}" class="ml-3 text-sm text-gray-600">
                                                {{ $color->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="lg:col-span-3">
                        <div class="relative mt-8 mb-11">
                            <div class="relative -mb-6 w-full overflow-x-auto pb-6">
                                <ul role="list"
                                    class="mx-4 inline-flex space-x-8 sm:mx-6 lg:mx-0 lg:grid lg:grid-cols-4 lg:gap-x-8 lg:space-x-0">
                                    @foreach ($products as $product)
                                        <li class="inline-flex w-64 flex-col text-center lg:w-auto">
                                            <div class="group relative">
                                                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200">
                                                    <img src="{{$product->image}}"
                                                        alt="Black machined steel pen with hexagonal grip and small white logo at top."
                                                        class="h-full w-full object-cover object-center group-hover:opacity-75">
                                                </div>
                                                <div class="mt-6">
                                                    <p class="text-sm text-gray-500">{{ $product->material->name }}</p>
                                                    <h3 class="mt-1 font-semibold text-gray-900">
                                                        <a href="{{ route('product.view', $product->slug) }}">
                                                            <span class="absolute inset-0"></span>
                                                            {{$product->title}}
                                                        </a>
                                                    </h3>
                                                    <p class="mt-1 text-gray-900">Rp. {{$product->price_retail}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        {{$products->links()}}
                    </div>
                </div>
            </section>
        </main>
    </div>
</x-app-layout>