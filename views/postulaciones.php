<div class="row">
  <div class="col-md-5">
    <h4>Postularse</h4>
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'ok'): ?><div class="alert alert-success">Postulación registrada.</div><?php endif; ?>
    <form method="POST" action="controllers/PostulacionesController.php">
      <input type="hidden" name="accion" value="registrar_postulacion">
      <div class="mb-2"><label>ID Aspirante</label><input class="form-control" name="id_usuario" required></div>
      <div class="mb-2"><label>ID Vacante</label><input class="form-control" name="id_vacante" required type="number"></div>
      <div class="mb-2"><label>Fecha</label><input class="form-control" name="fecha" type="date" required></div>
      <button class="btn btn-primary" type="submit">Postular</button>
    </form>
  </div>
  <div class="col-md-7">
    <h4>Información</h4>
    <p>Para listar postulaciones revisa la tabla en phpMyAdmin o crea una vista en la app si la necesitas.</p>
  </div>
</div>