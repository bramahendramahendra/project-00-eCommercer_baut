<?php
/** @var \Illuminate\Database\Eloquent\Collection $categories */
?>
<x-app-layout>
    <div>
        <main>
            <section aria-labelledby="category-heading" class="bg-gradient-to-b from-white to-transparent transition duration-300 ease-in-out">
                <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
                    <div class="sm:flex sm:items-baseline sm:justify-between">
                        <h2 id="category-heading" class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Telusuri Berdasarkan Kategori') }}</h2>
                        <a href="{{ route('katalog') }}" class="hidden text-sm font-semibold text-baut-color-red-200 hover:text-baut-color-red-300 sm:block">
                           {{ __('Lihat semua kategori') }}
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>
                    {{-- {{ var_dump($categories) }} --}}
                    {{-- asdas --}}
                   
                    <div class="mt-4 flow-root">
                        <div class="-my-2">
                            <div class="relative box-content h-80 overflow-x-auto py-2 xl:overflow-visible">
                                <div class="absolute flex space-x-8 px-4 sm:px-6 lg:px-8 xl:relative xl:grid xl:grid-cols-5 xl:gap-x-8 xl:space-x-0 xl:px-0">
                                    @foreach ($categoriesShop as $categoryShop)
                                        <a href="{{ route('kategori.index', $categoryShop->slug) }}" class="relative flex h-80 w-56 flex-col overflow-hidden rounded-lg p-6 hover:opacity-75 xl:w-auto">
                                            <span aria-hidden="true" class="absolute inset-0">
                                                <img src="{{$categoryShop->image}}" alt="{{$categoryShop->slug}}" class="h-full w-full object-cover object-center">
                                            </span>
                                            <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-gray-800 opacity-50"></span>
                                            <span class="relative mt-auto text-center text-xl font-bold text-white">
                                                {{ $categoryShop->name }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 sm:hidden">
                        <a href="{{ route('katalog') }}" class="block text-sm font-semibold text-baut-color-red-200 hover:text-baut-color-red-300">
                            {{ __('Lihat semua kategori') }}
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Featured section -->
            <section aria-labelledby="cause-heading">
                <div class="relative bg-gray-800 px-6 py-32 sm:px-12 sm:py-40 lg:px-16">
                    @php
                        $featuredImage = file_exists(public_path('images/featured_image.png')) ? asset('images/featured_image.png') : asset('images/featured_image_default.png');
                    @endphp
                    <div x-data="{
                        featuredImage: { src: '{{ $featuredImage }}', alt: 'Gambar Featured Section' },
                    }" class="absolute inset-0 overflow-hidden">
                        <img :src="featuredImage.src" :alt="featuredImage.alt" class="h-full w-full object-cover object-center">
                    </div>
                    <div aria-hidden="true" class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
                    <div class="relative mx-auto flex max-w-3xl flex-col items-center text-center">
                        <h2 id="cause-heading" class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            {{ __('Kualitas Terjamin Untuk Setiap Kebutuhan') }}
                        </h2>
                        <p class="mt-3 text-xl text-white">
                            {{ __('Kami berkomitmen untuk menyediakan baut, mur, dan aksesori lainnya dengan kualitas terbaik. Setiap produk yang kami jual telah melalui serangkaian pengujian ketat untuk memastikan daya tahan dan keandalannya.') }}
                        </p>
                        <a href="{{ route('katalog') }}" class="mt-8 block w-full rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto">
                            {{ __('Pelajari lebih lanjut') }}
                        </a>
                    </div>
                </div>
            </section>

            <!-- Favorites section -->
            <section aria-labelledby="trending-heading">
                <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8 lg:pt-32">
                    <div class="md:flex md:items-center md:justify-between">
                        <h2 id="favorites-heading" class="text-2xl font-bold tracking-tight text-gray-900">
                            {{ __('Produk Populer') }} 
                        </h2>
                        <a href="{{ route('katalog') }}" class="hidden text-sm font-medium text-baut-color-red-200 hover:text-baut-color-red-300 md:block">
                            {{ __('Lihat koleksinya') }}
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-x-4 gap-y-10 sm:gap-x-6 md:grid-cols-4 md:gap-y-0 lg:gap-x-8">
                        @foreach ($prodoctsTopSell as $prodoctTopSell)
                            <div class="group relative">
                                <div class="h-56 w-full overflow-hidden rounded-md group-hover:opacity-75 lg:h-72 xl:h-80">
                                    <img src="{{ $prodoctTopSell->image ?: asset('images/product_default.png') }}"
                                        alt="{{ $prodoctTopSell->slug }}"
                                        class="h-full w-full object-cover object-center">
                                </div>
                                <h3 class="mt-4 text-sm text-gray-700">
                                    <a href="{{ route('product.view', $prodoctTopSell->slug) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $prodoctTopSell->title }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Natural</p>
                                <p class="mt-1 text-sm font-medium text-gray-900">$75</p>
                            </div>
                        @endforeach
                        <!-- More products... -->
                    </div>

                    <div class="mt-8 text-sm md:hidden">
                        <a href="#" class="font-medium text-baut-color-red-200 hover:text-baut-color-red-300">
                            {{ __('Lihat koleksinya') }}
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- CTA section -->
            <section aria-labelledby="sale-heading">
                <div class="overflow-hidden pt-32 sm:pt-14">
                    <div class="bg-baut-color-red-400">
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <div class="relative pb-16 pt-48 sm:pb-24">
                                <div>
                                    <h2 id="sale-heading" class="text-4xl font-bold tracking-tight text-white md:text-5xl">
                                        {{ __('Stok Terbatas!') }}
                                        <br>
                                        {{ __('Diskon hingga 50%.') }}
                                    </h2>
                                    <div class="mt-6 text-base">
                                        <a href="#" class="font-semibold text-white">
                                            {{ __('Belanja sekarang') }}
                                            <span aria-hidden="true"> &rarr;</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="absolute -top-32 left-1/2 -translate-x-1/2 transform sm:top-6 sm:translate-x-0">
                                    @php
                                        $footerImage1 = file_exists(public_path('images/footerImage1.png')) ? asset('images/footerImage1.png') : asset('images/product_default.png');
                                        $footerImage2 = file_exists(public_path('images/footerImage2.png')) ? asset('images/footerImage2.png') : asset('images/product_default.png');
                                        $footerImage3 = file_exists(public_path('images/footerImage3.png')) ? asset('images/footerImage3.png') : asset('images/product_default.png');
                                        $footerImage4 = file_exists(public_path('images/footerImage4.png')) ? asset('images/footerImage4.png') : asset('images/product_default.png');
                                        $footerImage5 = file_exists(public_path('images/footerImage5.png')) ? asset('images/footerImage5.png') : asset('images/product_default.png');
                                        $footerImage6 = file_exists(public_path('images/footerImage6.png')) ? asset('images/footerImage6.png') : asset('images/product_default.png');
                                    @endphp
                                    <div x-data="{
                                            footerImage:[
                                                { src: '{{ $footerImage1 }}', alt: 'Gambar Footer Produk 1' },
                                                { src: '{{ $footerImage2 }}', alt: 'Gambar Footer Produk 2' },
                                                { src: '{{ $footerImage3 }}', alt: 'Gambar Footer Produk 3' },
                                                { src: '{{ $footerImage4 }}', alt: 'Gambar Footer Produk 4' },
                                                { src: '{{ $footerImage5 }}', alt: 'Gambar Footer Produk 5' },
                                                { src: '{{ $footerImage6 }}', alt: 'Gambar Footer Produk 6' },
                                            ]
                                        }" class="ml-24 flex min-w-max space-x-6 sm:ml-3 lg:space-x-8">
                                        <div class="flex space-x-6 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8">
                                            <div class="flex-shrink-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                                    src="/src/img/DALL·E 2023-10-26 01.56.42 - Photo of an assortment of fasteners like nuts, bolts, and screws placed inside separate compartments of a clear organizer box. The layout showcases th.png"
                                                    alt="">
                                            </div>
                                            <div class="mt-6 flex-shrink-0 sm:mt-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                                    src="/src/img/DALL·E 2023-10-26 01.56.42 - Photo of an assortment of fasteners like nuts, bolts, and screws placed inside separate compartments of a clear organizer box. The layout showcases th.png"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div
                                            class="flex space-x-6 sm:-mt-20 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8">
                                            <div class="flex-shrink-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                                    src="/src/img/DALL·E 2023-10-26 01.56.38 - Photo of a workshop table with various types of fasteners spread out. There are nuts, bolts, screws, and related tools, and the focus is on the divers.png"
                                                    alt="">
                                            </div>
                                            <div class="mt-6 flex-shrink-0 sm:mt-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                                    src="/src/img/DALL·E 2023-10-26 01.56.42 - Photo of an assortment of fasteners like nuts, bolts, and screws placed inside separate compartments of a clear organizer box. The layout showcases th.png"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div
                                            class="flex space-x-6 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8">
                                            <div class="flex-shrink-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                                    src="/src/img/DALL·E 2023-10-26 01.56.42 - Photo of an assortment of fasteners like nuts, bolts, and screws placed inside separate compartments of a clear organizer box. The layout showcases th.png"
                                                    alt="">
                                            </div>
                                            <div class="mt-6 flex-shrink-0 sm:mt-0">
                                                <img class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                                    src="/src/img/DALL·E 2023-10-26 01.56.42 - Photo of an assortment of fasteners like nuts, bolts, and screws placed inside separate compartments of a clear organizer box. The layout showcases th.png"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</x-app-layout>
