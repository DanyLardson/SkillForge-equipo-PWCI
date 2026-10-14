<?php
// ============================================
// API/CURSOS.PHP - Endpoint de cursos
// ============================================
// Devuelve la lista de cursos en formato JSON.
// Por ahora los datos están simulados.
// En la Tercera Entrega vendrán de la BD.
// ============================================

// Cabeceras para JSON y CORS
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

// Arreglo de cursos (simulando la BD)
$cursos = [
    [
        "id" => 1,
        "titulo" => "PHP y MySQL desde Cero",
        "descripcion" => "Aprende a crear aplicaciones web dinámicas con PHP puro y MySQL.",
        "imagen" => "https://bairesdev.mo.cloudinary.net/blog/2023/08/PHP-libraries.jpg",
        "categoria" => "IT & Software",
        "colorBadge" => "bg-primary",
        "rating" => 4.8,
        "precio" => "$49.99"
    ],
    [
        "id" => 2,
        "titulo" => "Marketing Digital Avanzado",
        "descripcion" => "Estrategias de SEO, SEM y redes sociales para hacer crecer tu negocio.",
        "imagen" => "https://tse2.mm.bing.net/th/id/OIP.FZl2Ea_EW1iLcb1oNXPqJAHaEO?r=0&pid=Api&P=0&h=180",
        "categoria" => "Marketing",
        "colorBadge" => "bg-success",
        "rating" => 4.6,
        "precio" => "$39.99"
    ],
    [
        "id" => 3,
        "titulo" => "Introducción a UX/UI",
        "descripcion" => "Principios básicos de diseño de interfaces y experiencia de usuario.",
        "imagen" => "https://blog.cubos.academy/content/images/2023/02/Designer-UI.jpg",
        "categoria" => "Diseño",
        "colorBadge" => "bg-danger",
        "rating" => 4.9,
        "precio" => "Gratis"
    ]
];

// Devolver JSON
echo json_encode([
    "total" => count($cursos),
    "cursos" => $cursos
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);