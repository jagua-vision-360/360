<?php
// 1. Incluye el controlador para poder acceder a sus métodos
require_once 'controllers/VacantesController.php';

// 2. Llama al método del controlador para obtener todas las vacantes
$ctrl = new VacantesController();
$vacantes = $ctrl->obtenerTodas();

// Array con los iconos para cada categoría
$iconos_vacante = [
    'Tecnología' => 'https://cdn-icons-png.flaticon.com/512/1055/1055666.png',
    'Marketing' => 'https://cdn-icons-png.flaticon.com/512/1150/1150614.png',
    'Finanzas' => 'https://cdn-icons-png.flaticon.com/512/1077/1077035.png',
    'Salud' => 'https://cdn-icons-png.flaticon.com/512/2965/2965567.png',
    'Educación' => 'https://cdn-icons-png.flaticon.com/512/2984/2984194.png',
    'Construcción' => 'https://cdn-icons-png.flaticon.com/512/2940/2940685.png',
    'default' => 'https://cdn-icons-png.flaticon.com/512/1159/1159842.png'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacantes</title>
    <style>
        /* ========================
           ESTILOS GENERALES
        ======================== */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #121212;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        /* ========================
           MÓDULO DE VACANTES
        ======================== */
        .vacante-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1rem;
        }

        .col-md-4 {
            flex-basis: 32%;
            max-width: 32%;
        }

        .col-md-3 {
            flex-basis: 66%;
            max-width: 66%;
        }

        .list-title {
            color: #f5f5f5;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        /* ========================
           ESTILOS DEL FORMULARIO DE VACANTES
        ======================== */
        .form-card {
            background: linear-gradient(145deg, #1e1e1e, #2a2a2a);
            padding: 2.5rem;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.8);
            border: 1px solid #2f2f2f;
            animation: fadeIn 0.6s ease;
        }

        .form-title {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2.2rem;
            text-align: center;
        }

        .form-card label {
            color: #bbb;
            margin-bottom: 6px;
            font-size: 0.92rem;
            font-weight: 500;
        }

        .form-card input.form-control,
        .form-card select.form-control,
        .form-card textarea.form-control {
            padding: 12px;
            border: 1px solid #444;
            border-radius: 10px;
            background-color: #1c1c1c;
            color: #f5f5f5;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-card input:focus,
        .form-card select:focus,
        .form-card textarea:focus {
            border-color: #0d6efd;
            outline: none;
            box-shadow: 0 0 8px rgba(13,110,253,0.7);
        }

        .btn-publicar {
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

        .btn-publicar:hover {
            background: linear-gradient(135deg, #0b5ed7, #094bac);
            transform: translateY(-2px);
        }

        .alert-dark {
            background-color: #2a2a2a;
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid #444;
        }

        /* ========================
           ESTILOS DE LAS TARJETAS (SERVICIO)
        ======================== */
        .tarjetas-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-start;
        }

        .tarjeta {
            flex: 0 0 calc(20% - 8px);
            max-width: calc(20% - 8px);
            background: linear-gradient(145deg, #e0e0e0, #ffffff);
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .tarjeta:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .tarjeta img {
            width: 25px;
            height: 25px;
            margin-bottom: 8px;
            filter: none;
            transition: filter 0.3s ease-in-out;
        }

        .tarjeta:hover img {
            filter: none;
        }

        .tarjeta .card-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .tarjeta .salario {
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 5px;
        }

        .tarjeta .sub-info {
            font-size: 12px;
            color: #777;
            margin-bottom: 5px;
        }

        .tarjeta .publicado {
            font-size: 11px;
            color: #777;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .vacante-wrapper {
                flex-direction: column;
            }

            .col-md-4, .col-md-3 {
                flex-basis: 100%;
                max-width: 100%;
            }
            
            .tarjeta-vacante {
                flex-basis: calc(50% - 5px);
                max-width: calc(50% - 5px);
            }
        }

        @media (max-width: 480px) {
            .tarjeta-vacante {
                flex-basis: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="row vacante-wrapper">
    <div class="col-md-4 mb-4">
        <div class="form-card">
            <h4 class="form-title"><span style="vertical-align:middle; margin-right:8px;">📝</span>Publicar vacante</h4>
            <form method="POST" action="controllers/VacantesController.php">
                <input type="hidden" name="accion" value="registrar_vacante">

                <div class="mb-3">
                    <label>ID Usuario <span title="Identificador del usuario que publica" style="color:#0d6efd;cursor:help;">&#9432;</span></label>
                    <input class="form-control" name="id_usuario" required maxlength="20" placeholder="Ej: 12345678">
                </div>

                <div class="mb-3">
                    <label>Título del Puesto <span style="color:#0d6efd;">&#128188;</span></label>
                    <input class="form-control" name="titulo" required maxlength="60" placeholder="Ej: Desarrollador Web">
                </div>

                <div class="mb-3">
                    <label>Empresa <span style="color:#0d6efd;">&#127970;</span></label>
                    <input class="form-control" name="empresa" required maxlength="60" placeholder="Ej: Tech Solutions Inc.">
                </div>

                <div class="mb-3">
                    <label>Ubicación <span style="color:#0d6efd;">&#128205;</span></label>
                    <input class="form-control" name="ubicacion" required maxlength="60" placeholder="Ej: Bogotá, Colombia">
                </div>

                <div class="mb-3">
                    <label>Categoría <span style="color:#0d6efd;">&#128200;</span></label>
                    <select class="form-control" name="categoria" required>
                        <option value="">Seleccione una categoría...</option>
                        <option value="Tecnología">Tecnología</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Finanzas">Finanzas</option>
                        <option value="Salud">Salud</option>
                        <option value="Educación">Educación</option>
                        <option value="Construcción">Construcción</option>
                        <option value="Manufactura">Manufactura</option>
                        <option value="Servicios al Cliente">Servicios al Cliente</option>
                        <option value="Recursos Humanos">Recursos Humanos</option>
                        <option value="Legal">Legal</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Salario <span style="color:#0d6efd;">&#128181;</span></label>
                    <input class="form-control" name="salario" required maxlength="30" placeholder="Ej: $1.500.000 COP">
                </div>

                <div class="mb-3">
                    <label>Descripción <span style="color:#0d6efd;">&#128221;</span></label>
                    <textarea class="form-control" name="descripcion" rows="3" required maxlength="300" placeholder="Describe la vacante..."></textarea>
                </div>

                <button type="submit" class="btn-publicar"><span style="vertical-align:middle; margin-right:6px;">&#128640;</span>Publicar Vacante</button>
            </form>
        </div>
</div>

<div class="col-md-3">
    <h3 class="list-title">Vacantes disponibles</h3>
    <div class="tarjetas-container">
        <?php foreach ($vacantes as $vac): 
            $icono_url = $iconos_vacante[$vac['categoria']] ?? $iconos_vacante['default'];
        ?>
            <div class="tarjeta">
                <img src="<?= $icono_url ?>" alt="<?= htmlspecialchars($vac['categoria']) ?>">
                <div class="card-title"><?= htmlspecialchars($vac['titulo']) ?></div>
                <div class="sub-info">ID: <strong style="color:#0d6efd;"><?= htmlspecialchars($vac['id_vacante'] ?? $vac['id'] ?? '') ?></strong></div>
                <div class="sub-info"><?= htmlspecialchars($vac['empresa']) ?> - <?= htmlspecialchars($vac['ubicacion']) ?></div>
                <div class="salario"><?= htmlspecialchars($vac['salario']) ?></div>
                <div class="sub-info"><?= htmlspecialchars($vac['nombre_completo'] ?? 'Usuario') ?></div>
                <div class="publicado"><?= date('d/m/Y', strtotime($vac['fecha_creacion'] ?? date('Y-m-d'))) ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>

</body>
</html>
