<?php
//paypal api
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

//Validar usuario logueado
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Debes iniciar sesión para comprar"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['curso_id']) || empty($data['monto'])) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan datos del curso o el monto"]);
    exit;
}

//aqui ira la conexion real con paypal

//Simulamo que PayPal proceso el pago exitosamente
//ID transaccion falso
$transactionId = "PAY-" . strtoupper(bin2hex(random_bytes(5)));

// Simulamos un pequeño retraso (como si tardara en conectar)
sleep(1);

//devolvemos la respuesta exitosa 
http_response_code(200);
echo json_encode([
    "status" => "COMPLETED",
    "mensaje" => "Pago procesado correctamente por PayPal",
    "transaction_id" => $transactionId,
    "monto_pagado" => $data['monto'],
    "curso_id" => $data['curso_id'],
    "metodo_pago" => "PayPal"
]);