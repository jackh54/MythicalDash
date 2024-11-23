<script setup lang="ts">
import { ref, reactive } from 'vue'
import Layout from '@/components/Layout.vue'
import FormCard from '@/components/Auth/FormCard.vue'
import FormInput from '@/components/Auth/FormInput.vue'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'

const router = useRouter()
const { t } = useI18n()

const loading = ref(false)
const form = reactive({
  email: '',
})

document.title = t('auth.pages.forgot_password.page.title')

const handleSubmit = async () => {
  loading.value = true
  try {
    await new Promise((resolve) => setTimeout(resolve, 1000))
    console.log('Forgot password submitted:', form)
  } catch (error) {
    console.error('Forgot password failed:', error)
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <Layout>
    <FormCard :title="$t('auth.pages.forgot_password.page.subTitle')" @submit="handleSubmit">
      <FormInput
        id="email"
        :label="$t('auth.pages.forgot_password.page.form.email.label')"
        v-model="form.email"
        :placeholder="$t('auth.pages.forgot_password.page.form.email.placeholder')"
        required
      />

      <button
        type="submit"
        class="w-full mt-6 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors"
        :disabled="loading"
      >
        {{
          loading
            ? t('auth.pages.forgot_password.page.form.reset_button.loading')
            : t('auth.pages.forgot_password.page.form.reset_button.label')
        }}
      </button>

      <p class="mt-4 text-center text-sm text-gray-400">
        {{ t('auth.pages.forgot_password.page.form.login.label') }}
        <router-link to="/auth/login" class="text-purple-400 hover:text-purple-300">
          {{ t('auth.pages.forgot_password.page.form.login.link') }}
        </router-link>
      </p>
    </FormCard>
  </Layout>
</template>
