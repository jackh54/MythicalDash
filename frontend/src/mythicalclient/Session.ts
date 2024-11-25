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
        const updateSessionInfo = async () => {
            try {
                const response = await fetch('/api/user/session');
                const data = await response.json();
                if (data.success) {
                    const { user_info } = data;
                    for (const [key, value] of Object.entries(user_info)) {
                        localStorage.setItem(key, JSON.stringify(value));
                    }
                } else {
                    console.error('Failed to update session:', data.message);
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
