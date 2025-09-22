<?php
session_start();
require_once __DIR__ . '/controllers/VacantesController.php';
$ctrl = new VacantesController();

$error_msg = $_GET['error'] ?? '';
$success_msg = $_GET['msg'] ?? '';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_vacante = $_GET['id'];
    $vacante = $ctrl->obtenerVacanteParaEdicion($id_vacante);

    if (!$vacante || $vacante['id_usuario'] !== $_SESSION['usuario']['id_usuario']) {
        header('Location: views/vacantes.php?error=' . urlencode('Vacante no encontrada o sin permiso.'));
        exit;
    }
} else {
    header('Location: views/vacantes.php?error=' . urlencode('ID de vacante no especificado.'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Vacante</title>
    <style>
        .edit-vacante-card { max-width: 500px; margin: 3rem auto; background: #222; padding: 2rem; border-radius: 16px; color: #fff; }
        .edit-vacante-card label { display:block; margin-bottom:6px; color:#bbb; }
        .edit-vacante-card input, .edit-vacante-card textarea, .edit-vacante-card select { width:100%; margin-bottom:1rem; padding:10px; border-radius:8px; border:1px solid #444; background:#1c1c1c; color:#fff; }
        .btn-actualizar { background:#198754; color:#fff; border:none; padding:12px 24px; border-radius:10px; font-weight:bold; cursor:pointer; margin-right:8px; }
        .btn-cancelar { background:#6c757d; color:#fff; border:none; padding:12px 24px; border-radius:10px; font-weight:bold; cursor:pointer; }
    </style>
</head>
<body>
<div class="edit-vacante-card">
    <h2>Editar Vacante</h2>
    <?php if ($error_msg): ?><div style="color:#dc3545;"><?= htmlspecialchars($error_msg) ?></div><?php endif; ?>
    <?php if ($success_msg): ?><div style="color:#198754;"><?= htmlspecialchars($success_msg) ?></div><?php endif; ?>
    <form method="POST" action="controllers/VacantesController.php">
        <input type="hidden" name="accion" value="actualizar_vacante">
        <input type="hidden" name="id_vacante" value="<?= htmlspecialchars($vacante['id_vacante']) ?>">
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($vacante['id_usuario']) ?>">
        <label>Título</label>
        <input name="titulo" value="<?= htmlspecialchars($vacante['titulo']) ?>" required>
        <label>Empresa</label>
        <input name="empresa" value="<?= htmlspecialchars($vacante['empresa']) ?>" required>
        <label>Ubicación</label>
        <input name="ubicacion" value="<?= htmlspecialchars($vacante['ubicacion']) ?>" required>
        <label>Categoría</label>
        <select name="categoria" required>
            <?php
            $categorias = ["Tecnología","Marketing","Finanzas","Salud","Educación","Construcción","Manufactura","Servicios al Cliente","Recursos Humanos","Legal"];
            foreach ($categorias as $cat) {
                $selected = ($cat === $vacante['categoria']) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($cat) . '" ' . $selected . '>' . htmlspecialchars($cat) . '</option>';
            }
            ?>
        </select>
        <label>Salario</label>
        <input name="salario" value="<?= htmlspecialchars($vacante['salario']) ?>" required>
        <label>Descripción</label>
        <textarea name="descripcion" rows="3" required><?= htmlspecialchars($vacante['descripcion']) ?></textarea>
        <button type="submit" class="btn-actualizar">Guardar cambios</button>
        <button type="button" class="btn-cancelar" onclick="window.location.href='views/vacantes.php';">Cancelar</button>
    </form>
</div>
</body>
</html>
