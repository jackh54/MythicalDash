import Swal from 'sweetalert2';

class Register {
    static getToken() {
        console.log('Getting token!');
        return fetch('/api/user/auth/register')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Token:', data.register.csrf);
                    return data.register.csrf;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "CSRF token not found!",
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

}

export default Register;
