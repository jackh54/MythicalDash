<template>
    <ErrorPage
        :icon="ShieldAlertIcon"
        title="500 - Server Error"
        message="Houston, we have a problem! Our servers are experiencing some cosmic interference. Please try again later."
    />
</template>

<script setup lang="ts">
import { ShieldAlertIcon } from 'lucide-vue-next';
import ErrorPage from '@/components/Errors/ErrorPage.vue';
</script>
