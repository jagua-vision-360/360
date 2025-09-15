<?php
class Database {
    private $host = '127.0.0.1';
    private $db_name = 'jagua360';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Error de conexión a la base de datos: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
        return $this->conn;
    }
}