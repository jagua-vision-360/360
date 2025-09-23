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

    public function eliminar($id_postulacion, $id_usuario) {
        $stmt = $this->db->prepare("DELETE FROM postulaciones WHERE id_postulacion = ? AND id_usuario = ?");
        $stmt->bind_param("ii", $id_postulacion, $id_usuario);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

// Manejo de acciones POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $ctrl = new PostulacionesController();
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'registrar_postulacion') {
        $res = $ctrl->crear($_POST);
        if ($res['success']) header('Location: ../index.php?page=postulaciones&msg=ok');
        else header('Location: ../index.php?page=postulaciones&error=' . urlencode($res['message']));
        exit;
    }

    if ($accion === 'eliminar_postulacion') {
        $id_postulacion = $_POST['id_postulacion'] ?? null;
        $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null;
        if ($id_postulacion && $id_usuario) {
            $ok = $ctrl->eliminar($id_postulacion, $id_usuario);
            if ($ok) {
                header('Location: ../index.php?page=perfil&msg=eliminada');
            } else {
                header('Location: ../index.php?page=perfil&error=No se pudo eliminar la postulación.');
            }
            exit;
        } else {
            header('Location: ../index.php?page=perfil&error=Datos incompletos para eliminar.');
            exit;
        }
    }
}
