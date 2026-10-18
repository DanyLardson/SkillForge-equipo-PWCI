document.addEventListener("DOMContentLoaded", function() {
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
                    alert('¡Bienvenido ' + res.body.usuario + '!');
                    window.location.href = 'index.php';
                } else {
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