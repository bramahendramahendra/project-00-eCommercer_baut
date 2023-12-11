<template>
    <div>
        <!-- Bagian Select untuk Perangkat Kecil -->
        <div class="sm:hidden">
            <label for="tabs-select" class="sr-only">Pilih Laporan</label>
             <select id="tabs-select" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    v-model="selectedReportName" @change="onSelectChange">
                <option v-for="report in reports" :key="report.name" :value="report.name">{{ report.name }}</option>
            </select>
        </div>

        <!-- Bagian Navigasi untuk Perangkat Besar -->
        <div class="hidden sm:block">
            <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow" aria-label="Tabs">
                <router-link v-for="(report, reportIdx) in reports" :key="report.name" :to="report.to"
                    :class="tabClass(report, reportIdx)" @click="setActiveReport(report.name)">
                    <span>{{ report.name }}</span>
                    <span aria-hidden="true" :class="indicatorClass(report)" />
                </router-link>
            </nav>
        </div>

        <!-- Bagian Tampilan Konten -->
        <div class="bg-white p-3 rounded-md mt-3 shadow-md">
            <router-view />
        </div>
    </div>
</template>

<script setup>
import { ref, watchEffect } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const reports = ref([
    { name: 'Orders Report', to: { name: 'reports.orders' } },
    { name: 'Customers Report', to: { name: 'reports.customers' } },
]);

const selectedReport = ref(reports.value[0].name);
const selectedReportName = ref(reports.value[0].name);

// Fungsi untuk mengatur kelas tab
const tabClass = (report, reportIdx) => [
    report.name === selectedReport.value ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700',
    reportIdx === 0 ? 'rounded-l-lg' : '',
    reportIdx === reports.value.length - 1 ? 'rounded-r-lg' : '',
    'group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10'
];

// Fungsi untuk indikator aktif
const indicatorClass = (report) => [
    report.name === selectedReport.value ? 'bg-indigo-500' : 'bg-transparent',
    'absolute inset-x-0 bottom-0 h-0.5'
];

// Mengatur laporan aktif
const setActiveReport = (name) => {
    selectedReport.value = name;
};

const onSelectChange = () => {
    const selectedReport = reports.value.find(report => report.name === selectedReportName.value);
    if (selectedReport) {
        router.push(selectedReport.to);
    }
};

// Watch untuk rute
watchEffect(() => {
    const currentReport = reports.value.find(report => report.to.name === route.name);
    if (currentReport) {
        selectedReport.value = currentReport.name;
        selectedReportName.value = currentReport.name;
    }
});
</script>

<style scoped> /* Tambahkan gaya bila diperlukan */
</style>
