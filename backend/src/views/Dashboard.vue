<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Dashboard</h1>
            </div>
        </div>
        <div>
            <h3 class="text-base font-semibold leading-6 text-gray-900 text-right">All Time</h3>
            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <UsersIcon class="h-6 w-6 text-white" aria-hidden="true" />
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Active Customers</p>
                    
                    </dt>
                    <template v-if="!loading.customersCount">
                        <dd class="ml-16 flex items-baseline ">
                            <p class="text-2xl font-semibold text-gray-900">{{ customersCount }}</p>
                        </dd>
                    </template>
                    <Spinner v-else text="" class="ml-16 flex items-baseline" />
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <Square3Stack3DIcon class="h-6 w-6 text-white" aria-hidden="true" />
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Active Products</p>
                    </dt>
                    <template v-if="!loading.productsCount">
                        <dd class="ml-16 flex items-baseline ">
                            <p class="text-2xl font-semibold text-gray-900">{{ productsCount }}</p>
                        </dd>
                    </template>
                    <Spinner v-else text="" class="ml-16 flex items-baseline" />
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <ShoppingCartIcon class="h-6 w-6 text-white" aria-hidden="true" />
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Paid Orders</p>
                    </dt>
                    <template v-if="!loading.paidOrders">
                        <dd class="ml-16 flex items-baseline ">
                            <p class="text-2xl font-semibold text-gray-900">{{ paidOrders }}</p>
                        </dd>
                    </template>
                    <Spinner v-else text="" class="ml-16 flex items-baseline" />
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <BanknotesIcon class="h-6 w-6 text-white" aria-hidden="true" />
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Income</p>
                    </dt>
                    <template v-if="!loading.totalIncome">
                        <dd class="ml-16 flex items-baseline ">
                            <p class="text-2xl font-semibold text-gray-900">{{ totalIncome }}</p>
                        </dd>
                    </template>
                    <Spinner v-else text="" class="ml-16 flex items-baseline" />
                </div>
            </dl>
        </div>

        <div>
            <dl class="mt-5 grid grid-cols-1 grid-rows-1 gap-5 sm:grid-cols-1 sm:grid-rows-1 lg:grid-cols-3 lg:grid-rows-2">
                <div class="relative overflow-hidden rounded-lg col-span-2 row-span-2 bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                    <dt>
                        <p class="text-lg font-medium text-gray-500">Total Income</p>
                    </dt>
                    <DoughnutChart :width="140" :height="200" :data="chartData" />
                </div>
                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                     <dt>
                        <p class="text-lg font-medium text-gray-500">Latest Customers</p>
                    </dt>
                    <pre>{{latestCustomers}}</pre>
                    <ul role="list" class="divide-y divide-gray-100">
                        <li v-for="person in latestCustomers" :key="person.id" class="relative py-5 hover:bg-gray-50">
                            <div class="px-4 sm:px-6 lg:px-8">
                                <div class="mx-auto flex max-w-4xl justify-between gap-x-6">
                                <div class="flex min-w-0 gap-x-4">
                                    <UserCircleIcon fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12" />
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">  
                                            <span class="absolute inset-x-0 -top-px bottom-0" />
                                            {{ person.first_name }} {{ person.last_name }}
                                        </p>
                                        <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                            <a :href="`mailto:${person.email}`" class="relative truncate hover:underline">{{ person.email }}</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex shrink-0 items-center gap-x-4">
                                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                                        <p class="text-sm leading-6 text-gray-900">Customer</p>
                                    <!-- <p v-if="person.lastSeen" class="mt-1 text-xs leading-5 text-gray-500"> -->
                                        <!-- Last seen <time :datetime="person.lastSeenDateTime">{{ person.lastSeen }}</time> -->
                                    <!-- </p>
                                    <div v-else class="mt-1 flex items-center gap-x-1.5">
                                        <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                        <div class="h-1.5 w-1.5 rounded-full bg-emerald-500" />
                                        </div>
                                        <p class="text-xs leading-5 text-gray-500">Online</p>
                                    </div> -->
                                    </div>
                                    <ChevronRightIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                                </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- <div v-for="c of latestCustomers" :key="c.user_id">
                    </div> -->
                </div>
            </dl>
        </div>
    </div>
</template>

<script setup>
    import { UserCircleIcon, UsersIcon, Square3Stack3DIcon, ShoppingCartIcon, BanknotesIcon } from '@heroicons/vue/24/outline';
    import DoughnutChart from '../components/core/Charts/Doughnut.vue';
    import axiosClient from "../axios.js";
    import { ref } from 'vue';
    import Spinner from '../components/core/Spinner.vue';

    const chartData = {
        labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
        datasets: [{
                backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
                data: [25, 25, 10, 40]
        }]
    }

    // chartDatas.value = chartData

    const loading = ref({
        customersCount : true,
        productsCount : true,
        paidOrders : true,
        totalIncome : true,
        latestCustomers: true,
    })

    const customersCount = ref(0);
    const productsCount = ref(0);
    const paidOrders = ref(0);
    const totalIncome = ref(0);
    const latestCustomers = ref([]);  

    axiosClient.get(`/dashboard/customers-count`).then(({data}) => {
        customersCount.value = data;
        loading.value.customersCount = false;
    })
    axiosClient.get(`/dashboard/products-count`).then(({data}) => {
        productsCount.value = data;
        loading.value.productsCount = false;
    })
    axiosClient.get(`/dashboard/orders-count`).then(({data}) => {
        paidOrders.value = data;
        loading.value.paidOrders = false;
    })
    axiosClient.get(`/dashboard/income-amount`).then(({data}) => {
        totalIncome.value = new Intl.NumberFormat('ID', { style: 'currency', currency: 'IDR' }).format(
            data,
        );
        loading.value.totalIncome = false;
    })
    axiosClient.get(`/dashboard/latest-customers`).then(({data: customers}) => {
        latestCustomers.value = customers;
        loading.value.latestCustomers = false;
    })
</script>

<style scoped>

</style>