<template>
    <!-- <pre>{{ products }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Produk</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" @click="showAddNewModal"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </div>
        <ProductModal v-model="showProductModal" :product="productModel" @close="onModalClose" />
        <ProductsTable @clickEdit="editProduct" />
    </div>
</template>
  
<script setup>
import {computed, ref } from 'vue';
import store from '../../store';
import ProductModal from './ProductModal.vue';
import ProductsTable from './ProductsTable.vue';

const DEFAULT_PRODUCT = {}

const products = computed(() => store.state.products);

const productModel = ref({ ...DEFAULT_PRODUCT })
const showProductModal = ref(false)

function showAddNewModal() {
    showProductModal.value = true
}

function editProduct(p) {
    store.dispatch('getProduct', p.id)
        .then(({ data }) => {
            productModel.value = data
            showAddNewModal()
        })
}

function onModalClose() {
    productModel.value = { ...DEFAULT_PRODUCT }
}

</script>

<style scoped></style>