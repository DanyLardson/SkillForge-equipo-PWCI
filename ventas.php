<?php

//Ahora me simulo como instructor (bro con suerte voy a ejercer)
$instructor = [
    "nombre" => "Daniel Montelongo",
    "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg"
];


$resumen = [
    "totalIngresos" => 15015.97,
    "totalAlumnos" => 348,
    "cursosActivos" => 4
];


$desglosePagos = [
    ["forma" => "Tarjeta", "icono" => "fa-credit-card", "monto" => 9500.00],
    ["forma" => "Efectivo", "icono" => "fa-money-bill", "monto" => 3200.00],
    ["forma" => "Transferencia", "icono" => "fa-building-columns", "monto" => 2315.97]
];


$cursos = [
    [
        "id" => 1,
        "titulo" => "PHP y MySQL desde Cero",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-primary",
        "alumnos" => 120,
        "nivelPromedio" => 2.5,
        "ingresos" => 5998.80
    ],
    [
        "id" => 4,
        "titulo" => "Python para Data Science",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-primary",
        "alumnos" => 85,
        "nivelPromedio" => 1.8,
        "ingresos" => 5099.15
    ],
    [
        "id" => 2,
        "titulo" => "Marketing Digital Avanzado",
        "categoria" => "Marketing",
        "colorBadge" => "bg-success",
        "alumnos" => 98,
        "nivelPromedio" => 3.0,
        "ingresos" => 3918.02
    ],
    [
        "id" => 3,
        "titulo" => "Introducción a UX/UI",
        "categoria" => "Diseño",
        "colorBadge" => "bg-danger",
        "alumnos" => 45,
        "nivelPromedio" => 1.2,
        "ingresos" => 0.00
    ]
];


$categorias = ["Todas", "IT & Software", "Marketing", "Diseño"];


$alumnosDetalle = [
    [
        "nombre" => "María González",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "fechaInscripcion" => "15 Ene 2026",
        "nivel" => 3,
        "precio" => 49.99,
        "formaPago" => "Tarjeta"
    ],
    [
        "nombre" => "Carlos Quiroz",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "fechaInscripcion" => "18 Ene 2026",
        "nivel" => 2,
        "precio" => 49.99,
        "formaPago" => "Transferencia"
    ],
    [
        "nombre" => "Ana López",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "fechaInscripcion" => "20 Ene 2026",
        "nivel" => 1,
        "precio" => 19.99,
        "formaPago" => "Efectivo"
    ]
];

$totalDetalle = array_sum(array_column($alumnosDetalle, 'precio'));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Ventas | SkillForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/ventas.css">
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
                            <img src="<?php echo $instructor['avatar']; ?>" class="rounded-circle me-2" width="35" height="35" alt="Avatar">
                            <span><?php echo explode(' ', $instructor['nombre'])[0]; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="index.php">Inicio</a></li>
                            <li><a class="dropdown-item" href="#">Mis Cursos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="login.php" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?');">
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
        
        <h2 class="fw-bold mb-4" style="color: #2c3e50;">
           Panel de Ventas
        </h2>

        
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white" style="background-color: #16a085;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Total de Ingresos</h6>
                                <h2 class="fw-bold mb-0">$<?php echo number_format($resumen['totalIngresos'], 2); ?></h2>
                            </div>
                            <i class="fa-solid fa-dollar-sign fa-2x" style="opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white" style="background-color: #e67e22;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Alumnos Inscritos</h6>
                                <h2 class="fw-bold mb-0"><?php echo $resumen['totalAlumnos']; ?></h2>
                            </div>
                            <i class="fa-solid fa-users fa-2x" style="opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white" style="background-color: #2c3e50;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Cursos Activos</h6>
                                <h2 class="fw-bold mb-0"><?php echo $resumen['cursosActivos']; ?></h2>
                            </div>
                            <i class="fa-solid fa-book fa-2x" style="opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #e67e22, #f39c12);">
            <div class="card-body text-white">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-filter me-2"></i>Filtros</h5>
                <form method="GET" action="ventas.php">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Rango de fechas de creacion</label>
                            <input type="date" class="form-control form-control-sm" name="fechaDesde">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Categoria</label>
                            <select class="form-select form-select-sm" name="categoria">
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Estado</label>
                            <select class="form-select form-select-sm" name="estado">
                                <option value="todos">Todos</option>
                                <option value="activos">Solo activos</option>
                                <option value="baja">Solo dados de baja</option>
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

        
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                   Vista General por Curso
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Curso</th>
                                <th>Categoría</th>
                                <th>Alumnos Inscritos</th>
                                <th>Nivel Promedio</th>
                                <th>Ingresos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cursos as $curso): ?>
                                <tr>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($curso['titulo']); ?></td>
                                    <td><span class="badge <?php echo $curso['colorBadge']; ?>"><?php echo $curso['categoria']; ?></span></td>
                                    <td><?php echo $curso['alumnos']; ?></td>
                                    <td>Nivel <?php echo number_format($curso['nivelPromedio'], 1); ?></td>
                                    <td class="fw-bold" style="color: #16a085;">
                                        $<?php echo number_format($curso['ingresos'], 2); ?>
                                    </td>
                                    <td>
                                        <a href="#detalleCurso<?php echo $curso['id']; ?>" class="btn btn-sm btn-outline-secondary">Ver Detalle</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total general:</td>
                                <td colspan="2" class="fw-bold" style="color: #16a085; font-size: 1.1rem;">
                                    $<?php echo number_format($resumen['totalIngresos'], 2); ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="mt-3 text-muted small">
                    <strong>Desglose por forma de pago:</strong>
                        <?php foreach ($desglosePagos as $pago): ?>
                           <span class="ms-2">
                               <?php echo $pago['forma']; ?>: $<?php echo number_format($pago['monto'], 2); ?>
                           </span> |
                        <?php endforeach; ?>
                </div>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    Detalle de Alumnos - PHP y MySQL desde Cero
                </h5>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Alumno</th>
                                <th>Fecha de Inscripción</th>
                                <th>Nivel de Avance</th>
                                <th>Precio Pagado</th>
                                <th>Forma de Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alumnosDetalle as $alumno): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo $alumno['avatar']; ?>" class="rounded-circle me-2" width="25" height="25" alt="Avatar">
                                        <?php echo htmlspecialchars($alumno['nombre']); ?>
                                    </td>
                                    <td><?php echo $alumno['fechaInscripcion']; ?></td>
                                    <td><span class="badge bg-info text-dark">Nivel <?php echo $alumno['nivel']; ?></span></td>
                                    <td>$<?php echo number_format($alumno['precio'], 2); ?></td>
                                    <td><?php echo $alumno['formaPago']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total del curso:</td>
                                <td colspan="2" class="fw-bold" style="color: #16a085;">
                                    $<?php echo number_format($totalDetalle, 2); ?>
                                </td>
                            </tr>
                        </tfoot>
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
    <script src="js/ventas.js"></script>
</body>
</html>