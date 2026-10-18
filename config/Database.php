<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'skillforge_db'; 
    private $username = 'root';
    private $password = ''; 
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            //recuerda no usar echo para los errores en las apis, mejor guardarlo o devolverlo en null 
            error_log("Error de conexión: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>