<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Project Baut') }}</title>

    <!-- Scripts -->
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-white">
        @include('layouts.navigation')

        <div>
            {{ $slot }}
        </div>

        <div x-data="toast" x-show="visible" x-cloak x-transition @notify.window="show($event.detail.message)"
            class="fixed w-[400px] left-1/2 -ml-[200px] top-20 py-2 px-4 pb-4 bg-emerald-500 text-white">
            <div class="font-semibold" x-text="message"></div>
            <button @click="close"
                class="absolute flex items-center justify-center right-2 top-2 w-[30px] h-[30px] rounded-full hover:bg-black/10 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div>
                <div class="absolute left-0 bottom-0 right-0 h-[6px] bg-black/10" :style="{'width': `${percent}%`}">
                </div>
            </div>
        </div>
        <footer aria-labelledby="footer-heading" class="bg-white">
            <h2 id="footer-heading" class="sr-only">Footer</h2>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- <div class="py-20 xl:grid xl:grid-cols-3 xl:gap-8"> -->
                <div class="grid grid-cols-2 gap-8 border-t border-gray-200 py-20 xl:grid xl:grid-cols-3 xl:gap-8">
                    <div class="grid grid-cols-2 gap-8 xl:col-span-2">
                        <div class="space-y-16 md:grid md:grid-cols-2 md:gap-8 md:space-y-0">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">{{ __('Toko') }}</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    @foreach ($categories as $category)
                                        <li class="text-sm">
                                            <a href="{{ route('kategori.index', $category->slug) }}" class="text-gray-500 hover:text-baut-color-red-200">{{$category->name}}</a>
                                        </li>
                                    @endforeach
                                    {{-- <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Tees</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Objects</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Home Goods</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Accessories</a>
                                    </li> --}}
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">{{ __('Perusahaan') }}</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="{{ route('about') }}" class="text-gray-500 hover:text-baut-color-red-200">{{ __('Tentang Kami') }}</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="{{ route('katalog') }}" class="text-gray-500 hover:text-baut-color-red-200">{{ __('Katalog Produk') }}</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">{{ __('Hubungi Kami') }}</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Karir</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Ketentuan &amp;
                                            Syarat</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Privasi</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="space-y-16 md:grid md:grid-cols-2 md:gap-8 md:space-y-0">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Akun</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Kelola Akun</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Retur &amp;
                                            Penukaran</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Tukar Kartu
                                            Hadiah</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Hubungi Kami</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Kontak</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Twitter</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Instagram</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-baut-color-red-200">Pinterest</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mt-16 md:mt-16 xl:mt-0">
                        <h3 class="text-sm font-medium text-gray-900">Dapatkan berita terbaru dengan berlangganan</h3>
                        <p class="mt-6 text-sm text-gray-500">Dapatkan informasi terbaru mengenai produk dan penawaran
                            spesial langsung ke email Anda.</p>
                        <form class="mt-2 flex sm:max-w-md">
                            <label for="email-address" class="sr-only">Alamat email</label>
                            <input id="email-address" type="text" autocomplete="email" required
                                class="w-full min-w-0 appearance-none rounded-md border border-gray-300 bg-white px-4 py-2 text-base text-baut-color-red-200 placeholder-gray-500 shadow-sm focus:border-baut-color-red-200 focus:outline-none focus:ring-1 focus:ring-baut-color-red-200">
                            <div class="ml-4 flex-shrink-0">
                                <button type="submit"
                                    class="flex w-full items-center justify-center rounded-md border border-transparent bg-baut-color-red-100 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-baut-color-red-200 focus:outline-none focus:ring-2 focus:ring-baut-color-red-200 focus:ring-offset-2">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="border-t border-gray-200 py-10">
                    <p class="text-sm text-gray-500">Copyright &copy; 2023 Brama Mahendra, Inc.</p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>