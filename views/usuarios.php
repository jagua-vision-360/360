<div class="registro-wrapper">
  <div class="registro-card">
    <div class="registro-header">
      <!-- Aquí va tu logo -->
      <div class="logo-placeholder">[JV360]</div>
      <h2>Registrar Usuario</h2>
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
.registro-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 3rem auto;
  padding: 1rem;
}

.registro-card {
  max-width: 700px;
  width: 100%;
  background: #1a1a1a;
  padding: 2rem;
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.6);
  border: 1px solid #333;
}

.registro-header {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 2rem;
  gap: 1rem;
}

.registro-header h2 {
  color: #fff;
  font-size: 1.6rem;
  border-left: 2px solid #0d6efd;
  padding-left: 1rem;
}

.logo-placeholder {
  width: 60px;
  height: 60px;
  background: #333;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #888;
  font-size: 0.7rem;
  border: 1px solid #444;
}

.registro-card form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
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
  color: #ccc;
  margin-bottom: 5px;
  font-size: 0.9rem;
}

.registro-card input,
.registro-card select {
  padding: 10px;
  border: 1px solid #444;
  border-radius: 8px;
  background-color: #262626;
  color: #f0f0f0;
  font-size: 0.95rem;
  transition: all 0.3s ease;
}

.registro-card input:focus,
.registro-card select:focus {
  border-color: #0d6efd;
  outline: none;
  box-shadow: 0 0 6px rgba(13,110,253,0.6);
}

.registro-card button {
  margin-top: 1rem;
  padding: 12px;
  background: #0d6efd;
  border: none;
  border-radius: 10px;
  color: white;
  font-weight: bold;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.3s ease, transform 0.2s;
}

.registro-card button:hover {
  background: #0b5ed7;
  transform: scale(1.02);
}
</style>
