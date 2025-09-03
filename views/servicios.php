<div class="row">
  <div class="col-md-4">
    <h4>Publicar servicio</h4>
    <form method="POST" action="controllers/ServiciosController.php">
      <input type="hidden" name="accion" value="registrar_servicio">
      <div class="mb-2"><label>ID Usuario</label><input class="form-control" name="id_usuario" required></div>
      <div class="mb-2"><label>Nombre servicio</label><input class="form-control" name="nombre_servicio" required></div>
      <div class="mb-2"><label>Descripción</label><textarea class="form-control" name="descripcion"></textarea></div>
      <div class="mb-2"><label>Precio</label><input class="form-control" name="precio" type="number" step="0.01"></div>
      <button class="btn btn-success" type="submit">Publicar</button>
    </form>
  </div>
  <div class="col-md-8">
    <h4>Servicios publicados</h4>
    <?php if (!empty($servicios)): ?>
      <div class="row">
        <?php foreach ($servicios as $s): ?>
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($s['nombre_servicio']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($s['descripcion']) ?></p>
                <p class="card-text"><strong>Precio:</strong> $<?= number_format($s['precio'] ?? 0, 0, ',', '.') ?></p>
                <p class="card-text"><small>Publicado por: <?= htmlspecialchars($s['nombre_completo'] ?? $s['id_usuario']) ?></small></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info">No hay servicios publicados aún.</div>
    <?php endif; ?>
  </div>
</div>