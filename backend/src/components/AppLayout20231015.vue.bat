<template>
    <div>
        <!-- Sidebar -->
       <Sidebar :sidebarOpen="sidebarOpen" />
       <div class="lg:pl-72">
        <!--/ Sidebar -->
            <TopHeader :sidebarOpen="sidebarOpen" @toggle-sidebar="toggleSidebar"></TopHeader>

            <!-- content -->
            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    <!-- Your content -->
                    <router-view></router-view>
                </div>
            </main>
            <!-- content -->
        </div>
    </div>
</template>

<script setup>
    import Sidebar from "./Sidebar.vue"
    import TopHeader from "./TopHeader.vue"

    import { ref } from 'vue'
    import {
        Dialog,
        DialogPanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot,
    } from '@headlessui/vue'
    import {
        Bars3Icon,
        BellIcon,
        CalendarIcon,
        ChartPieIcon,
        Cog6ToothIcon,
        DocumentDuplicateIcon,
        FolderIcon,
        HomeIcon,
        UsersIcon,
        XMarkIcon,
    } from '@heroicons/vue/24/outline'
    import { ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid'

    const navigation = [
        { name: 'Dashboard', href: '#', icon: HomeIcon, current: true },
        { name: 'Team', href: '#', icon: UsersIcon, current: false },
        { name: 'Projects', href: '#', icon: FolderIcon, current: false },
        { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
        { name: 'Documents', href: '#', icon: DocumentDuplicateIcon, current: false },
        { name: 'Reports', href: '#', icon: ChartPieIcon, current: false },
    ]
    const teams = [
        { id: 1, name: 'Heroicons', href: '#', initial: 'H', current: false },
        { id: 2, name: 'Tailwind Labs', href: '#', initial: 'T', current: false },
        { id: 3, name: 'Workcation', href: '#', initial: 'W', current: false },
    ]
    const userNavigation = [
        { name: 'Your profile', href: '#' },
        { name: 'Sign out', href: '#' },
    ]


    const sidebarOpen = ref(false)

    const toggleSidebar = () => {
        sidebarOpen.value = !sidebarOpen.value
    }


    
</script>

<style scoped>
</style>
