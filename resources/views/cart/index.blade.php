<x-app-layout>
    <div>
        <main class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Shopping Cart</h1>

            <div x-data="{
                    cartItems: {{
                        json_encode(
                            $products->map(fn($product) => [
                                'id' => $product->id,
                                'slug' => $product->slug,
                                'image' => $product->image,
                                'title' => $product->title,
                                'quantity_limit' => $product->quantity_limit,
                                'price_retail' => $product->price_retail,
                                'price_wholesale' => $product->price_wholesale,
                                'quantity' => $cartItems[$product->id]['quantity'],
                                'price' => $cartItems[$product->id]['quantity'] > $product->quantity_limit ? $product->price_wholesale : $product->price_retail,
                                'href' => route('product.view', $product->slug),
                                'removeUrl' => route('cart.remove', $product),
                                'updateQuantityUrl' => route('cart.update-quantity', $product),
                            ])
                        )
                    }},
                    updatePrice(productId, newQuantity) {
                        const itemIndex = this.cartItems.findIndex(item => item.id === productId);
                        if (itemIndex !== -1) {
                            const item = this.cartItems[itemIndex];
                            this.cartItems[itemIndex].price = newQuantity > item.quantity_limit ? item.price_wholesale : item.price_retail;
                        }
                    },
                    get cartTotal() {
                        return this.cartItems.reduce((accum, next) => accum + next.price * next.quantity, 0).toFixed(2)
                    },
                    jumlahOngkir: 5.00,
                    jumlahpajak: 8.32,
                    get totalPesanan() {
                        return (parseFloat(this.cartTotal) + this.jumlahOngkir + this.jumlahpajak).toFixed(2)
                    }
                   
                }"
                @update-price.window="updatePrice($event.detail.id, $event.detail.quantity)" >
                <template x-if="cartItems.length">
                    <form action="{{ route('cart.checkout') }}" method="post" class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
                        @csrf
                        <section aria-labelledby="cart-heading" class="lg:col-span-7">
                            <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>
                            <ul role="list" class="divide-y divide-gray-200 border-b border-t border-gray-200">
                                <template x-for="product of cartItems" :key="product.id">
                                    <li x-data="productItem(product)" class="flex py-6 sm:py-10">
                                        <div class="flex-shrink-0">
                                            <img :src="product.image" :alt="product.slug"
                                                class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48">
                                        </div>
                                        {{-- <span x-text="product.max_retail"></span> --}}
                                        <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                            <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                                <div>
                                                    <div class="flex justify-between">
                                                        <h3 class="text-sm">
                                                            <a x-text="product.title" 
                                                                :href="product.href"
                                                                class="font-medium text-gray-700 hover:text-gray-800"></a>
                                                        </h3>
                                                    </div>
                                                    <div class="mt-1 flex text-sm">
                                                        <p class="text-gray-500">Ukuran</p>
                                                        <p class="ml-4 border-l border-gray-200 pl-4 text-gray-500">Bahan
                                                        </p>
                                                    </div>
                                                    <p x-text="`Rp. ${product.price}`"
                                                        class="mt-1 text-sm font-medium text-gray-900"></p>
                                                </div>

                                                <div class="mt-4 sm:mt-0 sm:pr-9">
                                                    <label for="quantity-0" class="sr-only">Quantity, Basic Tee</label>
                                                    <input type="number" name="quantity-0" id="quantity-0" class="w-24 text-baut-color-red-200 focus:border-baut-color-red-200 focus:outline-none focus:ring-baut-color-red-200 rounded"
                                                        x-model="product.quantity"
                                                        @change="changeQuantity()"
                                                        min="1">
                                                    <div class="absolute right-0 top-0">
                                                        <button @click.prevent="removeItemFromCart()" type="button"
                                                            class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500">
                                                            <span class="sr-only">Remove</span>
                                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                                aria-hidden="true">
                                                                <path
                                                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                                                <svg class="h-5 w-5 flex-shrink-0 text-green-500" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>In stock</span>
                                            </p>
                                        </div>
                                    </li>
                                </template>
                            </ul>
                        </section>
                        <!-- Order summary -->
                        <section aria-labelledby="summary-heading" class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                            <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Ringkasan pemesanan</h2>
                            <dl class="mt-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm text-gray-600">Subtotal</dt>
                                    <dd class="text-sm font-medium text-gray-900" x-text="`Rp. ${cartTotal}`"></dd>
                                </div>
                                <div x-data="{showOngkirInfo: false}"
                                    class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="flex items-center text-sm text-gray-600">
                                        <span>Estimasi ongkir</span>
                                        <a href="#" @click.prevent="showOngkirInfo = !showOngkirInfo"
                                            class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Pelajari lebih lanjut tentang bagaimana ongkir
                                                dihitung</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </dt>
                                    <dd class="text-sm font-medium text-gray-900" x-text="`Rp. ${jumlahOngkir}`"></dd>
                                    <!-- Informasi Ongkir  -->
                                    <div x-show="showOngkirInfo" @click.away="showOngkirInfo = false"
                                        class="absolute bg-white border p-4 mt-2 rounded-md shadow-lg text-sm text-gray-600">
                                        Ongkir dihitung berdasarkan lokasi pengiriman dan berat total pesanan Anda.
                                        Mengingat produk kami meliputi mur, baut, dan sejenisnya yang memiliki berat yang
                                        bervariasi, pastikan Anda memeriksa detail ongkir sebelum melakukan pembayaran.
                                    </div>
                                </div>
                                <div x-data="{showPajakInfo: false}"
                                    class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="flex text-sm text-gray-600">
                                        <span>Estimasi pajak</span>
                                        <a href="#" @click.prevent="showPajakInfo = !showPajakInfo"
                                            class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Learn more about how tax is calculated</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </dt>
                                    <dd class="text-sm font-medium text-gray-900" x-text="`Rp. ${jumlahpajak}`"></dd>
                                    <div x-show=" showPajakInfo" @click.away="showPajakInfo = false"
                                        class="absolute bg-white border p-4 mt-2 rounded-md shadow-lg text-sm text-gray-600">
                                        Pajak dikenakan sesuai dengan regulasi setempat. Besaran pajak bisa berbeda
                                        tergantung lokasi pengiriman dan jenis
                                        produk yang Anda beli. Sebagai website e-commerce yang menjual mur, baut, dan
                                        sejenisnya, kami selalu memastikan
                                        pemungutan pajak sesuai dengan ketentuan yang berlaku.
                                    </div>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-base font-medium text-gray-900">Total pesanan</dt>
                                    <dd class="text-base font-medium text-gray-900" x-text="`Rp. ${totalPesanan}`"></dd>
                                </div>
                            </dl>

                            <div class="mt-6">
                                <button type="submit"
                                    class="w-full rounded-md border border-transparent bg-baut-color-red-100 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-baut-color-red-200 focus:outline-none focus:ring-2 focus:ring-baut-color-red-200 focus:ring-offset-2 focus:ring-offset-gray-50">Checkout</button>
                            </div>
                        </section>
                    </form>
                </template>
                <template x-if="!cartItems.length">
                    <div class="text-center py-8 text-gray-500">
                        Tidak terdapat produk di keranjang.
                    </div>
                </template>
            </div>

            <!-- Related products -->
            <section aria-labelledby="related-heading" class="mt-24">
                <h2 id="related-heading" class="text-lg font-medium text-gray-900">You may also like&hellip;</h2>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <div class="group relative">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img src="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-01-related-product-01.jpg"
                                alt="Front of Billfold Wallet in natural leather."
                                class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        Billfold Wallet
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Natural</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">$118</p>
                        </div>
                    </div>

                    <!-- More products... -->
                </div>
            </section>
        </main>
    </div>
</x-app-layout>