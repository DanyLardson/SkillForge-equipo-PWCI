<?php
//ahora la simulacion pero para la parte detalls, luego veo como hacer que cambie los datos
$todosLosCursos = [
    1 => [
        "titulo" => "PHP y MySQL desde Cero",
        "descripcion" => "Aprende a crear aplicaciones web dinámicas desde cero con PHP puro y MySQL. Este curso está diseñado para llevarte paso a paso desde los fundamentos del lenguaje hasta la construcción de un sistema completo con autenticación, CRUD y conexión a base de datos.",
        "imagen" => "https://bairesdev.mo.cloudinary.net/blog/2023/08/PHP-libraries.jpg",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-primary",
        "rating" => 4.8,
        "numCalificaciones" => 124,
        "numEstudiantes" => 1240,
        "duracion" => "12 horas",
        "precio" => "$49.99",
        "instructor" => [
            "nombre" => "Daniel Montelongo",
            "rol" => "Desarrollador Full Stack",
            "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg"
        ],
        "niveles" => [
            [
                "numero" => 1,
                "titulo" => "Introducción a PHP",
                "esGratis" => true,
                "precio" => null,
                "duracion" => "12:30",
                "contenido" => [
                    ["tipo" => "video", "nombre" => "¿Qué es PHP?", "duracion" => "12:30"],
                    ["tipo" => "pdf", "nombre" => "Instalación de XAMPP", "duracion" => "5 min"]
                ]
            ],
            [
                "numero" => 2,
                "titulo" => "Variables y Tipos de Datos",
                "esGratis" => false,
                "precio" => "$19.99",
                "duracion" => "45 min",
                "contenido" => [
                    ["tipo" => "video", "nombre" => "Variables en PHP", "duracion" => "20 min"]
                ]
            ],
            [
                "numero" => 3,
                "titulo" => "Conexión a MySQL",
                "esGratis" => false,
                "precio" => "$19.99",
                "duracion" => "1 hora",
                "contenido" => [
                    ["tipo" => "video", "nombre" => "Conectar PHP con MySQL", "duracion" => "30 min"]
                ]
            ]
        ],
        "comentarios" => [
            [
                "usuario" => "María González",
                "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
                "fecha" => "Hace 2 días",
                "estrellas" => 5,
                "texto" => "Excelente curso, esta chido. ya lo tome ya lo puedes borrar"
            ],
            [
                "usuario" => "Carlos Ramírez",
                "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
                "fecha" => "Hace 1 semana",
                "estrellas" => 4,
                "texto" => "Muy buen contenido, aunque no entendi esta parte, mi direccion es Av Adolfo Lopez Mateos No.232 podrias venir a explicarmelo ."
            ]
        ]
    ],
    2 => [
        "titulo" => "Marketing Digital Avanzado",
        "descripcion" => "Estrategias de SEO, SEM y redes sociales para hacer crecer tu negocio.",
        "imagen" => "https://tse2.mm.bing.net/th/id/OIP.FZl2Ea_EW1iLcb1oNXPqJAHaEO?r=0&pid=Api&P=0&h=180",
        "categoria" => "Marketing",
        "colorBadge" => "bg-success",
        "rating" => 4.6,
        "numCalificaciones" => 89,
        "numEstudiantes" => 780,
        "duracion" => "8 horas",
        "precio" => "$39.99",
        "instructor" => [
            "nombre" => "Ana López",
            "rol" => "Especialista en Marketing",
            "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg"
        ],
        "niveles" => [
            [
                "numero" => 1,
                "titulo" => "Fundamentos de SEO",
                "esGratis" => true,
                "precio" => null,
                "duracion" => "30 min",
                "contenido" => [
                    ["tipo" => "video", "nombre" => "¿Qué es SEO?", "duracion" => "30 min"]
                ]
            ]
        ],
        "comentarios" => [
            [
                "usuario" => "Juan Rodriguez",
                "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
                "fecha" => "Hace 3 días",
                "estrellas" => 5,
                "texto" => "Muy útil, ya soy alguien."
            ]
        ]
    ],
    3 => [
        "titulo" => "Introducción a UX/UI",
        "descripcion" => "Principios básicos de diseño de interfaces y experiencia de usuario.",
        "imagen" => "https://blog.cubos.academy/content/images/2023/02/Designer-UI.jpg",
        "categoria" => "Diseño",
        "colorBadge" => "bg-danger",
        "rating" => 4.9,
        "numCalificaciones" => 210,
        "numEstudiantes" => 1890,
        "duracion" => "6 horas",
        "precio" => "Gratis",
        "instructor" => [
            "nombre" => "Sofía Martínez",
            "rol" => "Diseñadora UX/UI",
            "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg"
        ],
        "niveles" => [
            [
                "numero" => 1,
                "titulo" => "Introducción al diseño",
                "esGratis" => true,
                "precio" => null,
                "duracion" => "20 min",
                "contenido" => [
                    ["tipo" => "video", "nombre" => "¿Qué es UX/UI?", "duracion" => "20 min"]
                ]
            ]
        ],
        "comentarios" => []
    ],
    4 => [
        "titulo" => "Python para Data Science",
        "descripcion" => "Análisis de datos y machine learning con Python y Pandas.",
        "imagen" => "https://tse4.mm.bing.net/th/id/OIP.FG7N73UM9C4_ig2cyOnrqQHaEK?r=0&pid=Api&P=0&h=180",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-primary",
        "rating" => 4.7,
        "numCalificaciones" => 156,
        "numEstudiantes" => 1420,
        "duracion" => "15 horas",
        "precio" => "$59.99",
        "instructor" => [
            "nombre" => "Roberto Díaz",
            "rol" => "Data Scientist",
            "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg"
        ],
        "niveles" => [],
        "comentarios" => []
    ],
    5 => [
        "titulo" => "Inglés para Negocios",
        "descripcion" => "Comunicación efectiva en inglés para entornos corporativos.",
        "imagen" => "https://urbantecno.com/hero/2023/04/descubre-cuales-son-los-mejores-cursos-para-aprender-ingles-desde-cero.jpg?width=1200",
        "categoria" => "Idiomas",
        "colorBadge" => "bg-warning text-dark",
        "rating" => 4.5,
        "numCalificaciones" => 78,
        "numEstudiantes" => 650,
        "duracion" => "10 horas",
        "precio" => "$29.99",
        "instructor" => [
            "nombre" => "Laura Fernández",
            "rol" => "Profesora de Inglés",
            "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg"
        ],
        "niveles" => [],
        "comentarios" => []
    ],
    6 => [
        "titulo" => "Redes y Ciberseguridad",
        "descripcion" => "Protege sistemas y aprende los fundamentos de redes y seguridad.",
        "imagen" => "https://dplnews.com/wp-content/uploads/2023/04/dplnews-ciberseguridad-dispositivo-jb020123-scaled.jpeg",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-info text-dark",
        "rating" => 4.8,
        "numCalificaciones" => 95,
        "numEstudiantes" => 870,
        "duracion" => "14 horas",
        "precio" => "$54.99",
        "instructor" => [
            "nombre" => "Diego Ocampos",
            "rol" => "Ingeniero en Seguridad",
            "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg"
        ],
        "niveles" => [],
        "comentarios" => []
    ]
];

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$cursoActual = $todosLosCursos[$id] ?? null;


if (!$cursoActual) {
    $error = "El curso solicitado no existe o no está disponible.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cursoActual ? htmlspecialchars($cursoActual['titulo']) : 'Curso no encontrado'; ?> | SkillForge</title>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex mx-auto" style="width: 50%;">
                    <input class="form-control me-2" type="search" placeholder="Buscar cursos..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <div class="d-flex">
                   <a href="index.php" class="btn btn-outline-light">
                      <i class="fa-solid fa-arrow-left me-1"></i> Volver al inicio
                   </a>
                </div>
            </div>
        </div>
    </nav>

    <?php if (!$cursoActual): ?>

        <div class="container my-5 text-center">
            <div class="card border-0 shadow-sm p-5">
                <i class="fa-solid fa-circle-exclamation display-1 mb-3" style="color: #e67e22;"></i>
                <h2 class="fw-bold mb-2" style="color: #2c3e50;">Curso no encontrado</h2>
                <p class="text-muted mb-4"><?php echo htmlspecialchars($error); ?></p>
                <a href="index.php" class="btn text-white mx-auto" style="background-color: #16a085;">
                    <i class="fa-solid fa-arrow-left me-2"></i>Volver al inicio
                </a>
            </div>
        </div>
    <?php else: ?>

        <div class="container my-5">
            <div class="row">
                

                <div class="col-lg-8">
                    <img src="<?php echo htmlspecialchars($cursoActual['imagen']); ?>" class="img-fluid rounded shadow-sm mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="<?php echo htmlspecialchars($cursoActual['titulo']); ?>">
                    
                    <span class="badge <?php echo $cursoActual['colorBadge']; ?> mb-2"><?php echo htmlspecialchars($cursoActual['categoria']); ?></span>
                    <h1 class="fw-bold mb-3"><?php echo htmlspecialchars($cursoActual['titulo']); ?></h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <span class="text-warning me-2"><i class="fa-solid fa-star"></i> <?php echo $cursoActual['rating']; ?></span>
                        <span class="text-muted me-3">(<?php echo $cursoActual['numCalificaciones']; ?> calificaciones)</span>
                        <span class="text-muted me-3"><i class="fa-solid fa-user-group"></i> <?php echo number_format($cursoActual['numEstudiantes']); ?> estudiantes</span>
                        <span class="text-muted"><i class="fa-solid fa-clock"></i> <?php echo $cursoActual['duracion']; ?> de contenido</span>
                    </div>

                    <h4 class="fw-bold mb-3">Descripcion del curso</h4>
                    <p class="text-muted"><?php echo htmlspecialchars($cursoActual['descripcion']); ?></p>


                    <?php if (!empty($cursoActual['niveles'])): ?>
                        <h4 class="fw-bold mt-5 mb-3">Contenido del curso</h4>
                        <div class="accordion" id="accordionNiveles">
                            <?php foreach ($cursoActual['niveles'] as $nivel): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#nivel<?php echo $nivel['numero']; ?>">
                                            <?php if ($nivel['esGratis']): ?>
                                                <i class="fa-solid fa-play-circle me-2" style="color: #16a085;"></i>
                                            <?php else: ?>
                                                <i class="fa-solid fa-lock me-2 text-muted"></i>
                                            <?php endif; ?>
                                            Nivel <?php echo $nivel['numero']; ?>: <?php echo htmlspecialchars($nivel['titulo']); ?>
                                            <?php if ($nivel['esGratis']): ?>
                                                <span class="ms-auto badge bg-secondary me-2">Gratis</span>
                                            <?php else: ?>
                                                <span class="ms-auto badge text-white me-2" style="background-color: #e67e22;"><?php echo $nivel['precio']; ?></span>
                                            <?php endif; ?>
                                        </button>
                                    </h2>
                                    <div id="nivel<?php echo $nivel['numero']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionNiveles">
                                        <div class="accordion-body">
                                            <?php if ($nivel['esGratis']): ?>
                                                <ul class="list-group list-group-flush">
                                                    <?php foreach ($nivel['contenido'] as $item): ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <span>
                                                                <?php if ($item['tipo'] === 'video'): ?>
                                                                    <i class="fa-solid fa-video text-muted me-2"></i>
                                                                <?php else: ?>
                                                                    <i class="fa-solid fa-file-pdf text-muted me-2"></i>
                                                                <?php endif; ?>
                                                                <?php echo htmlspecialchars($item['nombre']); ?>
                                                            </span>
                                                            <span class="text-muted small"><?php echo $item['duracion']; ?></span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php else: ?>
                                                <p class="text-muted mb-0">Contenido bloqueado. Compra el curso para acceder a este nivel.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>


                    <?php if (!empty($cursoActual['comentarios'])): ?>
                        <h4 class="fw-bold mt-5 mb-3">Comentarios de los estudiantes</h4>
                        <?php foreach ($cursoActual['comentarios'] as $comentario): ?>
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex mb-2">
                                        <img src="<?php echo $comentario['avatar']; ?>" class="rounded-circle me-3" width="50" height="50" alt="Avatar">
                                        <div>
                                            <h6 class="fw-bold mb-0"><?php echo htmlspecialchars($comentario['usuario']); ?></h6>
                                            <small class="text-muted"><?php echo $comentario['fecha']; ?></small>
                                        </div>
                                        <div class="ms-auto text-warning">
                                            <?php for ($i = 0; $i < $comentario['estrellas']; $i++): ?>
                                                <i class="fa-solid fa-star"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = $comentario['estrellas']; $i < 5; $i++): ?>
                                                <i class="fa-regular fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted"><?php echo htmlspecialchars($comentario['texto']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>


                <div class="col-lg-4">
                    <div class="card shadow border-0 sticky-top" style="top: 20px;">
                        <div class="card-body p-4">
                            <h2 class="fw-bold mb-3" style="color: #16a085;"><?php echo $cursoActual['precio']; ?></h2>
                            <p class="text-muted small mb-4"><i class="fa-solid fa-tag me-1"></i> Precio del curso completo</p>

                            <button id="btnComprar" class="btn text-white w-100 py-2 fw-bold mb-2" style="background-color: #e67e22;" onclick="comprarCurso()">
                                <i class="fa-brands fa-paypal me-2"></i> Comprar con PayPal
                            </button>
                            <button class="btn btn-outline-secondary w-100 py-2 mb-3">
                                <i class="fa-solid fa-play me-2"></i> Probar Nivel Gratis
                            </button>

                            <hr>

                            <h6 class="fw-bold mb-3">Este curso incluye:</h6>
                            <ul class="list-unstyled text-muted small">
                                <li class="mb-2"><i class="fa-solid fa-video me-2" style="color: #16a085;"></i> <?php echo $cursoActual['duracion']; ?> de video bajo demanda</li>
                                <li class="mb-2"><i class="fa-solid fa-file-pdf me-2" style="color: #16a085;"></i> Recursos descargables</li>
                                <li class="mb-2"><i class="fa-solid fa-mobile-screen me-2" style="color: #16a085;"></i> Acceso en móvil y TV</li>
                                <li class="mb-2"><i class="fa-solid fa-certificate me-2" style="color: #16a085;"></i> Certificado al finalizar</li>
                                <li class="mb-2"><i class="fa-solid fa-infinity me-2" style="color: #16a085;"></i> Acceso de por vida</li>
                            </ul>

                            <hr>

                            <h6 class="fw-bold mb-3">Instructor:</h6>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo $cursoActual['instructor']['avatar']; ?>" class="rounded-circle me-3" width="50" height="50" alt="Instructor">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo htmlspecialchars($cursoActual['instructor']['nombre']); ?></p>
                                    <small class="text-muted"><?php echo htmlspecialchars($cursoActual['instructor']['rol']); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?>


    <footer class="text-white text-center py-4 mt-5" style="background-color: #2c3e50;">
        <div class="container">
            <p class="mb-1">&copy; 2026 SkillForge</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/detallesCurso.js"></script>
    <script>
    function comprarCurso() {
        const btn = document.getElementById('btnComprar');
        
        //sacamos el ID del curso de la URL
        const params = new URLSearchParams(window.location.search);
        const cursoId = params.get('id');

        if (!cursoId) {
            alert("Error: No se identificó el curso.");
            return;
        }

        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Procesando pago...';
        btn.disabled = true;

        //petición a nuestra API simulada
        fetch('api/paypal.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                curso_id: cursoId, 
                monto: 49.99 
            })
        })
        .then(res => res.json().then(data => ({ status: res.status, body: data })))
        .then(res => {
            if (res.status === 200) {
                //pago exitoso
                alert('✅ ' + res.body.mensaje + '\n\nID de Transacción: ' + res.body.transaction_id);
                //aqui podrías redirigir al kardex del alumno
                window.location.href = 'kardex.php'; 
            } else {
                //Error,no ha iniciado sesion, o faltan datos
                alert('❌ ' + res.body.error);
                btn.innerHTML = '<i class="fa-brands fa-paypal me-2"></i> Comprar con PayPal';
                btn.disabled = false;
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error de conexión al procesar el pago.");
            btn.innerHTML = '<i class="fa-brands fa-paypal me-2"></i> Comprar con PayPal';
            btn.disabled = false;
        });
    }
</script>
</body>
</html>