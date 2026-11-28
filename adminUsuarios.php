<?php
require_once 'core/Auth.php';
Auth::check('admin');
require_once 'modelos/Curso.php';

$modelo = new Curso();
$usuarios = $modelo->obtenerTodosLosUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios | SkillForge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #2c3e50;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white" href="index.php">
                <i class="fa-solid fa-graduation-cap me-1" style="color: #e67e22;"></i>SkillForge
                <span class="badge bg-danger ms-1">Admin</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="adminUsuarios.php">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminCategorias.php">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminComentarios.php">Comentarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminReportes.php">Reportes</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3"><i class="fa-solid fa-user-shield me-1"></i> Administrador</span>
                    <a href="logout.php" class="btn btn-sm btn-outline-light" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?');">Salir</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="fw-bold mb-4">Gestión de Usuarios</h2>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Fecha Ingreso</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><span class="fw-semibold"><?php echo htmlspecialchars($usuario['nombre']); ?></span></td>
                                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                    <td><span class="badge bg-info text-dark"><?php echo ucfirst($usuario['rol']); ?></span></td>
                                    <td><?php echo date('d M Y', strtotime($usuario['fecha_registro'])); ?></td>
                                    <td>
                                        <?php if ($usuario['activo'] == 1): ?>
                                            <span class="badge bg-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Bloqueado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Boton que llama despues para cambiar el estado -->
                                        <button class="btn btn-sm btn-outline-<?php echo $usuario['activo'] == 1 ? 'danger' : 'success'; ?>" onclick="cambiarEstado(<?php echo $usuario['id']; ?>, <?php echo $usuario['activo']; ?>)">
                                            <i class="fa-solid fa-<?php echo $usuario['activo'] == 1 ? 'ban' : 'check'; ?>"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function cambiarEstado(id, estadoActual) {
        if (!confirm('¿Estás seguro de cambiar el estado de este usuario?')) return;
        
        const nuevoEstado = estadoActual == 1 ? 0 : 1;

        //peticion a un nuevo endpoint que vamos a crear 
        fetch('api/usuarios.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, activo: nuevoEstado })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Estado actualizado correctamente.');
                window.location.reload(); 
            } else {
                alert('Error: ' + (data.error || 'No se pudo cambiar el estado.'));
            }
        })
        .catch(err => {
            alert('Error de conexión: ' + err.message);
        });
    }
    </script>
</body>
</html>
