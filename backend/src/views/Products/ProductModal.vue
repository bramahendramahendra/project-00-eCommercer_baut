<template>
    <TransitionRoot appear :show="show" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-50">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-75" />
            </TransitionChild>

            <!-- {{ product }} -->
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-5xl transform overflow-visible rounded-2xl bg-white text-left align-middle shadow-xl transition-all">
                            <Spinner v-if="loading"
                                class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center" />
                            <header class="py-3 px-4 flex justify-between items-center">
                                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                                    {{ product.id ? `Update Produk: "${props.product.title}"` : 'Tambah Produk Baru' }}
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
                                <div class="bg-white grid grid-cols-3 gap-2 place-items-stretch px-4 pt-5 pb-4">
                                    <!-- <CustomInput class="mb-2" v-model="product.type_id" label="Jenis" /> -->
                                    <CustomInput class="mb-2 col-span-3" type="combobox" v-model="product.type" :options="types" optionValue="id" optionText="name" placeholder="Pilih Jenis" :errors="errors.type" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.code" label="Kode Produk" :errors="errors.code" />
                                    <CustomInput class="mb-2 col-span-2" v-model="product.title" label="Judul Produk" :errors="errors.title" />
                                    <CustomInput class="mb-2 col-span-1" type="file" v-model="product.image" label="Gambar Produk" @change="file => product.image = file" :errors="errors.image" />
                                    <CustomInput class="mb-2 col-span-2" type="textarea" v-model="product.description" label="Deskripsi Produk" :errors="errors.description" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.price_retail" label="Harga Eceran" prepend="Rp." :errors="errors.price_retail" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.quantity_limit" label="Max Kuantitas Eceran" prepend="Max" :errors="errors.quantity_limit" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.price_wholesale" label="Harga Grosir" prepend="Rp." :errors="errors.price_wholesale" />
                                    <CustomInput class="mb-2 col-span-1" type="combobox" v-model="product.unit" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Unit" :errors="errors.unit" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="product.material" :options="materials" optionValue="id" optionText="name" placeholder="Pilih Material" :errors="errors.material" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.weight" label="Berat" prepend="" :errors="errors.weight" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="product.weight_unit" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Berat" :errors="errors.weight_unit" />
                                    <CustomInput class="mb-2 col-span-1" type="number"  v-model="product.contents_per_box" label="Isi Per Kotak" prepend="" :errors="errors.contents_per_box" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="product.contents_per_box_unit" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Per Box" :errors="errors.contents_per_box_unit" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.grade" label="Grade" :errors="errors.grade" />
                                    <CustomInput class="mb-2 col-span-1" type="combobox" v-model="product.thread_direction" :options="threadDirections" optionValue="id" optionText="name" placeholder="Pilih Thread Direction" :errors="errors.thread_direction" />
                                    <CustomInput class="mb-2 col-span-1" type="combobox" v-model="product.thread_density" :options="threadDensities" optionValue="id" optionText="name" placeholder="Pilih Thread Density" :errors="errors.thread_density" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.diameter" label="Diameter" prepend="" :errors="errors.diameter" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.inner_diameter" label="Diameter Dalam" prepend="" :errors="errors.inner_diameter" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.outer_diameter" label="Diameter Luar" prepend="" :errors="errors.outer_diameter" />
                                    <CustomInput class="mb-2 col-span-3" type="combobox" v-model="product.diameter_unit" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Diameter" :errors="errors.diameter_unit" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.length" label="Panjang" prepend="" :errors="errors.length" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="product.length_unit" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Panjang" :errors="errors.length_unit" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.thick_head" label="Tebal Kepala" prepend="" :errors="errors.thick_head" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="product.thick_head_unit" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Tebal Kepala" :errors="errors.thick_head_unit" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.drat_length" label="Panjang drat (b)" prepend="" :errors="errors.drat_length" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="product.drat_length_unit" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Panjang drat" :errors="errors.drat_length_unit" />
                                    <CustomInput class="mb-2 col-span-3" type="combobox" v-model="product.color" :options="colors" optionValue="id" optionText="name" placeholder="Pilih Warna" :errors="errors.color" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.drat_type" label="Tipe drat" :errors="errors.drat_type" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.drat_size" label="Ukuran Drat" :errors="errors.drat_size" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.dimensional_standart" label="Dimensional Standart" :errors="errors.dimensional_standart" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.head_style" label="Head Style" :errors="errors.head_style" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.drive_type" label="Drive Type" :errors="errors.drive_type" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.across_flats" label="Kunci Kepala" :errors="errors.across_flats" />
                                    <CustomInput class="mb-2" type="checkbox" v-model="product.published" label="Published" :errors="errors.published" />
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
import { computed, ref, onUpdated } from 'vue'
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

const product = ref({})  
const errors = ref({
    type: [],
    code: [],
    title: [],
    image: [],
    description: [],
    price_retail: [],
    quantity_limit: [],
    price_wholesale: [],
    unit: [],
    material: [],
    weight: [],
    weight_unit: [],
    contents_per_box: [],
    contents_per_box_unit: [],
    grade: [],
    thread_direction: [],
    thread_density: [],
    diameter: [],
    inner_diameter: [],
    outer_diameter: [],
    diameter_unit: [],
    length: [],
    length_unit: [],
    thick_head: [],
    thick_head_unit: [],
    drat_length: [],
    drat_length_unit: [],
    color: [],
    drat_type: [],
    drat_size: [],
    dimensional_standart: [],
    head_style: [],
    drive_type: [],
    across_flats: [],
    published: [],
})

const loading = ref(false)

const props = defineProps({
    modelValue: Boolean,
    product: {
        required: true,
        type: Object,
    }
})

const emit = defineEmits(['update:modelValue', 'close'])

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
})

const types = ref([]);
const units = ref([]);
const materials = ref([]);
const threadDensities = ref([]);
const threadDirections = ref([]);
const colors = ref([]);

onUpdated(() => {
    getProduct();
    getOptions();
});

function getProduct() {
    product.value = {
        id: props.product.id,
        type: props.product.type,
        code: props.product.code,
        image: props.product.image,
        title: props.product.title,
        description: props.product.description,
        price_retail: props.product.price_retail,
        quantity_limit: props.product.quantity_limit,
        price_wholesale: props.product.price_wholesale,
        unit: props.product.unit,
        material: props.product.material,
        weight: props.product.weight,
        weight_unit: props.product.weight_unit,
        contents_per_box: props.product.contents_per_box,
        contents_per_box_unit: props.product.contents_per_box_unit,
        grade: props.product.grade,
        thread_direction: props.product.thread_direction,
        thread_density: props.product.thread_density,
        diameter: props.product.diameter,
        inner_diameter: props.product.inner_diameter,
        outer_diameter: props.product.outer_diameter,
        diameter_unit: props.product.diameter_unit,
        length: props.product.length,
        length_unit: props.product.length_unit,
        thick_head: props.product.thick_head,
        thick_head_unit: props.product.thick_head_unit,
        drat_length: props.product.drat_length,
        drat_length_unit: props.product.drat_length_unit,
        drat_size: props.product.drat_size,
        dimensional_standart: props.product.dimensional_standart,
        head_style: props.product.head_style,
        drive_type: props.product.drive_type,
        across_flats: props.product.across_flats,
        drat_type: props.product.drat_type,
        color: props.product.color,
        published: props.product.published,
    };
}

function getOptions() {
    store.dispatch('getOptionTypes')
        .then(({ data }) => {
            types.value = data
        })
    store.dispatch('getOptionUnits')
        .then(({ data }) => {
            units.value = data;
        });
    store.dispatch('getOptionMaterials')
        .then(({ data }) => {
            materials.value = data;
        });
    store.dispatch('getOptionThreadDensities')
        .then(({ data }) => {
           threadDensities.value = data;
        });
    store.dispatch('getOptionThreadDirections')
        .then(({ data }) => {
           threadDirections.value = data;
        });
    store.dispatch('getOptionColors')
        .then(({ data }) => {
           colors.value = data;
        });
}

function closeModal() {
    show.value = false
    emit('close')
}

function onSubmit() {
    // debugger;
    // console.log(product);
    loading.value = true

    const payload = {
        id: product.value.id,
        type_id: product.value.type?product.value.type.id:'',
        code: product.value.code?product.value.code:'',
        title: product.value.title?product.value.title:'',
        // image: product.value.image instanceof File ? product.value.image : undefined,
        image: product.value.image,
        description: product.value.description?product.value.description:'',
        price_retail: product.value.price_retail?product.value.price_retail:'',
        quantity_limit: product.value.quantity_limit?product.value.quantity_limit:'',
        price_wholesale: product.value.price_wholesale?product.value.price_wholesale:'',
        unit_id: product.value.unit? product.value.unit.id:'',
        material_id: product.value.material?product.value.material.id:'',
        weight: product.value.weight?product.value.weight:'',
        weight_unit_id: product.value.weight_unit?product.value.weight_unit.id:'',
        contents_per_box: product.value.contents_per_box?product.value.contents_per_box:'',
        contents_per_box_unit_id: product.value.contents_per_box_unit?product.value.contents_per_box_unit.id:'',
        grade: product.value.grade?product.value.grade:'',
        thread_direction_id: product.value.thread_direction?product.value.thread_direction.id:'',
        thread_density_id: product.value.thread_density?product.value.thread_density.id:'',
        diameter: product.value.diameter?product.value.diameter:'',
        inner_diameter: product.value.inner_diameter?product.value.inner_diameter:'',
        outer_diameter: product.value.outer_diameter?product.value.outer_diameter:'',
        diameter_unit_id: product.value.diameter_unit?product.value.diameter_unit.id:'',
        length: product.value.length?product.value.length:'',
        length_unit_id: product.value.length_unit?product.value.length_unit.id:'',
        thick_head: product.value.thick_head?product.value.thick_head:'',
        thick_head_unit_id: product.value.thick_head_unit?product.value.thick_head_unit.id:'',
        drat_length: product.value.drat_length?product.value.drat_length:'',
        drat_length_unit_id: product.value.drat_length_unit?product.value.drat_length_unit.id:'',
        drat_size: product.value.drat_size?product.value.drat_size:'',
        dimensional_standart: product.value.dimensional_standart?product.value.dimensional_standart:'',
        head_style: product.value.head_style?product.value.head_style:'',
        drive_type: product.value.drive_type?product.value.drive_type:'',
        across_flats: product.value.across_flats?product.value.across_flats:'',
        drat_type: product.value.drat_type?product.value.drat_type:'',
        color_id: product.value.color?product.value.color.id:'',
        published: product.value.published?product.value.published:0,
    };

    // console.log(payload);
    //  debugger;

    if (product.value.id) {
        // debugger;
        store.dispatch('updateProduct', payload)
            .then(response => {
                loading.value = false;
                if (response.status === 200) {
                    store.dispatch('getProducts')
                    closeModal()
                }
            })
            .catch(err => {
                loading.value = false;
                //  show.value = true
                errors.value = err.response.data.errors;
            })
    } else {
        // debugger;
        store.dispatch('createProduct', payload)
            .then(response => {
                loading.value = false;
                if (response.status === 201) {
                    store.dispatch('getProducts')
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