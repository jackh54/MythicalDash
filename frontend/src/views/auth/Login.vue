<template>
  <Layout>
    <FormCard title="Login to Continue" @submit="handleSubmit">
      <FormInput id="email" :label="$t('auth.pages.login.page.form.email.label')" v-model="form.email"
        :placeholder="$t('auth.pages.login.page.form.email.placeholder')" required />
      <div class="flex items-center justify-between mb-2">
        <label class="block text-sm text-gray-400">{{ $t("auth.pages.login.page.form.password.label") }}</label>
        <router-link to="/auth/forgot-password" class="text-sm text-purple-400 hover:text-purple-300">
          {{ $t("auth.pages.login.page.form.forgot_password") }}
        </router-link>
      </div>

      <FormInput id="password" type="password" v-model="form.password"
        :placeholder="t('auth.pages.login.page.form.password.placeholder')" required />

      <button type="submit"
        class="w-full mt-6 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors"
        :disabled="loading">
        {{ loading ? $t('auth.pages.login.page.form.login_button.loading') :
          $t('auth.pages.login.page.form.login_button.label') }}
      </button>

      <p class="mt-4 text-center text-sm text-gray-400">
        {{ $t('auth.pages.login.page.form.register.label') }}
        <router-link to="/auth/register" class="text-purple-400 hover:text-purple-300">
          {{ $t('auth.pages.login.page.form.register.link') }}
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
import Swal from 'sweetalert2'
import { useI18n } from 'vue-i18n'
const { t } = useI18n()

document.title = t('auth.pages.login.page.title')

const loading = ref(false)
const form = reactive({
  email: '',
  password: ''
})

const handleSubmit = async () => {
  loading.value = true
  try {
    if (!form.email || !form.password) {
      Swak.fire({
        icon: 'error',
        title: t('auth.pages.login.alerts.error.title'),
        text: t('auth.pages.login.alerts.error.missing_fields')
      })
      loading.value = false
      return
    }

    // Example login logic
    const response = await fetch('/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        email: form.email,
        password: form.password
      })
    })

    if (!response.ok) {
      Swal.fire({
        icon: 'error',
        title: t('auth.pages.login.alerts.error.title'),
        text: t('auth.pages.login.alerts.error.invalid_credentials')
      })
      loading.value = false
      return
    }

    const data = await response.json()
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: t('auth.pages.login.alerts.error.title'),
      text: t('auth.pages.login.alerts.error.generic')
    })
  } finally {
    loading.value = false
  }
}
</script>