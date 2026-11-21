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
    public function obtenerTodos($busqueda = null) {
        if ($busqueda) {
            //si hay busquda filtra por tipo y categoria
            $query = "SELECT * FROM cursos WHERE activo = 1 AND (titulo LIKE :busqueda OR categoria LIKE :busqueda)";
            $stmt = $this->db->prepare($query);
            $termino = '%' . $busqueda . '%';
            $stmt->bindParam(':busqueda', $termino);
            $stmt->execute();
        } else {
            //si no hay busqueda trae todo
            $stmt = $this->db->query("SELECT * FROM cursos WHERE activo = 1");
        }
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
    
    // resumen de ventas para un instructor especifico
    public function obtenerResumenVentas($instructor_id) {
        $query = "SELECT 
                    COUNT(i.id) as total_alumnos,
                    SUM(i.monto_pagado) as total_ingresos
                  FROM inscripciones i
                  INNER JOIN cursos c ON i.curso_id = c.id
                  WHERE c.instructor_id = :instructor_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':instructor_id', $instructor_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    //ventas agrupadas por curso para un instructor
    public function obtenerVentasPorCurso($instructor_id) {
        $query = "SELECT c.id, c.titulo, c.categoria, 
                    COUNT(i.id) as alumnos,
                    SUM(i.monto_pagado) as ingresos
                  FROM cursos c
                  LEFT JOIN inscripciones i ON c.id = i.curso_id
                  WHERE c.instructor_id = :instructor_id
                  GROUP BY c.id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':instructor_id', $instructor_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>