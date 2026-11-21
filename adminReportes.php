<?php
require_once 'core/Auth.php';
Auth::check('admin'); // Solo admins

require_once 'config/Database.php';
$database = new Database();
$db = $database->connect();

//obtener todos los usuarios pare el reporte
$stmt = $db->query("SELECT id, nombre, email, rol, fecha_registro FROM usuarios WHERE activo = 1");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$instructores = [];
$estudiantes = [];

//clasificar y calcular estadisticas
foreach ($usuarios as $user) {
    if ($user['rol'] === 'instructor' || $user['rol'] === 'admin') {
        //calcular ganancias para instructores
        $q = $db->prepare("SELECT SUM(i.monto_pagado) as ganancias, COUNT(DISTINCT c.id) as cursos 
                           FROM cursos c 
                           LEFT JOIN inscripciones i ON c.id = i.curso_id 
                           WHERE c.instructor_id = :id");
        $q->execute([':id' => $user['id']]);
        $stats = $q->fetch(PDO::FETCH_ASSOC);

        $instructores[] = [
            'nombre' => $user['nombre'],
            'email' => $user['email'],
            'fecha_registro' => $user['fecha_registro'],
            'cursos' => $stats['cursos'] ?? 0,
            'ganancias' => $stats['ganancias'] ?? 0
        ];
    } else {
        //calcular cursos para estudiantes
        $q = $db->prepare("SELECT COUNT(id) as cursos FROM inscripciones WHERE usuario_id = :id");
        $q->execute([':id' => $user['id']]);
        $stats = $q->fetch(PDO::FETCH_ASSOC);

        $estudiantes[] = [
            'nombre' => $user['nombre'],
            'email' => $user['email'],
            'fecha_registro' => $user['fecha_registro'],
            'cursos' => $stats['cursos'] ?? 0,
            'porcentaje' => 0 //aquie se podria calcular el prosentaje real si tuvieramos mas datos
        ];
    }
}

$tipoReporte = $_GET['tipo'] ?? 'instructor';
$fechaDesde = $_GET['fechaDesde'] ?? null;
$fechaHasta = $_GET['fechaHasta'] ?? null;
$totalGananciasGlobal = array_sum(array_column($instructores, 'ganancias'));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes | SkillForge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adminReportes.css">
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
                    <li class="nav-item"><a class="nav-link" href="adminComentarios.php">Comentarios</a></li>
                    <li class="nav-item"><a class="nav-link active" href="adminReportes.php">Reportes</a></li>
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
                Reporte de Usuarios
            </h2>
        </div>


        <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #e67e22, #f39c12);">
            <div class="card-body text-white">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-filter me-2"></i>Filtros del Reporte</h5>
                <form method="GET" action="adminReportes.php">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Tipo de Usuario</label>
                            <select class="form-select form-select-sm" name="tipo" onchange="this.form.submit()">
                                <option value="instructor" <?php echo $tipoReporte === 'instructor' ? 'selected' : ''; ?>>Instructores</option>
                                <option value="estudiante" <?php echo $tipoReporte === 'estudiante' ? 'selected' : ''; ?>>Estudiantes</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Fecha de ingreso (desde)</label>
                            <input type="date" class="form-control form-control-sm" name="fechaDesde">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Fecha de ingreso (hasta)</label>
                            <input type="date" class="form-control form-control-sm" name="fechaHasta">
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-sm text-white" style="background-color: #2c3e50;">
                            <i class="fa-solid fa-magnifying-glass me-1"></i> Aplicar Filtros
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white" style="background-color: #2c3e50;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Total Usuarios</h6>
                                <h2 class="fw-bold mb-0"><?php echo $tipoReporte === 'instructor' ? count($instructores) : count($estudiantes); ?></h2>
                            </div>
                            <i class="fa-solid fa-users fa-2x" style="opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white" style="background-color: #16a085;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">
                                    <?php echo $tipoReporte === 'instructor' ? 'Ganancias Totales' : 'Promedio Terminados'; ?>
                                </h6>
                                <h2 class="fw-bold mb-0">
                                    <?php if ($tipoReporte === 'instructor'): ?>
                                        $<?php echo number_format($totalGananciasGlobal, 2); ?>
                                    <?php else: ?>
                                        <?php 
                                            //como ahora todos tienen 0% por defecto, el promedio es 0
                                            $promedio = count($estudiantes) > 0 ? array_sum(array_column($estudiantes, 'porcentaje')) / count($estudiantes) : 0;
                                            echo round($promedio) . '%';
                                        ?>
                                    <?php endif; ?>
                                </h2>
                            </div>
                            <i class="fa-solid fa-<?php echo $tipoReporte === 'instructor' ? 'dollar-sign' : 'graduation-cap'; ?> fa-2x" style="opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white" style="background-color: #e67e22;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Estado</h6>
                                <h2 class="fw-bold mb-0">Solo Activos</h2>
                            </div>
                            <i class="fa-solid fa-check-circle fa-2x" style="opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                   <?php echo $tipoReporte === 'instructor' ? 'Reporte de Instructores' : 'Reporte de Estudiantes'; ?>
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Fecha Ingreso</th>
                                <?php if ($tipoReporte === 'instructor'): ?>
                                    <th>Cursos Ofrecidos</th>
                                    <th>Total Ganancias</th>
                                <?php else: ?>
                                    <th>Cursos Inscritos</th>
                                    <th>% Cursos Terminados</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($tipoReporte === 'instructor'): ?>
                                <?php foreach ($instructores as $inst): ?>
                                    <tr>
                                        <td class="fw-semibold"><?php echo htmlspecialchars($inst['email']); ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                <!-- esto quita la imagen para que no salga raro o el url -->
                                                    <i class="fa-solid fa-user-circle me-2 fs-4 text-muted"></i>
                                                <?php echo htmlspecialchars($inst['nombre']); ?>
                                            </div>
                                        </td>
                                        <td><?php echo date('d M Y', strtotime($inst['fecha_registro'])); ?></td>
                                        <td><span class="badge bg-info text-dark"><?php echo $inst['cursos']; ?></span></td>
                                        <td class="fw-bold" style="color: #16a085;">
                                            $<?php echo number_format($inst['ganancias'], 2); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php foreach ($estudiantes as $est): ?>
                                    <tr>
                                        <td class="fw-semibold"><?php echo htmlspecialchars($est['email']); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-user-circle me-2 fs-4 text-muted"></i>
                                                <?php echo htmlspecialchars($est['nombre']); ?>
                                            </div>
                                        </td>
                                        <td><?php echo date('d M Y', strtotime($est['fecha_registro'])); ?></td>
                                        <td><span class="badge bg-info text-dark"><?php echo $est['cursos']; ?></span></td>
                                        <td>
                                            <span class="fw-bold small"><?php echo $est['porcentaje']; ?>%</span>
                                        </td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress me-2" style="height: 8px; width: 80px;">
                                                    <div class="progress-bar <?php echo $est['porcentaje'] >= 50 ? 'bg-success' : 'bg-warning'; ?>" 
                                                         style="width: <?php echo $est['porcentaje']; ?>%;"></div>
                                                </div>
                                                <span class="fw-bold small"><?php echo $est['porcentaje']; ?>%</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <?php if ($tipoReporte === 'instructor'): ?>
                                    <td colspan="4" class="text-end fw-bold">Total de ganancias:</td>
                                    <td class="fw-bold" style="color: #16a085; font-size: 1.1rem;">
                                        $<?php echo number_format($totalGananciasGlobal, 2); ?>
                                    </td>
                                <?php else: ?>
                                    <td colspan="5" class="text-center text-muted small">
                                        <i class="fa-solid fa-info-circle me-1"></i>
                                        Mostrando unicamente usuarios activos del portal.
                                    </td>
                                <?php endif; ?>
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
    <script src="js/adminReportes.js"></script>
</body>
</html>