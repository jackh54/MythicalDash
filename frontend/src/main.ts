import './assets/main.css';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import VueSweetalert2 from 'vue-sweetalert2';
import { createI18n } from 'vue-i18n';
import EN from '@/locale/en.yml';
import Settings from '@/mythicalclient/Settings';
import 'sweetalert2/dist/sweetalert2.min.css';
import SeoManager from '@/mythicalclient/SeoManager';

const app = createApp(App);

app.use(router);
app.use(VueSweetalert2);

const i18n = createI18n({
    locale: 'EN',
    messages: {
        EN: EN,
    },
});
app.use(i18n);

Settings.initializeSettings();

app.mount('#app');

