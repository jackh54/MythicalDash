<template>
  <div class="space-y-4">
    <!-- Table Card -->
    <div class="bg-gray-900/50 border border-gray-800 rounded-lg p-4">
      <div v-if="cardTitle" class="relative overflow-x-auto">
        <div class="mb-4">
          <h2 class="text-lg font-semibold text-gray-200">{{ cardTitle }}</h2>
          <p class="text-sm text-gray-400 mt-2">{{ cardDescription }}</p>
        </div>
      </div>
      <div v-if="cardTitle" class="my-1 border-t border-gray-700"></div>
      <br v-if="cardTitle" />
      <slot></slot>
    </div>
  </div>
</template>
<script setup>
const props = defineProps({
  cardTitle: {
    type: String,
    required: true,
  },
  cardDescription: {
    type: String,
    required: true,
  },
})
</script>
