<template>
    <span class="inline-flex items-center rounded-md  px-2 py-1 text-xs font-medium ring-1 ring-inset" :class="[statuses[contactUs.status]]">
        {{ ucfirst(contactUs.status) }}</span>
</template>

<script setup>
const statuses = {
    solved: 'text-emerald-700 bg-emerald-50 ring-emerald-600/20',
    unread: 'text-yellow-700 bg-yellow-50 ring-yellow-600/20',
    read: 'text-blue-700 bg-blue-50 ring-blue-600/20',
}

const { contactUs } = defineProps({
    contactUs: Object
})

function ucfirst(string) {
    if (!string) return '';
    return string.charAt(0).toUpperCase() + string.slice(1);
}
</script>

<style scoped></style>