<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//la conexion REAL a paypal
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

//validar al usuario logueado
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

//configuaciones de paypal sandbox
$clientID = "AbOz1rxRTT7nQMMccbS3UgWAccGFXizLWTb4xNBlpFYLCgZyqAVwFvaxnOPaZc47pIoV4B1YiHqFaYse"; 
$secret = "EOuYlwPqxAP1QA3TzoP8FQCLpt9m6OEqkn79Mwe9rKSXe_bso7_5HHclkoVSOITCu71_gMVTv1-Y4QQA";
$url_api = "https://api-m.sandbox.paypal.com";

//Token de acceso al paypal 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_api . '/v1/oauth2/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_USERPWD, $clientID . ":" . $secret);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

$result = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión con PayPal: " . $err]);
    exit;
}

$json = json_decode($result);
$accessToken = $json->access_token;

if (!$accessToken) {
    http_response_code(500);
    echo json_encode(["error" => "No se pudo obtener el token de PayPal", "detalle" => $json]);
    exit;
}

//orden de pago en paypal
$monto = number_format((float)$data['monto'], 2, '.', '');
$payload = json_encode([
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "amount" => [
            "currency_code" => "USD",
            "value" => $monto
        ],
        "description" => "Curso ID: " . $data['curso_id']
    ]]
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_api . '/v2/checkout/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $accessToken
));

$result = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    http_response_code(500);
    echo json_encode(["error" => "Error creando la orden: " . $err]);
    exit;
}

$order = json_decode($result);

//mandar respuesta exitosa o error
if (isset($order->id)) {
    http_response_code(201); //created
    echo json_encode([
        "status" => "CREATED",
        "mensaje" => "Orden de PayPal creada correctamente",
        "order_id" => $order->id,
        "monto_pagado" => $monto,
        "curso_id" => $data['curso_id'],
        "link_pago" => $order->links[1]->href
    ]);
} else {
    http_response_code(400);
    echo json_encode(["error" => "PayPal rechazó la orden", "detalle" => $order]);
}
?>