<template>
    <!-- <pre>{{ contactUs }}</pre> -->

    <div class="mb-5">
        <router-link :to="{ name: 'app.contactUses' }"
            class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <ArrowUturnLeftIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
            Kembali
        </router-link>
    </div>
    <div v-if="!contactUs">
        <Spinner class="my-4" v-if="!contactUs" />
        <p v-else class="text-center py-8 text-gray-700">
            There are no contact us
        </p>
    </div>

    <div v-else>
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Contact Us Detail</h3>
            <!-- <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and application.</p> -->
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">ID</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ contactUs.id }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Date</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ contactUs.created_at }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Status</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <!-- <div :class="[statuses[ucfirst(contactUs.status)], 'rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset inline-block items-center justify-center']">{{ ucfirst(contactUs.status) }}</div> -->
                        <ContactUsStatus :contactUs="contactUs" />
                        <div>
                            <select v-model="contactUs.status" @change="onStatusChange" id="country" name="country"
                                autocomplete="country-name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option v-for="status of contactUsStatuses" :value="status">{{ status }}</option>
                            </select>
                        </div>
                    </dd>
                </div>
               
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Name</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ contactUs.first_name }} {{ contactUs.last_name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Email</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ contactUs.email }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ contactUs.phone }}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Message</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ contactUs.message }}</dd>
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
import ContactUsStatus from './ContactUsStatus.vue';

const route = useRoute()

const contactUs = ref(null);
const contactUsStatuses = ref([]);

// const statuses = {
//     Paid: 'text-emerald-700 bg-emerald-50 ring-emerald-600/20',
//     Unpaid: 'text-yellow-600 bg-yellow-50 ring-yellow-500/10',
//     Cancelled: 'text-red-700 bg-red-50 ring-red-600/10',
//     Shipped: 'text-orange-600 bg-orange-50 ring-orange-500/10',
//     Completed: 'text-blue-700 bg-blue-50 ring-blue-600/10',
// }

onMounted(() => {
    store.dispatch('getContactUs', route.params.id)
        .then(({ data }) => {
            contactUs.value = data
        })
    axiosClient.get('/contactUses/statuses')
        .then(({ data }) => contactUsStatuses.value = data)
})

function onStatusChange() {
    // console.log(contactUs.value.status);
    axiosClient.post(`/contactUses/change-status/${contactUs.value.id}/${contactUs.value.status}`)
        .then(({ data }) => {
            store.commit('showToast', `Contact Us status was successfully change into "${contactUs.value.status}"`)
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