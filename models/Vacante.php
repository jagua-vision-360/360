<?php
class Vacante {
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function crear($data) {
        $sql = "INSERT INTO vacantes (id_usuario, titulo, descripcion, salario) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$data['id_usuario'], $data['titulo'], $data['descripcion'] ?? null, $data['salario'] ?? null]);
    }

    public function obtenerTodos() {
        $sql = "SELECT v.*, u.nombre_completo FROM vacantes v LEFT JOIN usuarios u ON v.id_usuario = u.id_usuario ORDER BY v.id_vacante DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }
}
