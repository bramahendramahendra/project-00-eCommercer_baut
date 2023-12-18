<template>
    <LineChart v-if="chartData" :chart-data="chartData" :height="240" />
</template>

<script setup>
import { ref, watch } from 'vue';
import LineChart from '../../components/core/Charts/Line.vue';
import axiosClient from '../../axios';
import { useRoute } from 'vue-router';

const route = useRoute();
const chartData = ref(null);

watch(route, (rt) => {
    getData();
}, { immediate: true })

function getData() {
    axiosClient.get(`report/customers`, { params: { d: route.params.date } })
        .then(({ data }) => {
            chartData.value = data;
        }
    )
}

</script>

<style scoped></style>