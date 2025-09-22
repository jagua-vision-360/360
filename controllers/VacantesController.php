<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Vacante.php';

class VacantesController {
    private $model;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->model = new Vacante($this->db);
    }

    public function crear($post) {
        try {
            $ok = $this->model->crear($post);
            return ['success' => $ok];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function obtenerTodas() {
        return $this->model->obtenerTodos();
    }

    public function editar($post) {
        try {
            $ok = $this->model->editar($post);
            return ['success' => $ok];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function eliminar($id_vacante, $id_usuario) {
        try {
            $ok = $this->model->eliminar($id_vacante, $id_usuario);
            return ['success' => $ok];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function obtenerVacanteParaEdicion($id_vacante) {
        require_once __DIR__ . '/../config/database.php';
        $database = new Database();
        $db = $database->getConnection();

        $stmt = $db->prepare("SELECT * FROM vacantes WHERE id_vacante = ?");
        $stmt->bind_param("i", $id_vacante);
        $stmt->execute();
        $result = $stmt->get_result();
        $vacante = $result->fetch_assoc();
        $stmt->close();
        return $vacante;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $ctrl = new VacantesController();

    if ($accion === 'registrar_vacante') {
        $res = $ctrl->crear($_POST);
        if ($res['success']) {
            header('Location: ../index.php?page=vacantes');
        } else {
            header('Location: ../index.php?page=vacantes&error=' . urlencode($res['message']));
        }
        exit;
    }
    if ($accion === 'editar_vacante') {
        $res = $ctrl->editar($_POST);
        if ($res['success']) {
            header('Location: ../index.php?page=vacantes&msg=editado');
        } else {
            header('Location: ../index.php?page=vacantes&error=' . urlencode($res['message']));
        }
        exit;
    }
    if ($accion === 'eliminar_vacante') {
        session_start();
        $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null;
        $id_vacante = $_POST['id_vacante'] ?? null;
        $res = $ctrl->eliminar($id_vacante, $id_usuario);
        if ($res['success']) {
            header('Location: ../index.php?page=vacantes&msg=eliminado');
        } else {
            header('Location: ../index.php?page=vacantes&error=' . urlencode($res['message']));
        }
        exit;
    }
}