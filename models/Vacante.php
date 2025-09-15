<?php
class Vacante {
    private $conn;

    public function __construct($db) { 
        $this->conn = $db; 
    }

    public function crear($data) {
        $sql = "INSERT INTO vacantes (id_usuario, titulo, descripcion, salario, empresa, ubicacion, categoria) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conn->error);
        }
        
        $stmt->bind_param("sssssss", $data['id_usuario'], $data['titulo'], $data['descripcion'], $data['salario'], $data['empresa'], $data['ubicacion'], $data['categoria']);
        
        $ok = $stmt->execute();
        $stmt->close();
        
        return $ok;
    }

    public function obtenerTodos() {
        $sql = "SELECT v.*, u.nombre_completo FROM vacantes v LEFT JOIN usuarios u ON v.id_usuario = u.id_usuario ORDER BY v.id_vacante DESC";
        
        $result = $this->conn->query($sql);
        
        if ($result) {
            $vacantes = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $vacantes;
        } else {
            return [];
        }
    }
}