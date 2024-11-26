/**
 * The Auth class
 *
 * This class contains methods for authenticating users
 *
 * @class Auth
 *
 * @method forgotPassword
 * @method resetPassword
 * @method isLoginVerifyTokenValid
 * @method register
 * @method login
 * 
 * @export Auth
 * @type {Class}
 */
class Auth {
    /**
     * Logs the user in
     *
     * @param email The email to log in with
     * @param turnstileResponse The turnstile response
     *
     * @returns The response from the server
     */
    static async forgotPassword(email: string, turnstileResponse: string) {
        const response = await fetch('/api/user/auth/forgot', {
            method: 'POST',
            body: new URLSearchParams({
                email: email,
                turnstileResponse: turnstileResponse,
            }),
        });
        const data = await response.json();
        return data;
    }

    /**
     * Resets the password
     *
     * @param confirmPassword The password to confirm
     * @param password The new password
     * @param resetCode The reset code
     * @param turnstileResponse The turnstile response
     *
     * @returns The response from the server
     */
    static async resetPassword(
        confirmPassword: string,
        password: string,
        resetCode: string,
        turnstileResponse: string,
    ) {
        const response = await fetch('/api/user/auth/reset', {
            method: 'POST',
            body: new URLSearchParams({
                password: password,
                confirmPassword: confirmPassword,
                email_code: resetCode || '',
                turnstileResponse: turnstileResponse,
            }),
        });
        const data = await response.json();
        return data;
    }

    /**
     * Verifies the login token
     *
     * @param code The code to verify
     *
     * @returns The response from the server
     */
    static async isLoginVerifyTokenValid(code: string) {
        const response = await fetch(`/api/user/auth/reset?code=${code}`, {
            method: 'GET',
        });
        const data = await response.json();
        return data;
    }

    /**
     * Registers the user
     *
     * @param firstName The first name
     * @param lastName The last name
     * @param email The email
     * @param username The username
     * @param password The password
     * @param turnstileResponse The turnstile response
     *
     * @returns The response from the server
     */
    static async register(
        firstName: string,
        lastName: string,
        email: string,
        username: string,
        password: string,
        turnstileResponse: string,
    ) {
        const response = await fetch('/api/user/auth/register', {
            method: 'POST',
            body: new URLSearchParams({
                firstName: firstName,
                lastName: lastName,
                email: email,
                username: username,
                password: password,
                turnstileResponse: turnstileResponse,
            }),
        });
        const data = await response.json();
        return data;
    }
    /**
     * Logs the user in
     *
     * @param login The users email or username
     * @param password The users password
     * @param turnstileResponse The turnstile response
     * @returns
     */
    static async login(login: string, password: string, turnstileResponse: string) {
        const response = await fetch('/api/user/auth/login', {
            method: 'POST',
            body: new URLSearchParams({
                login: login,
                password: password,
                turnstileResponse: turnstileResponse,
            }),
        });
        const data = await response.json();
        return data;
    }
}

export default Auth;
