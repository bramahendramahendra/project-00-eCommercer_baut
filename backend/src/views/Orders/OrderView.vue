<template>
    <div class="mb-5">
        <router-link :to="{ name: 'app.orders' }" 
            class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <ArrowUturnLeftIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
            Kembali
        </router-link>
    </div>
    <div v-if=" !order">
        <Spinner class="my-4" v-if="!order" />
        <p v-else class="text-center py-8 text-gray-700 animate-fade-in-down">
            There are no order
        </p>
    </div>

   
    <div v-else class="animate-fade-in-down">
         <!-- {{ order }} -->
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Order Product Detail</h3>
            <!-- <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and application.</p> -->
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Order ID</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ order.id }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Order Date</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ order.created_at }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Order Status</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <!-- <div :class="[statuses[ucfirst(order.status)], 'rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset inline-block items-center justify-center']">{{ ucfirst(order.status) }}</div> -->
                        <OrderStatus :order="order" />
                        <div>
                            <select v-model="order.status" @change="onStatusChange" id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option v-for="status of orderStatuses" :value="status">{{ status }}</option>
                            </select>
                        </div>
                    </dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">SubTotal</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ order.total_price }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Customer Name</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ order.customer.first_name }} {{ order.customer.last_name }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Customer Email</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ order.customer.email }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Customer Phone</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ order.customer.phone }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <ul role="list" class="grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-2 xl:gap-x-8">
                            <li class="overflow-hidden rounded-xl border border-gray-200">
                                <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                                    <div class="flex gap-x-4 py-3">
                                        <dt class="text-gray-500">Billing Address</dt>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Address 1</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.billingAddress.address1 }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Address 2</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.billingAddress.address2 }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">City</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.billingAddress.city }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Province</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.billingAddress.state }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Zipcode</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.billingAddress.zipcode }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Country</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.billingAddress.country }}</div>
                                        </dd>
                                    </div>
                                </dl>
                            </li>
                            <li class="overflow-hidden rounded-xl border border-gray-200">
                                <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                                    <div class="flex gap-x-4 py-3">
                                        <dt class="text-gray-500">Shipping Address</dt>
                                    </div>
                                   <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Address 1</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.shippingAddress.address1 }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Address 2</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.shippingAddress.address2 }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">City</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.shippingAddress.city }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Province</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.shippingAddress.state }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Zipcode</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.shippingAddress.zipcode }}</div>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between gap-x-4 py-3">
                                        <dt class="text-gray-500">Country</dt>
                                        <dd class="text-gray-700">
                                            <div class="font-medium">{{ order.customer.shippingAddress.country }}</div>
                                        </dd>
                                    </div>
                                </dl>
                            </li>
                        </ul>
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Products Items</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <!-- <template > -->
                            <div v-for="item in order.items" :key="order.items.id" class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                            
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 " :src="item.product.image" alt="" />
                                </div>
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-sm font-medium text-gray-900">{{ item.product.title }}</p>
                                        <div class="flex justify-between">
                                            <p class="truncate text-sm text-gray-500">Rp. {{ item.unit_price }}</p>
                                            <p class="truncate text-sm text-gray-500">Qty : {{ item.quantity }}</p>
                                        </div>
                                    </a>
                                </div>
                            
                            </div>
                            <!-- </template> -->
                        </div>
                    </dd>
                </div>
           
            </dl>
        </div>
    </div>
</template>
  
<script setup>
import { computed, onMounted, ref } from 'vue';
import store from '../../store';
import Spinner from '../../components/core/Spinner.vue';
import { useRoute } from 'vue-router';
import { ArrowUturnLeftIcon, EllipsisHorizontalIcon } from '@heroicons/vue/20/solid'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import axiosClient from '../../axios';
import OrderStatus from './OrderStatus.vue';

const route = useRoute()

const order = ref(null);
const orderStatuses = ref([]);

// const statuses = {
//     Paid: 'text-emerald-700 bg-emerald-50 ring-emerald-600/20',
//     Unpaid: 'text-yellow-600 bg-yellow-50 ring-yellow-500/10',
//     Cancelled: 'text-red-700 bg-red-50 ring-red-600/10',
//     Shipped: 'text-orange-600 bg-orange-50 ring-orange-500/10',
//     Completed: 'text-blue-700 bg-blue-50 ring-blue-600/10',
// }

onMounted(() => {
    // debugger
    store.dispatch('getOrder', route.params.id)
        .then(({data}) => {
            order.value = data
        })
    axiosClient.get('/orders/statuses')
        .then(({data}) => orderStatuses.value = data)

    console.log(orderStatuses);
})

function onStatusChange() {
    // console.log(order.value.status);
    axiosClient.post(`/orders/change-status/${order.value.id}/${order.value.status}`)
        .then(({data}) => {
            store.commit('showToast', `Order status was successfully change into "${order.value.status}"`)
        })
    
}

function ucfirst(string) {
    if (!string) return '';
    return string.charAt(0).toUpperCase() + string.slice(1);
}

const clients = [
    {
        id: 1,
        name: 'Tuple',
        imageUrl: 'https://tailwindui.com/img/logos/48x48/tuple.svg',
        lastInvoice: { date: 'December 13, 2022', dateTime: '2022-12-13', amount: '$2,000.00', status: 'Overdue' },
    },
    {
        id: 2,
        name: 'SavvyCal',
        imageUrl: 'https://tailwindui.com/img/logos/48x48/savvycal.svg',
        lastInvoice: { date: 'January 22, 2023', dateTime: '2023-01-22', amount: '$14,000.00', status: 'Paid' },
    },
]

</script>

<style scoped></style>