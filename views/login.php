<div class="col-md-4 offset-md-4">
  <h3>Iniciar sesión</h3>
  <?php if (isset($_GET['error'])): ?><div class="alert alert-danger">Usuario o contraseña incorrectos</div><?php endif; ?>
  <form method="POST" action="controllers/UsuariosController.php">
    <input type="hidden" name="accion" value="login_usuario">
    <div class="mb-2"><label>Usuario</label><input class="form-control" name="usuario" required></div>
    <div class="mb-2"><label>Contraseña</label><input type="password" class="form-control" name="contrasena" required></div>
    <button class="btn btn-primary" type="submit">Entrar</button>
  </form>
</div>