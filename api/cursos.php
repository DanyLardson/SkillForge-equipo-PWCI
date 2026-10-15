<?php
// ============================================
// API/CURSOS.PHP - Endpoints de cursos
// ============================================
// Endpoint 1: GET /api/cursos           → Lista todos los cursos
// Endpoint 2: GET /api/cursos.php?id=X  → Devuelve un curso por ID
//
// Por ahora los datos están simulados en un arreglo.
// En la Tercera Entrega vendrán de la BD (Modelo).
// ============================================

// ---- Cabeceras de la API ----
header('Content-Type: application/json; charset=utf-8');

// ---- Middleware de CORS ----
// Permite el origen del cliente (el propio portal)
$origenesPermitidos = [
    'http://localhost',
    'http://localhost/PWCI_051_PIA',
    'http://127.0.0.1'
];

$origen = $_SERVER['HTTP_ORIGIN'] ?? '';

if (in_array($origen, $origenesPermitidos)) {
    header('Access-Control-Allow-Origin: ' . $origen);
} else {
    // Si no viene un origen permitido, igual permitimos localhost para pruebas
    header('Access-Control-Allow-Origin: http://localhost');
}

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Max-Age: 86400');

// Si es una petición preflight (OPTIONS), terminar aquí
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ---- Datos simulados (luego vendrán de la BD) ----
$cursos = [
    [
        "id" => 1,
        "titulo" => "PHP y MySQL desde Cero",
        "descripcion" => "Aprende a crear aplicaciones web dinámicas desde cero con PHP puro y MySQL. Este curso está diseñado para llevarte paso a paso desde los fundamentos del lenguaje hasta la construcción de un sistema completo con autenticación, CRUD y conexión a base de datos.",
        "imagen" => "https://bairesdev.mo.cloudinary.net/blog/2023/08/PHP-libraries.jpg",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-primary",
        "rating" => 4.8,
        "calificacion" => 4.8,
        "numCalificaciones" => 124,
        "numEstudiantes" => 1240,
        "duracion" => "12 horas",
        "precio" => "$49.99",
        "instructor" => [
            "nombre" => "Daniel Montelongo",
            "rol" => "Desarrollador Full Stack",
            "avatar" => "https://i.pravatar.cc/50?img=60"
        ],
        "niveles" => [
            ["numero" => 1, "titulo" => "Introducción a PHP", "esGratis" => true, "precio" => null],
            ["numero" => 2, "titulo" => "Variables y Tipos de Datos", "esGratis" => false, "precio" => "$19.99"],
            ["numero" => 3, "titulo" => "Conexión a MySQL", "esGratis" => false, "precio" => "$19.99"]
        ]
    ],
    [
        "id" => 2,
        "titulo" => "Marketing Digital Avanzado",
        "descripcion" => "Estrategias de SEO, SEM y redes sociales para hacer crecer tu negocio.",
        "imagen" => "https://tse2.mm.bing.net/th/id/OIP.FZl2Ea_EW1iLcb1oNXPqJAHaEO?r=0&pid=Api&P=0&h=180",
        "categoria" => "Marketing",
        "colorBadge" => "bg-success",
        "rating" => 4.6,
        "calificacion" => 4.6,
        "numCalificaciones" => 89,
        "numEstudiantes" => 780,
        "duracion" => "8 horas",
        "precio" => "$39.99",
        "instructor" => [
            "nombre" => "Ana López",
            "rol" => "Especialista en Marketing",
            "avatar" => "https://i.pravatar.cc/50?img=45"
        ],
        "niveles" => [
            ["numero" => 1, "titulo" => "Fundamentos de SEO", "esGratis" => true, "precio" => null]
        ]
    ],
    [
        "id" => 3,
        "titulo" => "Introducción a UX/UI",
        "descripcion" => "Principios básicos de diseño de interfaces y experiencia de usuario.",
        "imagen" => "https://blog.cubos.academy/content/images/2023/02/Designer-UI.jpg",
        "categoria" => "Diseño",
        "colorBadge" => "bg-danger",
        "rating" => 4.9,
        "calificacion" => 4.9,
        "numCalificaciones" => 210,
        "numEstudiantes" => 1890,
        "duracion" => "6 horas",
        "precio" => "Gratis",
        "instructor" => [
            "nombre" => "Sofía Martínez",
            "rol" => "Diseñadora UX/UI",
            "avatar" => "https://i.pravatar.cc/50?img=32"
        ],
        "niveles" => [
            ["numero" => 1, "titulo" => "Introducción al diseño", "esGratis" => true, "precio" => null]
        ]
    ]
];

// ---- Enrutamiento básico ----
$metodo = $_SERVER['REQUEST_METHOD'];

// Solo permitimos GET por ahora
if ($metodo !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "error" => "Método no permitido",
        "codigo" => 405
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Verificar si viene un id en la URL
if (isset($_GET['id'])) {
    // ============================================
    // ENDPOINT 2: GET /api/cursos.php?id=X
    // Devuelve un solo curso
    // ============================================
    $id = (int)$_GET['id'];
    
    $cursoEncontrado = null;
    foreach ($cursos as $curso) {
        if ($curso['id'] === $id) {
            $cursoEncontrado = $curso;
            break;
        }
    }

    if ($cursoEncontrado === null) {
        http_response_code(404);
        echo json_encode([
            "error" => "Curso no encontrado",
            "codigo" => 404
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    http_response_code(200);
    echo json_encode($cursoEncontrado, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// ============================================
// ENDPOINT 1: GET /api/cursos.php
// Devuelve la lista completa de cursos
// ============================================
http_response_code(200);
echo json_encode([
    "total" => count($cursos),
    "cursos" => $cursos
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);