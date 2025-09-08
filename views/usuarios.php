<div class="registro-wrapper">
  <div class="registro-card">
    <div class="registro-header">
      <!-- Aquí va tu logo -->
          <h2>Registro de Usuario</h2>
    </div>

    <form method="POST" action="controllers/UsuariosController.php">
      <input type="hidden" name="accion" value="registrar_usuario">

      <div class="form-row">
        <div class="form-group">
          <label>Cédula/NIT</label>
          <input type="text" name="id_usuario" required>
        </div>

        <div class="form-group">
          <label>Nombre completo / Razón social</label>
          <input type="text" name="nombre_completo" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Correo</label>
          <input type="email" name="correo" required>
        </div>

        <div class="form-group">
          <label>Usuario</label>
          <input type="text" name="usuario" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Contraseña</label>
          <input type="password" name="contrasena" required>
        </div>

        <div class="form-group">
          <label>Tipo</label>
          <select name="tipo_usuario" required>
            <option value="">Selecciona...</option>
            <option value="persona_natural">Persona natural</option>
            <option value="empresa">Empresa</option>
            <option value="aspirante">Aspirante</option>
            <option value="administrador">Administrador</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Teléfono</label>
          <input type="text" name="telefono" required>
        </div>

        <div class="form-group">
          <label>Razón social</label>
          <input type="text" name="razon_social">
        </div>
      </div>

      <div class="form-group">
        <label>Dirección</label>
        <input type="text" name="direccion">
      </div>

      <button type="submit">Registrar</button>
    </form>
  </div>
</div>

<style>
/* ========================
   FORMULARIO REGISTRO
======================== */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #121212;
  margin: 0;
  padding: 0;
}

.registro-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 3rem 1rem;
}

.registro-card {
  max-width: 720px;
  width: 100%;
  background: linear-gradient(145deg, #1e1e1e, #2a2a2a);
  padding: 2.5rem;
  border-radius: 18px;
  box-shadow: 0 8px 30px rgba(0,0,0,0.8);
  border: 1px solid #2f2f2f;
  animation: fadeIn 0.6s ease;
}

.registro-header {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 2.2rem;
  gap: 1rem;
}

.registro-header h2 {
  color: #ffffff;
  font-size: 1.8rem;
  font-weight: 600;
  border-left: 
  padding-left: 1rem;
}

.registro-logo {
  width: 65px;
  height: 65px;
  object-fit: contain;
  border-radius: 50%;
  background: #2d2d2d;
  padding: 6px;
  border: 1px solid #444;
}

.registro-card form {
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
}

.form-row {
  display: flex;
  gap: 1rem;
}

.form-group {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.registro-card label {
  color: #bbb;
  margin-bottom: 6px;
  font-size: 0.92rem;
  font-weight: 500;
}

.registro-card input,
.registro-card select {
  padding: 12px;
  border: 1px solid #444;
  border-radius: 10px;
  background-color: #1c1c1c;
  color: #f5f5f5;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.registro-card input:focus,
.registro-card select:focus {
  border-color: #0d6efd;
  outline: none;
  box-shadow: 0 0 8px rgba(13,110,253,0.7);
}

.registro-card button {
  margin-top: 1.2rem;
  padding: 14px;
  background: linear-gradient(135deg, #0d6efd, #0a58ca);
  border: none;
  border-radius: 12px;
  color: white;
  font-weight: bold;
  font-size: 1.05rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.registro-card button:hover {
  background: linear-gradient(135deg, #0b5ed7, #094bac);
  transform: translateY(-2px);
}

@keyframes fadeIn {
  from {opacity: 0; transform: translateY(15px);}
  to {opacity: 1; transform: translateY(0);}
}

/* Responsive */
@media (max-width: 600px) {
  .form-row {
    flex-direction: column;
  }
  .registro-header {
    flex-direction: column;
  }
}
</style>
