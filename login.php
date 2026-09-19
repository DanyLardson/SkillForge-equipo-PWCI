<?php

//de momento todo esta simulado
$error = "";
$email = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    //validacion para servidor
    if (empty($email) || empty($password)) {
        $error = "Por favor, completa todos los campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electrónico no es válido.";
    } else {
        
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion | SkillForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="container-fluid vh-100">
        <div class="row h-100">
            
            
            <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
                <div class="w-75" style="max-width: 400px;">
                    <h2 class="fw-bold mb-2" style="color: #2c3e50;">Bienvenido</h2>
                    <p class="text-muted mb-4">ingresa tus credenciales para seguir.</p>

                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                   
                    <form id="formLogin" method="POST" action="login.php" novalidate>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo Electronico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="tu@correo.com" 
                                       value="<?php echo htmlspecialchars($email); ?>" required>
                                <div class="invalid-feedback">ingresa un correo valido.</div>
                            </div>
                        </div>

                        
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="••••••••" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                                </button>
                                <div class="invalid-feedback">La contraseña es obligatoria.</div>
                            </div>
                        </div>

                        
                        <div id="alertaBloqueo" class="alert alert-danger d-none" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            Fallaste 3 veces seguidas. Tu cuenta ha sido bloqueada temporalmente. Contacta al administrador.
                        </div>

                        
                        <button type="submit" class="btn text-white w-100 py-2 fw-bold" style="background-color: #e67e22;">
                            Iniciar Sesion
                        </button>
                    </form>

                    <p class="text-center mt-4 text-muted">
                        ¿No tienes cuenta? <a href="registro.php" style="color: #16a085; font-weight: bold;">Regístrate aquí</a>
                    </p>
                </div>
            </div>

            
            <div class="col-md-6 d-none d-md-flex hero-section align-items-center justify-content-center">
                <div class="text-center text-white position-relative z-1">
                    <i class="fa-solid fa-graduation-cap display-1 mb-3"></i>
                    <h1 class="display-3 fw-bold">SkillForge</h1>
                    <p class="fs-4">Aprende sin limites</p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/login.js"></script>
</body>
</html>