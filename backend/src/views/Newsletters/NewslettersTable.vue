<template>
    <div class="mt-8 flow-root animate-fade-in-down">
        <div class="flex justify-between border-b-2 pb-3">
            <div class="flex items-center">
                <span class="whitespace-nowrap mr-3">Per Page</span>
                <select @change="getNewsletters(null)" v-model="perPage"
                    class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div>
                <input v-model="search" @change="getNewsletters(null)"
                    class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Cari Newsletter">
            </div>
        </div>

        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <TableHeaderCell field="id" scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3"
                                :sort-field="sortField" :sort-direction="sortDirection" @click="sortNewsletters('id')">
                                ID
                            </TableHeaderCell>
                            <TableHeaderCell field="email" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" :sort-field="sortField"
                                :sort-direction="sortDirection" @click="sortNewsletters('email')">
                                Email
                            </TableHeaderCell>
                            <!-- <TableHeaderCell field="status" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" :sort-field="sortField"
                                :sort-direction="sortDirection" @click="sortNewsletters('status')">
                                Status
                            </TableHeaderCell> -->
                            <TableHeaderCell field="created_at" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" :sort-field="sortField"
                                :sort-direction="sortDirection" @click="sortNewsletters('created_at')">
                                Register Date
                            </TableHeaderCell>
                        </tr>
                    </thead>
                    <!-- <pre>{{ newsletters }}</pre> -->
                    <tbody v-if="newsletters.loading || !newsletters.data.length">
                        <tr>
                            <td colspan="4">
                                <Spinner class="my-4" v-if="newsletters.loading" />
                                <p v-else class="text-center py-8 text-gray-700">
                                    There are no newsletters
                                </p>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else class="bg-white">
                        <tr v-for="(newsletter, index) of newsletters.data" class="even:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">{{ newsletter.id }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ newsletter.email }}</td>
                            <!-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ newsletter.phone }}</td> -->
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ newsletter.created_at }}</td>
                           
                        </tr>
                    </tbody>
                </table>
                <div v-if="!newsletters.loading" class="flex justify-between items-center mt-5">
                    <span>
                        Showing from {{ newsletters.from }} to {{ newsletters.to }}
                    </span>
                    <nav v-if="newsletters.total > newsletters.limit"
                        class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                        aria-label="Pagination">
                        <a v-for="(link, i) of newsletters.links" :key="i" :disabled="!link.url" href="#"
                            @click.prevent="getForPage($event, link)" aria-current="page"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                            :class="[link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50', i === 0 ? 'rounded-l-md' : '', i === newsletters.links.length - 1 ? 'rounded-r-md' : '', !link.url ? 'bg-gray-100 text-gray-700' : '']"
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
import { NEWSLETTERS_PER_PAGE } from "../../constants"
import TableHeaderCell from '../../components/core/Table/TableHeaderCell.vue';

const perPage = ref(NEWSLETTERS_PER_PAGE)
const search = ref('')
const newsletters = computed(() => store.state.newsletters)
const sortField = ref('updated_at')
const sortDirection = ref('desc')

const newsletter = ref({})

const emit = defineEmits(['clickEdit'])

onMounted(() => {
    getNewsletters();
})

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }

    getNewsletters(link.url)
}

function getNewsletters(url = null) {
    store.dispatch('getNewsletters', {
        url,
        search: search.value,
        per_page: perPage.value,
        sort_field: sortField.value,
        sort_direction: sortDirection.value
    })
}

function sortNewsletters(field) {
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

    getNewsletters();
}
</script>

<style scoped></style>