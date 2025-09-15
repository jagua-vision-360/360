<?php
require_once __DIR__ . '/../config/database.php';

class PostulacionesController {
    private $db;
    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function crear($post) {
        if (empty($post['id_usuario']) || empty($post['id_vacante']) || empty($post['fecha_postulacion'])) {
            return ['success'=>false,'message'=>'Faltan campos.'];
        }
        $estado = 'pendiente';
        try {
            $sql = "INSERT INTO postulaciones (id_usuario, id_vacante, fecha_postulacion, estado) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $post['id_usuario'],
                $post['id_vacante'],
                $post['fecha_postulacion'],
                $estado
            ]);
            return ['success'=>true];
        } catch (Exception $e) {
            return ['success'=>false,'message'=>$e->getMessage()];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $ctrl = new PostulacionesController();
    if ($accion === 'registrar_postulacion') {
        $res = $ctrl->crear($_POST);
        if ($res['success']) header('Location: ../index.php?page=postulaciones&msg=ok');
        else header('Location: ../index.php?page=postulaciones&error=' . urlencode($res['message']));
        exit;
    }
}
