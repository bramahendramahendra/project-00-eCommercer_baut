<template>
    <!-- <pre>{{ products.data }}</pre> -->
    <div class="mt-8 flow-root animate-fade-in-down">
        <div class="flex justify-between border-b-2 pb-3">
            <div class="flex items-center">
                <span class="whitespace-nowrap mr-3">Per Page</span>
                <select @change="getProducts(null)" v-model="perPage"
                    class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div>
                <input v-model="search" @change="getProducts(null)"
                    class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Cari Kategori">
            </div>
        </div>
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <TableHeaderCell @click="sortProduct('id')" scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3" field="id"
                                :sort-field="sortField" :sort-direction="sortDirection">ID</TableHeaderCell>
                            <TableHeaderCell @click="sortProduct('image_url')" scope="col" class="px-3 py-3.5 text-left"
                                field="image_url">Image</TableHeaderCell>
                            <TableHeaderCell @click="sortProduct('category_name')" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" field="category_name"
                                :sort-field="sortField" :sort-direction="sortDirection">Kategori</TableHeaderCell>
                            <TableHeaderCell @click="sortProduct('type_name')" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" field="type_name"
                                :sort-field="sortField" :sort-direction="sortDirection">Jenis</TableHeaderCell>
                            <TableHeaderCell @click="sortProduct('code')" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" field="code"
                                :sort-field="sortField" :sort-direction="sortDirection">Kode</TableHeaderCell>
                            <TableHeaderCell @click="sortProduct('title')" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" fieldimage="title"
                                :sort-field="sortField" :sort-direction="sortDirection">Judul</TableHeaderCell>
                            <TableHeaderCell @click="sortProduct('updated_at')" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" field="updated_at"
                                :sort-field="sortField" :sort-direction="sortDirection">Last Updated At</TableHeaderCell>
                            <TableHeaderCell field="actions">Actions</TableHeaderCell>
                        </tr>
                    </thead>
                    <tbody v-if="products.loading || !products.data.length">
                        <tr>
                            <td colspan="8">
                                <Spinner class="my-4" v-if="products.loading" />
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else class="bg-white">
                        <tr v-for="(product, index) of products.data" class="even:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                {{ product.id }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <img class="w-16" :src="product.image_url" :alt="product.title">
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.type.category.name }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.type.name }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.code }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.title }}</td>
                            <!-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.price_retail }}</td> -->
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.updated_at }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <Menu as="div" class="relative inline-block text-left ">
                                    <div>
                                        <MenuButton
                                            class="inline-flex items-center justify-center w-full rounded-full h-10 bg-black bg-opacity-0 text-sm font-medium text-white hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                                            <EllipsisVerticalIcon class="h-5 w-5 text-indigo-500" aria-hidden="true" />
                                        </MenuButton>
                                    </div>
                                    <transition enter-active-class="transition duration-100 ease-out"
                                        enter-from-class="transform scale-95 opacity-0"
                                        enter-to-class="transform scale-100 opacity-100"
                                        leave-active-class="transition duration-75 ease-in"
                                        leave-from-class="transform scale-100 opacity-100"
                                        leave-to-class="transform scale-95 opacity-0">
                                        <MenuItems class="absolute right-0 z-20 mt-0 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <div class="px-1 py-1">
                                                <MenuItem v-slot="{ active }">
                                                    <router-link :to="{ name: 'app.product.view', params: { id: product.id } }" 
                                                        :class="[
                                                            active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                                            'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                                        ]" >
                                                            <EyeIcon :active="active" class="mr-2 h-5 w-5 text-violet-400"
                                                                aria-hidden="true" />
                                                            Detail
                                                    </router-link>
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }">
                                                    <button :class="[
                                                            active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                                            'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                                        ]" 
                                                        @click="editProduct(product)">
                                                        <PencilIcon :active="active" class="mr-2 h-5 w-5 text-violet-400"
                                                            aria-hidden="true" />
                                                        Edit
                                                    </button>
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }">
                                                    <button :class="[
                                                            active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                                            'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                                        ]" @click="deleteProduct(product)">
                                                        <TrashIcon :active="active" class="mr-2 h-5 w-5 text-violet-400"
                                                            aria-hidden="true" />
                                                        Delete
                                                    </button>
                                                </MenuItem>
                                            </div>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="!products.loading" class="flex justify-between items-center mt-5">
                    <span>
                        Showing from {{ products.from }} to {{ products.to }}
                    </span>
                    <nav v-if="products.total > products.limit" class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a v-for="(link, i) of products.links" :key="i" :disabled="!link.url" href="" @click.prevent="getForPage($event, link)" aria-current="page" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap" :class="[link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50', i === 0 ? 'rounded-l-md' : '', i === products.links.length - 1 ? 'rounded-r-md' : '', !link.url ? 'bg-gray-100 text-gray-700' : '']" v-html="link.label"></a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { computed, onMounted, ref } from 'vue';
import store from '../../store';
import Spinner from '../../components/core/Spinner.vue';
import { PRODUCTS_PER_PAGE } from "../../constants"
import TableHeaderCell from '../../components/core/Table/TableHeaderCell.vue';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { EllipsisVerticalIcon, EyeIcon, PencilIcon, TrashIcon } from '@heroicons/vue/20/solid'

const emit = defineEmits(['clickEdit'])

const perPage = ref(PRODUCTS_PER_PAGE)
const search = ref('')
const products = computed(() => store.state.products)
const sortField = ref('updated_at')
const sortDirection = ref('desc')

onMounted(() => {
    getProducts();
})

function getForPage(ev, link) {
    if (!link.url || link.active) {
        // ev.preventDefault();
        return
    }
    getProducts(link.url)
}

function getProducts(url = null) {
    store.dispatch('getProducts', {
        url,
        search: search.value,
        per_page: perPage.value,
        sort_field: sortField.value,
        sort_direction: sortDirection.value,
    })
}

function sortProduct(field) {
    if (sortField.value === field) {
        if (sortDirection.value === 'asc') {
            sortDirection.value = 'desc'
        } else {
            sortDirection.value = 'asc'
        }
    } else {
        sortField.value = field;
        sortDirection.value = 'asc'
    }

    getProducts();
}

function editProduct(p) {
    emit('clickEdit', p)
}

function deleteProduct(product) {
    if (!confirm('Apakah anda yakin ingin menghapus produk berikut ?')) {
        return
    }
    store.dispatch('deleteProduct', product.id)
        .then(res => {
            // TODO Show notification 
            store.commit('showToast', 'Produk berhasil dihapus.');
            store.dispatch('getProducts')
        })
}
</script>

<style scoped></style>