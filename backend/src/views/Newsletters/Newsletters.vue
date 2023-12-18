<template>
    <!-- <pre>{{ newsletters }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Newsletters</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the newsletters in your account including their name, title, email and role.</p> -->
            </div>
        </div>
        <NewslettersTable />
    </div>
</template>
  
<script setup>
    import { computed } from 'vue';
    import store from '../../store';
    import NewslettersTable from './NewslettersTable.vue';

    const newsletters = computed(() => store.state.newsletters)
</script>

<style scoped></style>