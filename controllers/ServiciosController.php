<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Servicio.php';

class ServiciosController {
    public function editar($post) {
        try {
            $ok = $this->model->editar($post);
            return ['success' => $ok];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function eliminar($id_servicio, $id_usuario) {
        try {
            $ok = $this->model->eliminar($id_servicio, $id_usuario);
            return ['success' => $ok];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    private $model;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->model = new Servicio($this->db);
    }

    // Este método debería recibir un array con todos los datos, incluido el ícono.
    public function crear($post) {
        try {
            // El modelo ahora espera un array con todos los datos necesarios para la inserción.
            $ok = $this->model->crear($post);
            return ['success' => $ok];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($accion === 'editar_servicio') {
        $res = $ctrl->editar($_POST);
        if ($res['success']) {
            header('Location: ../index.php?page=servicios&msg=editado');
        } else {
            header('Location: ../index.php?page=servicios&error=' . urlencode($res['message']));
        }
        exit;
    }
    if ($accion === 'eliminar_servicio') {
        session_start();
        $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null;
        $id_servicio = $_POST['id_servicio'] ?? null;
        $res = $ctrl->eliminar($id_servicio, $id_usuario);
        if ($res['success']) {
            header('Location: ../index.php?page=servicios&msg=eliminado');
        } else {
            header('Location: ../index.php?page=servicios&error=' . urlencode($res['message']));
        }
        exit;
    }
    $accion = $_POST['accion'] ?? '';
    $ctrl = new ServiciosController();

    if ($accion === 'registrar_servicio') {
        // --- INICIO DE LOS CAMBIOS ---

        // 1. Define el mismo mapa de íconos que usas en la vista.
        $iconos_servicio = [
            'Comercio y Ventas al Detal' => 'https://cdn-icons-png.flaticon.com/512/1170/1170678.png',
            'Gastronomía y Bebidas' => 'https://cdn-icons-png.flaticon.com/512/1046/1046784.png',
            'Servicios de Salud y Bienestar' => 'https://cdn-icons-png.flaticon.com/512/2965/2965567.png',
            'Educación y Formación' => 'https://cdn-icons-png.flaticon.com/512/2984/2984194.png',
            'Transporte y Logística' => 'https://cdn-icons-png.flaticon.com/512/1907/1907109.png',
            'Servicios Técnicos y Profesionales' => 'https://cdn-icons-png.flaticon.com/512/1077/1077035.png',
            'Entretenimiento y Cultura' => 'https://cdn-icons-png.flaticon.com/512/845/845777.png',
            'Turismo y Hospedaje' => 'https://cdn-icons-png.flaticon.com/512/3448/3448573.png',
            'Servicios Financieros y Jurídicos' => 'https://cdn-icons-png.flaticon.com/512/492/492649.png',
            'Medio Ambiente y Sostenibilidad' => 'https://cdn-icons-png.flaticon.com/512/616/616408.png',
            'Agroindustria y Productos Locales' => 'https://cdn-icons-png.flaticon.com/512/3081/3081826.png',
            'Construcción y Obra Civil' => 'https://cdn-icons-png.flaticon.com/512/2940/2940685.png',
            'Belleza y Estética' => 'https://cdn-icons-png.flaticon.com/512/3855/3855675.png',
            'Mantenimiento y Reparaciones' => 'https://cdn-icons-png.flaticon.com/512/2921/2921822.png',
            'Energía y Servicios Públicos' => 'https://cdn-icons-png.flaticon.com/512/3207/3207993.png',
            'default' => 'https://cdn-icons-png.flaticon.com/512/1077/1077035.png'
        ];

        // 2. Obtén la URL del ícono basándose en el nombre de la categoría del formulario.
        $nombre_categoria = $_POST['nombre_servicio'] ?? '';
        $icono_url = $iconos_servicio[$nombre_categoria] ?? $iconos_servicio['default'];

        // 3. Agrega la URL del ícono al array POST antes de pasárselo al modelo.
        $_POST['icono_url'] = $icono_url;

        // --- FIN DE LOS CAMBIOS ---
        
        $res = $ctrl->crear($_POST);
        
        if ($res['success']) {
            header('Location: ../index.php?page=servicios');
        } else {
            header('Location: ../index.php?page=servicios&error=' . urlencode($res['message']));
        }
        exit;
    }
}
?>