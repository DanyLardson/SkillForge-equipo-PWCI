<?php

//como lo de mas tambien simulacion para la base de datos
$error = "";
$exito = "";


$nombre = "";
$email = "";
$genero = "";
$fechaNac = "";
$rol = "estudiante";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $genero = $_POST['genero'] ?? '';
    $fechaNac = $_POST['fechaNac'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordConfirm = $_POST['passwordConfirm'] ?? '';
    $rol = $_POST['rol'] ?? 'estudiante';

    //validaciones servidor 

    if (empty($nombre) || empty($email) || empty($genero) || empty($fechaNac) || empty($password)) {
        $error = "Por favor, completa todos los campos obligatorios.";
    }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electrónico no es válido.";
    }
    
    elseif (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[^A-Za-z0-9]/', $password)
    ) {
        $error = "La contraseña debe tener mínimo 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.";
    }
   
    elseif ($password !== $passwordConfirm) {
        $error = "Las contraseñas no coinciden.";
    }
    
    elseif (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
        $error = "Debes subir una foto de perfil.";
    }
    else {


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
    <title>Registro | SkillForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>

    <div class="container-fluid vh-100">
        <div class="row h-100">
            
            
            <div class="col-md-7 d-flex align-items-center justify-content-center bg-white py-4">
                <div class="w-75" style="max-width: 550px;">
                    <h2 class="fw-bold mb-2" style="color: #2c3e50;">Crea tu cuenta</h2>
                    <p class="text-muted mb-4">Unete a SkillForge y empieza a aprender hoy mismo.</p>

                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    
                    <?php if (!empty($exito)): ?>
                        <div class="alert alert-success" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            <?php echo htmlspecialchars($exito); ?>
                        </div>
                    <?php endif; ?>

                    <form id="formRegistro" method="POST" action="registro.php" enctype="multipart/form-data" novalidate>
                        <div class="row">
                            
                            <div class="col-md-12 mb-3">
                                <label for="nombre" class="form-label fw-semibold">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       placeholder="Ej. Nombre - apellido" 
                                       value="<?php echo htmlspecialchars($nombre); ?>" required>
                                <div class="invalid-feedback">El nombre es obligatorio.</div>
                            </div>

                            
                            <div class="col-md-12 mb-3">
                                <label for="emailReg" class="form-label fw-semibold">Correo Electronico</label>
                                <input type="email" class="form-control" id="emailReg" name="email" 
                                       placeholder="tu@correo.com" 
                                       value="<?php echo htmlspecialchars($email); ?>" required>
                                <div class="invalid-feedback">Ingresa un correo valido.</div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="genero" class="form-label fw-semibold">Genero</label>
                                <select class="form-select" id="genero" name="genero" required>
                                    <option value="">Selecciona...</option>
                                    <option value="M" <?php echo ($genero === 'M') ? 'selected' : ''; ?>>Masculino</option>
                                    <option value="F" <?php echo ($genero === 'F') ? 'selected' : ''; ?>>Femenino</option>
                                    <option value="O" <?php echo ($genero === 'O') ? 'selected' : ''; ?>>Otro</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un genero.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fechaNac" class="form-label fw-semibold">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fechaNac" name="fechaNac" 
                                       value="<?php echo htmlspecialchars($fechaNac); ?>" required>
                                <div class="invalid-feedback">Ingresa tu fecha de nacimiento.</div>
                            </div>

                            
                            <div class="col-md-6 mb-3">
                                <label for="passReg" class="form-label fw-semibold">Contraseña</label>
                                <input type="password" class="form-control" id="passReg" name="password" 
                                       placeholder="••••••••" required>
                                <div class="form-text small">Min. 8 caracteres, 1 mayúscula, 1 numero y 1 simbolo.</div>
                                <div class="invalid-feedback" id="errorPass">La contraseña no cumple los requisitos.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="passConfirm" class="form-label fw-semibold">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="passConfirm" name="passwordConfirm" 
                                       placeholder="••••••••" required>
                                <div class="invalid-feedback" id="errorConfirm">Las contraseñas no coinciden.</div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="avatar" class="form-label fw-semibold">Foto de Perfil (Avatar)</label>
                                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" required>
                                <div class="invalid-feedback">Sube una foto de perfil.</div>
                            </div>


                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Quiero registrarme como:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rol" id="rolEstudiante" value="estudiante" 
                                           <?php echo ($rol === 'estudiante') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="rolEstudiante">Estudiante (tomaras cursos)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rol" id="rolInstructor" value="instructor"
                                           <?php echo ($rol === 'instructor') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="rolInstructor">Instructor (daras cursos)</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn text-white w-100 py-2 fw-bold mt-2" style="background-color: #16a085;">
                            Registrarme
                        </button>
                    </form>

                    <p class="text-center mt-3 text-muted">
                        ¿Ya tienes cuenta? <a href="login.php" style="color: #e67e22; font-weight: bold;">Inicia Sesion</a>
                    </p>
                </div>
            </div>


            <div class="col-md-5 d-none d-md-flex hero-section align-items-center justify-content-center">
                <div class="text-center text-white position-relative z-1">
                    <i class="fa-solid fa-graduation-cap display-1 mb-3"></i>
                    <h1 class="display-4 fw-bold">SkillForge</h1>
                    <p class="fs-5">Tu futuro empieza hoy</p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/registro.js"></script>
</body>
</html>