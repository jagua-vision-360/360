<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="row servicio-wrapper">
  <div class="col-md-4 offset-md-4 mb-4">
    <div class="form-card">
      <h3 class="form-title">Iniciar sesión</h3>
      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Usuario o contraseña incorrectos</div>
      <?php endif; ?>
      <form method="POST" action="controllers/UsuariosController.php">
        <input type="hidden" name="accion" value="login_usuario">

        <div class="mb-5">
          <label>Usuario</label>
          <input class="form-control" name="usuario" required>
        </div>

        <div class="mb-5">
          <label>Contraseña</label>
          <input type="password" class="form-control" name="contrasena" required>
        </div>

        <button class="btn-publicar" type="submit">Entrar</button>
      </form>
    </div>
  </div>
</div>

<style>
.servicio-wrapper {
  margin-top: 2rem;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

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

@keyframes fadeIn {
  from {opacity: 0; transform: translateY(15px);}
  to {opacity: 1; transform: translateY(0);}
}
</style>
