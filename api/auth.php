<?php
//api/auth.php-login conectado a MySQL

session_start();
require_once '../config/Database.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(["error" => "El correo y la contraseña son obligatorios"]);
    exit;
}

$database = new Database();
$db = $database->connect();

$stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email AND activo = 1");
$stmt->execute([':email' => $data['email']]);
$usuario = $stmt->fetch();

//la contra que pusimos en la BD (Admin123!) ya esta hasheada con password_hash
if ($usuario && password_verify($data['password'], $usuario['password'])) {
    //login exitoso
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nombre'] = $usuario['nombre'];
    $_SESSION['usuario_rol'] = $usuario['rol'];
    
    http_response_code(200);
    echo json_encode([
        "mensaje" => "Login exitoso", 
        "usuario" => $usuario['nombre'],
        "rol" => $usuario['rol']
    ]);
} else {
    http_response_code(401);
    echo json_encode(["error" => "Credenciales incorrectas o cuenta bloqueada"]);
}