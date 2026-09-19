<?php
//datos del diploma para la base de datos simulada
$diploma = [
    "folio" => "SF-2026-0001",
    "fechaTerminacion" => "14 de Septiembre de 2026",
    "alumno" => [
        "nombre" => "Maria Gonzalez Perez",
        "email" => "maria.gonzalez@correo.com"
    ],
    "curso" => [
        "titulo" => "PHP y MySQL desde Cero",
        "duracion" => "12 horas",
        "instructor" => "Daniel Montelongo"
    ],
    "certifica" => [
        "nombre" => "SkillForge",
        "representante" => "Direccion Academica",
        "firma" => "SkillForge - Plataforma de Cursos en Linea"
    ]
];
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
                    <h2 class="diploma-nombre"><?php echo htmlspecialchars($diploma['alumno']['nombre']); ?></h2>
                    <div class="diploma-linea"></div>
                </div>

                
                <div class="text-center my-4">
                    <p class="diploma-texto">Por haber completado satisfactoriamente el curso:</p>
                    <h3 class="diploma-curso"><?php echo htmlspecialchars($diploma['curso']['titulo']); ?></h3>
                    <p class="diploma-duracion">
                        <i class="fa-solid fa-clock me-1"></i> Duracion: <?php echo $diploma['curso']['duracion']; ?>
                    </p>
                </div>

                
                <div class="text-center my-4">
                    <p class="diploma-texto">Terminado el dia:</p>
                    <p class="diploma-fecha"><?php echo $diploma['fechaTerminacion']; ?></p>
                </div>

                
                <div class="row mt-5 pt-4">
                    <div class="col-6 text-center">
                        <div class="diploma-firma-linea"></div>
                        <p class="diploma-firma-nombre"><?php echo htmlspecialchars($diploma['curso']['instructor']); ?></p>
                        <p class="diploma-firma-rol">Instructor del Curso</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="diploma-firma-linea"></div>
                        <p class="diploma-firma-nombre"><?php echo htmlspecialchars($diploma['certifica']['representante']); ?></p>
                        <p class="diploma-firma-rol"><?php echo htmlspecialchars($diploma['certifica']['nombre']); ?></p>
                    </div>
                </div>

                
                <div class="text-center mt-5">
                    <p class="diploma-folio">
                        <i class="fa-solid fa-certificate me-1"></i>
                        Folio: <?php echo $diploma['folio']; ?>
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