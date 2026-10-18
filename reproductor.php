<?php
require_once 'core/Auth.php';
Auth::check(); //para proteger la ventana

$curso = [
    "titulo" => "PHP y MySQL desde Cero",
    "instructor" => "Daniel Montelongo",
    "niveles" => [
        ["id" => 1, "titulo" => "Nivel 1: Introducción a PHP", "completado" => true],
        ["id" => 2, "titulo" => "Nivel 2: Variables", "completado" => false],
        ["id" => 3, "titulo" => "Nivel 3: Conexión a MySQL", "completado" => false]
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reproductor | SkillForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark shadow-sm" style="background-color: #2c3e50;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white" href="kardex.php"><i class="fa-solid fa-arrow-left me-2"></i>Volver al Kardex</a>
        </div>
    </nav>

    <div class="container-fluid my-4">
        <div class="row">
            <!-- Reproductor -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="ratio ratio-16x9 bg-dark d-flex align-items-center justify-content-center">
                        <div class="text-center text-white">
                            <i class="fa-solid fa-circle-play display-1 mb-3" style="color: #e67e22;"></i>
                            <h4 class="fw-bold">Video del curso</h4>
                            <p class="text-muted mb-0">El video se reproducirá aquí.</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="fw-bold">Nivel 1: Introducción a PHP</h4>
                        <p class="text-muted">Curso: <?php echo $curso['titulo']; ?> | Instructor: <?php echo $curso['instructor']; ?></p>
                        <button class="btn text-white" style="background-color: #16a085;"><i class="fa-solid fa-check me-2"></i>Marcar como completado</button>
                    </div>
                </div>
            </div>

            <!-- Lista niveles -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header text-white fw-bold" style="background-color: #2c3e50;">Contenido del Curso</div>
                    <ul class="list-group list-group-flush">
                        <?php foreach($curso['niveles'] as $nivel): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fa-solid <?php echo $nivel['completado'] ? 'fa-circle-check text-success' : 'fa-play text-muted'; ?> me-2"></i> <?php echo $nivel['titulo']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>