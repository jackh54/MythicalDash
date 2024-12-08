<script setup lang="ts">
import { onMounted } from 'vue';
import { computed } from 'vue';

const props = defineProps({
    modelValue: String,
    options: {
        type: Array as () => Array<{ value: string; label: string }>,
        default: () => [],
    },
    inputClass: {
        type: String,
        default:
            'w-full bg-gray-800/50 border border-gray-700/50 rounded-lg pl-4 pr-10 py-2 text-sm text-gray-100 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50 focus:outline-none',
    },
});

const emit = defineEmits(['update:modelValue']);

const inputValue = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value),
});

onMounted(() => {
    if (!props.modelValue && props.options.length > 0) {
        emit('update:modelValue', props.options[0].value);
    }
});
</script>
<template>
    <select v-model="inputValue" :class="inputClass">
        <option v-for="option in options" :key="option.value" :value="option.value" class="bg-gray-900 text-gray-300">
            {{ option.label }}
        </option>
    </select>
</template>
