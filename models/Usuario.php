<?php
class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db; // objeto mysqli
    }

    /* ------------------------------------
       REGISTRAR NUEVO USUARIO CON FOTO
    -------------------------------------*/
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
            "issssssssssss",
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

    /* ------------------------------------
       LOGIN DE USUARIO
    -------------------------------------*/
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

    /* ------------------------------------
       ACTUALIZAR FOTO DE PERFIL
    -------------------------------------*/
    public function actualizarFotoPerfil($id_usuario, $ruta) {
        $sql = "UPDATE usuarios SET foto_perfil = ? WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param("si", $ruta, $id_usuario);
        return $stmt->execute();
    }

    /* ------------------------------------
       LISTAR TODOS LOS USUARIOS
    -------------------------------------*/
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
