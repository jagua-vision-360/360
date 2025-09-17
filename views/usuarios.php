
<div class="registro-wrapper">
  <div class="registro-card">
    <div class="registro-header">
      <h2>Registro de Usuario</h2>
    </div>

    <form method="POST" 
          action="controllers/UsuariosController.php"
          enctype="multipart/form-data">
          
      <input type="hidden" name="accion" value="registrar_usuario">

      <div class="form-group">
        <label>Foto de perfil</label>
        <input type="file" name="foto" accept="image/*">
      </div>

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
      </div>

      <button type="submit">Registrar</button>
    </form>
  </div>
</div>

<style>
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
  background: linear-gradient(145deg, #e0e0e0, #ffffff);
  padding: 2.2rem;
  border-radius: 18px;
  box-shadow: 0 8px 30px rgba(0,0,0,0.08);
  border: 1px solid #ccc;
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
  color: #222;
  font-size: 1.7rem;
  font-weight: 700;
  border-left: 4px solid #0d6efd;
  padding-left: 1rem;
  background: none;
  border-radius: 0;
  margin-bottom: 0.5rem;
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
  color: #555;
  margin-bottom: 6px;
  font-size: 0.98rem;
  font-weight: 500;
}
.registro-card input,
.registro-card select {
  padding: 10px;
  border: 1px solid #bbb;
  border-radius: 8px;
  background-color: #f7f7f7;
  color: #222;
  font-size: 1rem;
  margin-bottom: 1rem;
  transition: all 0.3s ease;
}
.registro-card input:focus,
.registro-card select:focus {
  border-color: #0d6efd;
  outline: none;
  box-shadow: 0 0 8px rgba(13,110,253,0.12);
}
.registro-card button {
  margin-top: 1.2rem;
  padding: 12px;
  background: linear-gradient(135deg, #0d6efd, #0a58ca);
  border: none;
  border-radius: 10px;
  color: white;
  font-weight: bold;
  font-size: 1.08rem;
  cursor: pointer;
  width: 100%;
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
@media (max-width: 600px) {
  .form-row {
    flex-direction: column;
  }
  .registro-header {
    flex-direction: column;
  }
}
</style>
