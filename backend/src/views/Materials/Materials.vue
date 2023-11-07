<template>
    <!-- <pre>{{ materials }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Material</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" @click="showMaterialModal"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </div>
        <MaterialModal v-model="showModal" :material="materialModel" @close="onModalClose" />
        <MaterialsTable @clickEdit="editMaterial" />

    </div>
</template>
  
<script setup>
import { ref } from 'vue';
import MaterialsTable from './MaterialsTable.vue';
import MaterialModal from './MaterialModal.vue';
import store from '../../store';

const DEFAULT_EMPTY_OBJECT = {
    id: '',
    name: '',
}

const showModal = ref(false)
const materialModel = ref({ ...DEFAULT_EMPTY_OBJECT })

function showMaterialModal() {
    showModal.value = true
}

function editMaterial(material) {
    store.dispatch('getMaterial', material.id)
        .then(({ data }) => {
            materialModel.value = data
            showMaterialModal()
        })
}

function onModalClose() {
    materialModel.value = { ...DEFAULT_EMPTY_OBJECT }
}

</script>

<style scoped></style>