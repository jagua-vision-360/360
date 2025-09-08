<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="row servicio-wrapper">
  <div class="col-md-8 offset-md-2 mb-4">
    <div class="form-card">
      <h3 class="form-title">Mi perfil</h3>

      <?php if (empty($_SESSION['usuario'])): ?>
        <div class="alert alert-warning">Debes iniciar sesión para ver tu perfil.</div>
      <?php else: ?>
        <table class="table table-dark table-striped mt-3">
          <tr><th>Cédula</th><td><?= htmlspecialchars($_SESSION['usuario']['id_usuario']) ?></td></tr>
          <tr><th>Nombre</th><td><?= htmlspecialchars($_SESSION['usuario']['nombre_completo']) ?></td></tr>
          <tr><th>Correo</th><td><?= htmlspecialchars($_SESSION['usuario']['correo']) ?></td></tr>
          <tr><th>Tipo</th><td><?= htmlspecialchars($_SESSION['usuario']['tipo_usuario']) ?></td></tr>
          <tr><th>Teléfono</th><td><?= htmlspecialchars($_SESSION['usuario']['telefono']) ?></td></tr>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>
/* ================ ESTILO GENERAL ================= */
.servicio-wrapper {
  margin-top: 2rem;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* FORMULARIO Y TARJETA */
.form-card {
  background: #1a1a1a;
  padding: 2rem;
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.6);
  border: 1px solid #333;
  animation: fadeIn 0.5s ease;
}

.form-title {
  color: #fff;
  font-size: 1.5rem;
  margin-bottom: 1.5rem;
  border-left: 3px solid #0d6efd;
  padding-left: 10px;
}

/* TABLA PERFIL */
.table-dark {
  background: #1e1e1e;
  color: #e0e0e0;
  border-radius: 10px;
  overflow: hidden;
}

.table th {
  color: #0d6efd;
  font-weight: bold;
  width: 30%;
}

.table td {
  color: #ccc;
}

/* ALERTAS */
.alert-warning {
  background: #ff9800;
  color: #fff;
  border-radius: 10px;
  padding: 10px;
  margin-bottom: 1rem;
}

/* Animación */
@keyframes fadeIn {
  from {opacity: 0; transform: translateY(15px);}
  to {opacity: 1; transform: translateY(0);}
}
</style>
