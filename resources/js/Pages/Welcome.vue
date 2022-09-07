<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<template>

    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0 mx-auto">
        <div v-if="canLogin" class="hidden fixed top-0  px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('animal.index')" class="text-lg text-gray-700 dark:text-gray-500 underline block mx-auto">Dashboard</Link>

            <template v-else class="">
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline ">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div>
        
        <div class="max-w-6xl sm:px-6 lg:px-8 justify-center mx-auto">
            <img src="/images/animalWelcome.png" class="scale-75	" alt="...">
            <h1 class="text-center text-3xl">Welcome!</h1>
        </div>
    </div>

</template>
