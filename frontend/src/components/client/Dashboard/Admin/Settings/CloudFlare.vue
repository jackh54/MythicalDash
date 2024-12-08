<script setup lang="ts">
import { ref } from 'vue';
import CardComponent from '@/components/client/ui/Card/CardComponent.vue';
import TextInput from '@/components/client/ui/TextForms/TextInput.vue';
import SelectInput from '@/components/client/ui/TextForms/SelectInput.vue';

const fetchCloudflareData = async () => {
    try {
        const response = await fetch('/api/system/fetchcloudflaretrusedip');
        const data = await response.json();
        cloudflareConfig.value.trustedProxies = data.ipv4.join(', ');
    } catch (error) {
        console.error('Error fetching Cloudflare IPs:', error);
    }
};

const cloudflareConfig = ref({
    turnstileSiteKey: '',
    turnstileSecretKey: '',
    trustedProxies: '',
    securityLevel: 'essentially_off',
});
</script>
<template>
    <CardComponent cardTitle="Cloudflare Settings" cardDescription="Configure your Cloudflare settings.">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Cloudflare Turnstile Settings -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Turnstile Site Key</label>
                    <TextInput
                        v-model="cloudflareConfig.turnstileSiteKey"
                        type="text"
                        class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Turnstile Secret Key</label>
                    <TextInput
                        v-model="cloudflareConfig.turnstileSecretKey"
                        type="text"
                        class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                    />
                </div>
            </div>

            <!-- Cloudflare Proxies Settings -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Trusted Proxies</label>
                    <div class="flex items-center mt-2">
                        <TextInput
                            v-model="cloudflareConfig.trustedProxies"
                            type="text"
                            placeholder="Comma-separated list of IPs"
                            class="flex-grow bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                        />
                        <button
                            type="button"
                            @click="fetchCloudflareData"
                            class="ml-2 px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded text-sm font-medium transition-colors"
                        >
                            Fetch
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Security Level</label>
                    <SelectInput
                        v-model="cloudflareConfig.securityLevel"
                        :options="[
                            { value: 'essentially_off', label: 'Essentially Off' },
                            { value: 'low', label: 'Low' },
                            { value: 'medium', label: 'Medium' },
                            { value: 'high', label: 'High' },
                            { value: 'under_attack', label: 'Under Attack' },
                        ]"
                        class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
                    />
                </div>
            </div>
        </div>
        <div class="mt-6">
            <hr class="border-gray-700/50" />
        </div>
        <div class="flex justify-start mt-4">
            <button
                type="button"
                class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded text-sm font-medium transition-colors"
            >
                Save changes
            </button>
        </div>
    </CardComponent>
</template>
