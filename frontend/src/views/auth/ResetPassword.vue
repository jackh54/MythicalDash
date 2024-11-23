<template>
    <Layout>
        <FormCard title="Reset Password" @submit="handleSubmit">
            <FormInput
                id="password"
                label="New Password"
                v-model="form.password"
                type="password"
                placeholder="Enter your new password"
                required
            />
            <FormInput
                id="confirmPassword"
                label="Confirm Password"
                v-model="form.confirmPassword"
                type="password"
                placeholder="Confirm your new password"
                required
            />

            <button
                type="submit"
                class="w-full mt-6 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors"
                :disabled="loading"
            >
                {{ loading ? 'Submitting...' : 'Submit' }}
            </button>

            <p class="mt-4 text-center text-sm text-gray-400">
                Remembered your password?
                <router-link to="/auth/login" class="text-purple-400 hover:text-purple-300"> Login </router-link>
            </p>
        </FormCard>
    </Layout>
</template>

<script setup lang="ts">
import { ref, reactive } from 'vue';
import Layout from '@/components/Layout.vue';
import FormCard from '@/components/Auth/FormCard.vue';
import FormInput from '@/components/Auth/FormInput.vue';

const loading = ref(false);
const form = reactive({
    password: '',
    confirmPassword: '',
});

const handleSubmit = async () => {
    if (form.password !== form.confirmPassword) {
        alert('Passwords do not match');
        return;
    }

    loading.value = true;
    try {
        // Implement your reset password logic here
        await new Promise((resolve) => setTimeout(resolve, 1000));
        console.log('Password reset submitted:', form);
    } catch (error) {
        console.error('Password reset failed:', error);
    } finally {
        loading.value = false;
    }
};
</script>
