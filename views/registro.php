
<div class="registro-row">
  <div class="registro-logo">
    <img src="img/imagenesjagua360/JAGUA VISION 360 copy 2.jpg" alt="Logo Jagua Vision 360" />
  </div>
  <div class="registro-form">
    <h3>Registro (público)</h3>
    <form method="POST" action="controllers/UsuariosController.php">
      <input type="hidden" name="accion" value="registrar_usuario">
      <div class="mb-2"><label>Cédula / NIT</label><input class="form-control" name="id_usuario" required></div>
      <div class="mb-2"><label>Nombre completo</label><input class="form-control" name="nombre_completo" required></div>
      <div class="mb-2"><label>Correo</label><input type="email" class="form-control" name="correo" required></div>
      <div class="mb-2"><label>Usuario</label><input class="form-control" name="usuario" required></div>
      <div class="mb-2"><label>Contraseña</label><input type="password" class="form-control" name="contrasena" required></div>
      <div class="mb-2"><label>Teléfono</label><input class="form-control" name="telefono" required></div>
      <button class="btn btn-primary" type="submit">Registrarse</button>
    </form>
  </div>
</div>