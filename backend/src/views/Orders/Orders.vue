<template>
    <!-- <pre>{{ orders }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Orders</h1>
            </div>
        </div>
        <OrdersTable  />
    </div>
</template>
  
<script setup>
import { computed, onMounted, ref } from 'vue';
import store from '../../store';
import OrdersTable from './OrdersTable.vue';

const orders = computed( () => store.state.orders)


</script>

<style scoped></style>