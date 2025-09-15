<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'controllers/ServiciosController.php';
require_once 'controllers/VacantesController.php';

$usuario_actual = $_SESSION['usuario']['id_usuario'] ?? null;
$servicios_ctrl = new ServiciosController();
$vacantes_ctrl = new VacantesController();

// Obtener solo servicios y vacantes del usuario actual
$mis_servicios = [];
$mis_vacantes = [];
if ($usuario_actual) {
    $todos_servicios = $servicios_ctrl->model->obtenerTodos();
    foreach ($todos_servicios as $s) {
        if ($s['id_usuario'] === $usuario_actual) $mis_servicios[] = $s;
    }
    $todos_vacantes = $vacantes_ctrl->model->obtenerTodas();
    foreach ($todos_vacantes as $v) {
        if ($v['id_usuario'] === $usuario_actual) $mis_vacantes[] = $v;
    }
}
?>
<link rel="stylesheet" href="estilos/main-unificado.css">
<div class="dashboard-wrapper">
  <h2 class="dashboard-title">Mi Panel</h2>
  <div class="dashboard-section">
    <h3>Mis Servicios</h3>
    <?php if (empty($mis_servicios)): ?>
      <div class="alert alert-dark">No has publicado servicios aún.</div>
    <?php else: ?>
      <div class="tarjetas-container">
        <?php foreach ($mis_servicios as $s): ?>
          <div class="tarjeta">
            <h5 class="card-title"><?= htmlspecialchars($s['nombre_servicio']) ?></h5>
            <p class="precio"><strong>$<?= number_format($s['precio'] ?? 0, 0, ',', '.') ?></strong></p>
            <p class="publicado"><small><?= htmlspecialchars($s['descripcion']) ?></small></p>
            <form method="POST" action="controllers/ServiciosController.php" style="display:inline-block;margin-top:8px;">
              <input type="hidden" name="accion" value="editar_servicio">
              <input type="hidden" name="id_servicio" value="<?= htmlspecialchars($s['id_servicio']) ?>">
              <button type="submit" class="btn-publicar" style="background:#ffc107;color:#222;padding:6px 12px;font-size:0.95rem;border-radius:8px;margin-right:4px;">Editar</button>
            </form>
            <form method="POST" action="controllers/ServiciosController.php" style="display:inline-block;">
              <input type="hidden" name="accion" value="eliminar_servicio">
              <input type="hidden" name="id_servicio" value="<?= htmlspecialchars($s['id_servicio']) ?>">
              <button type="submit" class="btn-publicar" style="background:#dc3545;color:#fff;padding:6px 12px;font-size:0.95rem;border-radius:8px;">Eliminar</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
  <div class="dashboard-section">
    <h3>Mis Vacantes</h3>
    <?php if (empty($mis_vacantes)): ?>
      <div class="alert alert-dark">No has publicado vacantes aún.</div>
    <?php else: ?>
      <div class="tarjetas-container">
        <?php foreach ($mis_vacantes as $v): ?>
          <div class="tarjeta">
            <h5 class="card-title"><?= htmlspecialchars($v['titulo']) ?></h5>
            <p class="precio"><strong><?= htmlspecialchars($v['salario']) ?></strong></p>
            <p class="publicado"><small><?= htmlspecialchars($v['descripcion']) ?></small></p>
            <form method="POST" action="controllers/VacantesController.php" style="display:inline-block;margin-top:8px;">
              <input type="hidden" name="accion" value="editar_vacante">
              <input type="hidden" name="id_vacante" value="<?= htmlspecialchars($v['id_vacante']) ?>">
              <button type="submit" class="btn-publicar" style="background:#ffc107;color:#222;padding:6px 12px;font-size:0.95rem;border-radius:8px;margin-right:4px;">Editar</button>
            </form>
            <form method="POST" action="controllers/VacantesController.php" style="display:inline-block;">
              <input type="hidden" name="accion" value="eliminar_vacante">
              <input type="hidden" name="id_vacante" value="<?= htmlspecialchars($v['id_vacante']) ?>">
              <button type="submit" class="btn-publicar" style="background:#dc3545;color:#fff;padding:6px 12px;font-size:0.95rem;border-radius:8px;">Eliminar</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
