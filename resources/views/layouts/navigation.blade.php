<script>
        window.menu = @json($menu);
    </script>
<div x-data="{ mobileMenuOpen: false }">
    <!-- Mobile  -->
    <div x-cloak class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
        <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0 " x-transition:enter-end="opacity-100 "
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-25"></div>

        <!-- <div class="fixed inset-0 z-40 flex"> -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0 " x-transition:leave-end="-translate-x-full "
            class="fixed inset-0 z-40 flex">
            <div @click.away="mobileMenuOpen = false" class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
                <div class="flex px-4 pb-2 pt-5">
                    <button @click="mobileMenuOpen = false" type="button" class="relative -m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Links -->
                <div class="mt-2">
                    <div class="border-b border-gray-200">
                        <div class="-mb-px flex space-x-8 px-4" aria-orientation="horizontal" role="tablist">
                            <button class="flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium border-baut-color-red-200 text-baut-color-red-200" type="button">
                                {{ __('Kategori') }}
                            </button>
                        </div>
                    </div>

                    <div x-data="dropdown()" class="space-y-10 px-4 pb-8 pt-10" >
                        <p id="kategori-clothing-heading-mobile" class="font-medium text-gray-900">
                            {{ __('Semua Kategori') }}
                        </p>
                        <ul role="list" aria-labelledby="kategori-clothing-heading-mobile" class="mt-6 flex flex-col space-y-6">
                            <template x-for="(categoryItem, categoryIndex) in categoryMenus" :key="categoryIndex">
                                <li class="flow-root">
                                    <a href=:href="`/category/${categoryItem.slug}`" class="-m-2 block p-2 text-gray-500" x-text="categoryItem.name"></a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>

                <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                    <div class="flow-root">
                        <a href="{{ route('katalog') }}" class="-m-2 block p-2 font-medium text-gray-900">{{ __('Katalog') }}</a>
                    </div>
                    <div class="flow-root">
                        <a href="{{ route('about') }}" class="-m-2 block p-2 font-medium text-gray-900">{{ __('Tentang Kami') }}</a>
                    </div>
                </div>

                <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                    <div class="flow-root">
                        @if (!Auth::guest())
                            <a href="{{ route('profile.edit') }}" class="-m-2 block p-2 font-medium text-gray-900">{{ __('Profil') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="-m-2 block p-2 font-medium text-gray-900">{{ __('Masuk') }}</a>
                        @endif
                    </div>
                    <div class="flow-root">
                        @if (!Auth::guest())
                            <a href="{{ route('order.index') }}" class="-m-2 block p-2 font-medium text-gray-900">{{ __('Order History') }}</a>
                        @else
                            <a href="{{ route('register') }}" class="-m-2 block p-2 font-medium text-gray-900">{{ __('Daftar') }}</a>
                        @endif
                    </div>
                </div>

                <div class="border-t border-gray-200 px-4 py-6">
                    @if (!Auth::guest())
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="-m-2 flex items-center p-2">
                                <span class="block text-base font-medium text-gray-900">{{ __('Keluar') }}</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>

    <header class="relative bg-white">
        <nav aria-label="Top"
            class="relative z-20 bg-gradient-to-b from-white to-transparent bg-opacity-90 backdrop-blur-xl">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-b border-gray-200">
                <div class="flex h-16 items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="relative rounded-md bg-white p-2 text-gray-400 lg:hidden">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <div class="ml-4 flex lg:ml-0">
                        <a href="{{route('home')}}">
                            <span class="sr-only">Logo</span>
                            <x-application-logo class="h-8 w-auto" />
                        </a>
                    </div>

                    <!-- Flyout menus -->
                    <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                        <div class="flex h-full space-x-8" x-data="{ isOn: null }">
                            <div class="flex" x-data="{ isOn: false }" @click.away="isOn = false">
                                <div class="relative flex">
                                    <button type="button"
                                        @click="isOn = (isOn === 'kategori' ? null : 'kategori')"
                                        :class="{'border-baut-color-red-200 text-baut-color-red-200': isOn === 'kategori', 'border-transparent text-gray-700 hover:text-baut-color-red-200': isOn !== 'kategori' }"
                                        class="border-transparent text-gray-700 relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out"
                                        aria-expanded="false">
                                        {{ __('Semua Kategori') }}
                                    </button>
                                </div>

                                <div x-show="isOn" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    x-cloak
                                    class="absolute inset-x-0 top-full z-20 bg-white text-sm text-gray-500">
                                    <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true"></div>

                                    <div class="relative bg-white" x-data="dropdown()">
                                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                                            <div class="grid grid-cols-2 gap-x-8 gap-y-10 py-16">
                                                <div class="col-start-2 grid grid-cols-2 gap-x-8">
                                                    <div class="group relative text-base sm:text-sm"
                                                        x-show="showImage">
                                                        <div
                                                            class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                                            <img x-bind:src="selectedMenu && selectedMenu.image ? selectedMenu.image : ''"
                                                                alt="All Kategori"
                                                                class="object-cover object-center">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div @mouseleave="handleMouseLeaveCategory()"
                                                    class="row-start-1 grid grid-cols-3 gap-x-8 gap-y-10 text-sm">
                                                    <div>
                                                        <p id="Categories-heading" class="font-medium text-gray-900">
                                                            {{ __('Kategori') }}
                                                        </p>
                                                        <ul role="list" aria-labelledby="Categories-heading"
                                                            class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                            <template x-for="(categoryItem, categoryIndex) in categoryMenus" :key="categoryIndex">
                                                                <li class="flex">
                                                                    <a :href="`/category/${categoryItem.slug}`"
                                                                        @mouseenter="setActiveCategories(categoryItem)"
                                                                        class="hover:text-baut-color-red-200"
                                                                        :class="{'text-red-500 ': activeMenu === categoryItem.name}"
                                                                        x-text="categoryItem.name">
                                                                    </a>
                                                                </li>
                                                            </template>
                                                        </ul>
                                                    </div>
                                                    <div x-show="activeMenu" @mouseleave="handleMouseLeaveType()">
                                                        <p id="Types-heading" class="font-medium text-gray-900">
                                                            {{ __('Jenis') }}
                                                        </p>
                                                        <ul role="list" aria-labelledby="Types-heading"
                                                            class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                            <template x-for="(typeItem, typeIndex) in typeMenus" :key="typeIndex">
                                                                <li class="flex">
                                                                    <a :href="`/type/${typeItem.slug}`"
                                                                        class="hover:text-baut-color-red-200"
                                                                        :class="{'text-red-500 ':tempSelectedType === typeItem}"
                                                                        @mouseenter="setActiveTypes(typeItem,selectedMenu)"
                                                                        x-text="typeItem.name"></a>
                                                                </li>
                                                            </template>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('katalog') }}" class="flex items-center text-sm font-medium text-gray-700 hover:text-baut-color-red-200">
                                {{ __('Katalog') }}
                            </a>
                            <a href="{{ route('about') }}" class="flex items-center text-sm font-medium text-gray-700 hover:text-baut-color-red-200">
                                {{ __('Tentang Kami') }}
                            </a>
                        </div>
                    </div>
                    <div class="ml-auto flex items-center">
                        <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                            @if (!Auth::guest())
                                <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-gray-700 hover:text-baut-color-red-200">
                                    {{ __('Profil') }}
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-baut-color-red-200">
                                    {{ __('Masuk') }}
                                </a>
                            @endif
                            <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                            @if (!Auth::guest())
                                <a href="{{ route('order.index') }}" class="text-sm font-medium text-gray-700 hover:text-baut-color-red-200">
                                    {{ __('Order History') }}
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="text-sm font-medium text-gray-700 hover:text-baut-color-red-200">
                                    {{ __('Daftar') }}
                                </a>
                            @endif
                        </div>

                        <div class="hidden lg:ml-8 lg:flex">
                            @if (!Auth::guest())
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="flex items-center text-gray-700 hover:text-baut-color-red-200">
                                        <span class="ml-3 block text-sm font-medium">{{ __('Keluar') }}</span>
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Cart -->
                        <div 
                            x-data="{
                                cartItemsCount: {{ \App\Helpers\Cart::getCartItemsCount() }}
                            }"
                            @cart-change.window="cartItemsCount = $event.detail.count"
                            class="ml-4 flow-root lg:ml-6">
                            <a href="{{ route('cart.index') }}" class="group -m-2 flex items-center p-2">
                                <svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-baut-color-red-200"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <span x-show="cartItemsCount" 
                                    x-transition
                                    x-text="cartItemsCount"
                                    class="ml-2 text-sm font-medium text-gray-700 group-hover:text-baut-color-red-200"></span>
                                <span class="sr-only">items in cart, view bag</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @if(Route::currentRouteName() == 'home')
            <div class="pb-80 pt-16 sm:pb-40 sm:pt-24 lg:pb-48 lg:pt-40">
                <div class="absolute inset-x-0 -top-40 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#8B0000] to-[#FF0000] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>

                <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
                    <div class="sm:max-w-lg">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">{{ __('Koleksi Baut Terbaik') }}</h1>
                        <p class="mt-4 text-xl text-gray-500">{{ __('Tempat kekuatan bertemu kualitas. Jelajahi rangkaian kami sekarang.') }}</p>
                    </div>
                    <div>
                        <div class="mt-10">
                            <div aria-hidden="true" class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                                <div class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                                    @php
                                        $headerImage1 = file_exists(public_path('images/headerImage1.png')) ? asset('images/headerImage1.png') : asset('images/product_default.png');
                                        $headerImage2 = file_exists(public_path('images/headerImage2.png')) ? asset('images/headerImage2.png') : asset('images/product_default.png');
                                        $headerImage3 = file_exists(public_path('images/headerImage3.png')) ? asset('images/headerImage3.png') : asset('images/product_default.png');
                                        $headerImage4 = file_exists(public_path('images/headerImage4.png')) ? asset('images/headerImage4.png') : asset('images/product_default.png');
                                        $headerImage5 = file_exists(public_path('images/headerImage5.png')) ? asset('images/headerImage5.png') : asset('images/product_default.png');
                                        $headerImage6 = file_exists(public_path('images/headerImage6.png')) ? asset('images/headerImage6.png') : asset('images/product_default.png');
                                        $headerImage7 = file_exists(public_path('images/headerImage7.png')) ? asset('images/headerImage7.png') : asset('images/product_default.png');
                                    @endphp
                                    <div x-data="{
                                            headerImage:[
                                                { src: '{{ $headerImage1 }}', alt: 'Gambar Header Produk 1' },
                                                { src: '{{ $headerImage2 }}', alt: 'Gambar Header Produk 2' },
                                                { src: '{{ $headerImage3 }}', alt: 'Gambar Header Produk 3' },
                                                { src: '{{ $headerImage4 }}', alt: 'Gambar Header Produk 4' },
                                                { src: '{{ $headerImage5 }}', alt: 'Gambar Header Produk 5' },
                                                { src: '{{ $headerImage6 }}', alt: 'Gambar Header Produk 6' },
                                                { src: '{{ $headerImage7 }}', alt: 'Gambar Header Produk 7' },
                                            ]
                                        }" class="flex items-center space-x-6 lg:space-x-8">
                                        <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                            <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                                                <img :src="headerImage[0].src" :alt="headerImage[0].alt" class="h-full w-full object-cover object-center">
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img :src="headerImage[1].src" :alt="headerImage[1].alt" class="h-full w-full object-cover object-center">
                                            </div>
                                        </div>
                                        <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img :src="headerImage[2].src" :alt="headerImage[2].alt" class="h-full w-full object-cover object-center">
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img :src="headerImage[3].src" :alt="headerImage[3].alt" class="h-full w-full object-cover object-center">
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img :src="headerImage[4].src" :alt="headerImage[4].alt" class="h-full w-full object-cover object-center">
                                            </div>
                                        </div>
                                        <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img :src="headerImage[5].src" :alt="headerImage[5].alt" class="h-full w-full object-cover object-center">
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img :src="headerImage[6].src" :alt="headerImage[6].alt" class="h-full w-full object-cover object-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('katalog') }}" class="inline-block rounded-md border border-transparent bg-baut-color-red-100 px-8 py-3 text-center font-medium text-white hover:bg-baut-color-red-200 ">
                                {{ __('Belanja Koleksi') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </header>
</div>
{{-- <script>
    console.log(this.categoryMenus); // Periksa output di konsol browser
</script> --}}