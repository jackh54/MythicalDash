<template>
    <ErrorPage
        :icon="ShieldAlertIcon"
        title="403 - Access Forbidden"
        message="Hold it right there, space traveler! You don't have the necessary clearance to access this area."
    />
</template>

<script setup lang="ts">
import { ShieldAlertIcon } from 'lucide-vue-next';
import ErrorPage from '@/components/Errors/ErrorPage.vue';
</script>
