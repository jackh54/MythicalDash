<script setup lang="ts">
import { ref } from 'vue';
import CardComponent from '@/components/ui/Card/CardComponent.vue';
import TextInput from '@/components/ui/TextForms/TextInput.vue';
import SelectInput from '@/components/ui/TextForms/SelectInput.vue';

const emailConfig = ref({
    host: 'smtp.mythicalsystems.xyz',
    port: '587',
    username: 'noreply@mythicalsystems.xyz',
    password: '',
    fromEmail: 'noreply@mythicalsystems.xyz',
    encryption: 'tls',
});

function testEmailConnection() {}

function saveEmailSettings() {}
</script>

<template>
    <CardComponent
        cardTitle="Email Settings"
        cardDescription="Use our fancy email server to send emails for password resets logins or other cool stuff!"
    >
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">SMTP Host</label>
                <TextInput
                    v-model="emailConfig.host"
                    type="text"
                    class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">SMTP Port</label>
                <TextInput
                    v-model="emailConfig.port"
                    type="number"
                    class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Username</label>
                <TextInput
                    v-model="emailConfig.username"
                    type="text"
                    class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Password</label>
                <TextInput
                    v-model="emailConfig.password"
                    type="password"
                    class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">From Email</label>
                <TextInput
                    v-model="emailConfig.fromEmail"
                    type="email"
                    class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Encryption</label>
                <SelectInput
                    v-model="emailConfig.encryption"
                    :options="[
                        { value: 'tls', label: 'TLS' },
                        { value: 'ssl', label: 'SSL' },
                        { value: 'none', label: 'None' },
                    ]"
                    class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                />
            </div>
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
    </CardComponent>
</template>
