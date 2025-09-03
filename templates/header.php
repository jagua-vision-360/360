<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Jagua360</title>
  <link rel="stylesheet" href="public/css/main.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Jagua 360</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php?page=home">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=usuarios">Usuarios</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=servicios">Servicios</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=vacantes">Vacantes</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=postulaciones">Postulaciones</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if (!empty($_SESSION['usuario'])): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?page=perfil">Mi perfil (<?= htmlspecialchars($_SESSION['usuario']['nombre_completo']) ?>)</a></li>
          <li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="index.php?action=logout">Cerrar sesión</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="index.php?page=login">Iniciar sesión</a></li>
          <li class="nav-item"><a class="nav-link btn btn-success text-white ms-2" href="index.php?page=registro">Registrarse</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<main class="container my-4">