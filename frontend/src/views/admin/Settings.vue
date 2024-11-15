<template>
    <LayoutDashboard>
        <div class="space-y-6">
            <!-- Tabs Navigation -->
            <div class="overflow-x-auto -mx-6 px-6 mb-6 border-b border-gray-800">
                <div class="flex space-x-6 min-w-max">
                    <button v-for="tab in tabs" :key="tab.name" @click="activeTab = tab.name"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium -mb-px whitespace-nowrap" :class="[
                            activeTab === tab.name
                                ? 'text-purple-400 border-b-2 border-purple-400'
                                : 'text-gray-400 hover:text-gray-300'
                        ]">
                        <component :is="tab.icon" class="w-4 h-4" />
                        {{ tab.name }}
                    </button>
                </div>
            </div>

            <!-- Server Configuration -->
            <div v-if="activeTab === 'Server'" class="space-y-6">
                <DashboardSettings  />
            </div>

            <!-- Security Configuration -->
            <div v-if="activeTab === 'Security'" class="space-y-6">
                <SecuritySettings />
            </div>

            <!-- Email Configuration -->
            <div v-if="activeTab === 'Email'" class="space-y-6">
                <EmailSettings />
            </div>

            <!-- Advanced Configuration -->
            <div v-if="activeTab === 'Advanced Settings'" class="space-y-6">
                <AdvancedSettings />
            </div>

            <!-- Cloudflare Configuration -->
            <div v-if="activeTab === 'CloudFlare'" class="space-y-6">
                <CloudFlareSettings />
            </div>
        </div>
    </LayoutDashboard>
</template>

<script setup>
import { ref } from 'vue'
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import DashboardSettings from '@/components/Dashboard/Admin/Settings/Dashboard.vue';
import SecuritySettings from '@/components/Dashboard/Admin/Settings/Security.vue';
import EmailSettings from '@/components/Dashboard/Admin/Settings/Email.vue';
import AdvancedSettings from '@/components/Dashboard/Admin/Settings/Advanced.vue';
import CloudFlareSettings from '../../components/Dashboard/Admin/Settings/CloudFlare.vue';

import {
    Settings as SettingsIcon,
    Mail as MailIcon,
    Shield as SecurityIcon,
    Settings as AdvancedSettingsIcon,
    Cloud as CloudIcon,
} from 'lucide-vue-next'

const activeTab = ref('Server')

const tabs = [
    { name: 'Server', icon: SettingsIcon },
    { name: 'Security', icon: SecurityIcon },
    { name: 'Email', icon: MailIcon },
    { name: 'Advanced Settings', icon: AdvancedSettingsIcon },
    { name: 'CloudFlare', icon: CloudIcon },
]



</script>

<style scoped>
/* Hide scrollbar for Chrome, Safari and Opera */
.overflow-x-auto::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.overflow-x-auto {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}
</style>