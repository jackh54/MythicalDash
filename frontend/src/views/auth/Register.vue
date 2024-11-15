<template>
    <Layout>
        <FormCard :title="t('auth.pages.register.page.title')" @submit="handleSubmit">
            <div class="flex space-x-4">
                <FormInput id="firstName" :label="t('auth.pages.register.page.form.firstName.label')"
                    v-model="form.firstName" :placeholder="t('auth.pages.register.page.form.firstName.placeholder')"
                    required />
                <FormInput id="lastName" :label="t('auth.pages.register.page.form.lastName.label')"
                    v-model="form.lastName" :placeholder="t('auth.pages.register.page.form.lastName.placeholder')"
                    required />
            </div>
            <FormInput id="username" :label="t('auth.pages.register.page.form.username.label')" v-model="form.username"
                :placeholder="t('auth.pages.register.page.form.username.placeholder')" required />
            <FormInput id="email" :label="t('auth.pages.register.page.form.email.label')" v-model="form.email"
                :placeholder="t('auth.pages.register.page.form.email.placeholder')" required />

            <div class="flex items-center justify-between mb-2">
                <label class="block text-sm text-gray-400">{{ t('auth.pages.register.page.form.password.label')
                    }}</label>
            </div>

            <FormInput id="password" type="password" v-model="form.password"
                :placeholder="t('auth.pages.register.page.form.password.placeholder')" required />

            <button type="submit"
                class="w-full mt-6 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors"
                :disabled="loading">
                {{ loading ? t('auth.pages.register.page.form.register_button.loading') :
                    t('auth.pages.register.page.form.register_button.label') }}
            </button>

            <p class="mt-4 text-center text-sm text-gray-400">
                {{ t('auth.pages.register.page.form.login.label') }}
                <router-link to="/auth/login" class="text-purple-400 hover:text-purple-300">
                    {{ t('auth.pages.register.page.form.login.link') }}
                </router-link>
            </p>
        </FormCard>
    </Layout>
</template>

<script setup>
import { ref, reactive } from 'vue'
import Layout from './../../components/Layout.vue'
import FormCard from './../../components/Auth/FormCard.vue'
import FormInput from './../../components/Auth/FormInput.vue'
import { useI18n } from 'vue-i18n'
const { t } = useI18n()

const loading = ref(false)
const form = reactive({
    firstName: '',
    lastName: '',
    username: '',
    email: '',
    password: ''
})

const handleSubmit = async () => {
    loading.value = true
    try {
        // Implement your register logic here
        await new Promise(resolve => setTimeout(resolve, 1000))
        console.log('Register submitted:', form)
    } catch (error) {
        console.error('Register failed:', error)
    } finally {
        loading.value = false
    }
}
</script>