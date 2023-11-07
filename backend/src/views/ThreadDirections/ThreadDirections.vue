<template>
    <!-- <pre>{{ threadDirections }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Thread Direction</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" @click="showThreadDirectionModal"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </div>
        <ThreadDirectionModal v-model="showModal" :threadDirection="threadDirectionModel" @close="onModalClose" />
        <ThreadDirectionsTable @clickEdit="editThreadDirection" />

    </div>
</template>
  
<script setup>
import { ref } from 'vue';
import ThreadDirectionsTable from './ThreadDirectionsTable.vue';
import ThreadDirectionModal from './ThreadDirectionModal.vue';
import store from '../../store';

const DEFAULT_EMPTY_OBJECT = {
    id: '',
    name: '',
}

const showModal = ref(false)
const threadDirectionModel = ref({ ...DEFAULT_EMPTY_OBJECT })

function showThreadDirectionModal() {
    showModal.value = true
}

function editThreadDirection(threadDirection) {
    store.dispatch('getThreadDirection', threadDirection.id)
        .then(({ data }) => {
            threadDirectionModel.value = data
            showThreadDirectionModal()
        })
}

function onModalClose() {
    threadDirectionModel.value = { ...DEFAULT_EMPTY_OBJECT }
}

</script>

<style scoped></style>