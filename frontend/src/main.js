import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './index.css'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { createI18n } from 'vue-i18n'
import EN from './locale/en.json'
import { Swal } from 'sweetalert2/dist/sweetalert2';

const app = createApp(App)
app.use(router)
app.use(VueSweetalert2);


const i18n = createI18n({
    locale: 'EN',
    messages: {
        EN: EN
    }
})
app.use(i18n)

fetch('/api/system/settings')
    .then(response => {
        if (!response.ok) {
            throw new Error('Server response was not ok: ' + response.statusText);
        }
    })
    .catch(error => {
        console.error(error);
        app.unmount();
        alert('Woops, it looks like our backend is not healthy. \nPlease try again later or contact the webmaster.\n\nDEBUG: ' + error);
    });

/**
 * Logic For Settings
 */
let settings = {};

export async function grabSettings() {
    try {
        const response = await fetch('/api/system/settings');
        const data = await response.json();
        if (data.success) {
            settings = data.settings;
            return settings;
        } else {
            throw new Error(data.message || 'Failed to fetch settings');
        }
    } catch (error) {
        console.error('Error fetching settings:', error);
        throw error;
    }
}

export function initializeSettings(app) {
    grabSettings().then(fetchedSettings => {
        console.log('Settings fetched:', fetchedSettings);
        for (const [key, value] of Object.entries(fetchedSettings)) {
            localStorage.setItem(key, JSON.stringify(value));
        }
    }).catch(error => {
        console.error('Failed to initialize settings:', error);
        alert('Failed to initialize settings: ' + error);
        app.unmount();
    });
}

app.mount('#app')
