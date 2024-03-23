<template>
    <!-- <pre>{{ termAndCondition }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Term and Conditions</h1>
            </div>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <form @submit.prevent="onSubmit">
                <!-- <pre>{{ errors }}</pre> -->
                <div class="bg-white px-4 pt-5 pb-4">
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Deskripsi</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput type="textarea" class="mb-2" v-model="termAndCondition.content"
                                label="Deskripsi" :errors="errors.content" />
                        </dd>
                    </div>
                </div>
                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2  text-base font-medium  focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                        Save
                    </button>
                </footer>
            </form>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h2 class="text-base font-semibold leading-6 text-gray-900">List Term and Conditions</h2>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button type="button" @click="showAddNewModal"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
                </div>
            </div>


            <TermAndConditionsTable @clickEdit="editTermAndCondition" />
            <TermAndConditionModal v-model="showTermAndConditionModal" :termAndCondition="termAndConditionModel"
                @close="onModalClose" />
        </div>
    </div>
</template>


<script setup>
import { computed, ref, onMounted } from 'vue';
import store from '../../store';
import CustomInput from '../../components/core/CustomInput.vue';
import { PhotoIcon } from '@heroicons/vue/24/solid';
import TermAndConditionModal from './TermAndConditionModal.vue';
import TermAndConditionsTable from './TermAndConditionsTable.vue';

const errors = ref({
    content: [],
})
const termAndCondition = ref({})

const loading = ref(false)

const DEFAULT_EMPTY_OBJECT = {
    id: '',
    title: '',
    content: '',
}

const termAndConditions = computed(() => store.state.termAndConditions)
const termAndConditionModel = ref({ ...DEFAULT_EMPTY_OBJECT })
const showTermAndConditionModal = ref(false)

function showAddNewModal() {
    showTermAndConditionModal.value = true
}

function editTermAndCondition(p) {
    store.dispatch('getTermAndCondition', p.id)
        .then(({ data }) => {
            termAndConditionModel.value = data
            showAddNewModal();
        })
}

function onModalClose() {
    termAndConditionModel.value = { ...DEFAULT_EMPTY_OBJECT }
}

onMounted(() => {
    store.dispatch('getTermAndCondition', 1)
        .then(({ data }) => {
            // console.log(data);
            termAndCondition.value = data
            // console.log(termAndCondition);

        })
})

function onSubmit() {
    loading.value = true
    if (termAndCondition.value.id) {
        store.dispatch('updateTermAndCondition', termAndCondition.value)
            .then(response => {
                loading.value = false;
                if (response.status === 200) {
                    // TODO show notification 
                    store.commit('showToast', 'Terms and Conditions berhasil diupdate.');
                    store.dispatch('getTermAndConditions', 1)
                    router.push({ name: 'app.termAndConditions' })
                }
            })
            .catch(err => {
                loading.value = false;
                errors.value = err.response.data.errors;
            })
    }
}
</script>

<style scoped></style>