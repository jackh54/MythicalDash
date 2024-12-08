<script setup lang="ts">
import { ref } from 'vue';
import CardComponent from '@/components/client/ui/Card/CardComponent.vue';

const advancedConfig = ref({
    maintenance: false,
    debug: false,
    cacheDuration: 60,
});

function saveEmailSettings() {}

function testEmailConnection() {}
</script>
<template>
    <CardComponent
        cardTitle="Advanced Settings"
        cardDescription="Configure advanced settings such as maintenance mode, debug mode, and cache duration."
    >
        <div class="space-y-4">
            <div>
                <label class="flex items-center">
                    <input
                        v-model="advancedConfig.maintenance"
                        type="checkbox"
                        class="rounded border-gray-700/50 bg-gray-800/50 text-purple-500 focus:ring-purple-500/50"
                    />
                    <span class="ml-2 text-sm text-gray-300">Maintenance Mode</span>
                </label>
            </div>
            <div>
                <label class="flex items-center">
                    <input
                        v-model="advancedConfig.debug"
                        type="checkbox"
                        class="rounded border-gray-700/50 bg-gray-800/50 text-purple-500 focus:ring-purple-500/50"
                    />
                    <span class="ml-2 text-sm text-gray-300">Debug Mode</span>
                </label>
            </div>
            <div class="mt-6">
                <hr class="border-gray-700/50" />
            </div>
            <div class="mt-4 flex space-x-4">
                <button
                    @click="saveEmailSettings"
                    class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded text-sm font-medium transition-colors"
                >
                    Save Settings
                </button>
                <button
                    @click="testEmailConnection"
                    class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded text-sm font-medium transition-colors"
                >
                    Test Connection
                </button>
            </div>
        </div>
    </CardComponent>
</template>
