document.addEventListener("DOMContentLoaded", function() {

    const formRegistro = document.getElementById('formRegistro');
    if (!formRegistro) return;

    const passReg = document.getElementById('passReg');
    const passConfirm = document.getElementById('passConfirm');
    const errorPass = document.getElementById('errorPass');
    const errorConfirm = document.getElementById('errorConfirm');

    formRegistro.addEventListener('submit', function(event) {
        let isValid = true;

        
        const camposRequeridos = ['nombre', 'emailReg', 'genero', 'fechaNac'];
        camposRequeridos.forEach(id => {
            const campo = document.getElementById(id);
            if (!campo.value.trim()) {
                campo.classList.add('is-invalid');
                isValid = false;
            } else {
                campo.classList.remove('is-invalid');
                campo.classList.add('is-valid');
            }
        });

        
        const emailReg = document.getElementById('emailReg');
        if (!emailReg.value.includes('@') || emailReg.value.length < 5) {
            emailReg.classList.add('is-invalid');
            isValid = false;
        }

        
        const passValue = passReg.value;
        const tieneMinimo = passValue.length >= 8;
        const tieneMayuscula = /[A-Z]/.test(passValue);
        const tieneMinuscula = /[a-z]/.test(passValue);
        const tieneNumero = /[0-9]/.test(passValue);
        const tieneEspecial = /[^A-Za-z0-9]/.test(passValue);

        if (!tieneMinimo || !tieneMayuscula || !tieneMinuscula || !tieneNumero || !tieneEspecial) {
            passReg.classList.add('is-invalid');
            errorPass.textContent = "Debe tener mín. 8 caracteres, 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial.";
            isValid = false;
        } else {
            passReg.classList.remove('is-invalid');
            passReg.classList.add('is-valid');
        }

        
        if (passReg.value !== passConfirm.value || passConfirm.value === '') {
            passConfirm.classList.add('is-invalid');
            errorConfirm.textContent = "Las contraseñas no coinciden.";
            isValid = false;
        } else {
            passConfirm.classList.remove('is-invalid');
            passConfirm.classList.add('is-valid');
        }

        
        const avatar = document.getElementById('avatar');
        if (avatar.files.length === 0) {
            avatar.classList.add('is-invalid');
            isValid = false;
        } else {
            avatar.classList.remove('is-invalid');
            avatar.classList.add('is-valid');
        }

        
        if (!isValid) {
            event.preventDefault();
        }
        
    });
});