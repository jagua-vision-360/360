<div class="row">
  <div class="col-md-6">
    <h3>Registrar Usuario</h3>
    <?php if (isset($_GET['error'])): ?><div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div><?php endif; ?>
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'registrado'): ?><div class="alert alert-success">Usuario registrado correctamente.</div><?php endif; ?>
    <form method="POST" action="controllers/UsuariosController.php">
      <input type="hidden" name="accion" value="registrar_usuario">
      <div class="mb-2"><label>Cédula/NIT</label><input class="form-control" name="id_usuario" required></div>
      <div class="mb-2"><label>Nombre completo / Razón social</label><input class="form-control" name="nombre_completo" required></div>
      <div class="mb-2"><label>Correo</label><input type="email" class="form-control" name="correo" required></div>
      <div class="mb-2"><label>Usuario</label><input class="form-control" name="usuario" required></div>
      <div class="mb-2"><label>Contraseña</label><input type="password" class="form-control" name="contrasena" required></div>
      <div class="mb-2"><label>Tipo</label>
        <select class="form-control" name="tipo_usuario" required>
          <option value="persona_natural">Persona natural</option>
          <option value="empresa">Empresa</option>
          <option value="aspirante">Aspirante</option>
          <option value="administrador">Administrador</option>
        </select>
      </div>
      <div class="mb-2"><label>Teléfono</label><input class="form-control" name="telefono" required></div>
      <div class="mb-2"><label>Razón social</label><input class="form-control" name="razon_social"></div>
      <div class="mb-2"><label>Dirección</label><input class="form-control" name="direccion"></div>
      <div class="mb-2"><label>Hoja de vida</label><textarea class="form-control" name="hoja_vida"></textarea></div>
      <div class="mb-2"><label>Experiencia</label><textarea class="form-control" name="experiencia"></textarea></div>
      <button class="btn btn-success" type="submit">Registrar</button>
    </form>
  </div>
