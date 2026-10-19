<?php
//Modelos del MVC
//Capa de datos
require_once __DIR__ . '/../config/Database.php';

class Curso {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    //consulta SQL para traer todos los cursos activos
    public function obtenerTodos() {
        $stmt = $this->db->query("SELECT * FROM cursos WHERE activo = 1");
        return $stmt->fetchAll();
    }
}
?>