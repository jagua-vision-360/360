<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';

// Traer todas las postulaciones
$stmt = (new Database())->getConnection()->query("SELECT * FROM postulaciones ORDER BY id_postulacion DESC");
$postulaciones = [];
if ($stmt) {
  while ($row = $stmt->fetch_assoc()) {
    $postulaciones[] = $row;
  }
}
?>

<div class="row servicio-wrapper">
  <!-- Formulario Postulaciones -->
  <div class="col-md-5 mb-4">
    <div class="form-card">
      <h4 class="form-title">Postularse</h4>
      <?php if (isset($_GET['msg']) && $_GET['msg'] === 'ok'): ?>
        <div class="alert alert-success">Postulación registrada.</div>
      <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
      <?php endif; ?>
      <form method="POST" action="controllers/PostulacionesController.php">
        <input type="hidden" name="accion" value="registrar_postulacion">

        <div class="mb-5">
          <label>ID Usuario</label>
          <input class="form-control" name="id_usuario" required>
        </div>


        <?php
        // Obtener vacantes para el select
        require_once __DIR__ . '/../models/Vacante.php';
        $vacanteModel = new Vacante((new Database())->getConnection());
        $vacantesDisponibles = $vacanteModel->obtenerTodos();
        ?>
        <div class="mb-5">
          <label>ID Vacante</label>
          <select class="form-control" name="id_vacante" required>
            <option value="">Seleccione una vacante...</option>
            <?php foreach ($vacantesDisponibles as $v): ?>
              <option value="<?= htmlspecialchars($v['id_vacante']) ?>">
                <?= htmlspecialchars($v['id_vacante']) ?> - <?= htmlspecialchars($v['titulo']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>


        <div class="mb-5">
          <label>Fecha de postulación</label>
          <input class="form-control" name="fecha_postulacion" type="date" required>
        </div>


        <button class="btn-publicar" type="submit">Postular</button>
      </form>
    </div>
  </div>

  <!-- Tabla de Postulaciones -->
  <div class="col-md-7">
    <div class="form-card">
      <h4 class="form-title">Postulaciones Registradas</h4>

      <?php if (!empty($postulaciones)): ?>
        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th>ID Postulación</th>
              <th>ID Usuario</th>
              <th>ID Vacante</th>
              <th>Fecha de postulación</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $usuario_actual = $_SESSION['usuario']['id_usuario'] ?? null;
            foreach ($postulaciones as $p):
            ?>
              <tr>
                <td><?= htmlspecialchars($p['id_postulacion'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['id_usuario'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['id_vacante'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['fecha_postulacion'] ?? '') ?></td>
                <td>
                  <?php
                    $estado = strtolower($p['estado'] ?? '');
                    $color = '#888';
                    if ($estado === 'pendiente') $color = '#d9534f'; // rojo
                    elseif ($estado === 'aceptado') $color = '#28a745'; // verde
                    elseif ($estado === 'rechazado') $color = '#6c757d'; // gris
                  ?>
                  <span style="font-weight:bold;color:<?= $color ?>;text-transform:capitalize;">
                    <?= htmlspecialchars($p['estado'] ?? '') ?>
                  </span>
                </td>
                <td>
                  <?php if ($usuario_actual && $usuario_actual == $p['id_usuario']): ?>
                    <!-- Solo botón Eliminar -->
                    <form method="POST" action="controllers/PostulacionesController.php" style="display:inline-block;width:auto;">
                      <input type="hidden" name="accion" value="eliminar_postulacion">
                      <input type="hidden" name="id_postulacion" value="<?= htmlspecialchars($p['id_postulacion']) ?>">
                      <button type="submit" class="btn-publicar" style="background:#dc3545;color:#fff;padding:6px 12px;font-size:0.95rem;border-radius:8px;width:auto;">Eliminar</button>
                    </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="alert alert-info">No hay postulaciones registradas.</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>
/* ================ ESTILOS GENERALES ================ */
.servicio-wrapper {
  margin-top: 2rem;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* FORMULARIO / CARDS */
.form-card {
  background: #1a1a1a;
  padding: 1.8rem;
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.6);
  border: 1px solid #333;
  animation: fadeIn 0.5s ease;
}

.form-title {
  color: #fff;
  font-size: 1.3rem;
  margin-bottom: 1.5rem;
  border-left: 3px solid #0d6efd;
  padding-left: 10px;
}

.form-card label {
  color: #ccc;
  font-size: 0.9rem;
  margin-bottom: 5px;
}

.form-card .form-control {
  background: #1c1c1c;
  border: 1px solid #444;
  color: #f5f5f5;
  border-radius: 10px;
  padding: 10px;
}

.form-card .form-control:focus {
  border-color: #0d6efd;
  box-shadow: 0 0 6px rgba(13,110,253,0.6);
}

/* Botón publicar / postular */
.btn-publicar {
  margin-top: 0.5rem;
  width: 100%;
  background: #0d6efd;
  color: #fff;
  font-weight: bold;
  font-size: 1rem;
  border: none;
  padding: 12px;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-publicar:hover {
  background: #0b5ed7;
  transform: translateY(-2px);
}

/* Tabla */
.table {
  width: 100%;
  color: #e0e0e0;
}

.table-dark th,
.table-dark td {
  border-color: #444;
}

.table-dark thead {
  background: #1e1e1e;
}

.table-dark tbody tr:hover {
  background: #2a2a2a;
}

/* Animación */
@keyframes fadeIn {
  from {opacity: 0; transform: translateY(15px);}
  to {opacity: 1; transform: translateY(0);}
}
</style>
