<?php
//punto de entrada para el patron MVC
require_once 'controladores/CursoController.php';

//llamas al controlador
$controller = new CursoController();
$controller->index();
?>