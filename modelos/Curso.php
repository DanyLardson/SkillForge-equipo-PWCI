<?php
//modelos del MVC
require_once __DIR__ . '/../config/Database.php';

class Curso {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    //consulta para traer los cursos actuvos
    public function obtenerTodos() {
        $stmt = $this->db->query("SELECT * FROM cursos WHERE activo = 1");
        return $stmt->fetchAll();
    }

    //cursos en los que esta inscrito el alumno
    public function obtenerInscripciones($usuario_id) {
        $query = "SELECT c.*, i.fecha_inscripcion, i.monto_pagado, i.estatus as estado_inscripcion
                  FROM cursos c
                  INNER JOIN inscripciones i ON c.id = i.curso_id
                  WHERE i.usuario_id = :usuario_id AND c.activo = 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>