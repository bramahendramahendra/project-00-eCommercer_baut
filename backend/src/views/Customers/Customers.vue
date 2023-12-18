<template>
    <!-- <pre>{{ customers }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Customers</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the customers in your account including their name, title, email and role.</p> -->
            </div>
        </div>
        <CustomersTable @clickEdit="editCustomer" />
        <CustomerModal v-model="showCustomerModal" :customer="customerModel" @close="onModalClose" />
        
    </div>
</template>
  
<script setup>
    import { computed, ref } from 'vue';
    import store from '../../store';
    import CustomerModal from './CustomerModal.vue';
    import CustomersTable from './CustomersTable.vue';

    const DEFAULT_EMPTY_OBJECT = {
    }

    const customers = computed(() => store.state.customers)
    const customerModel = ref({...DEFAULT_EMPTY_OBJECT})
    const showCustomerModal = ref(false)

    function showAddNewModal() {
        showCustomerModal.value = true
    }

    function editCustomer(c) {
        store.dispatch('getCustomer', c.id)
            .then(({ data }) => {
                customerModel.value = data;
                showAddNewModal();
            })
        // console.log(customerModel);

    }

    function onModalClose() {
        customerModel.value = {...DEFAULT_EMPTY_OBJECT}
    }

</script>

<style scoped>

</style>