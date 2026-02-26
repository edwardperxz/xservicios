<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservVehiculo> $vehiculos
 */
?>

<?php foreach ($vehiculos as $vehiculo): ?>

<?php
    // Estado visual
    $estado = strtolower($vehiculo->estado_operativo);

    $statusClass = 'status-dot';
    $statusText = 'Disponible';

    if ($estado === 'mantenimiento') {
        $statusClass .= ' inactive';
        $statusText = 'En mantenimiento';
    } elseif ($estado === 'ocupado' || $estado === 'en_servicio') {
        $statusText = 'En servicio';
    }

    // Tipo visual
    $tipoBadge = $vehiculo->tipo === 'coaster' ? 'Coaster' : 'Minibus';
?>

<div class="ficha-bus">
    <div class="ficha-inner">

        <span class="badge-tipo"><?= h($tipoBadge) ?></span>

        <div class="ficha-header">
            <div class="ficha-logo">
                <svg viewBox="0 0 24 24" stroke-width="2">
                    <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9L18 10l-1.9-4.6c-.3-.7-1-1.4-1.8-1.4H9.7c-.8 0-1.5.5-1.8 1.2L6 10l-2.5 1.1C2.7 11.3 2 12.1 2 13v3c0 .6.4 1 1 1h2"/>
                    <circle cx="7" cy="17" r="2"/>
                    <circle cx="17" cy="17" r="2"/>
                </svg>
            </div>
            <div class="ficha-brand">
                <span class="ficha-brand-name"><span>X</span>SERVICIOS</span>
                <span class="ficha-brand-sub">Ficha Técnica de Unidad</span>
            </div>
        </div>

        <div class="ficha-body">

        <!-- Imagen izquierda -->
        <div class="ficha-image-container">
            <img 
                class="ficha-image"
                src="<?= h($vehiculo->foto_url ?? '/img/default-bus.jpg') ?>"
                alt="<?= h($vehiculo->nombre_unidad) ?>">
        </div>

        <!-- Información derecha -->
        <div class="ficha-details">

            <div class="ficha-name">
                <?= h($vehiculo->nombre_unidad) ?> <?= h($vehiculo->anio) ?>
            </div>

            <div class="ficha-row">
                <span class="ficha-label">Capacidad:</span>
                <span class="ficha-value highlight">
                    <?= h($vehiculo->capacidad_max) ?> pasajeros
                </span>
            </div>

            <div class="ficha-row">
                <span class="ficha-label">Color:</span>
                <span class="ficha-value">
                    <?= h($vehiculo->color) ?>
                </span>
            </div>

            <div class="ficha-row">
                <span class="ficha-label">Placa:</span>
                <span class="ficha-value">
                    <?= h($vehiculo->placa) ?>
                </span>
            </div>

            <div class="ficha-row">
                <span class="ficha-label">Año:</span>
                <span class="ficha-value">
                    <?= h($vehiculo->anio) ?>
                </span>
            </div>

        </div>
    </div>

        <div class="ficha-footer">
            <div class="ficha-status">
                <span class="<?= $statusClass ?>"></span>
                <span class="status-text"><?= h($statusText) ?></span>
            </div>

            <span class="ficha-id">
                ID: XS-BUS-<?= str_pad($vehiculo->id, 3, '0', STR_PAD_LEFT) ?>
            </span>
        </div>

    </div>
</div>

<?php endforeach; ?>