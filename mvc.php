<?php
//punto de entrada para el patron MVC
require_once 'controladores/CursoController.php';

//llama al controlador
$controller = new CursoController();
$controller->index();
?>