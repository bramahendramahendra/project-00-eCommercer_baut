<template>
    <!-- <pre>{{ product }}</pre> -->
    <div v-if="product.loading">
        <Spinner class="my-4" v-if="product.loading" />
    </div>
    <div v-else class="mb-5">
        <router-link :to="{ name: 'app.products' }" 
            class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <ArrowUturnLeftIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
            Kembali
        </router-link>
    </div>
        <div class="px-4 sm:px-0">
        <h3 class="text-base font-semibold leading-7 text-gray-900">Product Detail</h3>
        <!-- <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and application.</p> -->
    </div>
    <div v-if="product">
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">ID</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.id || '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">SKU</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.category_code }}-{{ product.type_code }}-{{ product.code }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Produk</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.title || '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Kategori - Jenis</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.category_name }} - {{ product.type_name }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Deskripsi</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.description || '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Gambar</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <!-- <div class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100"> -->
                        <div class="group aspect-h-2 aspect-w-16 block w-1/6 overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                            <img :src="product.image_url" alt="" class="pointer-events-none object-cover group-hover:opacity-75" />
                            <!-- <img :src="product.image_url" alt="" class="pointer-events-none object-cover object-scale-down group-hover:opacity-75" /> -->
                            <button type="button" class="absolute inset-0 focus:outline-none">
                            <!-- <span class="sr-only">View details for {{ file.title }}</span> -->
                            </button>
                        </div>
                        <!-- <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">{{ file.title }}</p> -->
                        <!-- <p class="pointer-events-none block text-sm font-medium text-gray-500">{{ file.size }}</p> -->
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Harga Eceran</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.price_retail?formatRupiah(product.price_retail) + (product.quantity_limit?` ( 1 - ${product.quantity_limit} )`:''):'-' }} </dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Harga Grosir</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.price_wholesale ? formatRupiah(product.price_wholesale) + (product.quantity_limit ? ` ( ${product.quantity_limit + 1}++)` : '') : '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Units</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.unit_full_name || '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Material</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.material_name || '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Berat</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.weight? product.weight + (product.weight_unit_short_name?` ${product.weight_unit_short_name}`:'') : '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Isi Per Kotak</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.contents_per_box ? product.contents_per_box + (product.contents_per_box_unit_short_name ? ` ${product.contents_per_box_unit_short_name}` : '') : '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Grade</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.grade || '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Thread Direction</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.thread_direction_name || '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Thread Density</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.thread_density_name || '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Diameter</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.diameter ? product.diameter + (product.diameter_unit_symbol ? ` ${product.diameter_unit_symbol}` : '') : '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Diameter Dalam</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.inner_diameter ? product.inner_diameter + (product.diameter_unit_symbol ? ` ${product.diameter_unit_symbol}` : '') : '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Diameter Luar</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.outer_diameter ? product.outer_diameter + (product.diameter_unit_symbol ? ` ${product.diameter_unit_symbol}` : '') : '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Panjang</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.length ? product.length + (product.length_unit_symbol ? ` ${product.length_unit_symbol}` : '') : '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Dimensional Standart</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.dimensional_standart || '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Head Style</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.head_style || '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Drive Type</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.drive_type || '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Tebal Kepala</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.thick_head ? product.thick_head + (product.thick_head_unit_symbol ? ` ${product.thick_head_unit_symbol}` : '') : '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Kunci Kepala</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.across_flats || '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Ukuran Drat</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.drat_size || '-' }}</dd>
                    </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Tipe drat</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.drat_type || '-' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Panjang drat (b)</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.drat_length ? product.drat_length + (product.drat_length_unit_symbol ? ` ${product.drat_length_unit_symbol}` : '') : '-' }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Warna</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ product.color_name || '-' }}</dd>
                </div>
            </dl>
        </div>
    </div>
    <!-- <div v-else> -->
        <!-- <div class="mb-5">
            <button type="button" class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <ArrowUturnLeftIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                Kembali
            </button>
        </div> -->
    <!-- </div> -->
</template>

<script setup>
    import { onMounted, ref } from "vue";
    import store from "../../store";
    import Spinner from '../../components/core/Spinner.vue';
    import { useRoute } from "vue-router";
    // import axiosClient from "../../axios.js";
    import { ArrowUturnLeftIcon } from '@heroicons/vue/20/solid'

    const route = useRoute()
    // const product = ref(null);
    const product = ref({ loading: true, data: null });

    // Fungsi untuk memformat angka ke dalam format Rupiah
    const formatRupiah = (value) => {
        const number = parseFloat(value); // Ubah parseInt menjadi parseFloat untuk menangani desimal
        let formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 2, // Setel minimum dan maksimum ke 2 untuk memaksa dua digit desimal
            maximumFractionDigits: 2,
        }).format(number);

        // Mengganti ,00 menjadi ,- jika Anda menginginkan format tersebut
        formatted = formatted.replace(/,00(?=\s*?$)/, ',-');

        return formatted;
    };

    onMounted(() => {
        getProduct();
    
    })

    function getProduct() {
        store.dispatch('getProduct', route.params.id)
            .then(({ data }) => {
                product.value = data
            })
    }

</script>
<style scoped></style>
