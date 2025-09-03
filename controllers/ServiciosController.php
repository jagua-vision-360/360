<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Servicio.php';

class ServiciosController {
    private $model;
    private $db;
    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->model = new Servicio($this->db);
    }

    public function crear($post) {
        try {
            $ok = $this->model->crear($post);
            return ['success'=>$ok];
        } catch (Exception $e) {
            return ['success'=>false,'message'=>$e->getMessage()];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $ctrl = new ServiciosController();
    if ($accion === 'registrar_servicio') {
        $res = $ctrl->crear($_POST);
        if ($res['success']) header('Location: ../index.php?page=servicios');
        else header('Location: ../index.php?page=servicios&error=' . urlencode($res['message']));
        exit;
    }
}
