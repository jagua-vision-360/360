<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="estilos/main-unificado.css">

<div class="perfil-wrapper">
  <div class="perfil-card">
    <div class="perfil-title">Mi perfil</div>

    <?php if (empty($_SESSION['usuario'])): ?>
      <div class="alert alert-warning">Debes iniciar sesión para ver tu perfil.</div>
    <?php else: ?>
    
    <div class="perfil-foto">
      <img src="<?php echo !empty($_SESSION['usuario']['foto_perfil']) 
        ? 'public/img/' . htmlspecialchars($_SESSION['usuario']['foto_perfil']) 
        : 'public/img/logo.png'; ?>" alt="Foto de perfil">
    </div>

    <form method="POST" action="controllers/UsuariosController.php" enctype="multipart/form-data">
      <input type="hidden" name="accion" value="actualizar_foto">
      <input type="file" name="foto_perfil" accept="image/*" required>
      <button type="submit">Actualizar foto</button>
    </form>

    <table class="perfil-table">
      <tr><th>Cédula</th><td><?= htmlspecialchars($_SESSION['usuario']['id_usuario']) ?></td></tr>
      <tr><th>Nombre</th><td><?= htmlspecialchars($_SESSION['usuario']['nombre_completo']) ?></td></tr>
      <tr><th>Correo</th><td><?= htmlspecialchars($_SESSION['usuario']['correo']) ?></td></tr>
      <tr><th>Usuario</th><td><?= htmlspecialchars($_SESSION['usuario']['usuario']) ?></td></tr>
      <tr><th>Tipo</th><td><?= htmlspecialchars($_SESSION['usuario']['tipo_usuario']) ?></td></tr>
      <tr><th>Teléfono</th><td><?= htmlspecialchars($_SESSION['usuario']['telefono']) ?></td></tr>
      <tr><th>Razón social</th><td><?= htmlspecialchars($_SESSION['usuario']['razon_social'] ?? '') ?></td></tr>
      <tr><th>Dirección</th><td><?= htmlspecialchars($_SESSION['usuario']['direccion'] ?? '') ?></td></tr>
      <tr><th>Permisos</th><td><?= htmlspecialchars($_SESSION['usuario']['permisos'] ?? '') ?></td></tr>
    </table>
    <?php endif; ?>
  </div>
</div>