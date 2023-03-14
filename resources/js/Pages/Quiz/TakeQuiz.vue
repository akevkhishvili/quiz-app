<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    time_left: Number,
    question: Object,
    user_question_id: Number,
})

const form = useForm({
    id: props.question.id,
    user_question_id: props.user_question_id,
    answer_id: null
})

const submit = () => {
    form.post(route('quiz.question.submit'));
};

let disabled = false;

</script>

<script>
export default {
    props: {
        params:{
            time_left: Object.data,
        }
    },
    data() {
        return {
            countDown: this.time_left
        }
    },
    methods: {
        countDownTimer() {
            if (this.countDown > 0) {
                setTimeout(() => {
                    this.countDown -= 1
                    this.countDownTimer()
                }, 1000)
                if (this.countDown <= 1) {
                    window.location.reload()
                }
            }
        }
    },
    created() {
        this.countDownTimer()
    },
}
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <nav class="flex mb-5" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                <li class="inline-flex items-center">
                                    <Link :href="route('dashboard')"
                                          class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                        </svg>
                                        Dashboard
                                    </Link>
                                </li>

                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                                            add</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <div>
                            <span class="countdown font-mono text-6xl">{{ countDown }}</span>
                        </div>
                        <div v-if="$page.props.flash.message"
                             id="alert-additional-content-3"
                             class="custom-info-alert"
                             role="alert">
                            <div class="mt-2 mb-4 text-sm">
                                {{ $page.props.flash.message }}
                            </div>
                        </div>
                        <p class="text-2xl mb-2">question:</p>
                        <form @submit.prevent="submit">
                            <div>
                                <p class="mb-3">{{ props.question.question }}</p>
                                <div v-for="(answer, index) in props.question.answer"
                                     class="flex items-center mb-4">
                                    <input
                                        :disabled="$page.props.flash.message ? '' : disabled"
                                        v-model="form.answer_id" :id="index + 'default-radio'"
                                        type="radio" :value="answer.id"
                                        name="default-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-radio-1"
                                           class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ answer.text }}
                                    </label>
                                </div>
                                <InputError class="mt-2" :message="form.errors.answer_id"/>
                            </div>
                            <button :disabled="form.processing" v-if="!$page.props.flash.message"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 ">
                                submit
                            </button>
                        </form>
                        <div v-if="$page.props.flash.message">
                            <Link :href="route('quiz.confirm',[props.user_question_id])"
                                  :data="{ user_question_id: props.user_question_id }"
                                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 ">
                                Next
                            </Link>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

