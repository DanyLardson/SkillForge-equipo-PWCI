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

//busca solo el email
$stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
$stmt->execute([':email' => $data['email']]);
$usuario = $stmt->fetch();

//si existe y la contraseña es correcta
if ($usuario && password_verify($data['password'], $usuario['password'])) {
    
    //revisa si esta bloqueado
    if ($usuario['activo'] == 0) {
        http_response_code(403);
        echo json_encode(["error" => "Tu cuenta ha sido bloqueada por un administrador. Contacta a soporte."]);
        exit;
    }

    //Login exitoso 
    //reseteamos los intentos
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
    //si el login falla 
    //sumamos un intento si el usuario existe
    if ($usuario) {
        //verifica si ya estaba bloqueado 
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

//Ian bro te dejo esto tambien porque se me llega a ir que hacia cada parte de esto