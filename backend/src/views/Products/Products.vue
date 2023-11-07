<template>
    <!-- <pre>{{ products }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Produk</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" @click="showProductModal"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </div>
        <ProductModal v-model="showModal" :product="productModel" @close="onModalClose" />
        <ProductsTable @clickEdit="editProduct" />

    </div>
</template>
  
<script setup>
import { ref } from 'vue';
import ProductsTable from './ProductsTable.vue';
import ProductModal from './ProductModal.vue';
import store from '../../store';

const DEFAULT_EMPTY_OBJECT = {
    id: '',
    // type_id: '',
    code: '',
    title: '',
    image: '',
    description: '',
    price_retail: '',
}

const showModal = ref(false)
const productModel = ref({ ...DEFAULT_EMPTY_OBJECT })

function showProductModal() {
    showModal.value = true
}

function editProduct(product) {
    store.dispatch('getProduct', product.id)
        .then(({ data }) => {
            productModel.value = data
            showProductModal()
        })
}

function onModalClose() {
    productModel.value = { ...DEFAULT_EMPTY_OBJECT }
}

</script>

<style scoped></style>