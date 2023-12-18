<template>
    <TransitionRoot appear :show="show" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-50">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-75" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-5xl transform overflow-hidden rounded-2xl bg-white text-left align-middle shadow-xl transition-all">
                            <Spinner v-if="loading"
                                class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center" />
                            <header class="py-3 px-4 flex justify-between items-center">
                                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                                    {{ customer.id ? `Update Customer: "${props.customer.first_name} ${props.customer.last_name}"` : 'Tambah Customer Baru' }}
                                </DialogTitle>
                                <button @click="closeModal()"
                                    class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </header>
                            <form @submit.prevent="onSubmit">
                                <pre>{{ errors }}</pre>
                                <div class="bg-white px-4 pt-5 pb-4">
                                    <CustomInput class="mb-2" v-model="customer.first_name" label="First Name" :errors="errors.first_name" />
                                    <CustomInput class="mb-2" v-model="customer.last_name" label="Last Name" :errors="errors.last_name" />
                                    <CustomInput class="mb-2" v-model="customer.email" label="Email" :errors="errors.email" />
                                    <CustomInput class="mb-2" v-model="customer.phone" label="Phone" :errors="errors.phone" />
                                    <CustomInput type="checkbox" class="mb-2" v-model="customer.status" label="Active" :errors="errors.status" />
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">
                                                Billing Address
                                            </h2>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                                <CustomInput v-model="customer.billingAddress.address1" label="Address 1" :errors="errors['billingAddress.address1']" />
                                                <CustomInput v-model="customer.billingAddress.address2" label="Address 2" :errors="errors['billingAddress.address2']" />
                                                <CustomInput v-model="customer.billingAddress.city" label="City" :errors="errors['billingAddress.city']" />
                                                <CustomInput v-model="customer.billingAddress.state" label="State" :errors="errors['billingAddress.state']" />
                                                <CustomInput v-model="customer.billingAddress.country" label="Country" readonly="true" :errors="errors['billingAddress.country']" />
                                                <CustomInput v-model="customer.billingAddress.zipcode" label="Zip Code" :errors="errors['billingAddress.zipcode']" />
                                            </div>
                                        </div>
                                        <div>
                                            <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">
                                                Shipping Address
                                            </h2>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                                <CustomInput v-model="customer.shippingAddress.address1" label="Address 1" :errors="errors['shippingAddress.address1']" />
                                                <CustomInput v-model="customer.shippingAddress.address2" label="Address 2" :errors="errors['shippingAddress.address2']" />
                                                <CustomInput v-model="customer.shippingAddress.city" label="City" :errors="errors['shippingAddress.city']" />
                                                <CustomInput v-model="customer.shippingAddress.state" label="State" :errors="errors['shippingAddress.state']" />
                                                <CustomInput v-model="customer.shippingAddress.country" label="Country" readonly="true" :errors="errors['shippingAddress.country']" />
                                                <CustomInput v-model="customer.shippingAddress.zipcode" label="Zip Code" :errors="errors['shippingAddress.zipcode']" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2  text-base font-medium  focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">Submit</button>
                                    <button type="button"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                        @click="closeModal" ref="cancelButtonRef">Cancel</button>
                                </footer>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
  
<script setup>
import { computed, onUpdated, ref } from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import CustomInput from '../../components/core/CustomInput.vue';
import store from '../../store';
import Spinner from '../../components/core/Spinner.vue';

const customer = ref({})
const errors = ref({
    first_name: [],
    last_name: [],
    email: [],
    phone: [],
    status: [],
    'billingAddress.address1': [],
    'billingAddress.address2': [],
    'billingAddress.city': [],
    'billingAddress.state': [],
    'billingAddress.country': [],
    'billingAddress.zipcode': [],
    'shippingAddress.address1': [],
    'shippingAddress.address2': [],
    'shippingAddress.city': [],
    'shippingAddress.state': [],
    'shippingAddress.country': [],
    'shippingAddress.zipcode': [],
})

const loading = ref(false)

const props = defineProps({
    modelValue: Boolean,
    customer: {
        required: true,
        type: Object,
    }
})

const emit = defineEmits(['update:modelValue', 'close'])

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
})

onUpdated(() => {
    customer.value = {
        id: props.customer.id,
        first_name: props.customer.first_name,
        last_name: props.customer.last_name,
        email: props.customer.email,
        phone: props.customer.phone,
        status: props.customer.status,
        billingAddress: {
            ...props.customer.billingAddress
        },
        shippingAddress: {
            ...props.customer.shippingAddress
        },
    }
    console.log(customer);

})

function closeModal() {
    show.value = false
    emit('close')
}

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
                    closeModal()
                }
            })
            .catch(err =>{
                loading.value = false;
                //  show.value = true
                errors.value = err.response.data.errors;
            })
    } else {
        store.dispatch('createCustomer', customer.value)
            .then(response => {
                loading.value = false;
                if (response.status === 201) {
                    // TODO show notification 
                    store.dispatch('getCustomers')
                    closeModal()
                }
            })
            .catch(err => {
                loading.value = false;
                //  show.value = true
                errors.value = err.response.data.errors;
            })
    }
}

</script>
  

<style scoped></style>