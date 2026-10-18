<?php
class Auth {
    public static function check() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //si no hay sesión, mandamos  pal login
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: login.php?error=no_autorizado');
            exit;
        }
    }
}