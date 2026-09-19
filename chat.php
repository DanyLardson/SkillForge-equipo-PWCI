<?php
//ahora los chats
$usuarioActual = [
    "id" => 1,
    "nombre" => "María González",
    "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
    "rol" => "estudiante"
];


$conversaciones = [
    [
        "id" => 1,
        "nombre" => "Daniel Montelongo",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "rol" => "Instructor",
        "curso" => "PHP y MySQL desde Cero",
        "ultimoMensaje" => "oye por donde me estas mandando el mensaje?.",
        "fecha" => "10:30 AM",
        "noLeidos" => 2,
        "activo" => true
    ],
    [
        "id" => 2,
        "nombre" => "Ana López",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "rol" => "Instructor",
        "curso" => "Marketing Digital Avanzado",
        "ultimoMensaje" => "Hola, te gusta el jazz?.",
        "fecha" => "Ayer",
        "noLeidos" => 0,
        "activo" => false
    ],
    [
        "id" => 3,
        "nombre" => "Sofía Martínez",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "rol" => "Instructor",
        "curso" => "Introducción a UX/UI",
        "ultimoMensaje" => "Revisa el PDF que te compartí.",
        "fecha" => "Hace 2 días",
        "noLeidos" => 1,
        "activo" => false
    ],
    [
        "id" => 4,
        "nombre" => "Roberto Díaz",
        "avatar" => "https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg",
        "rol" => "Instructor",
        "curso" => "Python para Data Science",
        "ultimoMensaje" => "MARIA cambiate a linux.",
        "fecha" => "Hace 3 días",
        "noLeidos" => 0,
        "activo" => false
    ]
];


$mensajes = [
    [
        "emisor" => "otro",
        "texto" => "¡Hola María! Vi que te inscribiste a mi curso de PHP. ¿Cómo vas?",
        "fecha" => "10:15 AM"
    ],
    [
        "emisor" => "yo",
        "texto" => "¡Hola profe! Muy bien, ya terminé el nivel 1 y 2. Tengo una duda con la conexión a MySQL.",
        "fecha" => "10:20 AM"
    ],
    [
        "emisor" => "otro",
        "texto" => "¡Qué bueno! Claro, dime tu duda y te ayudo.",
        "fecha" => "10:25 AM"
    ],
    [
        "emisor" => "yo",
        "texto" => "bueno recuerda que nos dijo que subieramos la carpeta en la que hicimos el sql?, bueno creo que subi la carpeta con todos los componentes de sql y mi compu ya no se mueve, que hago.",
        "fecha" => "10:28 AM"
    ],
    [
        "emisor" => "otro",
        "texto" => "???.",
        "fecha" => "10:30 AM"
    ],
    [
        "emisor" => "otro",
        "texto" => "oye por donde me estas mandando el mensaje?.",
        "fecha" => "10:30 AM"
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes | SkillForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/chat.css">
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
                <div class="d-flex align-items-center ms-auto">
                    <a href="kardex.php" class="text-white me-3 text-decoration-none">
                        <i class="fa-solid fa-arrow-left me-1"></i> Volver al Kardex
                    </a>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?php echo $usuarioActual['avatar']; ?>" class="rounded-circle me-2" width="35" height="35" alt="Avatar">
                            <span><?php echo explode(' ', $usuarioActual['nombre'])[0]; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="kardex.php">Mi Kardex</a></li>
                            <li><a class="dropdown-item" href="#">Editar Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php">Cerrar Sesion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid my-4">
        <div class="row g-0 chat-container">
            

            <div class="col-lg-4 col-md-5 chat-sidebar">
                <div class="chat-sidebar-header">
                    <h5 class="fw-bold mb-0">
                        Mensajes
                    </h5>
                    <span class="badge bg-danger">3</span>
                </div>
                
                <div class="chat-search">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Buscar conversación...">
                    </div>
                </div>

                <div class="chat-list">
                    <?php foreach ($conversaciones as $conv): ?>
                        <a href="#" class="chat-item <?php echo $conv['activo'] ? 'chat-item-active' : ''; ?>">
                            <div class="position-relative">
                                <img src="<?php echo $conv['avatar']; ?>" class="rounded-circle chat-avatar" alt="Avatar">
                                <?php if ($conv['noLeidos'] > 0): ?>
                                    <span class="badge bg-danger chat-badge"><?php echo $conv['noLeidos']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="chat-info flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <strong class="chat-nombre"><?php echo htmlspecialchars($conv['nombre']); ?></strong>
                                    <small class="text-muted"><?php echo $conv['fecha']; ?></small>
                                </div>
                                <small class="text-muted d-block chat-rol">
                                    <i class="fa-solid fa-user-tie me-1"></i><?php echo $conv['rol']; ?>
                                </small>
                                <small class="text-muted d-block chat-curso">
                                    <i class="fa-solid fa-book me-1"></i><?php echo htmlspecialchars($conv['curso']); ?>
                                </small>
                                <small class="text-truncate d-block chat-ultimo">
                                    <?php echo htmlspecialchars($conv['ultimoMensaje']); ?>
                                </small>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="col-lg-8 col-md-7 chat-main">
                

                <div class="chat-header">
                    <div class="d-flex align-items-center">
                        <img src="https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg" class="rounded-circle me-3" width="45" height="45" alt="Avatar">
                        <div>
                            <strong class="d-block">Daniel Montelongo</strong>
                            <small class="text-muted">
                                <i class="fa-solid fa-user-tie me-1"></i>Instructor
                                <span class="mx-2">|</span>
                                <i class="fa-solid fa-book me-1"></i>PHP y MySQL desde Cero
                            </small>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary me-1" title="Ver perfil">
                            <i class="fa-solid fa-user"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" title="Más opciones">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </div>
                </div>


                <div class="chat-body">
                    <?php foreach ($mensajes as $msg): ?>
                        <div class="mensaje <?php echo $msg['emisor'] === 'yo' ? 'mensaje-yo' : 'mensaje-otro'; ?>">
                            <?php if ($msg['emisor'] === 'otro'): ?>
                                <img src="https://static.vecteezy.com/system/resources/previews/036/280/651/original/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg" class="rounded-circle mensaje-avatar" alt="Avatar">
                            <?php endif; ?>
                            <div class="mensaje-burbuja">
                                <p class="mb-1"><?php echo htmlspecialchars($msg['texto']); ?></p>
                                <small class="mensaje-fecha"><?php echo $msg['fecha']; ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


                <div class="chat-footer">
                    <form class="d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" title="Adjuntar archivo">
                            <i class="fa-solid fa-paperclip"></i>
                        </button>
                        <input type="text" class="form-control me-2" placeholder="Escribe un mensaje..." required>
                        <button type="submit" class="btn text-white" style="background-color: #e67e22;">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <footer class="text-white text-center py-3 mt-4" style="background-color: #2c3e50;">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 SkillForge</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/chat.js"></script>
</body>
</html>