<template>
    <!-- <pre>{{ frequentlyAskedQuestions }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Frequently Asked Question</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" @click="showAddNewModal" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </div>
        <FrequentlyAskedQuestionsTable @clickEdit="editFrequentlyAskedQuestion" />
        <FrequentlyAskedQuestionModal v-model="showFrequentlyAskedQuestionModal" :frequentlyAskedQuestion="frequentlyAskedQuestionModel" @close="onModalClose" />
    </div>
</template>

<script setup>
    import { computed, ref } from 'vue'
    import store from '../../store';
    import FrequentlyAskedQuestionModal from './FrequentlyAskedQuestionsModal.vue';
    import FrequentlyAskedQuestionsTable from './FrequentlyAskedQuestionsTable.vue';

    const DEFAULT_EMPTY_OBJECT = {
        id: '',
        question: '',
        answer: '',
    }

    const frequentlyAskedQuestions = computed(() => store.state.frequentlyAskedQuestions)
    const frequentlyAskedQuestionModel = ref({ ...DEFAULT_EMPTY_OBJECT })
    const showFrequentlyAskedQuestionModal = ref(false)

    function showAddNewModal() {
        showFrequentlyAskedQuestionModal.value = true
    }

    function editFrequentlyAskedQuestion(p) {
        store.dispatch('getFrequentlyAskedQuestion', p.id)
            .then(({ data }) => {
                frequentlyAskedQuestionModel.value = data
                showAddNewModal();
            })
    }

    function onModalClose() {
        frequentlyAskedQuestionModel.value = { ...DEFAULT_EMPTY_OBJECT }
    }
</script>

<style scoped></style>