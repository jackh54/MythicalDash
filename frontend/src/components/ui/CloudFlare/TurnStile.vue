<script>
import VueTurnstile from 'vue-turnstile';
import Settings from '@/mythicalclient/Settings.js';

const isProduction = false;

export default {
    components: { VueTurnstile },

    data() {
        return {
            token: Settings.getSetting("turnstile_key_pub"),
        };
    },
};
</script>

<template>
    <div style="display: flex; justify-content: center; margin-top: 20px;">
        <vue-turnstile :site-key="isProduction ? token : '1x00000000000000000000AA'" v-model="token" />
    </div>
</template>
