<?php
class Servicio {
    private $conn;

    public function __construct($db) {
        $this->conn = $db; // objeto mysqli
    }

    public function crear($data) {
        $sql = "INSERT INTO servicios (id_usuario, nombre_servicio, descripcion, precio) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        $id_usuario = $data['id_usuario'];
        $nombre = $data['nombre_servicio'];
        $descripcion = $data['descripcion'] ?? null;
        $precio = $data['precio'] ?? null;

        $stmt->bind_param("isss", $id_usuario, $nombre, $descripcion, $precio);
        return $stmt->execute();
    }

    public function obtenerTodos() {
        $sql = "SELECT s.*, u.nombre_completo 
                FROM servicios s 
                LEFT JOIN usuarios u ON s.id_usuario = u.id_usuario 
                ORDER BY s.id_servicio DESC";
        $result = $this->conn->query($sql);
        if (!$result) return [];
        $servicios = [];
        while ($row = $result->fetch_assoc()) {
            $servicios[] = $row;
        }
        return $servicios;
    }

    public function editar($data) {
        $sql = "UPDATE servicios SET nombre_servicio=?, descripcion=?, precio=? WHERE id_servicio=? AND id_usuario=?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conn->error);
        }
        $stmt->bind_param(
            "sssii",
            $data['nombre_servicio'],
            $data['descripcion'],
            $data['precio'],
            $data['id_servicio'],
            $data['id_usuario']
        );
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function eliminar($id_servicio, $id_usuario) {
        $sql = "DELETE FROM servicios WHERE id_servicio=? AND id_usuario=?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conn->error);
        }
        $stmt->bind_param("ii", $id_servicio, $id_usuario);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
