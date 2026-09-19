document.addEventListener("DOMContentLoaded", function() {

    //mostrar contraseña
    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    }

    //avlidacion del formulario parte del cliente
    const formLogin = document.getElementById('formLogin');
    if (formLogin) {
        formLogin.addEventListener('submit', function(event) {
            let isValid = true;
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            if (!email.value.includes('@') || email.value.length < 5) {
                email.classList.add('is-invalid');
                isValid = false;
            } else {
                email.classList.remove('is-invalid');
                email.classList.add('is-valid');
            }

            if (password.value.trim() === '') {
                password.classList.add('is-invalid');
                isValid = false;
            } else {
                password.classList.remove('is-invalid');
                password.classList.add('is-valid');
            }

            
            if (!isValid) {
                event.preventDefault();
            }
            
        });
    }
});