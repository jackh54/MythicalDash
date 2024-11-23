<template>
  <LayoutDashboard>
    <!-- Tabs -->
    <div class="overflow-x-auto -mx-6 px-6 mb-6 border-b border-gray-800">
      <div class="flex space-x-6 min-w-max">
        <button
          v-for="tab in tabs"
          :key="tab.name"
          class="flex items-center gap-2 px-4 py-2 text-sm font-medium -mb-px whitespace-nowrap"
          :class="[
            activeTab === tab.name
              ? 'text-purple-400 border-b-2 border-purple-400'
              : 'text-gray-400 hover:text-gray-300',
          ]"
          @click="activeTab = tab.name"
        >
          <component :is="tab.icon" class="w-4 h-4" />
          {{ tab.name }}
        </button>
      </div>
    </div>

    <SettingsTab v-if="activeTab === 'Settings'" />
    <SecurityTab v-if="activeTab === 'Security'" />
    <MailsTab v-if="activeTab === 'Mails'" />
    <ActivitiesTab v-if="activeTab === 'Activities'" />
    <ApiKeysTab v-if="activeTab === 'API Keys'" />
  </LayoutDashboard>
</template>

<script setup>
import LayoutDashboard from '../components/LayoutDashboard.vue'
import SettingsTab from '../components/Dashboard/Account/Settings.vue'
import SecurityTab from '../components/Dashboard/Account/Security.vue'
import MailsTab from '../components/Dashboard/Account/Mails.vue'
import ActivitiesTab from '../components/Dashboard/Account/Activities.vue'
import ApiKeysTab from '../components/Dashboard/Account/ApiKeys.vue'

import { ref } from 'vue'
import {
  Settings as SettingsIcon,
  Lock as SecurityIcon,
  Mail as MailIcon,
  Bell as ActivityIcon,
  Key as ApiKeyIcon,
} from 'lucide-vue-next'

const activeTab = ref('Settings')

const tabs = [
  { name: 'Settings', icon: SettingsIcon },
  { name: 'Security', icon: SecurityIcon },
  { name: 'Mails', icon: MailIcon },
  { name: 'Activities', icon: ActivityIcon },
  { name: 'API Keys', icon: ApiKeyIcon },
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
