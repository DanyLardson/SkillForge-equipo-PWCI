<?php

//No pos namas las categorias para la base de datos
$categorias = [
    [
        "id" => 1,
        "nombre" => "IT & Software",
        "descripcion" => "Cursos de programación, redes, bases de datos y tecnología.",
        "colorBadge" => "bg-primary",
        "creador" => "Administrador",
        "fechaCreacion" => "01 Ene 2026, 10:30 AM"
    ],
    [
        "id" => 2,
        "nombre" => "Marketing",
        "descripcion" => "Cursos de SEO, redes sociales, publicidad digital y ventas.",
        "colorBadge" => "bg-success",
        "creador" => "Administrador",
        "fechaCreacion" => "02 Ene 2026, 09:15 AM"
    ],
    [
        "id" => 3,
        "nombre" => "Diseño",
        "descripcion" => "Cursos de UX/UI, diseño gráfico, ilustración y Photoshop.",
        "colorBadge" => "bg-danger",
        "creador" => "Administrador",
        "fechaCreacion" => "03 Ene 2026, 02:45 PM"
    ],
    [
        "id" => 4,
        "nombre" => "Negocios",
        "descripcion" => "Cursos de emprendimiento, finanzas, liderazgo y gestión.",
        "colorBadge" => "bg-secondary",
        "creador" => "Administrador",
        "fechaCreacion" => "04 Ene 2026, 11:00 AM"
    ],
    [
        "id" => 5,
        "nombre" => "Idiomas",
        "descripcion" => "Cursos de inglés, francés, alemán y otros idiomas.",
        "colorBadge" => "bg-warning text-dark",
        "creador" => "Administrador",
        "fechaCreacion" => "05 Ene 2026, 04:20 PM"
    ],
    [
        "id" => 6,
        "nombre" => "Ciencias",
        "descripcion" => "Cursos de matemáticas, física, química y biología.",
        "colorBadge" => "bg-info text-dark",
        "creador" => "Administrador",
        "fechaCreacion" => "06 Ene 2026, 08:00 AM"
    ],
    [
        "id" => 7,
        "nombre" => "Arte y Musica",
        "descripcion" => "Cursos de música, pintura, fotografía y artes escénicas.",
        "colorBadge" => "bg-dark",
        "creador" => "Administrador",
        "fechaCreacion" => "07 Ene 2026, 01:30 PM"
    ]
];

$totalCategorias = count($categorias);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías | SkillForge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adminCategorias.css">
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
                    <li class="nav-item"><a class="nav-link" href="adminUsuarios.php">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link active" href="adminCategorias.php">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminComentarios.php">Comentarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminReportes.php">Reportes</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3"><i class="fa-solid fa-user-shield me-1"></i> Administrador</span>
                    <a href="index.php" class="btn btn-sm btn-outline-light" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?');">Salir</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="fw-bold" style="color: #2c3e50;">
                Gestión de Categorías
               <span class="badge bg-secondary ms-2"><?php echo $totalCategorias; ?></span>
            </h2>
            <button class="btn text-white" style="background-color: #16a085;" data-bs-toggle="modal" data-bs-target="#modalNuevaCategoria">
                <i class="fa-solid fa-plus me-2"></i>Nueva Categoria
            </button>
        </div>

        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Categoria</th>
                                <th>Descripcion</th>
                                <th>Creada por</th>
                                <th>Fecha y hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categorias as $cat): ?>
                                <tr>
                                    <td><?php echo $cat['id']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $cat['colorBadge']; ?>">
                                            <?php echo htmlspecialchars($cat['nombre']); ?>
                                        </span>
                                    </td>
                                    <td class="text-muted small"><?php echo htmlspecialchars($cat['descripcion']); ?></td>
                                    <td><?php echo htmlspecialchars($cat['creador']); ?></td>
                                    <td class="text-muted small"><?php echo $cat['fechaCreacion']; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary me-1" title="Editar" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta categoría? Esta acción no se puede deshacer.');">
                                            <i class="fa-solid fa-trash"></i>
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


    <div class="modal fade" id="modalNuevaCategoria" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #16a085;">
                    <h5 class="modal-title"><i class="fa-solid fa-plus me-2"></i>Nueva Categoria</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre de la categoria</label>
                            <input type="text" class="form-control" placeholder="Escribe el nombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Descripcion</label>
                            <textarea class="form-control" rows="3" placeholder="Describe el tipo de cursos que contendrá esta categoría..." required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn text-white" style="background-color: #16a085;">Guardar Categoria</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalEditarCategoria" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #e67e22;">
                    <h5 class="modal-title"><i class="fa-solid fa-pen me-2"></i>Editar Categoría</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre de la categoria</label>
                            <input type="text" class="form-control" value="IT & Software" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Descripcion</label>
                            <textarea class="form-control" rows="3" required>Cursos de programacion, redes, bases de datos y tecnologia.</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn text-white" style="background-color: #e67e22;">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white text-center py-4 mt-5" style="background-color: #2c3e50;">
        <div class="container">
            <p class="mb-1">&copy; 2026 SkillForge</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/adminCategorias.js"></script>
</body>
</html>