<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Asegúrate de que el usuario esté autenticado y tenga permisos
if (empty($_SESSION['usuario'])) {
    header('Location: index.php?page=login&error=' . urlencode('Debes iniciar sesión para editar servicios.'));
    exit;
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Servicio.php';
require_once __DIR__ . '/../controllers/ServiciosController.php';

$servicio_a_editar = null;
$error_msg = $_GET['error'] ?? '';
$success_msg = $_GET['msg'] ?? '';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_servicio = $_GET['id'];
    $ctrl = new ServiciosController();
    $servicio_a_editar = $ctrl->obtenerServicioParaEdicion($id_servicio);

    // Verificar si el servicio existe y pertenece al usuario actual (seguridad)
    if (!$servicio_a_editar || $servicio_a_editar['id_usuario'] !== $_SESSION['usuario']['id_usuario']) {
        header('Location: index.php?page=servicios&error=' . urlencode('Servicio no encontrado o no tienes permiso para editarlo.'));
        exit;
    }
} else {
    header('Location: index.php?page=servicios&error=' . urlencode('ID de servicio no especificado para edición.'));
    exit;
}

// Mapa de íconos para las categorías (replica el del archivo servicios.php si es necesario)
$iconos_servicio = [
    'Comercio y Ventas al Detal' => 'https://cdn-icons-png.flaticon.com/512/1170/1170678.png',
    'Gastronomía y Bebidas' => 'https://cdn-icons-png.flaticon.com/512/1046/1046784.png',
    'Servicios de Salud y Bienestar' => 'https://cdn-icons-png.flaticon.com/512/2965/2965567.png',
    'Educación y Formación' => 'https://cdn-icons-png.flaticon.com/512/2984/2984194.png',
    'Transporte y Logística' => 'https://cdn-icons-png.flaticon.com/512/1907/1907109.png',
    'Servicios Técnicos y Profesionales' => 'https://cdn-icons-png.flaticon.com/512/1077/1077035.png',
    'Entretenimiento y Cultura' => 'https://cdn-icons-png.flaticon.com/512/845/845777.png',
    'Turismo y Hospedaje' => 'https://cdn-icons-png.flaticon.com/512/3448/3448573.png',
    'Servicios Financieros y Jurídicos' => 'https://cdn-icons-png.flaticon.com/512/492/492649.png',
    'Medio Ambiente y Sostenibilidad' => 'https://cdn-icons-png.flaticon.com/512/616/616408.png',
    'Agroindustria y Productos Locales' => 'https://cdn-icons-png.flaticon.com/512/3081/3081826.png',
    'Construcción y Obra Civil' => 'https://cdn-icons-png.flaticon.com/512/2940/2940685.png',
    'Belleza y Estética' => 'https://cdn-icons-png.flaticon.com/512/3855/3855675.png',
    'Mantenimiento y Reparaciones' => 'https://cdn-icons-png.flaticon.com/512/2921/2921822.png',
    'Energía y Servicios Públicos' => 'https://cdn-icons-png.flaticon.com/512/3207/3207993.png',
    'default' => 'https://cdn-icons-png.flaticon.com/512/1077/1077035.png'
];
$nombre_servicio_actual = htmlspecialchars($servicio_a_editar['nombre_servicio']);
$icono_url_actual = $iconos_servicio[$nombre_servicio_actual] ?? $iconos_servicio['default'];
?>

<link rel="stylesheet" href="estilos/main-unificado.css"> 
<style>
/* Estilos para edición de servicio igual a editar_vacante.php */
body {
    background: #181818;
    color: #f5f5f5;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.edit-service-wrapper {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 3rem 1rem;
    min-height: calc(100vh - 120px - 100px);
}
.edit-service-card {
    background: #23213a;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.6);
    border: 1px solid #333;
    animation: fadeIn 0.5s ease;
    width: 100%;
    max-width: 500px;
    text-align: center;
}
.edit-service-title {
    color: #fff;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
    border-left: 3px solid #0d6efd;
    padding-left: 10px;
}
.edit-service-card label {
    color: #ccc;
    margin-bottom: 8px;
    font-size: 0.95rem;
    font-weight: 500;
    display: block;
    text-align: left;
}
.edit-service-card .form-control {
    padding: 12px;
    border: 1px solid #444;
    border-radius: 10px;
    background-color: #1c1c1c;
    color: #f5f5f5;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
    margin-bottom: 1.5rem;
}
.edit-service-card .form-control:focus {
    border-color: #0d6efd;
    outline: none;
    box-shadow: 0 0 8px rgba(13,110,253,0.7);
}
.btn-actualizar {
    margin-top: 1.5rem;
    padding: 15px 30px;
    background: #198754;
    border: none;
    border-radius: 12px;
    color: white;
    font-weight: bold;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
}
.btn-actualizar:hover {
    background: #157347;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(40, 167, 69, 0.4);
}
.current-icon-display {
    text-align: center;
    margin-bottom: 2rem;
    padding: 1rem;
    border: 1px dashed #444;
    border-radius: 10px;
    background-color: #222;
}
.current-icon-display img {
    height: 40px;
    width: 40px;
    margin-bottom: 10px;
}
.current-icon-display p {
    color: #f8f9fa;
    margin: 0;
    font-weight: 500;
}
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(15px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<div class="edit-service-wrapper">
    <div class="edit-service-card">
        <h4 class="edit-service-title">Editar Servicio</h4>

        <?php if (!empty($error_msg)): ?>
            <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error_msg) ?></div>
        <?php endif; ?>
        <?php if (!empty($success_msg)): ?>
            <div class="alert alert-success" role="alert"><?= htmlspecialchars($success_msg) ?></div>
        <?php endif; ?>

        <form method="POST" action="controllers/ServiciosController.php">
            <input type="hidden" name="accion" value="actualizar_servicio">
            <input type="hidden" name="id_servicio" value="<?= htmlspecialchars($servicio_a_editar['id_servicio']) ?>">
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($servicio_a_editar['id_usuario']) ?>">

            <div class="mb-4">
                <label for="nombre_servicio">Categoría de servicio</label>
                <div class="current-icon-display">
                    <img src="<?= $icono_url_actual ?>" alt="Ícono de categoría actual">
                    <p><?= $nombre_servicio_actual ?></p>
                </div>
                <select class="form-control" id="nombre_servicio" name="nombre_servicio" required>
                    <?php
                    $categorias = [
                        "Comercio y Ventas al Detal", "Gastronomía y Bebidas", "Servicios de Salud y Bienestar",
                        "Educación y Formación", "Transporte y Logística", "Servicios Técnicos y Profesionales",
                        "Entretenimiento y Cultura", "Turismo y Hospedaje", "Servicios Financieros y Jurídicos",
                        "Medio Ambiente y Sostenibilidad", "Agroindustria y Productos Locales",
                        "Construcción y Obra Civil", "Belleza y Estética", "Mantenimiento y Reparaciones",
                        "Energía y Servicios Públicos"
                    ];
                    foreach ($categorias as $cat) {
                        $selected = ($cat === $servicio_a_editar['nombre_servicio']) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($cat) . '" ' . $selected . '>' . htmlspecialchars($cat) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="descripcion_servicio">Descripción del servicio</label>
                <textarea class="form-control" id="descripcion_servicio" name="descripcion_servicio" rows="4" required><?= htmlspecialchars($servicio_a_editar['descripcion_servicio']) ?></textarea>
            </div>

            <div class="mb-4">
                <label for="precio_servicio">Precio del servicio (USD)</label>
                <input type="number" class="form-control" id="precio_servicio" name="precio_servicio" step="0.01" min="0" value="<?= htmlspecialchars($servicio_a_editar['precio_servicio']) ?>" required>
            </div>

            <div class="mb-4">
                <label for="duracion_servicio">Duración estimada (horas)</label>
                <input type="number" class="form-control" id="duracion_servicio" name="duracion_servicio" step="0.1" min="0" value="<?= htmlspecialchars($servicio_a_editar['duracion_servicio']) ?>" required>
            </div>

            <div class="mb-4">
                <label for="requisitos_servicio">Requisitos del servicio</label>
                <textarea class="form-control" id="requisitos_servicio" name="requisitos_servicio" rows="3"><?= htmlspecialchars($servicio_a_editar['requisitos_servicio']) ?></textarea>
            </div>

            <button type="submit" class="btn-actualizar">Actualizar Servicio</button>
        </form>
    </div>
</div>

<script>
// Script para manejar la lógica adicional si es necesario
</script>