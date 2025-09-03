<div class="row">
  <div class="col-md-4">
    <h4>Publicar vacante</h4>
    <form method="POST" action="controllers/VacantesController.php">
      <input type="hidden" name="accion" value="registrar_vacante">
      <div class="mb-2"><label>ID Usuario</label><input class="form-control" name="id_usuario" required></div>
      <div class="mb-2"><label>Título</label><input class="form-control" name="titulo" required></div>
      <div class="mb-2"><label>Descripción</label><textarea class="form-control" name="descripcion"></textarea></div>
      <div class="mb-2"><label>Salario</label><input class="form-control" name="salario" type="number" step="0.01"></div>
      <button class="btn btn-success" type="submit">Publicar vacante</button>
    </form>
  </div>
  <div class="col-md-8">
    <h4>Vacantes disponibles</h4>
    <?php if (!empty($vacantes)): ?>
      <div class="row">
        <?php foreach ($vacantes as $v): ?>
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($v['titulo']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($v['descripcion']) ?></p>
                <p class="card-text"><strong>Salario:</strong> $<?= number_format($v['salario'] ?? 0, 0, ',', '.') ?></p>
                <p class="card-text"><small>Publicado por: <?= htmlspecialchars($v['nombre_completo'] ?? $v['id_usuario']) ?></small></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info">No hay vacantes publicadas aún.</div>
    <?php endif; ?>
  </div>
</div>