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

    public function registrar($post) {
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
}

// --- Manejo directo del POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $ctrl = new UsuariosController();

    if ($accion === 'registrar_usuario') {
        $res = $ctrl->registrar($_POST);
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
            header('Location: ../index.php?page=home'); // Panel principal
        } else {
            header('Location: ../index.php?page=login&error=' . urlencode($res['message']));
        }
        exit;
    }
}
