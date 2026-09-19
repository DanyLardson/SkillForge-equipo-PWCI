<?php
//todavia no esta conectada a nada esta parte
class Database {
    
    private $host = 'localhost';
    private $db_name = 'skillforge_db';   
    private $username = 'root';           
    private $password = '';               
    private $conn;
     
    /**
     * establece laconexion usando pdoo
     * 
     * @return PDO|null devuelve la conexion por si falla
     */
     
    public function connect() {
        $this->conn = null;

        try {
            //conexion on el Pdo
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>