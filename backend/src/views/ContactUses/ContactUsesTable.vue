<template>
    <div class="mt-8 flow-root animate-fade-in-down">
        <div class="flex justify-between border-b-2 pb-3">
            <div class="flex items-center">
                <span class="whitespace-nowrap mr-3">Per Page</span>
                <select @change="getContactUses(null)" v-model="perPage"
                    class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div>
                <input v-model="search" @change="getContactUses(null)"
                    class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Cari Contact Us">
            </div>
        </div>

        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <TableHeaderCell field="id" scope="col" 
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3" 
                                :sort-field="sortField" :sort-direction="sortDirection"
                                @click="sortContactUses('id')">
                                ID
                            </TableHeaderCell>
                            <TableHeaderCell field="name" scope="col" 
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                :sort-field="sortField" :sort-direction="sortDirection"
                                @click="sortContactUses('name')">
                                Name
                            </TableHeaderCell>
                            <TableHeaderCell field="email" scope="col" 
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                :sort-field="sortField" :sort-direction="sortDirection"
                                @click="sortContactUses('email')">
                                Email
                            </TableHeaderCell>
                            <TableHeaderCell field="phone"  scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" 
                                :sort-field="sortField" :sort-direction="sortDirection" 
                                @click="sortContactUses('phone')">
                                Phone
                            </TableHeaderCell>
                            <TableHeaderCell field="status"  scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" 
                                :sort-field="sortField" :sort-direction="sortDirection"
                                @click="sortContactUses('status')">
                                Status
                            </TableHeaderCell>
                            
                            <TableHeaderCell field="created_at" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" 
                                :sort-field="sortField" :sort-direction="sortDirection" 
                                @click="sortContactUses('created_at')">
                                Send Date
                            </TableHeaderCell>
                            <TableHeaderCell field="actions">Actions</TableHeaderCell>
                        </tr>
                    </thead>
                    <!-- <pre>{{ contactUses }}</pre> -->
                    <tbody v-if="contactUses.loading || !contactUses.data.length">
                        <tr>
                            <td colspan="6">
                                <Spinner class="my-4" v-if="contactUses.loading" />
                                <p v-else class="text-center py-8 text-gray-700">
                                    There are no contact us
                                </p>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else class="bg-white">
                        <tr v-for="(contactUs, index) of contactUses.data" class="even:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">{{ contactUs.id }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ contactUs.first_name }} {{ contactUs.last_name }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ contactUs.email }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ contactUs.phone }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><ContactUsStatus :contactUs="contactUs" /></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ contactUs.created_at }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <router-link :to="{ name: 'app.contactUses.view', params: { id: contactUs.id } }" class="w-8 h-8 rounded-full text-indigo-500 border border-indigo-500 flex justify-center items-center hover:text-white hover:bg-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="!contactUses.loading" class="flex justify-between items-center mt-5">
                    <span>
                        Showing from {{ contactUses.from }} to {{ contactUses.to }}
                    </span>
                    <nav v-if="contactUses.total > contactUses.limit"
                        class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                        aria-label="Pagination">
                        <a v-for="(link, i) of contactUses.links" :key="i" :disabled="!link.url" href="#"
                            @click.prevent="getForPage($event, link)" aria-current="page"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                            :class="[link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50', i === 0 ? 'rounded-l-md' : '', i === contactUses.links.length - 1 ? 'rounded-r-md' : '', !link.url ? 'bg-gray-100 text-gray-700' : '']"
                            v-html="link.label">
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
    import { computed, onMounted, ref } from 'vue';
    import store from '../../store';
    import Spinner from '../../components/core/Spinner.vue';
    import { CONTACTUSES_PER_PAGE } from "../../constants"
    import TableHeaderCell from '../../components/core/Table/TableHeaderCell.vue';
    import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
    import { EllipsisVerticalIcon, PencilIcon, TrashIcon } from '@heroicons/vue/20/solid'
    import ContactUsStatus from './ContactUsStatus.vue';

    const perPage = ref(CONTACTUSES_PER_PAGE)
    const search = ref('')
    const contactUses = computed(() => store.state.contactUses)
    const sortField = ref('updated_at')
    const sortDirection = ref('desc')

    const contactUs = ref({})
    const showContactUsModal = ref(false);

    const emit = defineEmits(['clickEdit'])

    onMounted(() => {
        getContactUses();
    })

    function getForPage(ev, link) {
        ev.preventDefault();
        if (!link.url || link.active) {
            return;
        }

        getContactUses(link.url)
    }

    function getContactUses(url = null) {
        store.dispatch('getContactUses', {
            url,
            search: search.value,
            per_page: perPage.value,
            sort_field: sortField.value,
            sort_direction: sortDirection.value
        })
    }

    function sortContactUses(field) {
        if (sortField.value === field) {
            if (sortDirection.value === 'asc') {
                sortDirection.value = 'desc'
            } else {
                sortDirection.value = 'asc'
            }
        } else {
            sortField.value = field;
            sortDirection.value = 'asc'
        }

        getContactUses();
    }


    function showAddNewModal() {
        showContactUsModal.value = true
    }

    function deleteContactUs(contactUs) {
        if (!confirm(`Are you sure you want to delete the contact us?`)) {
            return
        }
        store.dispatch('deleteContactUs', contactUs.id)
            .then(res => {
                // TODO Show notification
                store.dispatch('getContactUses')
            })
    }

    function showContactUs(p) {
        emit('clickShow', p)
    }
</script>

<style scoped></style>