<template>
  <CardComponent cardTitle="Settings" cardDescription="Customize your application settings.">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Basic Settings -->
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Application Name</label>
          <TextInput
            v-model="serverConfig.appName"
            type="text"
            class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Domain</label>
          <TextInput
            v-model="serverConfig.domain"
            type="text"
            class="w-full bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Application Logo</label>
          <div class="flex items-center gap-4">
            <img
              :src="serverConfig.logo || '/placeholder.svg?height=40&width=40'"
              alt="Logo"
              class="w-10 h-10 rounded bg-gray-700"
            />
            <TextInput
              v-model="serverConfig.logo"
              type="text"
              placeholder="Enter logo URL"
              class="flex-1 bg-gray-800/50 border border-gray-700/50 rounded px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50"
            />
            <button
              type="button"
              class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded text-sm font-medium transition-colors"
            >
              Upload
            </button>
          </div>
        </div>
      </div>

      <!-- Theme Settings -->
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Theme</label>
          <SelectInput
            v-model="serverConfig.theme"
            :options="[
              { value: 'mythicalui', label: 'MythicalUI' },
              { value: 'vuexy', label: 'Vuexy' },
              { value: 'hopeui', label: 'HopeUI' },
            ]"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Accent Color</label>
          <div class="flex flex-wrap gap-2 ml-1">
            <button
              v-for="color in accentColors"
              :key="color.value"
              @click="serverConfig.accentColor = color.value"
              class="w-10 h-10 rounded-full border-2 focus:outline-none"
              :class="[
                color.class,
                serverConfig.accentColor === color.value ? 'border-white' : 'border-transparent',
              ]"
            />
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Language</label>
          <SelectInput
            v-model="serverConfig.language"
            :options="[
              { value: 'en', label: 'English' },
              { value: 'es', label: 'Español' },
              { value: 'fr', label: 'Français' },
              { value: 'de', label: 'Deutsch' },
              { value: 'it', label: 'Italiano' },
              { value: 'pt', label: 'Português' },
              { value: 'ru', label: 'Русский' },
              { value: 'zh', label: '中文' },
            ]"
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

const serverConfig = ref({
  appName: 'MythicalSystems',
  domain: 'mythicalsystems.xyz',
  logo: 'https://github.com/mythicalltd.png',
  theme: 'mythicalui',
  accentColor: 'purple',
})

const accentColors = [
  { value: 'purple', class: 'bg-purple-500' },
  { value: 'blue', class: 'bg-blue-500' },
  { value: 'green', class: 'bg-green-500' },
  { value: 'red', class: 'bg-red-500' },
  { value: 'yellow', class: 'bg-yellow-500' },
  { value: 'pink', class: 'bg-pink-500' },
]
</script>
