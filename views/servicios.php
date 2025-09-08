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
   MÓDULO DE SERVICIOS
======================== */
.servicio-wrapper {
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
    color: #ffffff;
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

/* ========================
   ESTILOS DEL FORMULARIO
======================== */
.form-card {
    background: linear-gradient(145deg, #1e1e1e, #2a2a2a);
    padding: 1.5rem; /* Reducido el padding para hacerlo más corto */
    border-radius: 18px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.8);
    border: 1px solid #2f2f2f;
    animation: fadeIn 0.6s ease;
    width: 100%; /* El formulario ocupa todo el ancho de su contenedor */
    float: left; /* Flota el elemento a la izquierda */
    clear: both; /* Asegura que no haya elementos flotantes a su alrededor */
    margin-right: 0; /* Elimina cualquier margen derecho para pegarlo al borde */
}

.form-title {
    color: #ffffff;
    font-size: 1.8rem;
    font-weight: 600;
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
   MÓDULO DE SERVICIOS
======================== */
.servicio-wrapper {
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
    color: #000000;
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

/* ========================
   ESTILOS DE LAS TARJETAS (NUEVO)
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
    /* Fondo con gradiente claro */
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
    /* Los íconos se verán en su color natural */
    filter: none;
    transition: filter 0.3s ease-in-out;
}

.tarjeta:hover img {
    /* No se necesita filtro al pasar el cursor */
    filter: none;
}

.tarjeta .card-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.tarjeta .precio {
    font-size: 16px;
    font-weight: bold;
    color: #28a745;
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
    .servicio-wrapper {
        flex-direction: column;
    }

    .col-md-4, .col-md-3 {
        flex-basis: 100%;
        max-width: 100%;
    }
    
    .tarjeta {
        flex-basis: calc(50% - 5px);
        max-width: calc(50% - 5px);
    }
}

@media (max-width: 480px) {
    .tarjeta {
        flex-basis: 100%;
        max-width: 100%;
    }
}
</style>
<div class="row servicio-wrapper">
    <div class="col-md-4 mb-4">
        <div class="form-card">
            <h4 class="form-title">Publicar servicio</h4>
            <form method="POST" action="controllers/ServiciosController.php">
                <input type="hidden" name="accion" value="registrar_servicio">

                <div class="mb-5">
                    <label>ID Usuario</label>
                    <input class="form-control" name="id_usuario" required>
                </div>

                <div class="mb-5">
                    <label>Categoría de servicio</label>
                    <select class="form-control" name="nombre_servicio" required>
                        <option value="">Seleccione una categoría...</option>
                        <option value="Comercio y Ventas al Detal">Comercio y Ventas al Detal</option>
                        <option value="Gastronomía y Bebidas">Gastronomía y Bebidas</option>
                        <option value="Servicios de Salud y Bienestar">Servicios de Salud y Bienestar</option>
                        <option value="Educación y Formación">Educación y Formación</option>
                        <option value="Transporte y Logística">Transporte y Logística</option>
                        <option value="Servicios Técnicos y Profesionales">Servicios Técnicos y Profesionales</option>
                        <option value="Entretenimiento y Cultura">Entretenimiento y Cultura</option>
                        <option value="Turismo y Hospedaje">Turismo y Hospedaje</option>
                        <option value="Servicios Financieros y Jurídicos">Servicios Financieros y Jurídicos</option>
                        <option value="Medio Ambiente y Sostenibilidad">Medio Ambiente y Sostenibilidad</option>
                        <option value="Agroindustria y Productos Locales">Agroindustria y Productos Locales</option>
                        <option value="Construcción y Obra Civil">Construcción y Obra Civil</option>
                        <option value="Belleza y Estética">Belleza y Estética</option>
                        <option value="Mantenimiento y Reparaciones">Mantenimiento y Reparaciones</option>
                        <option value="Energía y Servicios Públicos">Energía y Servicios Públicos</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label>Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="3"></textarea>
                </div>

                <div class="mb-5">
                    <label>Precio</label>
                    <input class="form-control" name="precio" type="number" step="0.01" placeholder="Ej: 50000">
                </div>

                <button class="btn-publicar" type="submit">+ Publicar</button>
            </form>
        </div>
    </div>
    
    <div class="col-md-3">
        <h4 class="list-title">Servicios publicados</h4>
        <?php
        // Mapa de íconos (este código se mantiene igual)
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
        
        if (!empty($servicios)): ?>
            <div class="tarjetas-container">
                <?php foreach ($servicios as $s): ?>
                    <?php
                    $nombre_servicio_limpio = trim(htmlspecialchars($s['nombre_servicio']));
                    $icono_url = $iconos_servicio[$nombre_servicio_limpio] ?? $iconos_servicio['default'];
                    ?>
                    <div class="tarjeta" onclick="alert('Servicio: <?= htmlspecialchars($s['nombre_servicio']) ?>\nDescripción: <?= htmlspecialchars($s['descripcion']) ?>\nPrecio: $<?= number_format($s['precio'] ?? 0, 0, ',', '.') ?>')">
                        <img src="<?= $icono_url ?>" alt="Ícono de servicio" />
                        <h5 class="card-title"><?= htmlspecialchars($s['nombre_servicio']) ?></h5>
                        <p class="precio"><strong>$<?= number_format($s['precio'] ?? 0, 0, ',', '.') ?></strong></p>
                        <p class="publicado"><small>Por: <?= htmlspecialchars($s['nombre_completo'] ?? $s['id_usuario']) ?></small></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-dark">No hay servicios publicados aún.</div>
        <?php endif; ?>
    </div>
</div>