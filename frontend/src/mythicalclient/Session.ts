import router from '@/router';
import Swal from 'sweetalert2';
import Settings from '@/mythicalclient/Settings';
import { useI18n } from 'vue-i18n';

class Session {
    static sessionData = {};

    static isSessionValid() {
        const cookies = document.cookie.split(';');
        for (const cookie of cookies) {
            const [name, value] = cookie.trim().split('=');
            if (name === 'user_token' && value) {
                return true;
            }
        }
        return false;
    }

    static getInfo(key: string) {
        const item = localStorage.getItem(key);
        return item ? JSON.parse(item) : null;
    }

    static async startSession() {
        const { t } = useI18n();
        const updateSessionInfo = async () => {
            try {
                const response = await fetch('/api/user/session');
                const data = await response.json();
                if (data.success) {
                    const { user_info } = data;
                    const { billing } = data;
                    for (const [key, value] of Object.entries(user_info)) {
                        localStorage.setItem(key, JSON.stringify(value));
                    }
                    for (const [key, value] of Object.entries(billing)) {
                        localStorage.setItem(key, JSON.stringify(value));
                    }
                } else {
                    if (Session.isSessionValid()) {
                        Settings.initializeSettings();
                        if (data.error_code == 'TW0_FA_BLOCKED') {
                            router.push('/auth/2fa/verify');
                        } else {
                            Swal.fire({
                                title: t('auth.logic.errors.title'),
                                text: t('auth.logic.errors.expired'),
                                footer: t('auth.logic.errors.footer'),
                                icon: 'error',
                                confirmButtonText: 'OK',
                            });
                            router.push('/auth/login');
                        }
                    } else {
                        console.warn('Session is not valid');
                    }
                }
            } catch (error) {
                console.error('Error fetching session:', error);
                throw error;
            }
        };

        // Initial session start
        await updateSessionInfo();

        // Update session info every 1 minute
        setInterval(updateSessionInfo, 60000);
    }
}

export default Session;
