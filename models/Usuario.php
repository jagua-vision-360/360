<?php
class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar($data) {
        $sql = "INSERT INTO usuarios 
            (id_usuario, nombre_completo, correo, usuario, contrasena, tipo_usuario, telefono, razon_social, direccion, hoja_vida, experiencia, permisos, foto_perfil)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        $hash = password_hash($data['contrasena'], PASSWORD_DEFAULT);

        $stmt->bind_param(
            "sssssssssssss",
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
            $data['permisos'],
            $data['foto_perfil']
        );

        return $stmt->execute();
    }

    public function login($usuario, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE usuario = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($contrasena, $user['contrasena'])) {
                return $user;
            }
        }
        return false;
    }

    public function actualizarFotoPerfil($id_usuario, $ruta) {
        $sql = "UPDATE usuarios SET foto_perfil = ? WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param("si", $ruta, $id_usuario);
        return $stmt->execute();
    }
    
    public function actualizar($id, $nombre, $correo, $telefono, $fotoPerfil) {
        $sql = "UPDATE usuarios SET nombre_completo = ?, correo = ?, telefono = ?, foto_perfil = ? WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param("sssss", $nombre, $correo, $telefono, $fotoPerfil, $id);
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
}