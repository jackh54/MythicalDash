<template>
    <CardComponent cardTitle="Advanced Settings"
        cardDescription="Configure advanced settings such as maintenance mode, debug mode, and cache duration.">
        <div class="space-y-4">
            <div>
                <label class="flex items-center">
                    <input v-model="advancedConfig.maintenance" type="checkbox"
                        class="rounded border-gray-700/50 bg-gray-800/50 text-purple-500 focus:ring-purple-500/50" />
                    <span class="ml-2 text-sm text-gray-300">Maintenance Mode</span>
                </label>
            </div>
            <div>
                <label class="flex items-center">
                    <input v-model="advancedConfig.debug" type="checkbox"
                        class="rounded border-gray-700/50 bg-gray-800/50 text-purple-500 focus:ring-purple-500/50" />
                    <span class="ml-2 text-sm text-gray-300">Debug Mode</span>
                </label>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Cache Duration (minutes)</label>
                <TextInput v-model="advancedConfig.cacheDuration" type="number"
                    class="w-full md:w-1/3 bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50" />
            </div>
            <div class="mt-6">
                <hr class="border-gray-700/50">
            </div>
            <div class="mt-4 flex space-x-4">
                <button @click="saveEmailSettings"
                    class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded text-sm font-medium transition-colors">
                    Save Settings
                </button>
                <button @click="testEmailConnection"
                    class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded text-sm font-medium transition-colors">
                    Test Connection
                </button>
            </div>
        </div>
    </CardComponent>
</template>
<script setup>
import { ref } from 'vue';
import CardComponent from '@/components/ui/Card/CardComponent.vue';
import TextInput from '@/components/ui/TextForms/TextInput.vue';
import SelectInput from '@/components/ui/TextForms/SelectInput.vue';



const advancedConfig = ref({
    maintenance: false,
    debug: false,
    cacheDuration: 60,
})
</script>