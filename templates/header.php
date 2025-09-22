<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Jagua360 - La visión de La Jagua de Ibirico</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="public/css/main.css" /> 
  
  <style>
    /* VARIABLES DE COLOR */
    :root {
      --primary-color: #0d6efd;
      --secondary-color: #0a58ca;
      --bg-dark: #1e1e1e;
      --text-light: #f8f9fa;
      --text-secondary: #adb5bd;
    }
    
    /* ESTILOS GENERALES DEL HEADER */
    .navbar {
      background-color: var(--bg-dark) !important;
      transition: background-color 0.3s ease-in-out;
      padding: 0.75rem 1rem;
    }
    .navbar-brand {
      display: flex;
      align-items: center;
      font-weight: 700;
      color: var(--text-light);
    }
    .navbar-brand img {
      height: 45px;
      width: 45px;
      border-radius: 50%;
      margin-right: 15px;
      box-shadow: 0 0 10px rgba(13,110,253,0.3);
    }
    .nav-link {
      color: var(--text-secondary) !important;
      font-weight: 500;
      transition: color 0.3s ease;
      padding: 0.5rem 1rem !important;
    }
    .nav-link:hover {
      color: var(--primary-color) !important;
    }

    /* ESTILO DE BOTONES Y CAMPOS */
    .btn-primary-custom {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      color: white;
      font-weight: bold;
      transition: all 0.3s ease;
      padding: 0.5rem 1.5rem;
      border-radius: 50px;
    }
    .btn-primary-custom:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(13,110,253,0.3);
    }
    
    /* ESTILOS DEL BUSCADOR */
    .search-bar .input-group .form-control {
      border-radius: 50px 0 0 50px !important;
      padding: 0.5rem 1.5rem;
      background-color: #333;
      border: 1px solid #444;
      color: white;
      transition: all 0.3s ease;
      border-right: none;
    }
    .search-bar .input-group .form-control:focus {
      background-color: #2b2b2b;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.25);
    }
    .search-bar .input-group .input-group-text {
      border-radius: 0 50px 50px 0 !important;
      background-color: #333;
      color: var(--text-secondary);
      border: 1px solid #444;
      border-left: none;
      padding: 0.5rem 1rem;
    }
    .search-bar {
      width: 100%;
      max-width: 450px; /* Ancho del buscador */
    }
    
    @media (max-width: 991.98px) {
      .search-bar {
        max-width: 100%;
        margin-top: 1rem;
        margin-bottom: 1rem;
      }
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?page=home">
      <img src="img/imagenesjagua360/JAGUA VISION 360.jpg" alt="Logo Jagua Visión 360"/>
      <span class="d-none d-md-block">Jagua Visión 360</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav" aria-controls="menuNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php?page=home">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=usuarios">Registro</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=servicios">Servicios</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=vacantes">Vacantes</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=postulaciones">Postulaciones</a></li>
      </ul>
      
      <form class="search-bar d-flex me-lg-3" role="search" action="index.php" method="GET">
        <input type="hidden" name="page" value="resultados_busqueda">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar..." aria-label="Search" name="query">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
      </form>
      
      <ul class="navbar-nav">
        <?php if (!empty($_SESSION['usuario'])): ?>
          <li class="nav-item">
            <a class="nav-link btn btn-primary-custom" href="index.php?page=perfil">
              <i class="bi bi-person-circle me-2"></i>Mi perfil
            </a>
          </li>
          <li class="nav-item ms-2">
            <a class="nav-link btn btn-danger text-white" href="index.php?action=logout">
              <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
            </a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link btn btn-primary-custom" href="index.php?page=login">
              <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar sesión
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<main class="container my-4">