<?php
require_once 'core/Auth.php';
Auth::check('admin');
require_once 'modelos/Curso.php';

$modelo = new Curso();

//procesa eliminacion si se envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_comentario_id'])) {
    $id = $_POST['eliminar_comentario_id'];
    $causa = $_POST['causa'] ?? 'No especificada';
    $modelo->eliminarComentario($id, $causa);
    header('Location: adminComentarios.php?success=1');
    exit;
}

$comentarios = $modelo->obtenerTodosLosComentarios();
$totalVisibles = count(array_filter($comentarios, fn($c) => $c['eliminado'] == 0));
$totalEliminados = count(array_filter($comentarios, fn($c) => $c['eliminado'] == 1));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Comentarios | SkillForge Admin</title>
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
        <h2 class="fw-bold mb-4">Gestión de Comentarios</h2>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Comentario eliminado con éxito.</div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <?php foreach ($comentarios as $comentario): ?>
                    <div class="card mb-3 border-0 shadow-sm <?php echo $comentario['eliminado'] ? 'bg-light' : ''; ?>">
                        <div class="card-body">
                            <div class="d-flex mb-2">
                                <i class="fa-solid fa-circle-user fs-2 text-secondary me-3"></i>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-0"><?php echo htmlspecialchars($comentario['usuario_nombre']); ?></h6>
                                    <small class="text-muted">
                                        <?php echo htmlspecialchars($comentario['curso_titulo']); ?> | <?php echo date('d M Y', strtotime($comentario['fecha_creacion'])); ?>
                                    </small>
                                </div>
                            </div>
                            
                            <?php if ($comentario['eliminado'] == 0): ?>
                                <p class="mb-3 text-muted"><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                                <div class="text-end">
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $comentario['id']; ?>">Eliminar comentario</button>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-secondary mb-0">
                                    <i class="fa-solid fa-ban me-2"></i>
                                    <strong>Comentario eliminado.</strong><br>
                                    <small><strong>Causa:</strong> <?php echo htmlspecialchars($comentario['razon_eliminacion']); ?></small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- modal para eliminar -->
                    <?php if ($comentario['eliminado'] == 0): ?>
                        <div class="modal fade" id="modalEliminar<?php echo $comentario['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Eliminar Comentario</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="eliminar_comentario_id" value="<?php echo $comentario['id']; ?>">
                                            <p>Escribe la causa de la eliminación:</p>
                                            <textarea name="causa" class="form-control" rows="2" required></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>