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
                                    <CustomInput class="mb-2 col-span-3" type="combobox" v-model="selectedType" :options="types" optionValue="id" optionText="name" placeholder="Pilih Jenis" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.code" label="Kode Produk" />
                                    <CustomInput class="mb-2 col-span-2" v-model="product.title" label="Judul Produk" />
                                    <CustomInput class="mb-2 col-span-1" type="file" v-model="product.image" label="Gambar Produk" @change="file => product.image = file" />
                                    <CustomInput class="mb-2 col-span-2" type="textarea" v-model="product.description" label="Deskripsi Produk" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.price_retail" label="Harga Eceran" prepend="Rp." />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.quantity_limit" label="Max Kuantitas Eceran" prepend="Max" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.price_wholesale" label="Harga Grosir" prepend="Rp." />
                                    <CustomInput class="mb-2 col-span-1" type="combobox" v-model="selectedUnit" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Unit" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="selectedMaterial" :options="materials" optionValue="id" optionText="name" placeholder="Pilih Material" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.weight" label="Berat" prepend="" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="selectedUnitWeight" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Berat" />
                                    <CustomInput class="mb-2 col-span-1" type="number"  v-model="product.contents_per_box" label="Isi Per Kotak" prepend="" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="selectedUnitPerBox" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Per Box" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.grade" label="Grade" />
                                    <CustomInput class="mb-2 col-span-1" type="combobox" v-model="selectedThreadDirection" :options="threadDirections" optionValue="id" optionText="name" placeholder="Pilih Thread Direction" />
                                    <CustomInput class="mb-2 col-span-1" type="combobox" v-model="selectedThreadDensity" :options="threadDensities" optionValue="id" optionText="name" placeholder="Pilih Thread Density" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.diameter" label="Diameter" prepend="" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.inner_diameter" label="Diameter Dalam" prepend="" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.outer_diameter" label="Diameter Luar" prepend="" />
                                    <CustomInput class="mb-2 col-span-3" type="combobox" v-model="selectedUnitDiameter" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Diameter" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.length" label="Panjang" prepend="" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="selectedUnitLength" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Panjang" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.thick_head" label="Tebal Kepala" prepend="" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="selectedUnitThickHead" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Tebal Kepala" />
                                    <CustomInput class="mb-2 col-span-1" type="number" v-model="product.drat_length" label="Panjang drat (b)" prepend="" />
                                    <CustomInput class="mb-2 col-span-2" type="combobox" v-model="selectedUnitDratLength" :options="units" optionValue="id" optionText="full_name" placeholder="Pilih Satuan Panjang drat" />
                                    <CustomInput class="mb-2 col-span-3" type="combobox" v-model="selectedColor" :options="colors" optionValue="id" optionText="name" placeholder="Pilih Warna" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.drat_type" label="Tipe drat" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.drat_size" label="Ukuran Drat" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.dimensional_standart" label="Dimensional Standart" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.head_style" label="Head Style" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.drive_type" label="Drive Type" />
                                    <CustomInput class="mb-2 col-span-1" v-model="product.across_flats" label="Kunci Kepala" />
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
import { computed, ref, onMounted, watch } from 'vue'
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

const product = ref({
    id: props.product.id,
    type_id: props.product.type_id,
    code: props.product.code,
    title: props.product.title,
    image: props.product.image,
    description: props.product.description,
    price_retail: props.product.price_retail,
    price_wholesale: props.product.price_wholesale,
    quantity_limit: props.product.quantity_limit,
    unit_id: props.product.unit_id,
    material_id: props.product.material_id,
    weight: props.product.weight,
    weight_unit_id: props.product.weight_unit_id,
    contents_per_box: props.product.contents_per_box,
    contents_per_box_unit_id: props.product.contents_per_box_unit_id,
    grade: props.product.grade,
    thread_direction_id: props.product.thread_direction_id,
    thread_density_id: props.product.thread_density_id,
    diameter: props.product.diameter,
    inner_diameter: props.product.inner_diameter,
    outer_diameter: props.product.outer_diameter,
    diameter_unit_id: props.product.diameter_unit_id,
    length: props.product.length,
    length_unit_id: props.product.length_unit_id,
    thick_head: props.product.thick_head,
    thick_head_unit_id: props.product.thick_head_unit_id,
    drat_length: props.product.drat_length,
    drat_length_unit_id: props.product.drat_length_unit_id,
    drat_size: props.product.drat_size,
    dimensional_standart: props.product.dimensional_standart,
    head_style: props.product.head_style,
    drive_type: props.product.drive_type,
    across_flats: props.product.across_flats,
    drat_type: props.product.drat_type,
    color_id: props.product.color_id,
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
const selectedType = ref('');
const selectedUnit = ref('');
const selectedMaterial = ref('');
const selectedUnitWeight = ref('');
const selectedUnitPerBox = ref('');
const selectedThreadDirection = ref('');
const selectedThreadDensity = ref('');
const selectedUnitDiameter = ref('');
const selectedUnitLength = ref('');
const selectedUnitThickHead = ref('');
const selectedUnitDratLength = ref('');
const selectedColor = ref('');

onMounted(async () => {
    types.value = await store.dispatch('getOptionTypes');
    units.value = await store.dispatch('getOptionUnits');
    materials.value = await store.dispatch('getOptionMaterials');
    colors.value = await store.dispatch('getOptionColors');
    threadDensities.value = await store.dispatch('getOptionThreadDensities');
    threadDirections.value = await store.dispatch('getOptionThreadDirections');
    setSelectedType();
    setSelectedUnit();
    setSelectedMaterial();
    setSelectedUnitWeight();
    setSelectedUnitPerBox();
    setSelectedThreadDirection();
    setSelectedThreadDensity();
    setSelectedUnitDiameter();
    setSelectedUnitLength();
    setSelectedUnitThickHead();
    setSelectedUnitDratLength();
    setSelectedColor();
});

watch(() => props.product, (newProduct) => {
    product.value = { ...newProduct };
    setSelectedType();
    setSelectedUnit();
    setSelectedMaterial();
    setSelectedUnitWeight();
    setSelectedUnitPerBox();
    setSelectedThreadDirection();
    setSelectedThreadDensity();
    setSelectedUnitDiameter();
    setSelectedUnitLength();
    setSelectedUnitThickHead();
    setSelectedUnitDratLength();
    setSelectedColor();
});


function setSelectedType() {
    if (product.value && product.value.type_id) {
        const type = types.value.find(c => c.id === product.value.type_id);
        selectedType.value = type || null;
    } else {
        selectedType.value = null;
    }
}

function setSelectedUnit() {
    if (product.value && product.value.unit_id) {
        const unit = units.value.find(c => c.id === product.value.unit_id);
        selectedUnit.value = unit || null;
    } else {
        selectedUnit.value = null;
    }
}

function setSelectedMaterial() {
    if (product.value && product.value.material_id) {
        const material = materials.value.find(c => c.id === product.value.material_id);
        selectedMaterial.value = material || null;
    } else {
        selectedMaterial.value = null;
    }
}

function setSelectedUnitWeight() {
    if (product.value && product.value.weight_unit_id) {
        const unit = units.value.find(c => c.id === product.value.weight_unit_id);
        selectedUnitWeight.value = unit || null;
    } else {
        selectedUnitWeight.value = null;
    }
}

function setSelectedUnitPerBox() {
    if (product.value && product.value.contents_per_box_unit_id) {
        const unit = units.value.find(c => c.id === product.value.contents_per_box_unit_id);
        selectedUnitPerBox.value = unit || null;
    } else {
        selectedUnitPerBox.value = null;
    }
}

function setSelectedThreadDirection() {
    if (product.value && product.value.thread_direction_id) {
        const threadDirection = threadDirections.value.find(c => c.id === product.value.thread_direction_id);
        selectedThreadDirection.value = threadDirection || null;
    } else {
        selectedThreadDirection.value = null;
    }
}

function setSelectedThreadDensity() {
    if (product.value && product.value.thread_density_id) {
        const threadDensity = threadDensities.value.find(c => c.id === product.value.thread_density_id);
        selectedThreadDensity.value = threadDensity || null;
    } else {
        selectedThreadDensity.value = null;
    }
}

function setSelectedUnitDiameter() {
    if (product.value && product.value.diameter_unit_id) {
        const unit = units.value.find(c => c.id === product.value.diameter_unit_id);
        selectedUnitDiameter.value = unit || null;
    } else {
        selectedUnitDiameter.value = null;
    }
}

function setSelectedUnitLength() {
    if (product.value && product.value.length_unit_id) {
        const unit = units.value.find(c => c.id === product.value.length_unit_id);
        selectedUnitLength.value = unit || null;
    } else {
        selectedUnitLength.value = null;
    }
}

function setSelectedUnitThickHead() {
    if (product.value && product.value.thick_head_unit_id) {
        const unit = units.value.find(c => c.id === product.value.thick_head_unit_id);
        selectedUnitThickHead.value = unit || null;
    } else {
        selectedUnitThickHead.value = null;
    }
}

function setSelectedUnitDratLength() {
    if (product.value && product.value.drat_length_unit_id) {
        const unit = units.value.find(c => c.id === product.value.drat_length_unit_id);
        selectedUnitDratLength.value = unit || null;
    } else {
        selectedUnitDratLength.value = null;
    }
}

function setSelectedColor() {
    if (product.value && product.value.color_id) {
        const color = colors.value.find(c => c.id === product.value.color_id);
        selectedColor.value = color || null;
    } else {
        selectedColor.value = null;
    }
}

// onUpdated(() => {
//     product.value = {
//         id: props.product.id,
//         code: props.product.code,
//         title: props.product.title,
//         image: props.product.image,
//         description: props.product.description,
//         price_retail: props.product.price_retail,
//     }
// })

function closeModal() {
    selectedType.value = null;
    selectedUnit.value = null;
    selectedMaterial.value = null;
    selectedUnitWeight.value = null;
    selectedUnitPerBox.value = null;
    selectedThreadDirection.value = null;
    selectedThreadDensity.value = null;
    selectedUnitDiameter.value = null;
    selectedUnitLength.value = null;
    selectedUnitThickHead.value = null;
    selectedUnitDratLength.value = null;
    selectedColor.value = null;
    show.value = false
    emit('close')
}

function onSubmit() {
    loading.value = true
    if (selectedType.value) {
        product.value.type_id = selectedType.value.id;
    }
    if (selectedUnit.value) {
        product.value.unit_id = selectedUnit.value.id;
    }
    if (selectedMaterial.value) {
        product.value.material_id = selectedMaterial.value.id;
    }
    if (selectedUnitWeight.value) {
        product.value.weight_unit_id = selectedUnitWeight.value.id;
    }
    if (selectedUnitPerBox.value) {
        product.value.contents_per_box_unit_id = selectedUnitPerBox.value.id;
    }
    if (selectedThreadDirection.value) {
        product.value.thread_direction_id = selectedThreadDirection.value.id;
    }
    if (selectedThreadDensity.value) {
        product.value.thread_density_id = selectedThreadDensity.value.id;
    }
    if (selectedUnitDiameter.value) {
        product.value.diameter_unit_id = selectedUnitDiameter.value.id;
    }
    if (selectedUnitLength.value) {
        product.value.length_unit_id = selectedUnitLength.value.id;
    }
    if (selectedUnitThickHead.value) {
        product.value.thick_head_unit_id = selectedUnitThickHead.value.id;
    }
    if (selectedUnitDratLength.value) {
        product.value.drat_length_unit_id = selectedUnitDratLength.value.id;
    }
    if (selectedColor.value) {
        product.value.color_id = selectedColor.value.id;
    }

    const payload = {
        id: product.value.id,
        type_id: product.value.type_id,
        code: product.value.code,
        title: product.value.title,
        image: product.value.image,
        description: product.value.description,
        price_retail: product.value.price_retail,
        price_wholesale: product.value.price_wholesale,
        unit_id: product.value.unit_id,
        material_id: product.value.material_id,
        weight: product.value.weight,
        weight_unit_id: product.value.weight_unit_id,
        contents_per_box: product.value.contents_per_box,
        contents_per_box_unit_id: product.value.contents_per_box_unit_id,
        grade: product.value.grade,
        thread_direction_id: product.value.thread_direction_id,
        thread_density_id: product.value.thread_density_id,
        diameter: product.value.diameter,
        inner_diameter: product.value.inner_diameter,
        outer_diameter: product.value.outer_diameter,
        diameter_unit_id: product.value.diameter_unit_id,
        length: product.value.length,
        length_unit_id: product.value.length_unit_id,
        thick_head: product.value.thick_head,
        thick_head_unit_id: product.value.thick_head_unit_id,
        drat_length: product.value.drat_length,
        drat_length_unit_id: product.value.drat_length_unit_id,
        drat_size: product.value.drat_size,
        dimensional_standart: product.value.dimensional_standart,
        head_style: product.value.head_style,
        drive_type: product.value.drive_type,
        across_flats: product.value.across_flats,
        drat_type: product.value.drat_type,
        color_id: product.value.color_id,
    };

    if (product.value.id) {
        debugger;
        store.dispatch('updateProduct', payload)
            .then(response => {
                loading.value = false;
                if (response.status === 200) {
                    store.dispatch('getProducts')
                    closeModal()
                }
            })
    } else {
        debugger;
        store.dispatch('createProduct', payload)
            .then(response => {
                loading.value = false;
                if (response.status === 201) {
                    store.dispatch('getProducts')
                    closeModal()
                }
            })
    }
}

</script>

<style scoped></style>