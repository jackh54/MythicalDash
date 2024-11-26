<script setup lang="ts">
import { FileQuestionIcon } from 'lucide-vue-next';
import ErrorPage from '@/components/Errors/ErrorPage.vue';
import Translation from '@/mythicalclient/Translation';

</script>
<template>
    <ErrorPage :icon="FileQuestionIcon" :title="Translation.getTranslation('errors.servererror.title')"
        :message="Translation.getTranslation('errors.servererror.message')" />
</template>
