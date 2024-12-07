<script setup lang="ts">
import { ShieldAlertIcon } from 'lucide-vue-next';
import ErrorPage from '@/components/Errors/ErrorPage.vue';
import Translation from '@/mythicalclient/Translation';
</script>

<template>
    <ErrorPage
        :icon="ShieldAlertIcon"
        :title="Translation.getTranslation('errors.forbidden.title')"
        :message="Translation.getTranslation('errors.forbidden.message')"
    />
</template>
