<?php
session_start();
require_once 'core/Auth.php';
Auth::check(); // candado pa que solo los logueados puedan ver esto

require_once 'modelos/Curso.php';

//datos del usuario de la sesion
$estudiante = [
    "nombre" => $_SESSION['usuario_nombre'] ?? 'Estudiante',
    "email" => "correo@ejemplo.com", 
    "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
    "fechaRegistro" => "Miembro"
];

//Inscripciones de la bd
$modelo = new Curso();
$cursosInscritos = $modelo->obtenerInscripciones($_SESSION['usuario_id']);

$categorias = ["Todas", "IT & Software", "Marketing", "Diseño", "Negocios", "Idiomas"];
$totalCursos = count($cursosInscritos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Kardex | SkillForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/kardex.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #2c3e50;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white" href="index.php">
                <i class="fa-solid fa-graduation-cap me-1" style="color: #e67e22;"></i>SkillForge
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex mx-auto" style="width: 40%;">
                    <input class="form-control me-2" type="search" placeholder="Buscar cursos..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <div class="d-flex align-items-center">
                    <a href="chat.php" class="text-white me-3 text-decoration-none">
                        <i class="fa-solid fa-comments"></i> Mensajes
                    </a>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?php echo $estudiante['avatar']; ?>" class="rounded-circle me-2" width="35" height="35" alt="Avatar">
                            <span><?php echo explode(' ', $estudiante['nombre'])[0]; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="index.php">Inicio</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">Editar Perfil</a></li>
                            
                            <?php if (isset($_SESSION['usuario_rol']) && ($_SESSION['usuario_rol'] === "instructor" || $_SESSION['usuario_rol'] === "admin")): ?>
                                <li><a class="dropdown-item" href="ventas.php"><i class="fa-solid fa-chart-line me-2"></i>Panel de Ventas</a></li>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === "admin"): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="adminUsuarios.php"><i class="fa-solid fa-users-cog me-2"></i>Usuarios</a></li>
                                <li><a class="dropdown-item" href="adminCategorias.php"><i class="fa-solid fa-tags me-2"></i>Categorías</a></li>
                                <li><a class="dropdown-item" href="adminComentarios.php"><i class="fa-solid fa-comments me-2"></i>Comentarios</a></li>
                                <li><a class="dropdown-item" href="adminReportes.php"><i class="fa-solid fa-chart-pie me-2"></i>Reportes</a></li>
                            <?php endif; ?>
                            
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?');">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="container-fluid px-0 mb-4">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #16a085, #1abc9c); border-radius: 0;">
                <div class="card-body text-white p-4">
                    <div class="container">
                        <div class="d-flex align-items-center flex-wrap">
                            <img src="<?php echo $estudiante['avatar']; ?>" class="rounded-circle border border-4 border-white me-4" width="100" height="100" alt="Avatar">
                            <div>
                                <h2 class="fw-bold mb-1"><?php echo htmlspecialchars($estudiante['nombre']); ?></h2>
                                <p class="mb-0"><i class="fa-solid fa-envelope me-2"></i> <?php echo htmlspecialchars($estudiante['email']); ?></p>
                                <p class="mb-0"><i class="fa-solid fa-calendar me-2"></i> Miembro desde <?php echo $estudiante['fechaRegistro']; ?></p>
                            </div>
                            <div class="ms-auto text-end mt-3 mt-md-0">
                                <h3 class="fw-bold mb-0"><?php echo $totalCursos; ?></h3>
                                <small>Cursos inscritos</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #e67e22, #f39c12);">
            <div class="card-body text-white">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-filter me-2"></i>Filtros</h5>
                <form method="GET" action="kardex.php">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Fecha de inscripcion (desde)</label>
                            <input type="date" class="form-control form-control-sm" name="fechaDesde">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Fecha de inscripcion (hasta)</label>
                            <input type="date" class="form-control form-control-sm" name="fechaHasta">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Categoria</label>
                            <select class="form-select form-select-sm" name="categoria">
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Estado</label>
                            <select class="form-select form-select-sm" name="estado">
                                <option value="todos">Todos</option>
                                <option value="terminados">Solo terminados</option>
                                <option value="activos">Solo activos</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="reset" class="btn btn-sm btn-light me-2">Limpiar</button>
                        <button type="submit" class="btn btn-sm text-white" style="background-color: #2c3e50;">Aplicar Filtros</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-book me-2" style="color: #16a085;"></i>Historial de Cursos</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Curso</th>
                                <th>Categoria</th>
                                <th>Inscripcion</th>
                                <th>Último Ingreso</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($cursosInscritos)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Aún no estás inscrito en ningún curso. ¡Explora el catálogo!</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($cursosInscritos as $curso): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?php echo htmlspecialchars($curso['imagen']); ?>" class="rounded me-2" width="50" height="40" style="object-fit: cover;" alt="<?php echo htmlspecialchars($curso['titulo']); ?>">
                                                <span class="fw-semibold"><?php echo htmlspecialchars($curso['titulo']); ?></span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary"><?php echo htmlspecialchars($curso['categoria']); ?></span></td>
                                        <td><?php echo date('d M Y', strtotime($curso['fecha_inscripcion'])); ?></td>
                                        <td><?php echo date('d M Y', strtotime($curso['fecha_inscripcion'])); ?></td>
                                        <td>
                                            <?php if (isset($curso['estado_inscripcion']) && $curso['estado_inscripcion'] === 'completado'): ?>
                                                <span class="badge bg-success">Terminado</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">En progreso</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($curso['estado_inscripcion']) && $curso['estado_inscripcion'] === 'completado'): ?>
                                                <a href="diploma.php?curso=<?php echo $curso['id']; ?>" class="btn btn-sm btn-outline-success">Certificado</a>
                                            <?php else: ?>
                                                <a href="detallesCurso.php?id=<?php echo $curso['id']; ?>" class="btn btn-sm text-white" style="background-color: #2c3e50;">Continuar</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
    <script src="js/kardex.js"></script>
</body>
</html>