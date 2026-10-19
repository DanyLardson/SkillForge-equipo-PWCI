<?php
//controladores de mvc
require_once __DIR__ . '/../modelos/Curso.php';

class CursoController {
    public function index() {
        //pide los datos al modelo
        $modelo = new Curso();
        $cursos = $modelo->obtenerTodos();
        
        //carga la vista y le pasa los datos
        require_once __DIR__ . '/../vistas/cursos/index.php';
    }
}
?>