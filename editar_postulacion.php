<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Obtener la postulación a editar
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: views/postulaciones.php?error=ID de postulación no especificado.');
    exit;
}

$id_postulacion = $_GET['id'];
$db = (new Database())->getConnection();
$stmt = $db->prepare("SELECT * FROM postulaciones WHERE id_postulacion = ?");
$stmt->bind_param("i", $id_postulacion);
$stmt->execute();
$result = $stmt->get_result();
$postulacion = $result->fetch_assoc();
$stmt->close();

if (!$postulacion) {
    header('Location: views/postulaciones.php?error=Postulación no encontrada.');
    exit;
}

// Solo el usuario creador puede editar
$usuario_actual = $_SESSION['usuario']['id_usuario'] ?? null;
if ($usuario_actual != $postulacion['id_usuario']) {
    header('Location: views/postulaciones.php?error=No tienes permiso para editar esta postulación.');
    exit;
}

// Obtener vacantes para el select
require_once __DIR__ . '/models/Vacante.php';
$vacanteModel = new Vacante($db);
$vacantesDisponibles = $vacanteModel->obtenerTodos();

$error_msg = $_GET['error'] ?? '';
$success_msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Postulación</title>
    <style>
        body { background: #181818; color: #f5f5f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .edit-postulacion-card { max-width: 500px; margin: 3rem auto; background: #23213a; padding: 2rem; border-radius: 16px; color: #fff; }
        .edit-postulacion-card label { display:block; margin-bottom:6px; color:#bbb; }
        .edit-postulacion-card input, .edit-postulacion-card textarea, .edit-postulacion-card select { width:100%; margin-bottom:1rem; padding:10px; border-radius:8px; border:1px solid #444; background:#1c1c1c; color:#fff; }
        .btn-actualizar { background:#198754; color:#fff; border:none; padding:12px 24px; border-radius:10px; font-weight:bold; cursor:pointer; margin-right:8px; }
        .btn-cancelar { background:#6c757d; color:#fff; border:none; padding:12px 24px; border-radius:10px; font-weight:bold; cursor:pointer; }
    </style>
</head>
<body>
<div class="edit-postulacion-card">
    <h2>Editar Postulación</h2>
    <?php if ($error_msg): ?><div style="color:#dc3545;"><?= htmlspecialchars($error_msg) ?></div><?php endif; ?>
    <?php if ($success_msg): ?><div style="color:#198754;"><?= htmlspecialchars($success_msg) ?></div><?php endif; ?>
    <form method="POST" action="controllers/PostulacionesController.php">
        <input type="hidden" name="accion" value="actualizar_postulacion">
        <input type="hidden" name="id_postulacion" value="<?= htmlspecialchars($postulacion['id_postulacion']) ?>">
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($postulacion['id_usuario']) ?>">

        <label>ID Vacante</label>
        <select name="id_vacante" required>
            <?php foreach ($vacantesDisponibles as $v): ?>
                <option value="<?= htmlspecialchars($v['id_vacante']) ?>" <?= $v['id_vacante'] == $postulacion['id_vacante'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($v['id_vacante']) ?> - <?= htmlspecialchars($v['titulo']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Fecha de postulación</label>
        <input type="date" name="fecha_postulacion" value="<?= htmlspecialchars($postulacion['fecha_postulacion']) ?>" required>

        <label>Estado</label>
        <select name="estado" required>
            <option value="pendiente" <?= $postulacion['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="aceptado" <?= $postulacion['estado'] == 'aceptado' ? 'selected' : '' ?>>Aceptado</option>
            <option value="rechazado" <?= $postulacion['estado'] == 'rechazado' ? 'selected' : '' ?>>Rechazado</option>
        </select>

        <button type="submit" class="btn-actualizar">Guardar cambios</button>
        <button type="button" class="btn-cancelar" onclick="window.location.href='views/postulaciones.php';">Cancelar</button>
    </form>
</div>
</body>
</html>
