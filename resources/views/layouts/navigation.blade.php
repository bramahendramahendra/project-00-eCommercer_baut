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
            <div @click.away="mobileMenuOpen = false"
                class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
                <div class="flex px-4 pb-2 pt-5">
                    <button @click="mobileMenuOpen = false" type="button"
                        class="relative -m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Links -->
                <div class="mt-2" x-data="{ selectedTab: 'kategori' }">
                    <div class="border-b border-gray-200">
                        <div class="-mb-px flex space-x-8 px-4" aria-orientation="horizontal" role="tablist">
                            <button @click="selectedTab = 'kategori'" id="tabs-1-tab-1"
                                :class="selectedTab === 'kategori' ? 'border-baut-color-red-200 text-baut-color-red-200' : 'border-transparent text-gray-900'"
                                class="flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium"
                                aria-controls="tabs-1-panel-1" role="tab" type="button">
                                Kategori
                            </button>
                        </div>
                    </div>

                    <!-- 'kategori' tab panel, show/hide based on tab state. -->
                    <div x-show="selectedTab === 'kategori'" id="tabs-1-panel-1"
                        class="space-y-10 px-4 pb-8 pt-10" aria-labelledby="tabs-1-tab-1" role="tabpanel"
                        tabindex="0">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="group relative text-sm">
                                <div
                                    class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                    <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg"
                                        alt="Models sitting back to back, wearing Basic Tee in black and bone."
                                        class="object-cover object-center">
                                </div>
                                <a href="#" class="mt-6 block font-medium text-gray-900">
                                    <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                    New Arrivals
                                </a>
                                <p aria-hidden="true" class="mt-1">Shop now</p>
                            </div>
                            <div class="group relative text-sm">
                                <div
                                    class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                    <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg"
                                        alt="Close up of Basic Tee fall bundle with off-white, ochre, olive, and black tees."
                                        class="object-cover object-center">
                                </div>
                                <a href="#" class="mt-6 block font-medium text-gray-900">
                                    <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                    Basic Tees
                                </a>
                                <p aria-hidden="true" class="mt-1">Shop now</p>
                            </div>
                        </div>
                        <div>
                            <p id="kategori-clothing-heading-mobile" class="font-medium text-gray-900">
                                Clothing
                            </p>
                            <ul role="list" aria-labelledby="kategori-clothing-heading-mobile"
                                class="mt-6 flex flex-col space-y-6">
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Tops</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Dresses</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Pants</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Denim</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Sweaters</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">T-Shirts</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Jackets</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Activewear</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Browse All</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p id="kategori-accessories-heading-mobile" class="font-medium text-gray-900">
                                Accessories</p>
                            <ul role="list" aria-labelledby="kategori-accessories-heading-mobile"
                                class="mt-6 flex flex-col space-y-6">
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Watches</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Wallets</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Bags</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Sunglasses</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Hats</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Belts</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p id="kategori-brands-heading-mobile" class="font-medium text-gray-900">Brands
                            </p>
                            <ul role="list" aria-labelledby="kategori-brands-heading-mobile"
                                class="mt-6 flex flex-col space-y-6">
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Full Nelson</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">My Way</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Re-Arranged</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Counterfeit</a>
                                </li>
                                <li class="flow-root">
                                    <a href="#" class="-m-2 block p-2 text-gray-500">Significant Other</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                    <div class="flow-root">
                        <a href="{{ route('katalog') }}" class="-m-2 block p-2 font-medium text-gray-900">{{ __('Katalog') }}</a>
                    </div>
                    <div class="flow-root">
                        <a href="#" class="-m-2 block p-2 font-medium text-gray-900">{{ __('Tentang Kami') }}</a>
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

                            <a href="{{ route('katalog') }}"
                                class="flex items-center text-sm font-medium text-gray-700 hover:text-baut-color-red-200">{{ __('Katalog') }}</a>
                            <a href="/src/about.html" class="flex items-center text-sm font-medium text-gray-700 hover:text-baut-color-red-200">
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
                                <span 
                                    x-show="cartItemsCount" 
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
    </header>
</div>
{{-- <script>
    console.log(this.categoryMenus); // Periksa output di konsol browser
</script> --}}