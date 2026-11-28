<?php
session_start();
require_once '../config/Database.php';

header('Content-Type: application/json; charset=utf-8');

// Solo el admin puede hacer esto
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    http_response_code(403);
    echo json_encode(["error" => "No tienes permisos de administrador."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['id']) || !isset($data['activo'])) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan datos (id o activo)."]);
    exit;
}

$database = new Database();
$db = $database->connect();

try {
    $stmt = $db->prepare("UPDATE usuarios SET activo = :activo WHERE id = :id");
    $stmt->execute([
        ':activo' => $data['activo'],
        ':id' => $data['id']
    ]);
    
    echo json_encode(["success" => true, "mensaje" => "Estado actualizado."]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error de base de datos: " . $e->getMessage()]);
}
?>