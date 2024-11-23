<template>
  <CardComponent cardTitle="Security Settings" cardDescription="Manage your security preferences.">
    <div class="space-y-6">
      <!-- Security Settings -->
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <label class="block text-sm font-medium text-gray-400"
            >Enable Two-Factor Authentication</label
          >
          <SelectInput
            v-model="securityConfig.twoFactorAuth"
            :options="[
              { value: true, label: 'Enabled' },
              { value: false, label: 'Disabled' },
            ]"
            class="w-1/2"
          />
        </div>
        <div class="flex items-center justify-between">
          <label class="block text-sm font-medium text-gray-400">Password Expiration (days)</label>
          <TextInput
            v-model="securityConfig.passwordExpiration"
            type="number"
            class="w-1/2 bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
          />
        </div>
        <div class="flex items-center justify-between">
          <label class="block text-sm font-medium text-gray-400">Account Lockout Threshold</label>
          <TextInput
            v-model="securityConfig.lockoutThreshold"
            type="number"
            class="w-1/2 bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
          />
        </div>
        <div class="flex items-center justify-between">
          <label class="block text-sm font-medium text-gray-400">Session Timeout (minutes)</label>
          <TextInput
            v-model="securityConfig.sessionTimeout"
            type="number"
            class="w-1/2 bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
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
<script setup>
import { ref } from 'vue'
import CardComponent from '@/components/ui/Card/CardComponent.vue'
import TextInput from '@/components/ui/TextForms/TextInput.vue'
import SelectInput from '@/components/ui/TextForms/SelectInput.vue'

const securityConfig = ref({
  twoFactorAuth: true,
  passwordExpiration: 90,
  lockoutThreshold: 5,
  sessionTimeout: 15,
})
</script>
