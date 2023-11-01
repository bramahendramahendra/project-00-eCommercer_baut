<template>
    <GuestLayout title="Set new password">
        <form class="space-y-6" action="#" method="POST">
            <div class="relative -space-y-px rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-0 z-10 rounded-md ring-1 ring-inset ring-gray-300" />
                <div>
                    <label for="new-password" class="sr-only">New Password</label>
                    <input id="new-password" name="password" type="password" required="" class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="New Password" />
                </div>
                <div>
                    <label for="password-repeat" class="sr-only">Repeat Password</label>
                    <input id="password-repeat" name="password_repeat" type="password" required="" class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Repeat Password" />
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="text-sm leading-6">
                    <router-link :to="{name: 'login'}" class="font-semibold text-indigo-600 hover:text-indigo-500">
                        Go back to Login
                    </router-link>
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