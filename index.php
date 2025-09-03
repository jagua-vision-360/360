<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Autoload simple for models and controllers
spl_autoload_register(function ($class) {
    $paths = ['controllers', 'models'];
    foreach ($paths as $p) {
        $file = __DIR__ . "/$p/{$class}.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// create db connection to pass to controllers when needed
$db = (new Database())->getConnection();

// routing
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? null;
if ($action === 'logout') {
    session_destroy();
    header('Location: index.php');
    exit;
}

// include header
include __DIR__ . '/templates/header.php';

switch ($page) {
    case 'usuarios':
        // prepare data: list users
        $usuarioModel = new Usuario($db);
        $usuarios = $usuarioModel->obtenerTodos();
        include __DIR__ . '/views/usuarios.php';
        break;
    case 'servicios':
        $servicioModel = new Servicio($db);
        $servicios = $servicioModel->obtenerTodos();
        include __DIR__ . '/views/servicios.php';
        break;
    case 'vacantes':
        $vacanteModel = new Vacante($db);
        $vacantes = $vacanteModel->obtenerTodos();
        include __DIR__ . '/views/vacantes.php';
        break;
    case 'postulaciones':
        include __DIR__ . '/views/postulaciones.php';
        break;
    case 'login':
        include __DIR__ . '/views/login.php';
        break;
    case 'registro':
        include __DIR__ . '/views/registro.php';
        break;
    case 'perfil':
        include __DIR__ . '/views/perfil.php';
        break;
    case 'home':
    default:
        include __DIR__ . '/views/index_home.php';
        break;
}

include __DIR__ . '/templates/footer.php';
