<template>
    <!-- <pre>{{ categories }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Kategori</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" @click="showCategoryModal" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </div>
        <CategoryModal v-model="showModal" :category="categoryModel" @close="onModalClose" />
        <CategoriesTable @clickEdit="editCategory" />
        
    </div>
</template>
  
<script setup>
    import { ref } from 'vue';
    import CategoriesTable from './CategoriesTable.vue';
    import CategoryModal from './CategoryModal.vue';
    import store from '../../store';

    const DEFAULT_EMPTY_OBJECT = {
        id: '',
        code: '',
        name: '',
        description: '',
    }

    const showModal = ref(false)
    const categoryModel = ref({...DEFAULT_EMPTY_OBJECT})

    function showCategoryModal() {
        showModal.value = true
    }

    function editCategory(category) {
        store.dispatch('getCategory', category.id)
            .then(({data}) => {
                categoryModel.value = data
                showCategoryModal()
            })
    }

    function onModalClose() {
        categoryModel.value = {...DEFAULT_EMPTY_OBJECT}
    }

</script>

<style scoped>

</style>