<?php
session_start();
require_once 'core/Auth.php';
Auth::check('instructor'); 
require_once 'modelos/Curso.php';

$modelo = new Curso();
$categoriasReales = $modelo->obtenerCategorias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Curso | SkillForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #2c3e50;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white" href="index.php">SkillForge</a>
            <a href="index.php" class="btn btn-outline-light"><i class="fa-solid fa-arrow-left me-1"></i> Volver al Inicio</a>
        </div>
    </nav>

    <div class="container my-5" style="max-width: 800px;">
        <div class="card shadow border-0">
            <div class="card-header text-white bg-success">
                <h4 class="mb-0">Crear Nuevo Curso</h4>
            </div>
            <div class="card-body p-4">
                <form id="formCrearCurso">
                    <div class="mb-3"><label class="fw-bold">Título del Curso</label><input type="text" id="nuevoTitulo" class="form-control" required></div>
                    <div class="mb-3"><label class="fw-bold">Descripción</label><textarea id="nuevaDesc" class="form-control" required></textarea></div>
                    <div class="mb-3"><label class="fw-bold">Categoría</label>
                        <select id="nuevaCat" class="form-select">
                            <?php if (empty($categoriasReales)): ?>
                                <option value="">No hay categorías registradas (Crea una en el Panel de Admin)</option>
                            <?php else: ?>
                                <?php foreach ($categoriasReales as $cat): ?>
                                    <option value="<?php echo htmlspecialchars($cat['nombre']); ?>"><?php echo htmlspecialchars($cat['nombre']); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3"><label class="fw-bold">Precio</label><input type="number" id="nuevoPrecio" class="form-control" step="0.01" required></div>
                    <div class="mb-3"><label class="fw-bold">URL de la Imagen</label><input type="url" id="nuevaImg" class="form-control" placeholder="https://..." required></div>
                    <button type="submit" class="btn btn-success w-100 fw-bold">Guardar Curso</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('formCrearCurso').addEventListener('submit', function(e) {
        e.preventDefault();
        const datos = {
            titulo: document.getElementById('nuevoTitulo').value,
            descripcion: document.getElementById('nuevaDesc').value,
            categoria: document.getElementById('nuevaCat').value,
            precio: document.getElementById('nuevoPrecio').value,
            imagen: document.getElementById('nuevaImg').value
        };
        fetch('api/cursos.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        })
        .then(res => res.json().then(data => ({ status: res.status, body: data })))
        .then(res => {
            if (res.status === 201) {
                alert('¡Curso guardado exitosamente!');
                window.location.href = 'index.php';
            } else {
                alert('Error: ' + (res.body.error || 'No autorizado'));
            }
        });
    });
    </script>
</body>
</html>