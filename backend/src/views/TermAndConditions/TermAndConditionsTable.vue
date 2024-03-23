<template>
    <div class="mt-8 flow-root animate-fade-in-down">
        <div class="flex justify-between border-b-2 pb-3">
            <div class="flex items-center">
                <span class="whitespace-nowrap mr-3">Per Page</span>
                <select @change="getTermAndConditions(null)" v-model="perPage" class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div>
                <input v-model="search" @change="getTermAndConditions(null)" class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Cari FAQ">
            </div>
        </div>
        
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <TableHeaderCell @click="sortTermAndCondition('id')" scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3" field="id" :sort-field="sortField" :sort-direction="sortDirection">ID</TableHeaderCell>
                            <TableHeaderCell @click="sortTermAndCondition('title')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" field="title" :sort-field="sortField" :sort-direction="sortDirection">Title</TableHeaderCell>
                            <TableHeaderCell @click="sortTermAndCondition('content')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" field="content" :sort-field="sortField" :sort-direction="sortDirection">Content</TableHeaderCell>
                            <TableHeaderCell @click="sortTermAndCondition('updated_at')" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" field="updated_at" :sort-field="sortField" :sort-direction="sortDirection">Last Updated At</TableHeaderCell>
                            <TableHeaderCell field="actions">Actions</TableHeaderCell>
                        </tr>
                    </thead>

                    <tbody v-if="termAndConditions.loading || !termAndConditions.data.length">
                        <tr>
                            <td colspan="4">
                                <Spinner class="my-4" v-if="termAndConditions.loading" />
                                <p v-else class="text-center py-8 text-gray-700">
                                    There are no Frequently Asked Question
                                </p>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else class="bg-white">
                        <tr v-for="(termAndCondition, index) of termAndConditions.data" class="even:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">{{ termAndCondition.id }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ truncatedString(termAndCondition.title) }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ truncatedString(termAndCondition.content) }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ termAndCondition.updated_at }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <Menu as="div" class="relative inline-block text-left ">
                                    <div>
                                        <MenuButton class="inline-flex items-center justify-center w-full rounded-full h-10 bg-black bg-opacity-0 text-sm font-medium text-white hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                                            <EllipsisVerticalIcon class="h-5 w-5 text-indigo-500" aria-hidden="true" />
                                        </MenuButton>
                                    </div>
                                    <transition
                                        enter-active-class="transition duration-100 ease-out"
                                        enter-from-class="transform scale-95 opacity-0"
                                        enter-to-class="transform scale-100 opacity-100"
                                        leave-active-class="transition duration-75 ease-in"
                                        leave-from-class="transform scale-100 opacity-100"
                                        leave-to-class="transform scale-95 opacity-0">
                                        <MenuItems class="absolute right-0 z-20 mt-0 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <div class="px-1 py-1">
                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        :class="[
                                                        active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                                        ]"
                                                        @click="editTermAndCondition(termAndCondition)"
                                                    >
                                                        <PencilIcon
                                                            :active="active"
                                                            class="mr-2 h-5 w-5 text-violet-400"
                                                            aria-hidden="true"
                                                        />
                                                        Edit
                                                    </button>
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        :class="[
                                                        active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                                        ]"
                                                        @click="deleteTermAndCondition(termAndCondition)"
                                                    >
                                                        <TrashIcon
                                                            :active="active"
                                                            class="mr-2 h-5 w-5 text-violet-400"
                                                            aria-hidden="true"
                                                        />
                                                        Delete
                                                    </button>
                                                </MenuItem>
                                            </div>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="!termAndConditions.loading" class="flex justify-between items-center mt-5">
                    <span>
                        Showing from {{ termAndConditions.from }} to {{ termAndConditions.to }}
                    </span>
                    <nav v-if="termAndConditions.total > termAndConditions.limit" class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a v-for="(link, i) of termAndConditions.links" :key="i" :disabled="!link.url" href="" @click.prevent="getForPage($event, link)" aria-current="page" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap" :class="[link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50', i === 0 ? 'rounded-l-md' : '', i === termAndConditions.links.length - 1 ? 'rounded-r-md' : '', !link.url ? 'bg-gray-100 text-gray-700' : '']" v-html="link.label">

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
    import { TERMANDCONDITIONS_PER_PAGE } from "../../constants"
    import TableHeaderCell from '../../components/core/Table/TableHeaderCell.vue';
    import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
    import { EllipsisVerticalIcon, PencilIcon, TrashIcon} from '@heroicons/vue/20/solid'

    const emit = defineEmits(['clickEdit'])

    const perPage = ref(TERMANDCONDITIONS_PER_PAGE)
    const search = ref('')
    const termAndConditions = computed(() => store.state.termAndConditions)
    const sortField = ref('id')
    const sortDirection = ref('asc')

    const truncatedString = (string) => {
        const maxLength = 50; // Atur maksimal panjang karakter
        return string.length > maxLength ? string.substring(0, maxLength) + '...' : string;
    };

    onMounted(() => {
        getTermAndConditions();
    })  

    function getTermAndConditions(url = null) {
        store.dispatch('getTermAndConditions', {
            url,
            sort_field: sortField.value,
            sort_direction: sortDirection.value,
            search: search.value,
            perPage: perPage.value
        })
    }

    function getForPage(ev, link) {
        if (!link.url  || link.active) {
            // ev.preventDefault();
            return
        }
        getTermAndConditions(link.url)
    }

    function sortTermAndCondition(field) {
        if(sortField.value === field) {
            if(sortDirection.value === 'asc') {
                sortDirection.value = 'desc'
            } else {
                sortDirection.value = 'asc'
            }
        } else {
            sortField.value = field;
            sortDirection.value = 'asc'
        } 

        getTermAndConditions();
    }

    function editTermAndCondition(f) {
        emit('clickEdit', f)
    }

    function deleteTermAndCondition(termAndCondition) {
        if(!confirm('Apakah anda yakin ingin menghapus Term And Conditions berikut ?')) {
            return 
        }
        debugger
        store.dispatch('deleteTermAndCondition', termAndCondition.id)
            .then(res => {
                // TODO Show notification 
                store.commit('showToast', 'Term And Conditions berhasil dihapus.');
                store.dispatch('getTermAndConditions')
            })
    }
</script>

<style scoped>

</style>