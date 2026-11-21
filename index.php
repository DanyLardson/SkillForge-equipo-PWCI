<?php
session_start();
require_once 'modelos/Curso.php'; 

$usuarioLogueado = isset($_SESSION['usuario_id']);
$tipoUsuario = $_SESSION['usuario_rol'] ?? 'estudiante';
$nombreUsuario = $_SESSION['usuario_nombre'] ?? 'Invitado';
$avatarUsuario = "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg";

$categorias = [
    "Todas las categorías",
    "IT & Software",
    "Marketing",
    "Diseño",
    "Negocios",
    "Idiomas",
    "Ciencias",
    "Arte y Música"
];

// --- CAMBIO DEL BUSCADOR ---
$busqueda = $_GET['q'] ?? null; 

$modelo = new Curso();
$cursosReales = $modelo->obtenerTodos($busqueda); 

$cursosMejorCalificados = array_slice($cursosReales, 0, 3);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillForge | Portal de Cursos en Linea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #2c3e50;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white" href="index.php">
                <i class="fa-solid fa-graduation-cap me-1" style="color: #e67e22;"></i>SkillForge
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- formulario para busqueda actualizado -->
                <form class="d-flex mx-auto" style="width: 50%;" method="GET" action="index.php">
                    <input class="form-control me-2" type="search" name="q" placeholder="Buscar cursos..." value="<?php echo htmlspecialchars($busqueda ?? ''); ?>">
                    <button class="btn btn-outline-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                
                <?php if ($usuarioLogueado): ?>
                    <div class="d-flex align-items-center">
                        <a href="chat.php" class="text-white me-3 text-decoration-none">
                            <i class="fa-solid fa-comments"></i>
                        </a>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="<?php echo $avatarUsuario; ?>" class="rounded-circle me-2" width="35" height="35" alt="Avatar">
                                <span><?php echo explode(' ', $nombreUsuario)[0]; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="kardex.php"><i class="fa-solid fa-book me-2"></i>Mi Kardex</a></li>
                                
                                <?php if ($tipoUsuario === "instructor" || $tipoUsuario === "admin"): ?>
                                    <li><a class="dropdown-item" href="ventas.php"><i class="fa-solid fa-chart-line me-2"></i>Panel de Ventas</a></li>
                                <?php endif; ?>

                                <?php if ($tipoUsuario === "admin"): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="adminUsuarios.php"><i class="fa-solid fa-users-cog me-2"></i>Usuarios</a></li>
                                    <li><a class="dropdown-item" href="adminCategorias.php"><i class="fa-solid fa-tags me-2"></i>Categorias</a></li>
                                    <li><a class="dropdown-item" href="adminComentarios.php"><i class="fa-solid fa-comments me-2"></i>Comentarios</a></li>
                                    <li><a class="dropdown-item" href="adminReportes.php"><i class="fa-solid fa-chart-pie me-2"></i>Reportes</a></li>
                                <?php endif; ?>
                                
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="logout.php" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?');">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="d-flex">
                        <a href="login.php" class="btn btn-outline-light me-2">Iniciar Sesion</a>
                        <a href="registro.php" class="btn text-white" style="background-color: #e67e22;">Registrarse</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- hero -->
    <header class="hero-section text-white text-center py-5">
        <div class="container position-relative z-1">
            <h1 class="display-4 fw-bold">Aprende a tu ritmo, desde cualquier lugar</h1>
            <p class="lead fs-4">Descubre cursos en linea de expertos en IT, Marketing, Diseño y mucho mas.</p>
            <a href="#cursos" class="btn btn-lg text-white fw-bold mt-3" style="background-color: #e67e22;">Ver Cursos</a>
        </div>
    </header>

    <!-- contenido principal -->
    <div class="container-fluid px-4 my-5">
        <div class="row">
            
            <!-- sidebar categorias -->
            <aside class="col-md-3 mb-4 ps-0">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white fw-bold" style="background-color: #2c3e50;">
                        <i class="fa-solid fa-list me-2"></i>Categorias
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($categorias as $categoria): ?>
                            <li class="list-group-item">
                                <a href="#" class="text-decoration-none text-dark"><?php echo $categoria; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>

            <!-- main -->
            <main class="col-md-9">
                
                <!-- cursos reales y buscador -->
                <section id="cursos" class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fw-bold text-dark">Nuestros Cursos</h3>
                        <a href="index.php" class="btn btn-sm btn-outline-secondary">Ver todos</a>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        
                        <?php if (empty($cursosMejorCalificados)): ?>
                            <div class="col-12"><p class="text-muted">No se encontraron cursos que coincidan con tu búsqueda.</p></div>
                        <?php else: ?>
                            <?php foreach ($cursosMejorCalificados as $curso): ?>
                                <div class="col">
                                    <div class="card h-100 shadow-sm border-0 card-hover">
                                        <img src="<?php echo htmlspecialchars($curso['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($curso['titulo']); ?>" style="height: 180px; object-fit: cover;">
                                        <div class="card-body">
                                            <span class="badge bg-primary mb-2"><?php echo htmlspecialchars($curso['categoria']); ?></span>
                                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($curso['titulo']); ?></h5>
                                            <p class="card-text text-muted small"><?php echo htmlspecialchars(substr($curso['descripcion'], 0, 80)) . '...'; ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-warning"><i class="fa-solid fa-star"></i> <?php echo $curso['rating']; ?></span>
                                                <span class="fw-bold text-success">$<?php echo number_format($curso['precio'], 2); ?></span>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white border-0 text-center pb-3">
                                            <a href="detallesCurso.php?id=<?php echo $curso['id']; ?>" class="btn btn-sm text-white w-100" style="background-color: #2c3e50;">Ver Detalle</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                    </div>
                </section>

                <!-- cursos mas recientes (Fetch) -->
                <section class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fw-bold text-dark">Cursos Mas Recientes</h3>
                        <a href="#" class="btn btn-sm btn-outline-secondary">Ver todos</a>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="contenedor-cursos">
                        <!-- se llenan con el JS -->
                    </div>
                </section>

            </main>
        </div>
    </div>

    <!-- footer -->
    <footer class="text-white text-center py-4 mt-5" style="background-color: #2c3e50;">
        <div class="container">
            <p class="mb-1">&copy; 2026 SkillForge </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/api-cursos.js"></script>
</body>
</html>