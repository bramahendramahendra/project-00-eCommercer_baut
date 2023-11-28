<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Dashboard</h1>
            </div>
        </div>
        <div>
            <h3 class="text-base font-semibold leading-6 text-gray-900 text-right">All Time</h3>
            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <UsersIcon class="h-6 w-6 text-white" aria-hidden="true" />
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Active Customers</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline ">
                        <p class="text-2xl font-semibold text-gray-900">15</p>
                    </dd>
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <UsersIcon class="h-6 w-6 text-white" aria-hidden="true" />
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Active Products</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline ">
                        <p class="text-2xl font-semibold text-gray-900">15</p>
                    </dd>
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <UsersIcon class="h-6 w-6 text-white" aria-hidden="true" />
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Paid Orders</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline ">
                        <p class="text-2xl font-semibold text-gray-900">15</p>
                    </dd>
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-5 pt-5 shadow sm:px-6 sm:pt-6 sm:pb-6">
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <UsersIcon class="h-6 w-6 text-white" aria-hidden="true" />
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Income</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline ">
                        <p class="text-2xl font-semibold text-gray-900">15</p>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</template>

<script setup>
import { UsersIcon, Square3Stack3DIcon } from '@heroicons/vue/24/outline'
</script>

<style scoped>

</style>