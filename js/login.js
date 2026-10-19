//scripts que sigo ocupando en el login  
document.addEventListener("DOMContentLoaded", function() {

    //ver contraseñas
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

    //login con fetch para la BD
    const formLogin = document.getElementById('formLogin');
    if (formLogin) {
        formLogin.addEventListener('submit', function(event) {
            event.preventDefault(); 

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const btn = formLogin.querySelector('button[type="submit"]');

            btn.innerHTML = 'Cargando...';
            btn.disabled = true;

            fetch('api/auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email: email, password: password })
            })
            .then(res => res.json().then(data => ({ status: res.status, body: data })))
            .then(res => {
                if (res.status === 200) {
                    //login exitoso
                    alert('¡Bienvenido ' + res.body.usuario + '!');
                    window.location.href = 'index.php';
                } else {
                    //error 
                    alert(res.body.error);
                    btn.innerHTML = 'Iniciar Sesión';
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                btn.innerHTML = 'Iniciar Sesión';
                btn.disabled = false;
                alert("Error de conexión");
            });
        });
    }
});