<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuariosController {
    private $model;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->model = new Usuario($this->db);
    }

    public function registrar($post, $files) {
        // Validar campos obligatorios
        $required = [
            'id_usuario','nombre_completo','correo',
            'usuario','contrasena','tipo_usuario','telefono'
        ];
        foreach ($required as $r) {
            if (empty($post[$r])) {
                return [
                    'success'=>false,
                    'message'=>"Falta campo $r"
                ];
            }
        }

        // Procesar foto de perfil si se envía
        $fotoPerfil = null;
        if (isset($files['foto_perfil']) && $files['foto_perfil']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivo = time() . '_' . basename($files['foto_perfil']['name']);
            $rutaDestino = __DIR__ . '/../public/img/' . $nombreArchivo;
            if (move_uploaded_file($files['foto_perfil']['tmp_name'], $rutaDestino)) {
                $fotoPerfil = $nombreArchivo;
            }
        }

        // Agregar el nombre de la foto al array de datos
        $post['foto_perfil'] = $fotoPerfil;

        try {
            $ok = $this->model->registrar($post);
            return $ok
                ? ['success'=>true]
                : ['success'=>false,'message'=>'No se pudo insertar el usuario.'];
        } catch (Exception $e) {
            return ['success'=>false,'message'=>$e->getMessage()];
        }
    }

    public function login($post) {
        $user = $post['usuario'] ?? '';
        $pass = $post['contrasena'] ?? '';

        $data = $this->model->login($user, $pass);

        if ($data) {
            $_SESSION['usuario'] = $data;
            return ['success'=>true,'data'=>$data];
        }
        return ['success'=>false,'message'=>'Credenciales incorrectas'];
    }

    public function actualizarPerfil($post, $files) {
        $id = $_SESSION['usuario']['id_usuario'];
        $nombre = $post['nombre_completo'] ?? '';
        $correo = $post['correo'] ?? '';
        $telefono = $post['telefono'] ?? '';
        $fotoPerfil = $_SESSION['usuario']['foto_perfil'] ?? null;

        if (isset($files['foto_perfil']) && $files['foto_perfil']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivo = time() . '_' . basename($files['foto_perfil']['name']);
            $rutaDestino = __DIR__ . '/../public/img/' . $nombreArchivo;
            if (move_uploaded_file($files['foto_perfil']['tmp_name'], $rutaDestino)) {
                $fotoPerfil = $nombreArchivo;
            }
        }

        $ok = $this->model->actualizar($id, $nombre, $correo, $telefono, $fotoPerfil);

        if ($ok) {
            $_SESSION['usuario']['nombre_completo'] = $nombre;
            $_SESSION['usuario']['correo'] = $correo;
            $_SESSION['usuario']['telefono'] = $telefono;
            $_SESSION['usuario']['foto_perfil'] = $fotoPerfil;

            return ['success'=>true];
        }
        return ['success'=>false,'message'=>'No se pudo actualizar el perfil.'];
    }
}

// --- Manejo directo del POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $ctrl = new UsuariosController();

    if ($accion === 'registrar_usuario') {
        $res = $ctrl->registrar($_POST, $_FILES);
        if ($res['success']) {
            header('Location: ../index.php?page=usuarios&msg=registrado');
        } else {
            header('Location: ../index.php?page=usuarios&error=' . urlencode($res['message']));
        }
        exit;
    }

    if ($accion === 'login_usuario') {
        $res = $ctrl->login($_POST);
        if ($res['success']) {
            header('Location: ../index.php?page=panel');
        } else {
            header('Location: ../index.php?page=login&error=' . urlencode($res['message']));
        }
        exit;
    }

    if ($accion === 'actualizar_perfil') {
        $res = $ctrl->actualizarPerfil($_POST, $_FILES);
        if ($res['success']) {
            header('Location: ../views/perfil.php?msg=actualizado');
        } else {
            header('Location: ../views/perfil.php?error=' . urlencode($res['message']));
        }
        exit;
    }
}
