<script setup lang="ts">
import { FileQuestionIcon } from 'lucide-vue-next';
import ErrorPage from '@/components/client/Errors/ErrorPage.vue';
import Translation from '@/mythicalclient/Translation';
</script>
<template>
    <ErrorPage
        :icon="FileQuestionIcon"
        :title="Translation.getTranslation('errors.notfound.title')"
        :message="Translation.getTranslation('errors.notfound.message')"
    />
</template>
