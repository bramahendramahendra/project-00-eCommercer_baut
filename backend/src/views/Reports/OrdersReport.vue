<template>
    <BarChart v-if="chartData" :chart-data="chartData" :height="300" />
</template>

<script setup>
    import { ref } from 'vue';
    import BarChart from '../../components/core/Charts/Bar.vue';
    import axiosClient from '../../axios';

    const chartData = ref(null);

    axiosClient.get(`report/orders`).then(({ data }) => {
        chartData.value = data;
    })
</script>

<style scoped>

</style>