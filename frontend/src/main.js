import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './index.css'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { createI18n } from 'vue-i18n'
import EN from './locale/en.json'

const i18n = createI18n({
    locale: 'EN',
    messages: {
        EN: EN
    }
})


const app = createApp(App)
app.use(router)
app.use(VueSweetalert2);
app.use(i18n)

app.mount('#app')
