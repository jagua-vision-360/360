<?php
class Usuario {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar($data) {
        $sql = "INSERT INTO usuarios (id_usuario, nombre_completo, correo, usuario, contrasena, tipo_usuario, telefono, razon_social, direccion, hoja_vida, experiencia, permisos)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $hash = password_hash($data['contrasena'], PASSWORD_DEFAULT);
        return $stmt->execute([
            $data['id_usuario'],
            $data['nombre_completo'],
            $data['correo'],
            $data['usuario'],
            $hash,
            $data['tipo_usuario'],
            $data['telefono'],
            $data['razon_social'] ?? null,
            $data['direccion'] ?? null,
            $data['hoja_vida'] ?? null,
            $data['experiencia'] ?? null,
            $data['permisos'] ?? null
        ]);
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM usuarios ORDER BY nombre_completo ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function login($usuario, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE usuario = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$usuario]);
        $row = $stmt->fetch();
        if ($row && password_verify($contrasena, $row['contrasena'])) {
            return $row;
        }
        return false;
    }
}
