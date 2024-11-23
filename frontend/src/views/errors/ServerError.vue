<template>
  <ErrorPage
    :icon="ShieldAlertIcon"
    title="500 - Server Error"
    message="Houston, we have a problem! Our servers are experiencing some cosmic interference. Please try again later."
  />
</template>

<script setup>
import { ShieldAlertIcon } from 'lucide-vue'
import ErrorPage from '@/components/Errors/ErrorPage.vue'
</script>
