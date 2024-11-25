class Session {
    static Session = {};

    static isSessionValid() {
        const cookies = document.cookie.split(';');
        for (let cookie of cookies) {
            const [name, value] = cookie.trim().split('=');
            if (name === 'user_token' && value) {
                return true;
            }
        }
        return false;
    }
}

export default Session;
