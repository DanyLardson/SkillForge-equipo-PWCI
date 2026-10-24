<?php
require_once 'core/Auth.php';
Auth::check('admin'); //Candado pa solo pasar si eres admin

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Categorias | SkillForge Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adminCategorias.css">
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
                    <li class="nav-item"><a class="nav-link active" href="adminCategorias.php">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminComentarios.php">Comentarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminReportes.php">Reportes</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3"><i class="fa-solid fa-user-shield me-1"></i> Administrador</span>
                    <a href="login.php" class="btn btn-sm btn-outline-light" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?');">Salir</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="fw-bold" style="color: #2c3e50;">
                Gestión de Categorias
            </h2>
        </div>

        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Categoria</th>
                                <th>Descripción</th>
                                <th>Creada por</th>
                                <th>Fecha y hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td>1</td>
                                <td><span class="badge bg-primary">IT & Software</span></td>
                                <td class="text-muted small">Cursos de programacion, redes, bases de datos y tecnologia.</td>
                                <td>Administrador</td>
                                <td class="text-muted small">01 Ene 2026, 10:30 AM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary me-1" onclick="editarCurso(1, 'IT & Software', 'Cursos de programación...', 'IT & Software', 49.99, 'https://bairesdev.mo.cloudinary.net/blog/2023/08/PHP-libraries.jpg')"><i class="fa-solid fa-pen"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="eliminarCurso(1)"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span class="badge bg-success">Marketing</span></td>
                                <td class="text-muted small">Cursos de SEO, redes sociales, publicidad digital y ventas.</td>
                                <td>Administrador</td>
                                <td class="text-muted small">02 Ene 2026, 09:15 AM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary me-1"><i class="fa-solid fa-pen"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    
    <!-- Boton y modal para crear cursos   -->
    
    
    <button type="button" class="btn btn-success shadow-lg" data-bs-toggle="modal" data-bs-target="#modalCrearCurso" style="position:fixed; bottom: 30px; right: 30px; z-index: 1000; border-radius: 50%; width: 65px; height: 65px; font-size: 28px;">
        +
    </button>

    <div class="modal fade" id="modalCrearCurso" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title">Crear Nuevo Curso</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="formCrearCurso">
                <div class="mb-3"><label class="fw-bold">Título del Curso</label><input type="text" id="nuevoTitulo" class="form-control" required></div>
                <div class="mb-3"><label class="fw-bold">Descripción</label><textarea id="nuevaDesc" class="form-control" required></textarea></div>
                <div class="mb-3"><label class="fw-bold">Categoría</label>
                    <select id="nuevaCat" class="form-select">
                        <option value="IT & Software">IT & Software</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Diseño">Diseño</option>
                    </select>
                </div>
                <div class="mb-3"><label class="fw-bold">Precio</label><input type="number" id="nuevoPrecio" class="form-control" step="0.01" required></div>
                <div class="mb-3"><label class="fw-bold">URL de la Imagen</label><input type="url" id="nuevaImg" class="form-control" placeholder="https://..." required></div>
                <button type="submit" class="btn btn-success w-100 fw-bold">Guardar Curso</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
    document.getElementById('formCrearCurso').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...'; 
        btn.disabled = true;

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
                alert('¡Curso guardado exitosamente en la base de datos!');
                window.location.href = 'index.php'; //te manda pal index para que veas tu curso nuevo
            } else {
                alert('Error: ' + (res.body.error || 'No autorizado'));
                btn.innerHTML = 'Guardar Curso en MySQL'; 
                btn.disabled = false;
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error de conexión al guardar el curso.');
            btn.innerHTML = 'Guardar Curso en MySQL'; 
            btn.disabled = false;
        });
    });
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/adminCategorias.js"></script>

    <!-- modal para editar el curso -->
<div class="modal fade" id="modalEditarCurso" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">editar curso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEditarCurso">
            <input type="hidden" id="editId">
            <div class="mb-3"><label class="fw-bold">Título</label><input type="text" id="editTitulo" class="form-control" required></div>
            <div class="mb-3"><label class="fw-bold">Descripción</label><textarea id="editDesc" class="form-control" required></textarea></div>
            <div class="mb-3"><label class="fw-bold">Categoría</label>
                <select id="editCat" class="form-select">
                    <option value="IT & Software">IT & Software</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Diseño">Diseño</option>
                </select>
            </div>
            <div class="mb-3"><label class="fw-bold">Precio</label><input type="number" id="editPrecio" class="form-control" step="0.01" required></div>
            <div class="mb-3"><label class="fw-bold">URL de la Imagen</label><input type="url" id="editImg" class="form-control" required></div>
            <button type="submit" class="btn btn-warning w-100 fw-bold">Actualizar Curso</button>
        </form>


<script>
//funcion para abrir el modal editar
function editarCurso(id, titulo, desc, cat, precio, img) {
    document.getElementById('editId').value = id;
    document.getElementById('editTitulo').value = titulo;
    document.getElementById('editDesc').value = desc;
    document.getElementById('editCat').value = cat;
    document.getElementById('editPrecio').value = precio;
    document.getElementById('editImg').value = img;
    
    var modal = new bootstrap.Modal(document.getElementById('modalEditarCurso'));
    modal.show();
}

//enviar el put
document.getElementById('formEditarCurso').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    const btn = this.querySelector('button[type="submit"]');
    btn.innerHTML = 'actualizando...'; btn.disabled = true;

    const datos = {
        titulo: document.getElementById('editTitulo').value,
        descripcion: document.getElementById('editDesc').value,
        categoria: document.getElementById('editCat').value,
        precio: document.getElementById('editPrecio').value,
        imagen: document.getElementById('editImg').value
    };

    fetch('api/cursos.php?id=' + id, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(datos)
    })
    .then(res => res.json().then(data => ({ status: res.status, body: data })))
    .then(res => {
        if (res.status === 200) {
            alert('¡curso actualizado correctamente!');
            window.location.reload();
        } else {
            alert('Error: ' + res.body.error);
            btn.innerHTML = 'actualizar curso'; btn.disabled = false;
        }
    });
});

//funcion para eliminar
function eliminarCurso(id) {
    if (!confirm('estas seguro de que quieres dar de baja este curso?')) return;

    fetch('api/cursos.php?id=' + id, {
        method: 'DELETE'
    })
    .then(res => res.json().then(data => ({ status: res.status, body: data })))
    .then(res => {
        if (res.status === 200) {
            alert('Curso dado de baja exitosamente');
            window.location.reload();
        } else {
            alert('Error: ' + res.body.error);
        }
    });
}
</script>
</body>
</html>