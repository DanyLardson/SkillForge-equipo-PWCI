<?php
session_start();
require_once 'core/Auth.php';
Auth::check(); // Solo usuarios logueados

require_once 'config/Database.php';
$database = new Database();
$db = $database->connect();

$curso_id = $_GET['curso'] ?? null;
$usuario_id = $_SESSION['usuario_id'];

// Validar que se pase un curso
if (!$curso_id) {
    die("Error: No se especificó un curso para el diploma.");
}

// Consultar si el alumno está inscrito y si ya terminó
$query = "SELECT c.titulo, c.descripcion, i.fecha_inscripcion, i.estatus as estado_inscripcion, u.nombre as alumno_nombre, u.email as alumno_email, inst.nombre as instructor_nombre
          FROM cursos c
          INNER JOIN inscripciones i ON c.id = i.curso_id
          INNER JOIN usuarios u ON i.usuario_id = u.id
          LEFT JOIN usuarios inst ON c.instructor_id = inst.id
          WHERE c.id = :curso_id AND i.usuario_id = :usuario_id";

$stmt = $db->prepare($query);
$stmt->execute([':curso_id' => $curso_id, ':usuario_id' => $usuario_id]);
$diploma = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$diploma) {
    die("Error: No estás inscrito en este curso o el curso no existe.");
}

// Si el estatus no es "completado", le podemos poner una fecha ficticia o usar la de inscripción
$fechaTerminacion = $diploma['estado_inscripcion'] === 'completado' 
                    ? date('d \d\e F \d\e Y', strtotime($diploma['fecha_inscripcion'])) 
                    : "Pendiente de completar";

$instructor = $diploma['instructor_nombre'] ?? 'SkillForge';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diploma | SkillForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/diploma.css">
</head>
<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm d-print-none" style="background-color: #2c3e50;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white" href="index.php">
                <i class="fa-solid fa-graduation-cap me-1" style="color: #e67e22;"></i>SkillForge
            </a>
            <div class="d-flex align-items-center ms-auto">
                <a href="kardex.php" class="text-white me-3 text-decoration-none">
                    <i class="fa-solid fa-arrow-left me-1"></i> Volver al Kardex
                </a>
                <button class="btn btn-sm text-white" style="background-color: #e67e22;" onclick="window.print();">
                    <i class="fa-solid fa-print me-1"></i> Imprimir / Descargar PDF
                </button>
            </div>
        </div>
    </nav>

    <!-- DIPLOMA -->
    <div class="container my-5">
        <div class="diploma mx-auto">
            <div class="diploma-borde">
                
                <div class="text-center mb-4">
                    <i class="fa-solid fa-graduation-cap diploma-logo"></i>
                    <h1 class="diploma-marca">SkillForge</h1>
                    <p class="diploma-subtitulo">Plataforma de Cursos en Linea</p>
                </div>

                <div class="text-center my-4">
                    <h2 class="diploma-titulo">CERTIFICADO DE FINALIZACION</h2>
                    <p class="diploma-texto">Se otorga el presente certificado a:</p>
                </div>

                <div class="text-center my-4">
                    <h2 class="diploma-nombre"><?php echo htmlspecialchars($diploma['alumno_nombre']); ?></h2>
                    <div class="diploma-linea"></div>
                </div>

                <div class="text-center my-4">
                    <p class="diploma-texto">Por haber completado satisfactoriamente el curso:</p>
                    <h3 class="diploma-curso"><?php echo htmlspecialchars($diploma['titulo']); ?></h3>
                    <p class="diploma-duracion">
                        <i class="fa-solid fa-clock me-1"></i> Fecha de Inscripción: <?php echo date('d/m/Y', strtotime($diploma['fecha_inscripcion'])); ?>
                    </p>
                </div>

                <div class="text-center my-4">
                    <p class="diploma-texto">Fecha de terminación:</p>
                    <p class="diploma-fecha"><?php echo $fechaTerminacion; ?></p>
                </div>

                <div class="row mt-5 pt-4">
                    <div class="col-6 text-center">
                        <div class="diploma-firma-linea"></div>
                        <p class="diploma-firma-nombre"><?php echo htmlspecialchars($instructor); ?></p>
                        <p class="diploma-firma-rol">Instructor del Curso</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="diploma-firma-linea"></div>
                        <p class="diploma-firma-nombre">SkillForge</p>
                        <p class="diploma-firma-rol">Certifica</p>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <p class="diploma-folio">
                        <i class="fa-solid fa-certificate me-1"></i>
                        Folio: SF-<?php echo date('Y') . '-' . str_pad($curso_id, 4, "0", STR_PAD_LEFT) . '-' . $usuario_id; ?>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <footer class="text-white text-center py-4 mt-5 d-print-none" style="background-color: #2c3e50;">
        <div class="container">
            <p class="mb-1">&copy; 2026 SkillForge</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/diploma.js"></script>
</body>
</html>