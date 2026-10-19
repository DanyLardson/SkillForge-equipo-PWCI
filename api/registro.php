<?php
//registro usuarios real

session_start();
require_once '../config/Database.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "metodo no permitido"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);


if (empty($data['nombre']) || empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(["error" => "nombre, correo y contrasena son obligatorios"]);
    exit;
}

$database = new Database();
$db = $database->connect();

try {
    //y el correo ya existe?
    $check = $db->prepare("SELECT id FROM usuarios WHERE email = :email");
    $check->execute([':email' => $data['email']]);
    if ($check->fetch()) {
        http_response_code(400);
        echo json_encode(["error" => "este correo ya esta registrado"]);
        exit;
    }

    
    $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

    //usuario registrado pa la BD
    $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)");
    $stmt->execute([
        ':nombre' => $data['nombre'],
        ':email' => $data['email'],
        ':password' => $passwordHash,
        ':rol' => $data['rol'] ?? 'estudiante'
    ]);

    http_response_code(201);
    echo json_encode(["mensaje" => "usuario registrado con exito"]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "error interno del servidor: " . $e->getMessage()]);
}