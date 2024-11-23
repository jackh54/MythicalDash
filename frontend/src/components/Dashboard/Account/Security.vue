<template>
  <!-- User Info -->
  <LayoutAccount />

  <!-- Change Password -->
  <CardComponent
    cardTitle="Change your Password"
    cardDescription="You want to change the password of your account?"
  >
    <form @submit.prevent="changePassword">
      <div class="mb-4">
        <label for="currentPassword" class="block text-sm font-medium text-gray-400 mb-1.5"
          >Current Password</label
        >
        <TextInput type="password" v-model="currentPassword" name="password" id="password" />
      </div>
      <div class="mb-4">
        <label for="newPassword" class="block text-sm font-medium text-gray-400 mb-1.5"
          >New Password</label
        >
        <TextInput type="password" v-model="newPassword" name="password" id="password" />
      </div>
      <br />
      <button
        type="submit"
        class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded text-sm font-medium transition-colors"
      >
        Change Password
      </button>
    </form>
  </CardComponent>
  <br />
  <!-- Two-Factor Authentication (2FA) -->
  <CardComponent
    cardTitle="Two-Factor Authentication (2FA)"
    cardDescription="You want to be sure your account will not be stolen?"
  >
    <div v-if="is2FAEnabled" class="flex items-center justify-between">
      <p class="text-sm text-gray-100">2FA is currently enabled.</p>
      <button
        @click="disable2FA"
        class="ml-4 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors"
      >
        Disable 2FA
      </button>
    </div>
    <div v-else class="flex items-center justify-between">
      <p class="text-sm text-gray-100">2FA is currently disabled.</p>
      <button
        @click="enable2FA"
        class="ml-4 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors"
      >
        Enable 2FA
      </button>
    </div>
  </CardComponent>
</template>

<script setup>
import { ref } from 'vue'
import LayoutAccount from './Layout.vue'
import TextInput from '@/components/ui/TextForms/TextInput.vue'
import CardComponent from '@/components/ui/Card/CardComponent.vue'

const currentPassword = ref('')
const newPassword = ref('')
const is2FAEnabled = ref(false)

const changePassword = () => {
  // Add logic to change the password
  alert('Password changed successfully')
}

const enable2FA = () => {
  // Add logic to enable 2FA
  is2FAEnabled.value = true
  alert('2FA enabled successfully')
}

const disable2FA = () => {
  // Add logic to disable 2FA
  is2FAEnabled.value = false
  alert('2FA disabled successfully')
}
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
