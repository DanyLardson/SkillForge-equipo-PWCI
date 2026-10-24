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
            if ($_SESSION['usuario_rol'] !== $rolRequerido) {
                //si no tiene rol, pal idex con su mensaje de error
                header('Location: index.php?error=sin_permisos');
                exit;
            }
        }
    }
}
?>