<script setup lang="ts">
import { ref } from 'vue';
import LayoutAccount from './Layout.vue';
import TextInput from '@/components/ui/TextForms/TextInput.vue';
import CardComponent from '@/components/ui/Card/CardComponent.vue';
import Session from '@/mythicalclient/Session';

const form = ref({
    firstName: Session.getInfo('first_name'),
    lastName: Session.getInfo('last_name'),
    email: Session.getInfo('email'),
    avatar: Session.getInfo('avatar'),
    background: Session.getInfo('background'),
});
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

    <!-- Settings Form -->
    <CardComponent
        cardTitle="Deactivate Account"
        cardDescription="Once you deactivate your account, there is no going back. Please be certain."
    >
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block">
                        <span class="block text-sm font-medium text-gray-400 mb-1.5">First name</span>
                        <TextInput v-model="form.firstName" name="firstName" id="firstName" />
                    </label>
                </div>
                <div>
                    <label class="block">
                        <span class="block text-sm font-medium text-gray-400 mb-1.5">Email</span>
                        <TextInput type="email" v-model="form.email" name="email" id="email" />
                    </label>
                </div>
                <div>
                    <label class="block">
                        <span class="block text-sm font-medium text-gray-400 mb-1.5">Background</span>
                        <TextInput type="url" v-model="form.background" name="background" id="background" />
                    </label>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block">
                        <span class="block text-sm font-medium text-gray-400 mb-1.5">Last name</span>
                        <TextInput type="text" v-model="form.lastName" name="lastName" id="lastName" />
                    </label>
                </div>
                <div>
                    <label class="block">
                        <span class="block text-sm font-medium text-gray-400 mb-1.5">Avatar</span>
                        <TextInput type="url" v-model="form.avatar" name="avatar" id="avatar" />
                    </label>
                </div>
            </div>
        </div>
        <br />
        <div class="flex flex-wrap gap-3">
            <button
                type="button"
                class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded text-sm font-medium transition-colors"
            >
                Save changes
            </button>
            <button
                type="button"
                class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded text-sm font-medium transition-colors"
            >
                Reset
            </button>
        </div>
    </CardComponent>
    <br />
    <CardComponent
        cardTitle="Deactivate Account"
        cardDescription="Once you deactivate your account, there is no going back. Please be certain."
    >
        <div class="space-y-4">
            <p class="text-sm text-gray-300">
                Once you deactivate your account, there is no going back. Please be certain.
            </p>
            <p class="text-sm text-gray-300">
                Once you delete your account, there is a 30 days window for you to contact support to recover your
                account. After 30 days, your account will be permanently disabled.
            </p>
            <p class="text-sm text-gray-300">
                This means that your account will be marked as deleted BUT we reserve the right to keep all the data for
                legal reasons. You may open a ticket for your data to be anonymized due to GDPR!
            </p>
            <br />
            <button
                type="button"
                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm font-medium transition-colors"
            >
                Deactivate account
            </button>
        </div>
    </CardComponent>
</template>
