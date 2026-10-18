<?php
// api/cursos.php-conectado a MySQL Real

require_once '../config/Database.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

//conexion BD
$database = new Database();
$db = $database->connect();

if (!$db) {
    http_response_code(500);
    echo json_encode(["error" => "Error interno de conexión a la base de datos", "codigo" => 500]);
    exit;
}

$metodo = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

//middleware simple pra POST PUT y DELETE 
if (in_array($metodo, ['POST', 'PUT', 'DELETE'])) {
    $headers = getallheaders();
    if (!isset($headers['Authorization']) || strpos($headers['Authorization'], 'Bearer ') === false) {
        http_response_code(401);
        echo json_encode(["error" => "No autorizado. Se requiere token.", "codigo" => 401]);
        exit;
    }
}

switch ($metodo) {
    case 'GET':
        if ($id) {
            $stmt = $db->prepare("SELECT * FROM cursos WHERE id = :id AND activo = 1");
            $stmt->execute([':id' => $id]);
            $curso = $stmt->fetch();
            
            if ($curso) {
                http_response_code(200);
                echo json_encode($curso);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Curso no encontrado", "codigo" => 404]);
            }
        } else {
            $stmt = $db->query("SELECT * FROM cursos WHERE activo = 1");
            $cursos = $stmt->fetchAll();
            http_response_code(200);
            echo json_encode(["total" => count($cursos), "cursos" => $cursos]);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['titulo']) || empty($data['precio'])) {
            http_response_code(400);
            echo json_encode(["error" => "El título y el precio son obligatorios", "codigo" => 400]);
            exit;
        }
        $stmt = $db->prepare("INSERT INTO cursos (titulo, descripcion, categoria, precio, imagen, instructor_id) VALUES (:titulo, :desc, :cat, :precio, :img, 2)");
        $stmt->execute([
            ':titulo' => $data['titulo'],
            ':desc' => $data['descripcion'] ?? '',
            ':cat' => $data['categoria'] ?? 'General',
            ':precio' => $data['precio'],
            ':img' => $data['imagen'] ?? 'https://via.placeholder.com/300'
        ]);
        http_response_code(201);
        echo json_encode(["mensaje" => "Curso creado exitosamente", "id" => $db->lastInsertId()]);
        break;

    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "Se requiere un ID para actualizar"]);
            exit;
        }
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $db->prepare("UPDATE cursos SET titulo = :titulo, precio = :precio WHERE id = :id");
        $stmt->execute([':titulo' => $data['titulo'], ':precio' => $data['precio'], ':id' => $id]);
        http_response_code(200);
        echo json_encode(["mensaje" => "Curso actualizado"]);
        break;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "Se requiere un ID para eliminar"]);
            exit;
        }
        //baja logica
        $stmt = $db->prepare("UPDATE cursos SET activo = 0 WHERE id = :id");
        $stmt->execute([':id' => $id]);
        http_response_code(200);
        echo json_encode(["mensaje" => "Curso dado de baja exitosamente"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido", "codigo" => 405]);
        break;
}