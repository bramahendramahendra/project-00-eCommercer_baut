
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
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white text-left align-middle shadow-xl transition-all">
                            <Spinner v-if="loading"
                                class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center" />
                            <header class="py-3 px-4 flex justify-between items-center">
                                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                                    {{ type.id ? `Update Jenis: "${props.type.name}"` : 'Tambah Jenis Baru' }}
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
                                <div class="bg-white px-4 pt-5 pb-4">
                                     <Combobox as="div" v-model="selectedCategory">
                                        <ComboboxLabel class="block text-sm font-medium text-gray-700">Kategori</ComboboxLabel>
                                        <div class="relative mt-1">
                                            <ComboboxInput class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @input="filterCategories" :display-value="(category) => category?.name" />
                                            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                            </ComboboxButton>

                                            <ComboboxOptions v-if="filteredCategories.length > 0" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                            <ComboboxOption v-for="category in filteredCategories" :key="category.id" :value="category" as="template" v-slot="{ active, selected }">
                                                <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                                <span :class="['block truncate', selected && 'font-semibold']">
                                                    {{ category.name }}
                                                </span>

                                                <span v-if="selected" :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                </span>
                                                </li>
                                            </ComboboxOption>
                                            </ComboboxOptions>
                                        </div>
                                    </Combobox>
                                    <CustomInput class="mb-2" v-model="type.code" label="Kode Jenis" />
                                    <CustomInput class="mb-2" v-model="type.name" label="Nama Jenis" />
                                    <CustomInput type="textarea" class="mb-2" v-model="type.description"
                                        label="Deskripsi Jenis" />
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
import { computed, onUpdated, ref, onMounted, watch } from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import Spinner from '../../components/core/Spinner.vue';
import store from '../../store';
import CustomInput from '../../components/core/CustomInput.vue';

const type = ref({
    category_id: props.type.category_id,
    id: props.type.id,
    code: props.type.code,
    name: props.type.name,
    description: props.type.description,
})

const loading = ref(false)

const props = defineProps({
    modelValue: Boolean,
    type: {
        required: true,
        type: Object,
    }
})

const emit = defineEmits(['update:modelValue', 'close'])

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
})

const categories = ref([]);
onMounted(() => {
    store.dispatch('getOptionCategories').then(data => {
        categories.value = data; // Asumsi data adalah array langsung dari kategori
    });
});

const selectedCategory = ref(null);
watch(selectedCategory, (newCategory) => {
    if (newCategory) {
        type.value.category_id = newCategory.id; // Pastikan Anda memperbarui ini dengan property ID yang benar dari objek category
    } else {
        type.value.category_id = null; // Atau nilai default yang sesuai jika tidak ada yang dipilih
    }
});

const filteredCategories = ref(categories.value)

function filterCategories(event) {
    const query = event.target.value.toLowerCase()
    filteredCategories.value = categories.value.filter((category) =>
        category.name.toLowerCase().includes(query)
    )
}

onUpdated(() => {
    type.value = {
        category_id: props.type.category_id,
        id: props.type.id,
        code: props.type.code,
        name: props.type.name,
        description: props.type.description,
    }
})

function closeModal() {
    show.value = false
    emit('close')
}

function onSubmit() {
    loading.value = true
    if (type.value.id) {
        store.dispatch('updateType', type.value)
            .then(response => {
                loading.value = false;
                if (response.status === 200) {
                    // TODO show notification 
                    store.dispatch('getTypes')
                    closeModal()
                }
            })
    } else {
        debugger;
        store.dispatch('createType', type.value)
            .then(response => {
                loading.value = false;
                
                if (response.status === 201) {
                    // TODO show notification 
                    store.dispatch('getTypes')
                    closeModal()
                }
            })
    }
}
</script>

<style scoped></style>