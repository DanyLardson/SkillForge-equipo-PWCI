<?php
// controladores/CursoController.php
require_once __DIR__ . '/../modelos/Curso.php';
require_once __DIR__ . '/../config/Database.php';

class CursoController {
    
    public function index() {
        $modelo = new Curso();
        $cursos = $modelo->obtenerTodos();
        require_once __DIR__ . '/../vistas/cursos/index.php';
    }

    public function comprar() {
        // Si la sesión no está iniciada, la iniciamos
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Validar que el usuario esté logueado
        if (!isset($_SESSION['usuario_id'])) {
            die("Error: No hay sesión iniciada. Por favor, inicia sesión primero.");
        }

        $curso_id = $_POST['curso_id'] ?? null;
        $monto = $_POST['monto'] ?? 0;
        $usuario_id = $_SESSION['usuario_id'];
        $metodo_pago = 'PayPal'; 

        if (!$curso_id) {
            die("Error: Curso no válido.");
        }

        try {
            $database = new Database();
            $db = $database->connect();

            // Insertar la inscripción (Esto alimenta el Kardex y Ventas)
            $query = "INSERT INTO inscripciones (usuario_id, curso_id, monto_pagado, metodo_pago) 
                      VALUES (:usuario_id, :curso_id, :monto, :metodo_pago)";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':curso_id', $curso_id);
            $stmt->bindParam(':monto', $monto);
            $stmt->bindParam(':metodo_pago', $metodo_pago);
            
            $stmt->execute();

            // Redirigir al Kardex (Ajustado para que funcione desde la raíz)
            header('Location: kardex.php?compra=exitosa');
            exit;

        } catch (PDOException $e) {
            die("Error al procesar la compra: " . $e->getMessage());
        }
    }
}
?>