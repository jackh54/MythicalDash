<script setup lang="ts">
import { ref } from 'vue';
import LayoutAccount from './Layout.vue';
import CardComponent from '@/components/ui/Card/CardComponent.vue';

const is2FAEnabled = ref(false);

const enable2FA = () => {
    // Add logic to enable 2FA
    is2FAEnabled.value = true;
    alert('2FA enabled successfully');
};

const disable2FA = () => {
    // Add logic to disable 2FA
    is2FAEnabled.value = false;
    alert('2FA disabled successfully');
};
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

<template>
    <!-- User Info -->
    <LayoutAccount />

    <!-- Change Password -->
    <CardComponent cardTitle="Change your Password" cardDescription="You want to change the password of your account?">
        <button
            type="submit"
            class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded text-sm font-medium transition-colors"
        >
            Change Password
        </button>
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
