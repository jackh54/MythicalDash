class Settings {
    static settings = {};

    static async grabSettings() {
        try {
            const response = await fetch('/api/system/settings');
            const data = await response.json();
            if (data.success) {
                Settings.settings = data.settings;
                return Settings.settings;
            } else {
                throw new Error(data.message || 'Failed to fetch settings');
            }
        } catch (error) {
            console.error('Error fetching settings:', error);
            throw error;
        }
    }

    static async initializeSettings() {
        try {
            const fetchedSettings = await Settings.grabSettings();
            console.log('Settings fetched:', fetchedSettings);
            for (const [key, value] of Object.entries(fetchedSettings)) {
                localStorage.setItem(key, JSON.stringify(value));
            }
        } catch (error) {
            console.error('Failed to initialize settings:', error);
            document.body.innerHTML = `
                <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8d7da; color: #721c24; font-family: Arial, sans-serif;">
                    <div style="text-align: center;">
                        <h1 style="font-size: 3em; margin-bottom: 0.5em;">We are so sorry</h1>
                        <p style="font-size: 1.5em;">Our backend is down at this moment :(</p>
                    </div>
                </div>
            `;
        }
    }

    static getSetting(key: string) {
        const item = localStorage.getItem(key);
        return item ? JSON.parse(item) : null;
    }
}

export default Settings;
