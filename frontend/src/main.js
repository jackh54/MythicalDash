import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import './index.css';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { createI18n } from 'vue-i18n';
import EN from './locale/en.json';
import Settings from '@/mythicalclient/Settings.js';

/**
 * Initialize the app
 */
const app = createApp(App);

/**
 * Add the router and sweetalert2
 */
app.use(router)
app.use(VueSweetalert2);

/**
 * Add i18n support
 */
const i18n = createI18n({
    locale: 'EN',
    messages: {
        EN: EN
    }
})
app.use(i18n)

/**
 * Initialize settings from the backend
 */
Settings.initializeSettings();

/**
 * Mount the app
 */
app.mount('#app')
