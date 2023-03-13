<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue'
const user = computed(() => usePage().props.auth.user)

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>

            <Link v-if="user.is_admin" :href="route('questions')"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Questions
            </Link>

            <button v-if="user.is_admin" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-1">
                User Quiz History
            </button>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="$page.props.flash.success" id="alert-additional-content-3" class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Info</span>
                            <h3 class="text-lg font-medium">success</h3>
                        </div>
                        <div class="mt-2 mb-4 text-sm">
                            {{ $page.props.flash.success }}
                        </div>
                    </div>
                    <div class="p-6 text-gray-900 flex flex-col items-center justify-center">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                            Start Quiz
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex flex-col items-center justify-center">
                        <H1 class="">
                            Top Scorers
                        </H1>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
