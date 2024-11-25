<script setup lang="ts">
import { ref, reactive } from 'vue';
import Layout from '@/components/Layout.vue';
import FormCard from '@/components/Auth/FormCard.vue';
import FormInput from '@/components/Auth/FormInput.vue';
import { useI18n } from 'vue-i18n';
import { useSound } from '@vueuse/sound'
import failedAlertSfx from "@/assets/sounds/error.mp3";
import successAlertSfx from "@/assets/sounds/success.mp3";
import Swal from 'sweetalert2';
import Turnstile from 'vue-turnstile';
import Settings from '@/mythicalclient/Settings';
import { useRouter } from 'vue-router';
import VueQrcode from 'vue-qrcode'

const { play: playError } = useSound(failedAlertSfx);
const { play: playSuccess } = useSound(successAlertSfx)
const router = useRouter();
const { t } = useI18n();

const loading = ref(false);
const form = reactive({
    secret: '',
    code: '',
    turnstileResponse: ''
});
const handleSubmit = async () => {

};

document.title = t('auth.pages.twofactor_setup.page.title');

function onDataUrlChange(dataUrl: string) {
    console.log(dataUrl);
}

const fetchSecret = async () => {
    try {
        loading.value = true;
        const response = await fetch('/api/user/auth/2fa/setup');
        const data = await response.json();
        if (data.success) {
            form.secret = data.secret;
        } else {
            window.location.href = '/auth/login';
        }
    } catch (error) {
        window.location.href = '/auth/login';
    } finally {
        loading.value = false;
    }
};

fetchSecret();
</script>

<template>
    <Layout>
        <FormCard :title='t("auth.pages.twofactor_setup.page.subTitle")' @submit="handleSubmit">
            <div style="display: flex; justify-content: center; margin-bottom: 20px;">
                <vue-qrcode
                  :value="`otpauth://totp/NaysKutzu?secret=${form.secret}&issuer=${Settings.getSetting('app_name')}`"
                  type="image/png"
                  :color="{ dark: '#000000', light: '#ffffff' }"
                  @change="onDataUrlChange"
                />
            </div>
            <FormInput id="secret" :label='$t("auth.pages.twofactor_setup.page.form.secret.label")' v-model="form.secret"
                type="text" :placeholder='t("auth.pages.twofactor_setup.page.form.secret.placeholder")' locked />
            <FormInput id="code" :label='$t("auth.pages.twofactor_setup.page.form.code.label")' v-model="form.code"
                type="number" :placeholder='t("auth.pages.twofactor_setup.page.form.code.placeholder")' required :maxChar="6" />
            
            <button type="submit"
                class="w-full mt-6 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors"
                :disabled="loading">
                {{ loading ? t('auth.pages.twofactor_setup.page.form.setup_button.loading') :
                    t('auth.pages.twofactor_setup.page.form.setup_button.label') }}
            </button>

            <div v-if="Settings.getSetting('turnstile_enabled') == 'true'"
                style="display: flex; justify-content: center; margin-top: 20px">
                <Turnstile :site-key="Settings.getSetting('turnstile_key_pub')" v-model="form.turnstileResponse" />
            </div>
        </FormCard>
    </Layout>
</template>
