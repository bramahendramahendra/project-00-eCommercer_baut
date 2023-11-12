<template>
    <!-- <pre>{{ types }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Jenis</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" @click="showTypeModal"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </div>
        <TypeModal v-model="showModal" :type="typeModel" @close="onModalClose" />
        <TypesTable @clickEdit="editType" />

    </div>
</template>
  
<script setup>
import { ref } from 'vue';
import TypesTable from './TypesTable.vue';
import TypeModal from './TypeModal.vue';
import store from '../../store';

const DEFAULT_EMPTY_OBJECT = {
    id: '',
    category_id: '',
    selectedCategory: '',
    code: '',
    name: '',
    description: '',
}

const showModal = ref(false)
const typeModel = ref({ ...DEFAULT_EMPTY_OBJECT })

function showTypeModal() {
    showModal.value = true
}

function editType(type) {
    store.dispatch('getType', type.id)
        .then(({ data }) => {
            typeModel.value = data
            showTypeModal()
        })
}

function onModalClose() {
    typeModel.value = { ...DEFAULT_EMPTY_OBJECT }
}

</script>

<style scoped></style>