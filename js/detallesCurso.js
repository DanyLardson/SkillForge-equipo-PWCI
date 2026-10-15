// =========================================
// SCRIPTS ESPECÍFICOS DEL DETALLE DEL CURSO
// =========================================

document.addEventListener("DOMContentLoaded", function() {
    console.log("Detalle del curso cargado.");

    // Obtener el ID del curso desde la URL
    const params = new URLSearchParams(window.location.search);
    const cursoId = params.get('id');

    if (!cursoId) {
        console.warn("No se especificó un ID de curso en la URL.");
        return;
    }

    console.log("ID del curso solicitado:", cursoId);

    // Consumir la API propia con fetch
    fetch('api/cursos.php?id=' + cursoId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error HTTP: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log("✅ Curso recibido desde la API:");
            console.log(data);
        })
        .catch(error => {
            console.error("❌ Error al cargar el curso desde la API:", error);
        });
});