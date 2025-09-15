<?php
class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db; // objeto mysqli
    }

    public function registrar($data) {
        $sql = "INSERT INTO usuarios 
            (id_usuario, nombre_completo, correo, usuario, contrasena, tipo_usuario, telefono, razon_social, direccion, hoja_vida, experiencia, permisos)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        $hash = password_hash($data['contrasena'], PASSWORD_DEFAULT);

        $stmt->bind_param(
            "isssssssssss",
            $data['id_usuario'],
            $data['nombre_completo'],
            $data['correo'],
            $data['usuario'],
            $hash,
            $data['tipo_usuario'],
            $data['telefono'],
            $data['razon_social'],
            $data['direccion'],
            $data['hoja_vida'],
            $data['experiencia'],
            $data['permisos']
        );

        return $stmt->execute();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM usuarios ORDER BY nombre_completo ASC";
        $result = $this->conn->query($sql);
        if (!$result) return [];

        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        return $usuarios;
    }

    public function login($usuario, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE usuario = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        $stmt->bind_param("s", $usuario);
        $stmt->execute();

        $res = $stmt->get_result();
        $row = $res->fetch_assoc();

        if ($row && password_verify($contrasena, $row['contrasena'])) {
            return $row;
        }
        return false;
    }
}
