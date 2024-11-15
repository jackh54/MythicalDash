<template>
    <ErrorPage :icon="FileQuestionIcon" title="404 - Page Not Found"
        message="Oops! It seems like you've ventured into uncharted space. This page doesn't exist in our star system." />
</template>

<script setup>
import { FileQuestionIcon } from 'lucide-vue-next'
import ErrorPage from './../../components/Errors/ErrorPage.vue'
</script>