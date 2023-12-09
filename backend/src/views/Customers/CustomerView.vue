<template>
    <div class="mb-5">
        <router-link :to="{ name: 'app.dashboard' }" 
            class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <ArrowUturnLeftIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
            Kembali
        </router-link>
    </div>
    <div v-if="!customer">
        <Spinner class="my-4" v-if="!customer" />
        <p v-else class="text-center py-8 text-gray-700 animate-fade-in-down">
            There are no customer
        </p>
    </div>
    <div v-else class="animate-fade-in-down">
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">{{ title }}</h3>
            <!-- <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and application.</p> -->
        </div>
        <form @submit.prevent="onSubmit">
            <div class="bg-white px-4 pt-5 pb-4">
                <CustomInput class="mb-2" v-model="customer.first_name" label="First Name" />
                <CustomInput class="mb-2" v-model="customer.last_name" label="Last Name" />
                <CustomInput class="mb-2" v-model="customer.email" label="Email" />
                <CustomInput class="mb-2" v-model="customer.phone" label="Phone" />
                <CustomInput type="checkbox" class="mb-2" v-model="customer.status" label="Active" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">
                            Billing Address
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <CustomInput v-model="customer.billingAddress.address1" label="Address 1" />
                            <CustomInput v-model="customer.billingAddress.address2" label="Address 2" />
                            <CustomInput v-model="customer.billingAddress.city" label="City" />
                            <CustomInput v-model="customer.billingAddress.zipcode" label="Zip Code" />
                            <CustomInput v-model="customer.billingAddress.country" label="Country" readonly="true" />
                            <CustomInput v-model="customer.billingAddress.state" label="State" />
                        </div>
                    </div>
                        <div>
                        <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">
                            Shipping Address
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <CustomInput v-model="customer.shippingAddress.address1" label="Address 1" />
                            <CustomInput v-model="customer.shippingAddress.address2" label="Address 2" />
                            <CustomInput v-model="customer.shippingAddress.city" label="City" />
                            <CustomInput v-model="customer.shippingAddress.zipcode" label="Zip Code" />
                            <CustomInput v-model="customer.shippingAddress.country" label="Country" readonly="true" />
                            <CustomInput v-model="customer.shippingAddress.state" label="State" />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2  text-base font-medium  focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">Submit</button>
                <router-link :to="{ name: 'app.dashboard' }"
                    class="mt-3 w-full inline-flex justify-center rounded-md border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    ref="cancelButtonRef">
                    Cancel
                </router-link>
            </footer>
        </form>
    </div>
</template>
  
<script setup>
import { computed, onMounted, ref } from 'vue';
import store from '../../store';
import { useRoute, useRouter } from 'vue-router';
import Spinner from '../../components/core/Spinner.vue';
import CustomInput from '../../components/core/CustomInput.vue';
import { ArrowUturnLeftIcon, EllipsisHorizontalIcon } from '@heroicons/vue/20/solid'


const router = useRouter();
const route = useRoute();

const title = ref('');
const customer = ref({
    billingAddress: {},
    shippingAddress: {},
})

const loading = ref(false)

function onSubmit() {
    loading.value = true
    if (customer.value.id) {
        customer.value.status = !!customer.value.status
        store.dispatch('updateCustomer', customer.value)
            .then(response => {
                loading.value = false;
                if (response.status === 200) {
                    // TODO show notification 
                    store.dispatch('getCustomers')
                    router.push({name: 'app.dashboard'})
                }
            })
    } else {
        store.dispatch('createCustomer', customer.value)
            .then(response => {
                loading.value = false;
                if (response.status === 201) {
                    // TODO show notification 
                    store.dispatch('getCustomers')
                    router.push({name: 'app.dashboard'})
                }
            })
    }
}

onMounted(() => {
    store.dispatch('getCustomer', route.params.id)
        .then(({ data }) => {
            title.value = `Update Customer: "${data.first_name} ${data.last_name}"` 
            customer.value = data
        })
})

</script>

<style scoped></style>