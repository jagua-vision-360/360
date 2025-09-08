<div class="row servicio-wrapper">
  <!-- Formulario Vacantes -->
  <div class="col-md-4 mb-4">
    <div class="form-card">
      <h4 class="form-title">Publicar vacante</h4>
      <form method="POST" action="controllers/VacantesController.php">
        <input type="hidden" name="accion" value="registrar_vacante">

        <div class="mb-5">
          <label>ID Usuario</label>
          <input class="form-control" name="id_usuario" required>
        </div>

        <div class="mb-5">
          <label>Título</label>
          <input class="form-control" name="titulo" required>
        </div>

        <div class="mb-5">
          <label>Descripción</label>
          <textarea class="form-control" name="descripcion" rows="3"></textarea>
        </div>

        <div class="mb-5">
          <label>Salario</label>
          <input class="form-control" name="salario" type="number" step="0.01" placeholder="Ej: 1500000">
        </div>

        <button class="btn-publicar" type="submit">+ Publicar</button>
      </form>
    </div>
  </div>

  <!-- Vacantes publicadas -->
  <div class="col-md-8">
    <h4 class="list-title">Vacantes disponibles</h4>
    <?php if (!empty($vacantes)): ?>
      <div class="row">
        <?php foreach ($vacantes as $v): ?>
          <div class="col-md-4 mb-4">
            <div class="card servicio-card h-100">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($v['titulo']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($v['descripcion']) ?></p>
                <p class="precio"><strong>$<?= number_format($v['salario'] ?? 0, 0, ',', '.') ?></strong></p>
                <p class="publicado">
                  <small>Publicado por: <?= htmlspecialchars($v['nombre_completo'] ?? $v['id_usuario']) ?></small>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-dark">No hay vacantes publicadas aún.</div>
    <?php endif; ?>
  </div>
</div>

<style>
/* ================ ESTILOS GENERALES ================ */
.servicio-wrapper {
  margin-top: 2rem;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* FORMULARIO */
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

/* Botón publicar */
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

/* LISTADO VACANTES */
.list-title {
  color: #000000ff;
  margin-bottom: 1rem;
  font-size: 1.4rem;
}

.servicio-card {
  border: none;
  border-radius: 15px;
  background: #1e1e1e;
  color: #e0e0e0;
  box-shadow: 0 6px 18px rgba(0,0,0,0.5);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.servicio-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.7);
}

.servicio-card .card-title {
  font-size: 1.2rem;
  color: #0d6efd;
  margin-bottom: 0.8rem;
}

.servicio-card .card-text {
  font-size: 0.95rem;
  margin-bottom: 0.6rem;
}

.servicio-card .precio {
  color: #0d6efd;
  font-weight: bold;
  font-size: 1.05rem;
  margin-bottom: 0.3rem;
}

.servicio-card .publicado {
  color: #bbb;
  font-size: 0.85rem;
}

/* Animación */
@keyframes fadeIn {
  from {opacity: 0; transform: translateY(15px);}
  to {opacity: 1; transform: translateY(0);}
}
</style>
