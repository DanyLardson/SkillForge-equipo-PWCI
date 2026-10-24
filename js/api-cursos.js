//Consumo de api propia-cursos, este archio consume el endpoint /api/ cursos.php y genera tarjetas dinamicas con fetch

document.addEventListener("DOMContentLoaded", function() {
    
    const contenedor = document.getElementById('contenedor-cursos');
    
    //si no existe el contenedor en esta pagina, salir
    if (!contenedor) return;

    console.log("Cargando cursos desde la API...");

    //peticion fetch a la API
    fetch('api/cursos.php')
        .then(response => {
            //si respuesta exitosa
            if (!response.ok) {
                throw new Error('Error HTTP: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Cursos recibidos:', data);

            //generar las tarjetas 
            let html = '';
            data.cursos.forEach(curso => {
                html += `
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 card-hover">
                            <img src="${curso.imagen}" class="card-img-top" alt="${curso.titulo}" style="height: 180px; object-fit: cover;">
                            <div class="card-body">
                                <span class="badge ${curso.colorBadge} mb-2">${curso.categoria}</span>
                                <h5 class="card-title fw-bold">${curso.titulo}</h5>
                                <p class="card-text text-muted small">${curso.descripcion}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-warning"><i class="fa-solid fa-star"></i> ${curso.rating ? curso.rating : '0.0'}</span>
                                    <span class="fw-bold text-success">${curso.precio}</span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 text-center pb-3">
                                <a href="detallesCurso.php?id=${curso.id}" class="btn btn-sm text-white w-100" style="background-color: #2c3e50;">Ver Detalle</a>
                            </div>
                        </div>
                    </div>
                `;
            });
            contenedor.innerHTML = html;
        })
        .catch(error => {
            //manejo error
            console.error('Error al cargar cursos:', error);
            contenedor.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>
                        Error al cargar los cursos. Por favor, recarga la página.
                    </div>
                </div>
            `;
        });
});