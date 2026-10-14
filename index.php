<?php

//BAse de datos (simulada por el momento)

$usuarioLogueado = true;
$tipoUsuario = "admin";  
$nombreUsuario = "María González";
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

$cursosMejorCalificados = [
    [
        "id" => 1,
        "titulo" => "PHP y MySQL desde Cero",
        "descripcion" => "Aprende a crear aplicaciones web dinámicas con PHP puro y MySQL.",
        "imagen" => "https://bairesdev.mo.cloudinary.net/blog/2023/08/PHP-libraries.jpg",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-primary",
        "rating" => 4.8,
        "precio" => "$49.99",
        "esGratis" => false
    ],
    [
        "id" => 2,
        "titulo" => "Marketing Digital Avanzado",
        "descripcion" => "Estrategias de SEO, SEM y redes sociales para hacer crecer tu negocio.",
        "imagen" => "https://tse2.mm.bing.net/th/id/OIP.FZl2Ea_EW1iLcb1oNXPqJAHaEO?r=0&pid=Api&P=0&h=180",
        "categoria" => "Marketing",
        "colorBadge" => "bg-success",
        "rating" => 4.6,
        "precio" => "$39.99",
        "esGratis" => false
    ],
    [
        "id" => 3,
        "titulo" => "Introducción a UX/UI",
        "descripcion" => "Principios básicos de diseño de interfaces y experiencia de usuario.",
        "imagen" => "https://blog.cubos.academy/content/images/2023/02/Designer-UI.jpg",
        "categoria" => "Diseño",
        "colorBadge" => "bg-danger",
        "rating" => 4.9,
        "precio" => "Gratis",
        "esGratis" => true
    ]
];

$cursosRecientes = [
    [
        "id" => 4,
        "titulo" => "Python para Data Science",
        "descripcion" => "Análisis de datos y machine learning con Python y Pandas.",
        "imagen" => "https://tse4.mm.bing.net/th/id/OIP.FG7N73UM9C4_ig2cyOnrqQHaEK?r=0&pid=Api&P=0&h=180",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-primary",
        "rating" => 4.7,
        "precio" => "$59.99",
        "esGratis" => false
    ],
    [
        "id" => 5,
        "titulo" => "Inglés para Negocios",
        "descripcion" => "Comunicación efectiva en inglés para entornos corporativos.",
        "imagen" => "https://urbantecno.com/hero/2023/04/descubre-cuales-son-los-mejores-cursos-para-aprender-ingles-desde-cero.jpg?width=1200",
        "categoria" => "Idiomas",
        "colorBadge" => "bg-warning text-dark",
        "rating" => 4.5,
        "precio" => "$29.99",
        "esGratis" => false
    ],
    [
        "id" => 6,
        "titulo" => "Redes y Ciberseguridad",
        "descripcion" => "Protege sistemas y aprende los fundamentos de redes y seguridad.",
        "imagen" => "https://dplnews.com/wp-content/uploads/2023/04/dplnews-ciberseguridad-dispositivo-jb020123-scaled.jpeg",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-info text-dark",
        "rating" => 4.8,
        "precio" => "$54.99",
        "esGratis" => false
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillForge | Portal de Cursos en Línea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                <form class="d-flex mx-auto" style="width: 50%;">
                    <input class="form-control me-2" type="search" placeholder="Buscar cursos por título, categoría o instructor..." aria-label="Search">
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
                <?php if ($tipoUsuario === "estudiante"): ?>
                    <li><a class="dropdown-item" href="kardex.php"><i class="fa-solid fa-book me-2"></i>Mi Kardex</a></li>
                <?php elseif ($tipoUsuario === "instructor"): ?>
                    <li><a class="dropdown-item" href="ventas.php"><i class="fa-solid fa-chart-line me-2"></i>Panel de Ventas</a></li>
                <?php elseif ($tipoUsuario === "admin"): ?>
                    <li><a class="dropdown-item" href="kardex.php"><i class="fa-solid fa-book me-2"></i>Mi Kardex</a></li>
                    <li><a class="dropdown-item" href="ventas.php"><i class="fa-solid fa-chart-line me-2"></i>Panel de Ventas</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="adminUsuarios.php"><i class="fa-solid fa-users-cog me-2"></i>Usuarios</a></li>
                    <li><a class="dropdown-item" href="adminCategorias.php"><i class="fa-solid fa-tags me-2"></i>Categorías</a></li>
                    <li><a class="dropdown-item" href="adminComentarios.php"><i class="fa-solid fa-comments me-2"></i>Comentarios</a></li>
                    <li><a class="dropdown-item" href="adminReportes.php"><i class="fa-solid fa-chart-pie me-2"></i>Reportes</a></li>
                <?php endif; ?>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="login.php" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?');">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
<?php else: ?>
    
    <div class="d-flex">
        <a href="login.php" class="btn btn-outline-light me-2">Iniciar Sesión</a>
        <a href="registro.php" class="btn text-white" style="background-color: #e67e22;">Registrarse</a>
    </div>
<?php endif; ?>
            </div>
        </div>
    </nav>

    
    <header class="hero-section text-white text-center py-5">
        <div class="container position-relative z-1">
            <h1 class="display-4 fw-bold">Aprende a tu ritmo, desde cualquier lugar</h1>
            <p class="lead fs-4">Descubre cursos en línea de expertos en IT, Marketing, Diseño y mucho más.</p>
            <a href="#cursos" class="btn btn-lg text-white fw-bold mt-3" style="background-color: #e67e22;">Ver Cursos</a>
        </div>
    </header>

    
    <div class="container-fluid px-4 my-5">
        <div class="row">
            
            
            <aside class="col-md-3 mb-4 ps-0">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white fw-bold" style="background-color: #2c3e50;">
                        <i class="fa-solid fa-list me-2"></i>Categorías
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

            
            <main class="col-md-9">
                
                
                <section id="cursos" class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fw-bold text-dark"> Cursos Mejor Calificados</h3>
                        <a href="#" class="btn btn-sm btn-outline-secondary">Ver todos</a>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        
                        
                        <?php foreach ($cursosMejorCalificados as $curso): ?>
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0 card-hover">
                                    <img src="<?php echo $curso['imagen']; ?>" class="card-img-top" alt="<?php echo $curso['titulo']; ?>" style="height: 180px; object-fit: cover;">
                                    <div class="card-body">
                                        <span class="badge <?php echo $curso['colorBadge']; ?> mb-2"><?php echo $curso['categoria']; ?></span>
                                        <h5 class="card-title fw-bold"><?php echo $curso['titulo']; ?></h5>
                                        <p class="card-text text-muted small"><?php echo $curso['descripcion']; ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-warning"><i class="fa-solid fa-star"></i> <?php echo $curso['rating']; ?></span>
                                            <span class="fw-bold text-success"><?php echo $curso['precio']; ?></span>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white border-0 text-center pb-3">
                                        <a href="detallesCurso.php?id=<?php echo $curso['id']; ?>" class="btn btn-sm text-white w-100" style="background-color: #2c3e50;">Ver Detalle</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                    </div>
                </section>

                
                <section class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fw-bold text-dark">Cursos Más Recientes</h3>
                        <a href="#" class="btn btn-sm btn-outline-secondary">Ver todos</a>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="contenedor-cursos">
                        <!-- Los cursos se cargarán con JavaScript desde la API -->
                    </div>
                </section>

            </main>
        </div>
    </div>

    
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