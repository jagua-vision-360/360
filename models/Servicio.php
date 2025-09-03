<?php
class Servicio {
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function crear($data) {
        $sql = "INSERT INTO servicios (id_usuario, nombre_servicio, descripcion, precio) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$data['id_usuario'], $data['nombre_servicio'], $data['descripcion'] ?? null, $data['precio'] ?? null]);
    }

    public function obtenerTodos() {
        $sql = "SELECT s.*, u.nombre_completo FROM servicios s LEFT JOIN usuarios u ON s.id_usuario = u.id_usuario ORDER BY s.id_servicio DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }
}
