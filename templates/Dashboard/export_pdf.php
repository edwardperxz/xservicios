<?php
/**
 * @var \App\View\AppView $this
 * @var array $servicios
 * @var array $reservas
 * @var array $rutas
 * @var array $asignaciones
 * @var array $choferes
 * @var array $vehiculos
 * @var array $usuarios
 * @var array $clientes
 * @var array $destinos
 * @var array $valoraciones
 * @var array $notificaciones
 * @var array $incidencias
 * @var array $ejecucionViajes
 * @var array $ubicaciones
 */
$this->assign('header-title', 'Exportar PDF');
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #2c3e50;
        line-height: 1.6;
        background-color: #f5f7fa;
    }

    .export-container {
        padding: 2.5rem;
        max-width: 1400px;
        margin: 0 auto;
        background: white;
    }

    .report-header {
        text-align: center;
        margin-bottom: 3rem;
        padding-bottom: 1.5rem;
        border-bottom: 4px solid #2c3e50;
        background: linear-gradient(135deg, #f5f7fa 0%, #fff 100%);
    }

    .report-header h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        color: #2c3e50;
        font-weight: 700;
    }

    .report-header .subtitle {
        font-size: 1rem;
        color: #7f8c8d;
        margin-bottom: 0.5rem;
    }

    .report-header .timestamp {
        font-size: 0.85rem;
        color: #95a5a6;
        font-style: italic;
    }

    .section {
        margin-bottom: 3rem;
        page-break-inside: avoid;
        border-radius: 6px;
        overflow: hidden;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: white;
        background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
        padding: 0.8rem 1.2rem;
        margin-bottom: 0;
    }

    .section-subtitle {
        font-size: 0.85rem;
        color: white;
        background: #34495e;
        padding: 0.4rem 1.2rem;
        margin: 0;
        font-weight: 500;
    }

    .section-content {
        padding: 1.2rem;
        background: white;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
        font-size: 0.9rem;
    }

    .data-table th {
        background: linear-gradient(135deg, #ecf0f1 0%, #d5dbdb 100%);
        color: #2c3e50;
        padding: 0.85rem 1rem;
        text-align: left;
        font-weight: 700;
        border: 1px solid #bdc3c7;
    }

    .data-table td {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid #ecf0f1;
    }

    .data-table tbody tr {
        transition: background-color 0.2s;
    }

    .data-table tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }

    .data-table tbody tr:nth-child(even) {
        background-color: #fff;
    }

    .empty-section {
        padding: 2rem;
        background-color: #ecf0f1;
        border-left: 6px solid #95a5a6;
        color: #7f8c8d;
        text-align: center;
        font-style: italic;
        border-radius: 4px;
    }

    .footer {
        margin-top: 4rem;
        padding-top: 1.5rem;
        border-top: 2px solid #bdc3c7;
        text-align: center;
        font-size: 0.8rem;
        color: #7f8c8d;
    }

    .export-actions {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .btn-print {
        padding: 0.85rem 2rem;
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 700;
        font-size: 0.95rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }

    .btn-print:hover {
        background: linear-gradient(135deg, #1a252f 0%, #243140 100%);
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        transform: translateY(-2px);
    }

    .btn-back {
        padding: 0.85rem 2rem;
        background: #95a5a6;
        color: white;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: #7f8c8d;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        text-decoration: none;
        transform: translateY(-2px);
    }
        font-size: 0.95rem;
    }

    .btn-back:hover {
        background: #333;
    }

    @media print {
        .sidebar,
        .admin-header,
        .export-actions {
            display: none !important;
        }

        body {
            background: #ffffff;
            color: #000000;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        .export-container {
            padding: 1.5rem 0;
        }

        .section {
            page-break-inside: avoid;
            border: none;
            box-shadow: none;
        }
    }
</style>

<div class="export-container">
    <div class="report-header">
        <h1>REPORTE COMPLETO DEL SISTEMA</h1>
        <div class="subtitle">Xservicios - Sistema de Gestión de Transporte</div>
        <div class="timestamp">Generado el <?= date('d/m/Y \a \l\a\s H:i:s') ?></div>
    </div>

    <div class="export-actions">
        <button class="btn-print" onclick="window.print()">Imprimir / Guardar PDF</button>
        <a class="btn-back" href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'reportes']) ?>">Volver a reportes</a>
    </div>

    <!-- SERVICIOS -->
    <div class="section">
        <div class="section-title">SERVICIOS</div>
        <div class="section-subtitle">Total: <?= count($servicios) ?> servicio(s) disponible(s)</div>
        <div class="section-content">
            <?php if (!empty($servicios)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 20%">Nombre</th>
                            <th style="width: 30%">Descripción</th>
                            <th style="width: 12%">Precio Base</th>
                            <th style="width: 15%">Variantes</th>
                            <th style="width: 10%">Estado</th>
                            <th style="width: 8%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicios as $s): ?>
                        <tr>
                            <td><?= h($s->id) ?></td>
                            <td><strong><?= h($s->nombre) ?></strong></td>
                            <td><?= h(substr($s->descripcion ?? '', 0, 60)) ?></td>
                            <td style="text-align: right;">$<?= number_format($s->precio_base, 2) ?></td>
                            <td><?= h($s->variantes ?? 'N/A') ?></td>
                            <td><?= $s->estado === 'activo' ? '✓ Activo' : '✗ ' . ucfirst($s->estado) ?></td>
                            <td><?= h($s->created_at ? $s->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay servicios registrados</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- RESERVAS -->
    <div class="section">
        <div class="section-title">RESERVAS</div>
        <div class="section-subtitle">Total: <?= count($reservas) ?> reserva(s)</div>
        <div class="section-content">
            <?php if (!empty($reservas)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 12%">Código</th>
                            <th style="width: 15%">Cliente</th>
                            <th style="width: 15%">Servicio</th>
                            <th style="width: 10%">Fecha</th>
                            <th style="width: 8%">Pax</th>
                            <th style="width: 12%">Precio</th>
                            <th style="width: 12%">Estado</th>
                            <th style="width: 11%">Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas as $r): ?>
                        <tr>
                            <td><?= h($r->id) ?></td>
                            <td><strong><?= h($r->codigo_reserva) ?></strong></td>
                            <td><?= h($r->cliente?->usuario?->nombre ?? $r->cliente?->identificacion_fiscal ?? 'N/A') ?></td>
                            <td><?= h($r->servicio?->nombre ?? 'N/A') ?></td>
                            <td><?= h($r->fecha ? $r->fecha->format('d/m/Y') : 'N/A') ?></td>
                            <td><?= h($r->pasajeros ?? 'N/A') ?></td>
                            <td style="text-align: right;">$<?= number_format($r->precio_pactado, 2) ?></td>
                            <td><?= h(ucfirst($r->estado)) ?></td>
                            <td><?= h(ucfirst($r->estado_pago)) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay reservas registradas</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- RUTAS -->
    <div class="section">
        <div class="section-title">RUTAS</div>
        <div class="section-subtitle">Total: <?= count($rutas) ?> ruta(s)</div>
        <div class="section-content">
            <?php if (!empty($rutas)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">Origen</th>
                            <th style="width: 15%">Destino</th>
                            <th style="width: 12%">Precio Base</th>
                            <th style="width: 15%">Tiempo Est. (min)</th>
                            <th style="width: 12%">Distancia (km)</th>
                            <th style="width: 10%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rutas as $r): ?>
                        <tr>
                            <td><?= h($r->id) ?></td>
                            <td><?= h($r->origen?->nombre ?? 'N/A') ?></td>
                            <td><?= h($r->destino?->nombre ?? 'N/A') ?></td>
                            <td style="text-align: right;">$<?= number_format($r->precio_base, 2) ?></td>
                            <td><?= h($r->tiempo_estimado_min ? $r->tiempo_estimado_min . ' min' : 'N/A') ?></td>
                            <td style="text-align: right;">—</td>
                            <td>—</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay rutas registradas</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- CHOFERES -->
    <div class="section">
        <div class="section-title">CHOFERES</div>
        <div class="section-subtitle">Total: <?= count($choferes) ?> chofer(es)</div>
        <div class="section-content">
            <?php if (!empty($choferes)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 20%">Nombre</th>
                            <th style="width: 18%">Email</th>
                            <th style="width: 12%">Tipo Licencia</th>
                            <th style="width: 12%">Disponibilidad</th>
                            <th style="width: 10%">Estado</th>
                            <th style="width: 8%">Ingreso</th>
                            <th style="width: 5%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($choferes as $c): ?>
                        <tr>
                            <td><?= h($c->id) ?></td>
                            <td><strong><?= h($c->usuario?->nombre ?? 'N/A') ?></strong></td>
                            <td><?= h($c->usuario?->correo ?? 'N/A') ?></td>
                            <td><?= h($c->tipo_licencia ?? 'N/A') ?></td>
                            <td><?= h(ucfirst($c->disponibilidad ?? 'N/A')) ?></td>
                            <td><?= $c->estado === 'activo' ? '✓ Activo' : '✗ ' . ucfirst($c->estado) ?></td>
                            <td><?= h($c->fecha_ingreso ? $c->fecha_ingreso->format('d/m/Y') : 'N/A') ?></td>
                            <td><?= h($c->created_at ? $c->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay choferes registrados</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- VEHÍCULOS -->
    <div class="section">
        <div class="section-title">VEHÍCULOS</div>
        <div class="section-subtitle">Total: <?= count($vehiculos) ?> vehículo(s)</div>
        <div class="section-content">
            <?php if (!empty($vehiculos)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 12%">Placa</th>
                            <th style="width: 12%">Nombre Unidad</th>
                            <th style="width: 10%">Tipo</th>
                            <th style="width: 8%">Año</th>
                            <th style="width: 8%">Capacidad</th>
                            <th style="width: 10%">KM Actual</th>
                            <th style="width: 12%">Estado</th>
                            <th style="width: 8%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehiculos as $v): ?>
                        <tr>
                            <td><?= h($v->id) ?></td>
                            <td><strong><?= h($v->placa) ?></strong></td>
                            <td><?= h($v->nombre_unidad) ?></td>
                            <td><?= h(ucfirst($v->tipo)) ?></td>
                            <td style="text-align: center;"><?= h($v->anio ?? 'N/A') ?></td>
                            <td style="text-align: center;"><?= h($v->capacidad_max ? $v->capacidad_max . ' pax' : 'N/A') ?></td>
                            <td style="text-align: right;"><?= h(number_format($v->kilometraje_actual ?? 0, 0)) ?> km</td>
                            <td><?= h(ucfirst($v->estado_operativo)) ?></td>
                            <td><?= h($v->created_at ? $v->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay vehículos registrados</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- CLIENTES -->
    <div class="section">
        <div class="section-title">CLIENTES</div>
        <div class="section-subtitle">Total: <?= count($clientes) ?> cliente(s)</div>
        <div class="section-content">
            <?php if (!empty($clientes)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 20%">Nombre</th>
                            <th style="width: 18%">Email</th>
                            <th style="width: 18%">Identificación</th>
                            <th style="width: 15%">Dirección Facturación</th>
                            <th style="width: 10%">Prefijo Idioma</th>
                            <th style="width: 8%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= h($c->id) ?></td>
                            <td><strong><?= h($c->usuario?->nombre ?? $c->identificacion_fiscal ?? 'N/A') ?></strong></td>
                            <td><?= h($c->usuario?->correo ?? 'N/A') ?></td>
                            <td><?= h($c->identificacion_fiscal ?? 'N/A') ?></td>
                            <td><?= h($c->direccion_facturacion ?? 'N/A') ?></td>
                            <td style="text-align: center;"><?= h(strtoupper($c->idioma_preferido ?? 'N/A')) ?></td>
                            <td><?= h($c->created_at ? $c->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay clientes registrados</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- USUARIOS -->
    <div class="section">
        <div class="section-title">USUARIOS</div>
        <div class="section-subtitle">Total: <?= count($usuarios) ?> usuario(s)</div>
        <div class="section-content">
            <?php if (!empty($usuarios)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 18%">Nombre</th>
                            <th style="width: 18%">Email</th>
                            <th style="width: 12%">Teléfono</th>
                            <th style="width: 10%">Rol</th>
                            <th style="width: 10%">Estado</th>
                            <th style="width: 12%">Identificación</th>
                            <th style="width: 8%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= h($u->id) ?></td>
                            <td><strong><?= h($u->nombre ?? 'N/A') ?></strong></td>
                            <td><?= h($u->correo ?? 'N/A') ?></td>
                            <td><?= h($u->telefono ?? 'N/A') ?></td>
                            <td><span style="background: #ecf0f1; padding: 2px 8px; border-radius: 3px; font-weight: 500;"><?= h(ucfirst($u->rol)) ?></span></td>
                            <td><?= $u->estado === 'activo' ? '✓ Activo' : '✗ ' . ucfirst($u->estado) ?></td>
                            <td><?= h($u->identificacion ?? 'N/A') ?></td>
                            <td><?= h($u->created_at ? $u->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay usuarios registrados</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- DESTINOS -->
    <div class="section">
        <div class="section-title">DESTINOS</div>
        <div class="section-subtitle">Total: <?= count($destinos) ?> destino(s)</div>
        <div class="section-content">
            <?php if (!empty($destinos)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 20%">Nombre</th>
                            <th style="width: 25%">Descripción (ES)</th>
                            <th style="width: 25%">Descripción (EN)</th>
                            <th style="width: 10%">Popular</th>
                            <th style="width: 8%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($destinos as $d): ?>
                        <tr>
                            <td><?= h($d->id) ?></td>
                            <td><strong><?= h($d->ubicacion?->nombre ?? 'N/A') ?></strong></td>
                            <td><?= h(substr($d->descripcion_es ?? '', 0, 50)) ?></td>
                            <td><?= h(substr($d->descripcion_en ?? '', 0, 50)) ?></td>
                            <td><?= $d->es_popular ? 'Si' : 'No' ?></td>
                            <td><?= h($d->created_at ? $d->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay destinos registrados</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ASIGNACIONES -->
    <div class="section">
        <div class="section-title">ASIGNACIONES</div>
        <div class="section-subtitle">Total: <?= count($asignaciones) ?> asignación(es)</div>
        <div class="section-content">
            <?php if (!empty($asignaciones)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">Chofer</th>
                            <th style="width: 15%">Vehículo</th>
                            <th style="width: 12%">Reserva</th>
                            <th style="width: 15%">Fecha Inicio</th>
                            <th style="width: 15%">Fecha Fin</th>
                            <th style="width: 12%">Estado</th>
                            <th style="width: 8%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asignaciones as $a): ?>
                        <tr>
                            <td><?= h($a->id) ?></td>
                            <td><strong><?= h($a->chofer?->usuario?->nombre ?? 'N/A') ?></strong></td>
                            <td><?= h($a->vehiculo?->placa ?? 'N/A') ?></td>
                            <td><?= h($a->reserva?->codigo_reserva ?? $a->reserva_id ?? 'N/A') ?></td>
                            <td><?= h($a->fecha_inicio_pactada ? $a->fecha_inicio_pactada->format('d/m/Y H:i') : 'N/A') ?></td>
                            <td><?= h($a->fecha_fin_pactada ? $a->fecha_fin_pactada->format('d/m/Y H:i') : 'N/A') ?></td>
                            <td><?= h(ucfirst($a->estado_asignacion)) ?></td>
                            <td><?= h($a->created_at ? $a->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay asignaciones registradas</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- VALORACIONES -->
    <div class="section">
        <div class="section-title">VALORACIONES/EVALUACIONES</div>
        <div class="section-subtitle">Total: <?= count($valoraciones) ?> valoración(es)</div>
        <div class="section-content">
            <?php if (!empty($valoraciones)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 12%">Reserva</th>
                            <th style="width: 12%">Calificación</th>
                            <th style="width: 12%">Limpieza</th>
                            <th style="width: 12%">Puntualidad</th>
                            <th style="width: 28%">Comentarios</th>
                            <th style="width: 12%">Moderación</th>
                            <th style="width: 8%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($valoraciones as $v): ?>
                        <tr>
                            <td><?= h($v->id) ?></td>
                            <td><?= h($v->reserva?->codigo_reserva ?? $v->reserva_id ?? 'N/A') ?></td>
                            <td style="text-align: center;"><strong><?= h($v->calificacion) ?>/5</strong></td>
                            <td style="text-align: center;"><?= h($v->puntuacion_limpieza ?? 'N/A') ?></td>
                            <td style="text-align: center;"><?= h($v->puntuacion_puntualidad ?? 'N/A') ?></td>
                            <td><?= h(substr($v->comentarios ?? '', 0, 40)) ?></td>
                            <td><?= h(ucfirst($v->estado_moderacion ?? 'pendiente')) ?></td>
                            <td><?= h($v->created_at ? $v->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay valoraciones registradas</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- NOTIFICACIONES -->
    <div class="section">
        <div class="section-title">NOTIFICACIONES</div>
        <div class="section-subtitle">Total: <?= count($notificaciones) ?> notificación(es)</div>
        <div class="section-content">
            <?php if (!empty($notificaciones)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">Tipo</th>
                            <th style="width: 12%">Medio</th>
                            <th style="width: 15%">Destinatario</th>
                            <th style="width: 15%">Contenido</th>
                            <th style="width: 12%">Estado Envío</th>
                            <th style="width: 10%">Enviado</th>
                            <th style="width: 8%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($notificaciones as $n): ?>
                        <tr>
                            <td><?= h($n->id) ?></td>
                            <td><?= h(ucfirst(str_replace('_', ' ', $n->tipo_notificacion))) ?></td>
                            <td><?= h(ucfirst($n->medio ?? 'N/A')) ?></td>
                            <td><?= h($n->destinatario ?? $n->usuario?->correo ?? $n->cliente?->usuario?->correo ?? 'Sistema') ?></td>
                            <td><?= h(substr($n->contenido ?? '', 0, 40)) ?></td>
                            <td><?= h(ucfirst($n->estado_envio ?? 'N/A')) ?></td>
                            <td><?= h($n->enviado_at ? $n->enviado_at->format('d/m/Y H:i') : '—') ?></td>
                            <td><?= h($n->created_at ? $n->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay notificaciones registradas</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- INCIDENCIAS DE VIAJE -->
    <div class="section">
        <div class="section-title">INCIDENCIAS DE VIAJE</div>
        <div class="section-subtitle">Total: <?= count($incidencias) ?> incidencia(s)</div>
        <div class="section-content">
            <?php if (!empty($incidencias)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 12%">Ejecución</th>
                            <th style="width: 12%">Tipo</th>
                            <th style="width: 25%">Descripción</th>
                            <th style="width: 12%">Severidad</th>
                            <th style="width: 10%">Resuelto</th>
                            <th style="width: 12%">Ubicación GPS</th>
                            <th style="width: 8%">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($incidencias as $i): ?>
                        <tr>
                            <td><?= h($i->id) ?></td>
                            <td><?= h($i->ejecucion?->id ?? $i->ejecucion_id ?? 'N/A') ?></td>
                            <td><?= h(ucfirst($i->tipo_incidencia)) ?></td>
                            <td><?= h(substr($i->descripcion ?? '', 0, 40)) ?></td>
                            <td style="text-align: center; font-weight: 500;"><?= h(strtoupper($i->severidad ?? 'N/A')) ?></td>
                            <td style="text-align: center;"><?= $i->resuelto ? '✓' : '✗' ?></td>
                            <td style="font-size: 0.8rem;"><?= h(($i->latitud_incidencia ? round($i->latitud_incidencia, 2) : '') . ' / ' . ($i->longitud_incidencia ? round($i->longitud_incidencia, 2) : '')) ?></td>
                            <td><?= h($i->created_at ? $i->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay incidencias registradas</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- EJECUCIÓN DE VIAJES -->
    <div class="section">
        <div class="section-title">EJECUCIÓN DE VIAJES</div>
        <div class="section-subtitle">Total: <?= count($ejecucionViajes) ?> viaje(s)</div>
        <div class="section-content">
            <?php if (!empty($ejecucionViajes)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 10%">Asignación</th>
                            <th style="width: 16%">Chofer</th>
                            <th style="width: 12%">Vehículo</th>
                            <th style="width: 10%">Inicio Real</th>
                            <th style="width: 10%">Fin Real</th>
                            <th style="width: 9%">KM Inicio</th>
                            <th style="width: 9%">KM Fin</th>
                            <th style="width: 9%">Estado</th>
                            <th style="width: 10%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ejecucionViajes as $e): ?>
                        <tr>
                            <td><?= h($e->id) ?></td>
                            <td><?= h($e->asignacion_id) ?></td>
                            <td><?= h($e->asignacion?->chofer?->usuario?->nombre ?? 'N/A') ?></td>
                            <td><?= h($e->asignacion?->vehiculo?->placa ?? 'N/A') ?></td>
                            <td><?= h($e->hora_inicio_real ? $e->hora_inicio_real->format('d/m H:i') : 'N/A') ?></td>
                            <td><?= h($e->hora_fin_real ? $e->hora_fin_real->format('d/m H:i') : 'En prog.') ?></td>
                            <td style="text-align: right;"><?= h(number_format($e->km_inicio ?? 0, 0)) ?></td>
                            <td style="text-align: right;"><?= h(number_format($e->km_fin ?? 0, 0)) ?></td>
                            <td><?= h(ucfirst($e->estado_ejecucion ?? 'N/A')) ?></td>
                            <td><?= h($e->created_at ? $e->created_at->format('d/m') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay ejecuciones de viajes registradas</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- UBICACIONES -->
    <div class="section">
        <div class="section-title">UBICACIONES</div>
        <div class="section-subtitle">Total: <?= count($ubicaciones) ?> ubicación(es)</div>
        <div class="section-content">
            <?php if (!empty($ubicaciones)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 25%">Nombre</th>
                            <th style="width: 15%">Provincia</th>
                            <th style="width: 35%">Coordenadas GPS</th>
                            <th style="width: 15%">Creado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ubicaciones as $u): ?>
                        <tr>
                            <td><?= h($u->id) ?></td>
                            <td><strong><?= h($u->nombre) ?></strong></td>
                            <td><?= h($u->EN_PROVINCIAS ?? 'N/A') ?></td>
                            <td style="font-family: monospace; font-size: 0.85rem;"><?= h($u->direccion_gps ?? 'N/A') ?></td>
                            <td><?= h($u->created_at ? $u->created_at->format('d/m/Y') : 'N/A') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-section">No hay ubicaciones registradas</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        <hr style="border: none; border-top: 1px solid #bdc3c7; margin: 2rem 0;">
        <p><strong>Resumen Ejecutivo</strong></p>
        <p>Servicios: <?= count($servicios) ?> | Reservas: <?= count($reservas) ?> | Rutas: <?= count($rutas) ?> | Choferes: <?= count($choferes) ?> | Vehículos: <?= count($vehiculos) ?> | Clientes: <?= count($clientes) ?> | Usuarios: <?= count($usuarios) ?></p>
        <p><br>Reporte generado automáticamente el <?= date('d/m/Y \a \l\a\s H:i:s') ?></p>
        <p>© Xservicios - Sistema de Gestión de Transporte</p>
    </div>
</div>
