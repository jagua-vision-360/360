
<style>
  .registro-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 32px;
    max-width: 900px;
    margin: 3rem auto;
    padding: 2rem 1rem;
  }
  .registro-logo {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .registro-logo img {
    max-width: 180px;
    width: 100%;
    border-radius: 16px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.10);
  }
  .registro-form {
    flex: 1.2;
    background: linear-gradient(145deg, #e0e0e0, #ffffff);
    padding: 2rem 1.5rem 1rem 1.5rem;
    border-radius: 18px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    border: 1px solid #ccc;
    min-width: 220px;
    max-width: 350px;
  }
  .registro-form h3 {
    color: #333;
    text-align: center;
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
    font-weight: 600;
  }
  .registro-form label {
    color: #555;
    font-size: 0.98rem;
    font-weight: 500;
    margin-bottom: 4px;
    display: block;
  }
  .registro-form .form-control {
    padding: 10px;
    border: 1px solid #bbb;
    border-radius: 8px;
    background-color: #f7f7f7;
    color: #222;
    font-size: 1rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
  }
  .registro-form .form-control:focus {
    border-color: #0d6efd;
    outline: none;
    box-shadow: 0 0 8px rgba(13,110,253,0.12);
  }
  .registro-form button {
    padding: 12px;
    background: linear-gradient(135deg, #0d6efd, #0a58ca);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    font-size: 1.08rem;
    cursor: pointer;
    width: 100%;
    margin-top: 0.5rem;
    transition: all 0.3s ease;
  }
  .registro-form button:hover {
    background: linear-gradient(135deg, #0b5ed7, #094bac);
    transform: translateY(-2px);
  }
  @media (max-width: 900px) {
    .registro-wrapper {
      flex-direction: column;
      gap: 2rem;
      margin: 2rem auto;
    }
    .registro-logo img {
      max-width: 120px;
    }
    .registro-form {
      width: 100%;
      max-width: 98vw;
      margin: 0 auto;
    }
  }
</style>
<div class="registro-wrapper">
  <div class="registro-logo">
    <img src="img/imagenesjagua360/JAGUA VISION 360 copy 2.jpg" alt="Logo Jagua Vision 360" />
  </div>
  <div class="registro-form">
    <h3>Registro de Usuario</h3>
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'ok'): ?>
      <div class="alert alert-success" style="background:#d4edda;color:#155724;padding:10px;border-radius:8px;margin-bottom:1rem;">¡Registro exitoso!</div>
    <?php elseif (isset($_GET['error'])): ?>
      <div class="alert alert-danger" style="background:#f8d7da;color:#721c24;padding:10px;border-radius:8px;margin-bottom:1rem;"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
    <form method="POST" action="controllers/UsuariosController.php" autocomplete="off">
      <input type="hidden" name="accion" value="registrar_usuario">
      <div class="mb-2">
        <label for="id_usuario">Cédula / NIT</label>
        <input class="form-control" id="id_usuario" name="id_usuario" required maxlength="20" pattern="[0-9]+" title="Solo números" placeholder="Ej: 12345678">
      </div>
      <div class="mb-2">
        <label for="nombre_completo">Nombre completo</label>
        <input class="form-control" id="nombre_completo" name="nombre_completo" required maxlength="60" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]{3,}" title="Solo letras y espacios" placeholder="Ej: Juan Pérez">
      </div>
      <div class="mb-2">
        <label for="correo">Correo</label>
        <input type="email" class="form-control" id="correo" name="correo" required maxlength="60" placeholder="Ej: correo@dominio.com">
      </div>
      <div class="mb-2">
        <label for="usuario">Usuario</label>
        <input class="form-control" id="usuario" name="usuario" required maxlength="30" pattern="[A-Za-z0-9_]{4,}" title="Mínimo 4 caracteres, solo letras, números y guion bajo" placeholder="Ej: juanperez">
      </div>
      <div class="mb-2">
        <label for="contrasena">Contraseña</label>
        <input type="password" class="form-control" id="contrasena" name="contrasena" required minlength="6" maxlength="30" placeholder="Mínimo 6 caracteres">
      </div>
      <div class="mb-2">
        <label for="telefono">Teléfono</label>
        <input class="form-control" id="telefono" name="telefono" required maxlength="15" pattern="[0-9]{7,15}" title="Solo números" placeholder="Ej: 3001234567">
      </div>
      <button type="submit">Registrarse</button>
    </form>
  </div>
</div>