<?php
session_start();
require_once 'modelos/Curso.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$modelo = new Curso();
$cursoActual = $modelo->obtenerPorId($id);

if (!$cursoActual) {
    die("El curso solicitado no existe o no está disponible.");
}

// Guardar comentario si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['usuario_id'])) {
    $comentario = $_POST['comentario'] ?? '';
    $calificacion = $_POST['calificacion'] ?? 5;
    
    if (!empty($comentario)) {
        $modelo->guardarComentario($id, $_SESSION['usuario_id'], $comentario, $calificacion);
        header("Location: detallesCurso.php?id=" . $id . "&success=1");
        exit;
    }
}

$comentarios = $modelo->obtenerComentarios($id);
$usuarioLogueado = isset($_SESSION['usuario_id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($cursoActual['titulo']); ?> | SkillForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/detallesCurso.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #2c3e50;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white" href="index.php">
                <i class="fa-solid fa-graduation-cap me-1" style="color: #e67e22;"></i>SkillForge
            </a>
            <div class="d-flex">
               <a href="index.php" class="btn btn-outline-light">
                  <i class="fa-solid fa-arrow-left me-1"></i> Volver al inicio
               </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <img src="<?php echo htmlspecialchars($cursoActual['imagen']); ?>" class="img-fluid rounded shadow-sm mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="<?php echo htmlspecialchars($cursoActual['titulo']); ?>">
                
                <span class="badge bg-primary mb-2"><?php echo htmlspecialchars($cursoActual['categoria']); ?></span>
                <h1 class="fw-bold mb-3"><?php echo htmlspecialchars($cursoActual['titulo']); ?></h1>
                
                <div class="d-flex align-items-center mb-4">
                    <span class="text-warning me-2"><i class="fa-solid fa-star"></i> <?php echo $cursoActual['rating']; ?></span>
                    <span class="text-muted me-3">(<?php echo count($comentarios); ?> calificaciones)</span>
                </div>

                <h4 class="fw-bold mb-3">Descripcion del curso</h4>
                <p class="text-muted"><?php echo htmlspecialchars($cursoActual['descripcion']); ?></p>

                <!-- SECCIÓN DE COMENTARIOS REALES -->
                <h4 class="fw-bold mt-5 mb-3">Comentarios de los estudiantes</h4>
                
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">¡Comentario guardado exitosamente!</div>
                <?php endif; ?>

                <!-- Formulario para comentar -->
                <?php if ($usuarioLogueado): ?>
                    <div class="card mb-4 border-0 shadow-sm bg-light">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Deja tu comentario y calificación</h6>
                            <form method="POST">
                                <div class="mb-2">
                                    <label class="form-label small">Calificación (1-5):</label>
                                    <select name="calificacion" class="form-select form-select-sm w-auto">
                                        <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                        <option value="4">⭐⭐⭐⭐ (4)</option>
                                        <option value="3">⭐⭐⭐ (3)</option>
                                        <option value="2">⭐⭐ (2)</option>
                                        <option value="1">⭐ (1)</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <textarea name="comentario" class="form-control" rows="2" placeholder="Escribe tu opinión sobre el curso..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-dark">Enviar Comentario</button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-muted small"><a href="login.php">Inicia sesión</a> para dejar un comentario.</p>
                <?php endif; ?>

                <!-- Lista de comentarios -->
                <?php if (empty($comentarios)): ?>
                    <p class="text-muted">Aún no hay comentarios. ¡Sé el primero en opinar!</p>
                <?php else: ?>
                    <?php foreach ($comentarios as $comentario): ?>
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex mb-2">
                                    <i class="fa-solid fa-circle-user fs-1 text-secondary me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-0"><?php echo htmlspecialchars($comentario['usuario_nombre']); ?></h6>
                                        <small class="text-muted"><?php echo date('d M Y', strtotime($comentario['fecha_creacion'])); ?></small>
                                    </div>
                                    <div class="ms-auto text-warning">
                                        <?php for ($i = 0; $i < $comentario['calificacion']; $i++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
                                        <?php for ($i = $comentario['calificacion']; $i < 5; $i++): ?><i class="fa-regular fa-star"></i><?php endfor; ?>
                                    </div>
                                </div>
                                <p class="mb-0 text-muted"><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- SIDEBAR DE COMPRA -->
            <div class="col-lg-4">
                <div class="card shadow border-0 sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h2 class="fw-bold mb-3" style="color: #16a085;">$<?php echo number_format($cursoActual['precio'], 2); ?></h2>
                        
                        <button id="btnComprar" class="btn text-white w-100 py-2 fw-bold mb-2" style="background-color: #e67e22;" onclick="comprarCurso()">
                            <i class="fa-brands fa-paypal me-2"></i> Comprar con PayPal
                        </button>

                        <hr>
                        <h6 class="fw-bold mb-3">Instructor:</h6>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-circle-user fs-2 me-2 text-secondary"></i>
                            <div>
                                <p class="fw-bold mb-0"><?php echo htmlspecialchars($cursoActual['instructor_nombre'] ?? 'Instructor'); ?></p>
                            </div>
                        </div>
                    </div>
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
    <script>
    function comprarCurso() {
        const btn = document.getElementById('btnComprar');
        const cursoId = <?php echo $id; ?>;
        const monto = <?php echo $cursoActual['precio']; ?>;

        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Procesando...';
        btn.disabled = true;

        fetch('api/paypal.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ curso_id: cursoId, monto: monto })
        })
        .then(res => res.json().then(data => ({ status: res.status, body: data })))
        .then(res => {
            if (res.status === 201 && res.body.status === "CREATED") {
                let formData = new FormData();
                formData.append('curso_id', cursoId);
                formData.append('monto', monto);

                return fetch('controladores/CursoController.php?accion=comprar', {
                    method: 'POST',
                    body: formData
                });
            } else {
                throw new Error(res.body.error || 'Error en PayPal');
            }
        })
        .then(() => { window.location.href = 'kardex.php?compra=exitosa'; })
        .catch(err => {
            alert('❌ ' + err.message);
            btn.innerHTML = '<i class="fa-brands fa-paypal me-2"></i> Comprar con PayPal';
            btn.disabled = false;
        });
    }
    </script>
</body>
</html>