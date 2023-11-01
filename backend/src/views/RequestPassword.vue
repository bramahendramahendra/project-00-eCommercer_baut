<template>
    <GuestLayout title="Request new password">
        <form class="space-y-6" action="#" method="POST">
            <div class="relative -space-y-px rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-0 z-10 rounded-md ring-1 ring-inset ring-gray-300" />
                <div>
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required="" class="relative block w-full rounded border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Email address" />
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="text-sm leading-6">
                    <router-link :to="{name: 'login'}" class="font-semibold text-indigo-600 hover:text-indigo-500">Remember your password?</router-link>
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
    import GuestLayout from "../components/GuestLayout.vue";
</script>