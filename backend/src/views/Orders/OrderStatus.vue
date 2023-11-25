<template>
    <span class="inline-flex items-center rounded-md  px-2 py-1 text-xs font-medium ring-1 ring-inset"
        :class="
        [statuses[order.status]]
        // {
        //     'bg-emerald-50 text-emerald-700 ring-emerald-600/20': order.status === 'paid',
        //     'bg-yellow-50 text-yellow-700 ring-yellow-600/20': order.status === 'unpaid',
        //     'bg-red-50 text-red-700 ring-red-600/20': order.status === 'cancelled',
        //     'bg-orange-50 text-orange-700 ring-orange-600/20': order.status === 'shipped',
        //     'bg-blue-50 text-blue-700 ring-blue-600/20': order.status === 'completed',
        // }
        ">{{ ucfirst(order.status) }}</span>
</template>

<script setup>
    const statuses = {
        paid: 'text-emerald-700 bg-emerald-50 ring-emerald-600/20',
        unpaid: 'text-yellow-700 bg-yellow-50 ring-yellow-600/20',
        cancelled: 'text-red-700 bg-red-50 ring-red-600/20',
        shipped: 'text-orange-700 bg-orange-50 ring-orange-600/20',
        completed: 'text-blue-700 bg-blue-50 ring-blue-600/20',
    }

    const {order} = defineProps({
        order: Object
    })

    function ucfirst(string) {
        if (!string) return '';
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>

<style scoped>
</style>