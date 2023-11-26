<template>
    <!-- <pre>{{ users }}</pre> -->
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
        <UsersTable @clickEdit="editUser" />
        <UserModal v-model="showUserModal" :user="userModel" @close="onModalClose" />
        
    </div>
</template>
  
<script setup>
    import { computed, ref } from 'vue';
    import store from '../../store';
    import UserModal from './UserModal.vue';
    import UsersTable from './UsersTable.vue';

    const DEFAULT_EMPTY_OBJECT = {
        id: '',
        code: '',
        name: '',
        description: '',
    }

    const users = computed(() => store.state.users)
    const userModel = ref({...DEFAULT_EMPTY_OBJECT})
    const showUserModal = ref(false)

    function showAddNewModal() {
        showUserModal.value = true
    }

    function editUser(u) {
        userModel.value = u
        showAddNewModal();
    }

    function onModalClose() {
        userModel.value = {...DEFAULT_EMPTY_OBJECT}
    }

</script>

<style scoped>

</style>