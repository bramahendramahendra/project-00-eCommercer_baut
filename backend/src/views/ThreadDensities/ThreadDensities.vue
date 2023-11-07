<template>
    <!-- <pre>{{ threadDensities }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Thread Density</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" @click="showThreadDensityModal"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </div>
        <ThreadDensityModal v-model="showModal" :threadDensity="threadDensityModel" @close="onModalClose" />
        <ThreadDensitiesTable @clickEdit="editThreadDensity" />

    </div>
</template>
  
<script setup>
import { ref } from 'vue';
import ThreadDensitiesTable from './ThreadDensitiesTable.vue';
import ThreadDensityModal from './ThreadDensityModal.vue';
import store from '../../store';

const DEFAULT_EMPTY_OBJECT = {
    id: '',
    name: '',
}

const showModal = ref(false)
const threadDensityModel = ref({ ...DEFAULT_EMPTY_OBJECT })

function showThreadDensityModal() {
    showModal.value = true
}

function editThreadDensity(threadDensity) {
    store.dispatch('getThreadDensity', threadDensity.id)
        .then(({ data }) => {
            threadDensityModel.value = data
            showThreadDensityModal()
        })
}

function onModalClose() {
    threadDensityModel.value = { ...DEFAULT_EMPTY_OBJECT }
}

</script>

<style scoped></style>