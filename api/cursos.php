<?php
//API REST Completa, ya con lo del MySQL

session_start();
require_once '../config/Database.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

$database = new Database();
$db = $database->connect();

if (!$db) {
    http_response_code(500);
    echo json_encode(["error" => "error de conexion a la BD", "codigo" => 500]);
    exit;
}

$metodo = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

//middleware autorizacion 
if (in_array($metodo, ['POST', 'PUT', 'DELETE'])) {
    //verifica si inicio sesion
    if (!isset($_SESSION['usuario_id'])) {
        http_response_code(401);
        echo json_encode(["error" => "No has iniciado sesion", "codigo" => 401]);
        exit;
    }
    
    //revisamos que el admin sea admin o instructor
    if ($_SESSION['usuario_rol'] !== 'admin' && $_SESSION['usuario_rol'] !== 'instructor') {
        http_response_code(403); 
        echo json_encode(["error" => "No tienes permisos para realizar esta accion", "codigo" => 403]);
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
                echo json_encode(["error" => "curso no encontrado", "codigo" => 404]);
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
        
        if (empty($data['titulo']) || !isset($data['precio'])) {
            http_response_code(400);
            echo json_encode(["error" => "el titulo y el precio son obligatorios", "codigo" => 400]);
            exit;
        }
        $stmt = $db->prepare("INSERT INTO cursos (titulo, descripcion, categoria, precio, imagen, instructor_id) VALUES (:titulo, :desc, :cat, :precio, :img, 1)");
        $stmt->execute([
            ':titulo' => $data['titulo'],
            ':desc' => $data['descripcion'] ?? 'sin descripcion',
            ':cat' => $data['categoria'] ?? 'General',
            ':precio' => $data['precio'],
            ':img' => $data['imagen'] ?? 'https://via.placeholder.com/300'
        ]);
        http_response_code(201); 
        echo json_encode(["mensaje" => "curso creado exitosamente", "id" => $db->lastInsertId()]);
        break;

     case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "se requiere un ID en la URL", "codigo" => 400]);
            exit;
        }
        $data = json_decode(file_get_contents("php://input"), true);
        
        //verifica si existe
        $check = $db->prepare("SELECT id FROM cursos WHERE id = :id");
        $check->execute([':id' => $id]);
        if (!$check->fetch()) {
            http_response_code(404);
            echo json_encode(["error" => "curso no encontrado", "codigo" => 404]);
            exit;
        }

        //actualiza todos los campos 
        $stmt = $db->prepare("UPDATE cursos SET titulo = :titulo, descripcion = :desc, categoria = :cat, precio = :precio, imagen = :img WHERE id = :id");
        $stmt->execute([
            ':titulo' => $data['titulo'],
            ':desc' => $data['descripcion'] ?? '',
            ':cat' => $data['categoria'] ?? 'General',
            ':precio' => $data['precio'],
            ':img' => $data['imagen'] ?? '',
            ':id' => $id
        ]);
        http_response_code(200);
        echo json_encode(["mensaje" => "curso actualizado correctamente"]);
        break;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "se requiere un ID en la URL", "codigo" => 400]);
            exit;
        }
        //baja lgica
        $stmt = $db->prepare("UPDATE cursos SET activo = 0 WHERE id = :id");
        $stmt->execute([':id' => $id]);
        
        if ($stmt->rowCount() > 0) {
            http_response_code(200);
            echo json_encode(["mensaje" => "curso dado de baja exitosamente"]);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "curso no encontrado", "codigo" => 404]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "metodo no permitido", "codigo" => 405]);
        break;
}