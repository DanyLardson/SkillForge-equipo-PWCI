<?php
require_once 'core/Auth.php';
Auth::check('admin'); //Candado pa solo pasar si eres admin

// simulacion, cuantas veces lo he dicho
$admin = [
    "nombre" => "Administrador",
    "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg"
];


$usuarios = [
    [
        "id" => 1,
        "nombre" => "María González",
        "email" => "maria.gonzalez@correo.com",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "tipo" => "Estudiante",
        "colorBadge" => "bg-primary",
        "fechaIngreso" => "15 Ene 2026",
        "estado" => "Activo"
    ],
    [
        "id" => 2,
        "nombre" => "Daniel Montelongo",
        "email" => "daniel.montelongo@correo.com",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "tipo" => "Instructor",
        "colorBadge" => "bg-warning text-dark",
        "fechaIngreso" => "10 Ene 2026",
        "estado" => "Activo"
    ],
    [
        "id" => 3,
        "nombre" => "Carlos Quiroz",
        "email" => "carlos.quiroz@correo.com",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "tipo" => "Estudiante",
        "colorBadge" => "bg-primary",
        "fechaIngreso" => "20 Ene 2026",
        "estado" => "Bloqueado"
    ],
    [
        "id" => 4,
        "nombre" => "Ana López",
        "email" => "ana.lopez@correo.com",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "tipo" => "Instructor",
        "colorBadge" => "bg-warning text-dark",
        "fechaIngreso" => "05 Feb 2026",
        "estado" => "Activo"
    ],
    [
        "id" => 5,
        "nombre" => "Juan Pérez",
        "email" => "juan.perez@correo.com",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "tipo" => "Estudiante",
        "colorBadge" => "bg-primary",
        "fechaIngreso" => "08 Feb 2026",
        "estado" => "Activo"
    ],
    [
        "id" => 6,
        "nombre" => "Sofía Martínez",
        "email" => "sofia.martinez@correo.com",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "tipo" => "Instructor",
        "colorBadge" => "bg-warning text-dark",
        "fechaIngreso" => "12 Feb 2026",
        "estado" => "Bloqueado"
    ]
];


$tiposUsuario = ["Todos", "Estudiante", "Instructor", "Administrador"];


$estados = ["Todos", "Activos", "Bloqueados"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios | SkillForge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adminUsuarios.css">
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
                    <a href="index.php" class="btn btn-sm btn-outline-light" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?');">Salir</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="fw-bold" style="color: #2c3e50;">
               Gestión de Usuarios
            </h2>
            <button class="btn text-white" style="background-color: #16a085;">
                <i class="fa-solid fa-plus me-2"></i>Nuevo Usuario
            </button>
        </div>

        
        <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #e67e22, #f39c12);">
            <div class="card-body text-white">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-filter me-2"></i>Filtros</h5>
                <form method="GET" action="adminUsuarios.php">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Buscar por nombre o email</label>
                            <input type="text" class="form-control form-control-sm" name="busqueda" placeholder="Buscar...">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Tipo de Usuario</label>
                            <select class="form-select form-select-sm" name="tipo">
                                <?php foreach ($tiposUsuario as $tipo): ?>
                                    <option value="<?php echo $tipo; ?>"><?php echo $tipo; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Estado</label>
                            <select class="form-select form-select-sm" name="estado">
                                <?php foreach ($estados as $est): ?>
                                    <option value="<?php echo $est; ?>"><?php echo $est; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-sm text-white w-100" style="background-color: #2c3e50;">
                                <i class="fa-solid fa-magnifying-glass me-1"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


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
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo $usuario['avatar']; ?>" class="rounded-circle me-2" width="35" height="35" alt="Avatar">
                                            <span class="fw-semibold"><?php echo htmlspecialchars($usuario['nombre']); ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                    <td><span class="badge <?php echo $usuario['colorBadge']; ?>"><?php echo $usuario['tipo']; ?></span></td>
                                    <td><?php echo $usuario['fechaIngreso']; ?></td>
                                    <td>
                                        <?php if ($usuario['estado'] === 'Activo'): ?>
                                            <span class="badge bg-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Bloqueado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($usuario['estado'] === 'Activo'): ?>
                                            <button class="btn btn-sm btn-outline-danger" title="Bloquear" onclick="return confirm('¿Estás seguro de bloquear a este usuario?');">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-outline-success" title="Desbloquear" onclick="return confirm('¿Estás seguro de desbloquear a este usuario?');">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        <?php endif; ?>
                                        <button class="btn btn-sm btn-outline-secondary" title="Editar">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                
                <nav class="mt-3">
                    <ul class="pagination pagination-sm justify-content-end mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#" style="background-color: #e67e22; border-color: #e67e22;">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                    </ul>
                </nav>
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
    <script src="js/adminUsuarios.js"></script>
</body>
</html>