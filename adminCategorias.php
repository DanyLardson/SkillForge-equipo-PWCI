<?php
require_once 'core/Auth.php';
Auth::check('admin');
require_once 'modelos/Curso.php';

$modelo = new Curso();

//procesar la creacion de categoria
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_categoria'])) {
    $nombre = $_POST['nombre'] ?? '';
    $desc = $_POST['descripcion'] ?? '';
    if (!empty($nombre)) {
        $modelo->crearCategoria($nombre, $desc, $_SESSION['usuario_id']);
        header('Location: adminCategorias.php?success=1');
        exit;
    }
}

//procesar eliminacion
if (isset($_GET['eliminar'])) {
    $modelo->eliminarCategoria($_GET['eliminar']);
    header('Location: adminCategorias.php?deleted=1');
    exit;
}

$categorias = $modelo->obtenerCategorias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Categorías | SkillForge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #2c3e50;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white" href="index.php">SkillForge <span class="badge bg-danger ms-1">Admin</span></a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="adminUsuarios.php">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link active" href="adminCategorias.php">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminComentarios.php">Comentarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminReportes.php">Reportes</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3"><i class="fa-solid fa-user-shield me-1"></i> Administrador</span>
                    <a href="logout.php" class="btn btn-sm btn-outline-light" onclick="return confirm('¿Cerrar sesión?');">Salir</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Gestión de Categorías</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearCategoria">
                <i class="fa-solid fa-plus me-2"></i>Nueva Categoría
            </button>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Categoría creada exitosamente.</div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($categorias)): ?>
                            <tr><td colspan="4" class="text-center text-muted py-4">No hay categorías registradas. ¡Crea la primera!</td></tr>
                        <?php else: ?>
                            <?php foreach ($categorias as $cat): ?>
                                <tr>
                                    <td><?php echo $cat['id']; ?></td>
                                    <td><span class="badge bg-primary"><?php echo htmlspecialchars($cat['nombre']); ?></span></td>
                                    <td class="text-muted small"><?php echo htmlspecialchars($cat['descripcion']); ?></td>
                                    <td>
                                        <a href="adminCategorias.php?eliminar=<?php echo $cat['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar categoría?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para crear categoria -->
    <div class="modal fade" id="modalCrearCategoria" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Nueva Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="crear_categoria" value="1">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Descripcion</label>
                            <textarea name="descripcion" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>