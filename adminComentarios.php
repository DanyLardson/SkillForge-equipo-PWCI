<?php
require_once 'core/Auth.php';
Auth::check('admin'); //Candado pa solo pasar si eres admin

//comentarios
$comentarios = [
    [
        "id" => 1,
        "curso" => "PHP y MySQL desde Cero",
        "usuario" => "María González",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "fecha" => "10 Feb 2026, 03:20 PM",
        "estrellas" => 5,
        "texto" => "Excelente curso, el instructor explica muy bien y los ejemplos son claros. Lo recomiendo ampliamente. Soy Ana profe, oiga profe podria responder el chat, es que traigo muchas dudas,ayuda aaaa",
        "estado" => "Visible",
        "fechaEliminacion" => null,
        "causa" => null
    ],
    [
        "id" => 2,
        "curso" => "PHP y MySQL desde Cero",
        "usuario" => "Carlos Quiroz",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "fecha" => "08 Feb 2026, 11:45 AM",
        "estrellas" => 4,
        "texto" => "Muy buen contenido, no lo entendi pero se ve que el profe le sabe, tome todo mi dinero buen hombre.",
        "estado" => "Visible",
        "fechaEliminacion" => null,
        "causa" => null
    ],
    [
        "id" => 3,
        "curso" => "Marketing Digital Avanzado",
        "usuario" => "Juan Pérez",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "fecha" => "05 Feb 2026, 09:10 AM",
        "estrellas" => 5,
        "texto" => "Oigan venia por el curso de python, pero estuvo con todo ahora ya se como poner mi negocio.",
        "estado" => "Visible",
        "fechaEliminacion" => null,
        "causa" => null
    ],
    [
        "id" => 4,
        "curso" => "Introducción a UX/UI",
        "usuario" => "Usuario Anónimo",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "fecha" => "03 Feb 2026, 07:30 PM",
        "estrellas" => 1,
        "texto" => "Con que aqui estabas basura, mucho curso y todavia no me pagas los 200 varos que te preste.",
        "estado" => "Eliminado",
        "fechaEliminacion" => "04 Feb 2026, 10:15 AM",
        "causa" => "Lenguaje ofensivo y falta de respeto hacia el instructor."
    ],
    [
        "id" => 5,
        "curso" => "Python para Data Science",
        "usuario" => "Ana López",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "fecha" => "01 Feb 2026, 02:00 PM",
        "estrellas" => 5,
        "texto" => "Increíble curso, aprendí muchísimo. ya podre hackiar.",
        "estado" => "Visible",
        "fechaEliminacion" => null,
        "causa" => null
    ],
    [
        "id" => 6,
        "curso" => "Redes y Ciberseguridad",
        "usuario" => "Usuario Spam",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "fecha" => "28 Ene 2026, 06:45 PM",
        "estrellas" => 1,
        "texto" => "vaya aprendimos muy rapido, pero no tan rapido como llegan los pedidos de 1xBET, asi es soy flash pueden depositarme a esta cuenta 0203939200123.",
        "estado" => "Eliminado",
        "fechaEliminacion" => "29 Ene 2026, 08:00 AM",
        "causa" => "Spam publicitario no relacionado con el curso."
    ]
];


$cursosFiltro = ["Todos", "PHP y MySQL desde Cero", "Marketing Digital Avanzado", "Introducción a UX/UI", "Python para Data Science", "Redes y Ciberseguridad"];


$estadosFiltro = ["Todos", "Visible", "Eliminado"];

$totalComentarios = count($comentarios);
$totalVisibles = count(array_filter($comentarios, fn($c) => $c['estado'] === 'Visible'));
$totalEliminados = count(array_filter($comentarios, fn($c) => $c['estado'] === 'Eliminado'));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Comentarios | SkillForge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adminComentarios.css">
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
                    <li class="nav-item"><a class="nav-link" href="adminCategorias.php">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link active" href="adminComentarios.php">Comentarios</a></li>
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
               Gestión de Comentarios
            </h2>
        </div>

       
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white" style="background-color: #2c3e50;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Total Comentarios</h6>
                                <h2 class="fw-bold mb-0"><?php echo $totalComentarios; ?></h2>
                            </div>
                            <i class="fa-solid fa-comments fa-2x" style="opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white" style="background-color: #16a085;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Visibles</h6>
                                <h2 class="fw-bold mb-0"><?php echo $totalVisibles; ?></h2>
                            </div>
                            <i class="fa-solid fa-eye fa-2x" style="opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white" style="background-color: #e74c3c;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Eliminados</h6>
                                <h2 class="fw-bold mb-0"><?php echo $totalEliminados; ?></h2>
                            </div>
                            <i class="fa-solid fa-trash fa-2x" style="opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #e67e22, #f39c12);">
            <div class="card-body text-white">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-filter me-2"></i>Filtros</h5>
                <form method="GET" action="adminComentarios.php">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label small fw-semibold">Curso</label>
                            <select class="form-select form-select-sm" name="curso">
                                <?php foreach ($cursosFiltro as $curso): ?>
                                    <option value="<?php echo $curso; ?>"><?php echo $curso; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small fw-semibold">Estado</label>
                            <select class="form-select form-select-sm" name="estado">
                                <?php foreach ($estadosFiltro as $estado): ?>
                                    <option value="<?php echo $estado; ?>"><?php echo $estado; ?></option>
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
               <h5 class="fw-bold mb-3">
                   Lista de Comentarios
               </h5>
                
                <?php foreach ($comentarios as $comentario): ?>
                    <div class="card mb-3 border-0 shadow-sm <?php echo $comentario['estado'] === 'Eliminado' ? 'comentario-eliminado' : ''; ?>">
                        <div class="card-body">
                            
  
                            <div class="d-flex mb-2 flex-wrap">
                                <img src="<?php echo $comentario['avatar']; ?>" class="rounded-circle me-3" width="45" height="45" alt="Avatar">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-0"><?php echo htmlspecialchars($comentario['usuario']); ?></h6>
                                    <small class="text-muted">
                                        <i class="fa-solid fa-book me-1"></i> <?php echo htmlspecialchars($comentario['curso']); ?>
                                        <span class="mx-2">|</span>
                                        <i class="fa-solid fa-clock me-1"></i> <?php echo $comentario['fecha']; ?>
                                    </small>
                                </div>
                                <div class="text-warning">
                                    <?php for ($i = 0; $i < $comentario['estrellas']; $i++): ?>
                                        <i class="fa-solid fa-star"></i>
                                    <?php endfor; ?>
                                    <?php for ($i = $comentario['estrellas']; $i < 5; $i++): ?>
                                        <i class="fa-regular fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>


                            <?php if ($comentario['estado'] === 'Visible'): ?>
                                <p class="mb-3 text-muted"><?php echo htmlspecialchars($comentario['texto']); ?></p>
                                <div class="text-end">
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $comentario['id']; ?>">
                                        <i class="fa-solid fa-trash me-1"></i>Eliminar comentario
                                    </button>
                                </div>
                            <?php else: ?>

                                <div class="alert alert-secondary mb-0">
                                    <i class="fa-solid fa-ban me-2"></i>
                                    <strong>Comentario eliminado.</strong>
                                    <br>
                                    <small>
                                        <strong>Fecha de eliminacion:</strong> <?php echo $comentario['fechaEliminacion']; ?>
                                        <br>
                                        <strong>Causa:</strong> <?php echo htmlspecialchars($comentario['causa']); ?>
                                    </small>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>


                    <?php if ($comentario['estado'] === 'Visible'): ?>
                        <div class="modal fade" id="modalEliminar<?php echo $comentario['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header text-white" style="background-color: #e74c3c;">
                                        <h5 class="modal-title"><i class="fa-solid fa-triangle-exclamation me-2"></i>Eliminar Comentario</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estas seguro de que quieres eliminar este comentario?</p>
                                        <p class="text-muted small">
                                            <strong>Usuario:</strong> <?php echo htmlspecialchars($comentario['usuario']); ?><br>
                                            <strong>Comentario:</strong> <?php echo htmlspecialchars($comentario['texto']); ?>
                                        </p>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Causa de la eliminacion <span class="text-danger">*</span></label>
                                            <select class="form-select mb-2" required>
                                                <option value="">Selecciona una causa...</option>
                                                <option>Lenguaje ofensivo</option>
                                                <option>Spam publicitario</option>
                                                <option>Contenido no relacionado con el curso</option>
                                                <option>Falta de respeto hacia el instructor</option>
                                                <option>Otro</option>
                                            </select>
                                            <textarea class="form-control" rows="2" placeholder="Detalles adicionales (opcional)"></textarea>
                                        </div>
                                        <div class="alert alert-warning small mb-0">
                                            <i class="fa-solid fa-info-circle me-1"></i>
                                            El comentario no se borrara de la base de datos, solo se marcará como eliminado y se mostrará una leyenda en su lugar.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger">Eliminar Comentario</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>

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
    <script src="js/adminComentarios.js"></script>
</body>
</html>