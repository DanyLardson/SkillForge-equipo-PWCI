<?php
class Auth {
    public static function check($rolRequerido = null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //validar que haya sesion
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: login.php?error=no_autorizado');
            exit;
        }

        //validar si el rol que se pidio es uno en especifico
        if ($rolRequerido !== null) {
            //bro te va a dejar si es el rol que se requiere o si eres el admin
            if ($_SESSION['usuario_rol'] !== $rolRequerido && $_SESSION['usuario_rol'] !== 'admin') {
                header('Location: index.php?error=sin_permisos');
                exit;
            }
        }
    }
}
?>