<template>
    <!-- <pre>{{ categories }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Kategori</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" @click="showAddNewModal" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </div>
        <CategoriesTable @clickEdit="editCategory" />
        <CategoryModal v-model="showCategoryModal" :category="categoryModel" @close="onModalClose" />
        
    </div>
</template>
  
<script setup>
    import { computed, ref } from 'vue';
    import store from '../../store';
    import CategoryModal from './CategoryModal.vue';
    import CategoriesTable from './CategoriesTable.vue';

    const DEFAULT_EMPTY_OBJECT = {
        id: '',
        code: '',
        name: '',
        description: '',
    }

    const categories = computed(() => store.state.categories)
    const categoryModel = ref({...DEFAULT_EMPTY_OBJECT})
    const showCategoryModal = ref(false)

    function showAddNewModal() {
        showCategoryModal.value = true
    }

    function editCategory(p) {
        store.dispatch('getCategory', p.id)
            .then(({data}) => {
                categoryModel.value = data
                showAddNewModal();
            })
    }

    function onModalClose() {
        categoryModel.value = {...DEFAULT_EMPTY_OBJECT}
    }

</script>

<style scoped>

</style>