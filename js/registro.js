//scirpts que ocupo en registrs

document.addEventListener("DOMContentLoaded", function() {

    const formRegistro = document.getElementById('formRegistro');
    if (!formRegistro) return;

    const passReg = document.getElementById('passReg');
    const passConfirm = document.getElementById('passConfirm');
    const errorPass = document.getElementById('errorPass');
    const errorConfirm = document.getElementById('errorConfirm');

    formRegistro.addEventListener('submit', function(event) {
        //dtenemos la recarga de l pagina
        event.preventDefault(); 
        
        let isValid = true;

        //validaciones visuales
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

        //validacion de email
        const emailReg = document.getElementById('emailReg');
        if (!emailReg.value.includes('@') || emailReg.value.length < 5) {
            emailReg.classList.add('is-invalid');
            isValid = false;
        }

        //validar contra, lo de siempre(minimo 8, mayuscula, minuscula, numero y especial)
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

        //validar confirmacion
        if (passReg.value !== passConfirm.value || passConfirm.value === '') {
            passConfirm.classList.add('is-invalid');
            errorConfirm.textContent = "Las contraseñas no coinciden.";
            isValid = false;
        } else {
            passConfirm.classList.remove('is-invalid');
            passConfirm.classList.add('is-valid');
        }

        //validar avatar
        const avatar = document.getElementById('avatar');
        if (avatar.files.length === 0) {
            avatar.classList.add('is-invalid');
            isValid = false;
        } else {
            avatar.classList.remove('is-invalid');
            avatar.classList.add('is-valid');
        }

        //Si hay algun error no envia nada
        if (!isValid) {
            return; 
        }

        //si todo esta bien, manda el api
        const btn = formRegistro.querySelector('button[type="submit"]');
        btn.innerHTML = 'Registrando...';
        btn.disabled = true;

        const datos = {
            nombre: document.getElementById('nombre').value,
            email: document.getElementById('emailReg').value,
            password: document.getElementById('passReg').value,
            rol: document.querySelector('input[name="rol"]:checked').value
        };

        fetch('api/registro.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        })
        .then(res => res.json().then(data => ({ status: res.status, body: data })))
        .then(res => {
            if (res.status === 201) {
                alert('¡Registro exitoso! Ahora puedes iniciar sesión.');
                window.location.href = 'login.php';
            } else {
                alert('Error: ' + (res.body.error || 'No se pudo registrar'));
                btn.innerHTML = 'Registrarme';
                btn.disabled = false;
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error de conexión al servidor");
            btn.innerHTML = 'Registrarme';
            btn.disabled = false;
        });
    });
});