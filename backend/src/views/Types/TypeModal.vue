
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
                                   <CustomInput 
                                        class="mb-2" 
                                        type="combobox" 
                                        v-model="selectedCategory" 
                                        :options="categories" 
                                        optionValue="id" 
                                        optionText="name"
                                        placeholder="Select a category" 
                                    />
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
import { computed, onUpdated, ref, onMounted, watch, watchEffect } from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
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
// onMounted(() => {
//     store.dispatch('getOptionCategories').then(data => {
//         categories.value = data; // Asumsi data adalah array langsung dari kategori
//     });
// });

onMounted(async () => {
    categories.value = await store.dispatch('getOptionCategories');
    if (type.value.category_id) {
        // Pastikan ini sesuai dengan bagaimana Anda mendapatkan kategori yang sesuai
        selectedCategory.value = categories.value.find(c => c.id === type.value.category_id) || null;
    }
});

// const selectedCategory = ref(null);
const selectedCategory = ref('');
// watch(selectedCategory, (newCategory) => {
//     if (newCategory) {
//         type.value.category_id = newCategory.id; // Pastikan Anda memperbarui ini dengan property ID yang benar dari objek category
//     } else {
//         type.value.category_id = null; // Atau nilai default yang sesuai jika tidak ada yang dipilih
//     }
// });

onMounted(async () => {
    categories.value = await store.dispatch('getOptionCategories');
    setSelectedCategory();
});

watch(selectedCategory, (newCategory) => {
    if (newCategory) {
        type.value.category_id = newCategory.id;
    } else {
        type.value.category_id = null;
    }
});

watchEffect(() => {
    type.value = { ...props.type };
    // setSelectedCategory();  /// error bug disini
});

function setSelectedCategory() {
    if (type.value && type.value.category_id) {
        const category = categories.value.find(c => c.id === type.value.category_id);
        selectedCategory.value = category || null;
    } else {
        selectedCategory.value = null;
    }
}

// Mengikuti nilai selectedCategory untuk memperbarui type.category_id



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
    selectedCategory.value = null;
    show.value = false
    emit('close')
}

function onSubmit() {
    loading.value = true
    if (type.value.id) {
        debugger;
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