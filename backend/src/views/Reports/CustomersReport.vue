<template>
    <LineChart v-if="chartData" :chart-data="chartData" :height="300" />
</template>

<script setup>
import { ref } from 'vue';
import LineChart from '../../components/core/Charts/Line.vue';
import axiosClient from '../../axios';

const chartData = ref(null);

axiosClient.get(`report/customers`).then(({ data }) => {
    chartData.value = data;
})
</script>

<style scoped></style>