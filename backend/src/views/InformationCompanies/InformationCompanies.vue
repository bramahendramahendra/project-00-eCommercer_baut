<template>
    <!-- <pre>{{ informationCompany }}</pre> -->
    <!-- <pre>{{ informationCompany.name }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Information Company</h1>
            </div>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <form @submit.prevent="onSubmit">
                 <!-- <pre>{{ errors }}</pre> -->
                <div class="bg-white px-4 pt-5 pb-4">
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Nama Perusahaan</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.name" label="Nama Perusahaan" :errors="errors.name" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Deskripsi Perusahaan</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.description" label="Deskripsi Perusahaan" :errors="errors.description" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Logo Perusahaan</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <div class="group aspect-h-2 aspect-w-16 block w-1/6 overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img :src="informationCompany.image_url" alt="" class="pointer-events-none object-cover group-hover:opacity-75" />
                            </div>
                            <CustomInput class="mb-2 col-span-1" type="file" v-model="informationCompany.image" label="Logo Perusahaan" @change="file => informationCompany.image = file" :errors="errors.image" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Email Perusahaan</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.email" label="Email Perusahaan" :errors="errors.email" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Telepon Perusahaan</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.phone" label="Telepon Perusahaan" :errors="errors.phone" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Hari Operasional</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.operating_days" label="Hari Operasional" :errors="errors.operating_days" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Jam Operasional</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.operating_hours" label="Jam Operasional" :errors="errors.operating_hours" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Alamat Perusahaan</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput type="textarea" class="mb-2" v-model="informationCompany.address" label="Alamat Perusahaan" :errors="errors.address" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Kota </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.city" label="Kota" :errors="errors.city" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Provinsi </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.state" label="Provinsi" :errors="errors.state" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Kode Pos </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.zipcode" label="Kode Pos" :errors="errors.zipcode" />
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-3">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Negara</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-3 sm:mt-0">
                            <CustomInput class="mb-2" v-model="informationCompany.country" label="Negara" :errors="errors.country" />
                        </dd>
                    </div>
                </div>
                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2  text-base font-medium  focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                        Save
                    </button>
                </footer>
            </form>
        </div>
    </div>
</template>
  
<script setup>
import { computed, ref, onMounted } from 'vue';
import store from '../../store';
import CustomInput from '../../components/core/CustomInput.vue';
import { PhotoIcon } from '@heroicons/vue/24/solid'

const errors = ref({
    name: [],
    description: [],
    image: [],
    email: [],
    phone: [],
    operating_days: [],
    operating_hours: [],
    address: [],
    city: [],
    state: [],
    zipcode: [],
    country: [],
})
const informationCompany = ref({})

const loading = ref(false)

onMounted(() => {
    store.dispatch('getInformationCompanies')
        .then(({ data }) => {
            informationCompany.value = data.data[0]
        })
})

function onSubmit() {
    loading.value = true
    if (informationCompany.value.id) {
        informationCompany.value.status = !!informationCompany.value.status
        store.dispatch('updateInformationCompanies', informationCompany.value)
            .then(response => {
                loading.value = false;
                if (response.status === 200) {
                    // TODO show notification 
                    store.commit('showToast', 'Information Company berhasil diupdate.');
                    store.dispatch('getInformationCompanies')
                    router.push({ name: 'app.informationCompanies' })
                }
            })
            .catch(err => {
                loading.value = false;
                errors.value = err.response.data.errors;
            })
    }
}
</script>

<style scoped></style>