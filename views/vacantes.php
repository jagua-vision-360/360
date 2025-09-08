<?php
// Este es un ejemplo de cómo podrías obtener tus datos de vacantes desde una base de datos.
// Reemplaza esto con tu propia lógica de base de datos.
$vacantes = [
    [
        'titulo' => 'Desarrollador Web',
        'empresa' => 'Tech Solutions Inc.',
        'ubicacion' => 'Bogotá',
        'salario' => '$2.500.000',
        'categoria' => 'Tecnología',
        'nombre_completo' => 'Carlos López'
    ],
    [
        'titulo' => 'Analista de Marketing Digital',
        'empresa' => 'Creative Hub',
        'ubicacion' => 'Medellín',
        'salario' => '$1.800.000',
        'categoria' => 'Marketing',
        'nombre_completo' => 'Ana Torres'
    ],
    [
        'titulo' => 'Contador Junior',
        'empresa' => 'Finance Partners',
        'ubicacion' => 'Cali',
        'salario' => '$1.200.000',
        'categoria' => 'Finanzas',
        'nombre_completo' => 'Juan Pérez'
    ],
    [
        'titulo' => 'Enfermero/a',
        'empresa' => 'Hospital Central',
        'ubicacion' => 'Barranquilla',
        'salario' => '$2.000.000',
        'categoria' => 'Salud',
        'nombre_completo' => 'Marta García'
    ],
    [
        'titulo' => 'Maestro de Primaria',
        'empresa' => 'Colegio Santa Clara',
        'ubicacion' => 'Bogotá',
        'salario' => '$1.700.000',
        'categoria' => 'Educación',
        'nombre_completo' => 'Ricardo Morales'
    ],
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
            color: #000000ff;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        /* ========================
           ESTILOS DEL FORMULARIO DE VACANTES leonela
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
           ESTILOS DE LAS TARJETAS DE VACANTES
        ======================== */
        .tarjetas-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-start;
        }

        .tarjeta-vacante {
            flex: 0 0 calc(20% - 8px);
            max-width: calc(20% - 8px);
            background: linear-gradient(145deg, #1e1e1e, #2a2a2a);
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #2f2f2f;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .tarjeta-vacante:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.6);
        }

        .tarjeta-vacante img {
            width: 25px;
            height: 25px;
            margin-bottom: 8px;
            filter: brightness(0.8) grayscale(100%);
            transition: filter 0.3s ease-in-out;
        }

        .tarjeta-vacante:hover img {
            filter: grayscale(0%) brightness(1);
        }

        .tarjeta-vacante .card-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #ffffff;
        }

        .tarjeta-vacante .sub-info {
            font-size: 12px;
            color: #bbb;
            margin-bottom: 5px;
        }

        .tarjeta-vacante .salario {
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 5px;
        }

        .tarjeta-vacante .publicado {
            font-size: 11px;
            color: #888;
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
            <h4 class="form-title">Publicar vacante</h4>
            <form method="POST" action="controllers/VacantesController.php">
                <input type="hidden" name="accion" value="registrar_vacante">

                <div class="mb-4">
                    <label>Título del Puesto</label>
                    <input class="form-control" name="titulo" required>
                </div>

                <div class="mb-4">
                    <label>Empresa</label>
                    <input class="form-control" name="empresa" required>
                </div>

                <div class="mb-4">
                    <label>Categoría</label>
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

                <div class="mb-4">
                    <label>Ubicación</label>
                    <input class="form-control" name="ubicacion" placeholder="Ej: Bogotá, Colombia">
                </div>

                <div class="mb-4">
                    <label>Salario</label>
                    <input class="form-control" name="salario" type="text" placeholder="Ej: $1.500.000 COP">
                </div>
                
                <div class="mb-4">
                    <label>Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="3"></textarea>
                </div>

                <button class="btn-publicar" type="submit">+ Publicar</button>
            </form>
        </div>
    </div>
    
    <div class="col-md-3">
        <h4 class="list-title">Vacantes disponibles</h4>
        <?php
        $iconos_vacante = [
            'Tecnología' => 'https://cdn-icons-png.flaticon.com/512/1055/1055666.png',
            'Marketing' => 'https://cdn-icons-png.flaticon.com/512/1150/1150614.png',
            'Finanzas' => 'https://cdn-icons-png.flaticon.com/512/1077/1077035.png',
            'Salud' => 'https://cdn-icons-png.flaticon.com/512/2965/2965567.png',
            'Educación' => 'https://cdn-icons-png.flaticon.com/512/2984/2984194.png',
            'Construcción' => 'https://cdn-icons-png.flaticon.com/512/2940/2940685.png',
            'default' => 'https://cdn-icons-png.flaticon.com/512/1159/1159842.png'
        ];

        if (!empty($vacantes)): ?>
            <div class="tarjetas-container">
                <?php foreach ($vacantes as $v): ?>
                    <?php
                    $categoria_vacante = trim(htmlspecialchars($v['categoria']));
                    $icono_url = $iconos_vacante[$categoria_vacante] ?? $iconos_vacante['default'];
                    ?>
                    <div class="tarjeta-vacante" onclick="alert('Vacante: <?= htmlspecialchars($v['titulo']) ?>\nEmpresa: <?= htmlspecialchars($v['empresa']) ?>\nSalario: <?= htmlspecialchars($v['salario']) ?>')">
                        <img src="<?= $icono_url ?>" alt="Ícono de vacante" />
                        <h5 class="card-title"><?= htmlspecialchars($v['titulo']) ?></h5>
                        <p class="sub-info"><?= htmlspecialchars($v['empresa']) ?> - <?= htmlspecialchars($v['ubicacion']) ?></p>
                        <p class="salario"><strong><?= htmlspecialchars($v['salario']) ?></strong></p>
                        <p class="publicado"><small>Publicada por: <?= htmlspecialchars($v['nombre_completo'] ?? 'Anónimo') ?></small></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-dark">No hay vacantes publicadas aún.</div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>