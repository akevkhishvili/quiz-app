<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import { computed } from 'vue'
const user = computed(() => usePage().props.auth.user)

const props = defineProps({
    modes: Object,
    scores:Object,
    errors: Object,
})

const form = useForm({
    question_mode_id: null
})

const submit = () => {
    form.get(route('start'));
};

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
                    <div v-if="$page.props.flash.error"
                         id="alert-additional-content-3"
                         class="custom-error-alert"
                         role="alert">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Info</span>
                            <h3 class="text-lg font-medium">error</h3>
                        </div>
                        <div class="mt-2 mb-4 text-sm">
                            {{ $page.props.flash.error }}
                        </div>
                    </div>
                    <div class="p-6 text-gray-900 flex flex-col items-center justify-center">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="mode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                    question mode</label>
                                <select id="mode" v-model="form.question_mode_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option
                                        v-for="(mode, index) in modes"
                                        :value="mode.id"
                                        :key="index">
                                        {{ mode.name }}
                                    </option>
                                </select>
                                <div v-if="form.errors.email">{{ form.errors.email }}</div>

                                <div v-if="errors.question_mode_id">
                                    <p class="text-sm text-red-600">
                                        {{ errors.question_mode_id }}
                                    </p>
                                </div>
                            </div>
                            <div class="p-6 text-gray-900 flex flex-col items-center justify-center">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 ">
                                    Start Quiz
                                </button>
                            </div>
                        </form>
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
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        email
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        correct answers
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        unanswered questions
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        total time
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(score, index) in props.scores" :key="index"
                                    class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                        {{score.user.name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{score.user.email}}
                                    </td>
                                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                        {{score.total_correct_answers}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{score.unanswered_questions}}
                                    </td>
                                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                        {{score.total_quiz_time}} sec
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
