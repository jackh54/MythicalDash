<script setup lang="ts">
import { useRouter } from 'vue-router';
const router = useRouter();
import Layout from './../Layout.vue';

defineProps({
    icon: {
        type: Object,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    message: {
        type: String,
        required: true,
    },
});

const goBack = () => {
    router.back();
};

const goHome = () => {
    router.push('/');
};
</script>
<template>
    <Layout>
        <div class="w-full max-w-md bg-[#12121f]/90 backdrop-blur-sm rounded-lg shadow-xl p-8 text-center">
            <div class="mb-6">
                <component :is="icon" class="w-20 h-20 mx-auto text-purple-500" />
            </div>
            <h1 class="text-3xl font-bold text-white mb-4">{{ title }}</h1>
            <p class="text-gray-400 mb-8">{{ message }}</p>
            <div class="flex justify-center space-x-4">
                <button
                    @click="goBack"
                    class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors"
                >
                    Go Back
                </button>
                <button
                    @click="goHome"
                    class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors"
                >
                    Go Home
                </button>
            </div>
        </div>
    </Layout>
</template>
