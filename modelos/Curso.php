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
    public function obtenerTodos($busqueda = null, $categoria = null) {
    $query = "SELECT * FROM cursos WHERE activo = 1";
    $parametros = [];

    if (!empty($busqueda)) {
        $query .= " AND (titulo LIKE :busqueda OR categoria LIKE :busqueda)";
        $parametros[':busqueda'] = '%' . $busqueda . '%';
    }

    if (!empty($categoria) && $categoria !== "Todas las categorías") {
        $query .= " AND categoria = :categoria";
        $parametros[':categoria'] = $categoria;
    }

    $stmt = $this->db->prepare($query);
    $stmt->execute($parametros);

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

      // obtener detalles de curso solo por la id
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT c.*, u.nombre as instructor_nombre FROM cursos c LEFT JOIN usuarios u ON c.instructor_id = u.id WHERE c.id = :id AND c.activo = 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    //obtener comentarios reales de un curso
    public function obtenerComentarios($curso_id) {
        $stmt = $this->db->prepare("SELECT co.*, u.nombre as usuario_nombre FROM comentarios co INNER JOIN usuarios u ON co.usuario_id = u.id WHERE co.curso_id = :curso_id AND co.eliminado = 0 ORDER BY co.fecha_creacion DESC");
        $stmt->execute([':curso_id' => $curso_id]);
        return $stmt->fetchAll();
    }

    //guardar nevo comentario
    public function guardarComentario($curso_id, $usuario_id, $comentario, $calificacion) {
        $stmt = $this->db->prepare("INSERT INTO comentarios (curso_id, usuario_id, comentario, calificacion) VALUES (:curso_id, :usuario_id, :comentario, :calificacion)");
        return $stmt->execute([
            ':curso_id' => $curso_id,
            ':usuario_id' => $usuario_id,
            ':comentario' => $comentario,
            ':calificacion' => $calificacion
        ]);
    }
}
?>