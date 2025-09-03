<div class="col-md-8 offset-md-2">
  <h3>Mi perfil</h3>
  <?php if (empty($_SESSION['usuario'])): ?>
    <div class="alert alert-warning">Debes iniciar sesión para ver tu perfil.</div>
  <?php else: ?>
    <table class="table">
      <tr><th>Cédula</th><td><?= htmlspecialchars($_SESSION['usuario']['id_usuario']) ?></td></tr>
      <tr><th>Nombre</th><td><?= htmlspecialchars($_SESSION['usuario']['nombre_completo']) ?></td></tr>
      <tr><th>Correo</th><td><?= htmlspecialchars($_SESSION['usuario']['correo']) ?></td></tr>
      <tr><th>Tipo</th><td><?= htmlspecialchars($_SESSION['usuario']['tipo_usuario']) ?></td></tr>
      <tr><th>Teléfono</th><td><?= htmlspecialchars($_SESSION['usuario']['telefono']) ?></td></tr>
    </table>
  <?php endif; ?>
</div>