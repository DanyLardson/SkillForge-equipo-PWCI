<?php
//login conectado a MySQL con bloqueo
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

if ($usuario && password_verify($data['password'], $usuario['password'])) {
    //login exito: reseteamos los intentos a 0
    $reset = $db->prepare("UPDATE usuarios SET intentos_fallidos = 0 WHERE id = :id");
    $reset->execute([':id' => $usuario['id']]);

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
    //login fallo: sumamos un intento si el usuario existe
    if ($usuario) {
        //verifica si ya estaba bloqueado bloqueado
        if ($usuario['intentos_fallidos'] >= 3) {
            http_response_code(403); 
            echo json_encode(["error" => "Cuenta bloqueada por 3 intentos fallidos."]);
            exit;
        }
        
        $update = $db->prepare("UPDATE usuarios SET intentos_fallidos = intentos_fallidos + 1 WHERE id = :id");
        $update->execute([':id' => $usuario['id']]);
    }
    
    http_response_code(401);
    echo json_encode(["error" => "Credenciales incorrectas"]);
}