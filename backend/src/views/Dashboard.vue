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
                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6 animate-fade-in-down" style="animation-delay: 0.1s;">
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

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6 animate-fade-in-down" style="animation-delay: 0.15s;">
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

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6 animate-fade-in-down" style="animation-delay: 0.2s;">
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

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6 animate-fade-in-down" style="animation-delay: 0.25s;">
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
                <div class="relative overflow-hidden rounded-lg col-span-2 row-span-2 bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6 animate-fade-in-down" style="animation-delay: 0.3s;">
                    <dt>
                        <p class="text-lg font-medium text-gray-500">Latest Orders</p>
                    </dt>
                    <template v-if="!loading.latestOrders">
                        <!-- <pre>{{ latestOrders }}</pre> -->
                        <div v-for="o of latestOrders" class="py-2 px-3 hover:bg-gray-50">   
                            <p>
                                <roter-link :to="{name: 'app.orders.view', params: {id: o.id}}" class="text-indigo-700 font-semibold">
                                    Order #{{ o.id }}
                                </roter-link>
                                created {{ o.created_at }}. {{ o.items }} items
                            </p>
                            <p class="flex justify-between">
                                <span>{{ o.first_name }} {{ o.last_name }}</span>
                                <span>{{ $filters.currencyIDR(o.total_price) }}</span>
                            </p>
                        </div>
                        <!-- <DoughnutChart :width="140" :height="200" :data="chartData" /> -->
                    </template>
                    <Spinner v-else text="" class="" />
                </div>
                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6 animate-fade-in-down" style="animation-delay: 0.35s;">
                     <dt>
                        <p class="text-lg font-medium text-gray-500">Latest Customers</p>
                    </dt>
                    <!-- <pre>{{latestCustomers}}</pre> -->
                     <template v-if="!loading.latestCustomers">
                        <ul role="list" class="divide-y divide-gray-100">
                            <li v-for="person in latestCustomers" :key="person.id" class="relative py-5 hover:bg-gray-50">
                                <router-link :to="{name: 'app.customers.view', params: {id: person.id}}">
                                    <div class="px-4 sm:px-6 lg:px-8">
                                        <div class="mx-auto flex max-w-4xl justify-between gap-x-6">
                                            <div class="flex min-w-0 gap-x-4">
                                                <UserCircleIcon fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12" />
                                                <div class="min-w-0 flex-auto">
                                                    <p class="text-sm font-semibold leading-6 text-gray-900">  
                                                        <span class="absolute inset-x-0 -top-px bottom-0" />
                                                        {{ person.first_name }} {{ person.last_name }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex shrink-0 items-center gap-x-4">
                                                <div class="hidden sm:flex sm:flex-col sm:items-end">
                                                    <p class="text-sm leading-6 text-gray-900">Customer</p>
                                                </div>
                                                <ChevronRightIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                                            </div>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                        </ul>
                    </template>
                    <Spinner v-else text="" class="" />
                </div>
            </dl>
        </div>
    </div>
</template>

<script setup>
    import { UserCircleIcon, UsersIcon, Square3Stack3DIcon, ShoppingCartIcon, BanknotesIcon, ChevronRightIcon } from '@heroicons/vue/24/outline';
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
        latestOrders: true,
    })

    const customersCount = ref(0);
    const productsCount = ref(0);
    const paidOrders = ref(0);
    const totalIncome = ref(0);
    const latestCustomers = ref([]);   
    const latestOrders = ref([]);   

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
    axiosClient.get(`/dashboard/latest-orders`).then(({data: orders}) => {
        latestOrders.value = orders.data;
        loading.value.latestOrders = false;
    })
</script>

<style scoped>

</style>