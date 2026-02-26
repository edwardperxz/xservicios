<?php
$this->assign('header-title', 'Detalle de Reserva');
?>

<style>
:root { --gold: #c9a962; --gold-light: #d4b978; --dark-bg: #0a0a0a; --dark-card: #1a1a1a; --dark-lighter: #2a2a2a; --text-white: #ffffff; --text-gray: #a0a0a0; --red: #ef4444; --blue: #3b82f6; --green: #4ade80; } .view-container { width: 100%; padding: 1.5rem; display: flex; justify-content: center; } .view-card { background: var(--dark-card, #1a1a1a); border-radius: 12px; padding: 2rem; border: 1px solid var(--dark-lighter, #2a2a2a); width: 100%; max-width: 1000px; } .view-header { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid var(--dark-lighter, #2a2a2a); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; } .view-title { font-size: 1.5rem; font-weight: 600; color: var(--text-white, #ffffff); } .view-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; } .btn { padding: 0.625rem 1.25rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; border: none; cursor: pointer; font-size: 0.875rem; white-space: nowrap; } .btn-primary { background: var(--gold, #c9a962); color: var(--dark-bg, #0a0a0a); } .btn-primary:hover { background: var(--gold-light, #d4b978); transform: translateY(-1px); } .btn-secondary { background: var(--dark-lighter, #2a2a2a); color: var(--text-white, #ffffff); border: 1px solid var(--text-gray, #a0a0a0); } .btn-secondary:hover { border-color: var(--gold, #c9a962); } .btn-danger { background: var(--red, #ef4444); color: var(--text-white, #ffffff); } .btn-danger:hover { background: #dc2626; transform: translateY(-1px); } .detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; } .detail-item { background: var(--dark-lighter, #2a2a2a); padding: 1rem; border-radius: 8px; } .detail-label { font-size: 0.75rem; color: var(--text-gray, #a0a0a0); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; } .detail-value { font-size: 1rem; color: var(--text-white, #ffffff); font-weight: 500; word-break: break-word; } .detail-value a { color: var(--gold, #c9a962); text-decoration: none; } .detail-value a:hover { text-decoration: underline; } @media (max-width: 768px) { .view-container { padding: 1rem; } .view-card { padding: 1.5rem; } .view-title { font-size: 1.25rem; } .view-header { flex-direction: column; align-items: flex-start; } .view-actions { width: 100%; } .btn { width: 100%; } .detail-grid { grid-template-columns: 1fr; gap: 1rem; } } @media (max-width: 480px) { .view-container { padding: 0.75rem; } .view-card { padding: 1rem; } .view-title { font-size: 1.125rem; } .btn { padding: 0.5rem 1rem; font-size: 0.8125rem; } }
</style>

<div class="view-container">
    <div class="view-card">
        <div class="view-header">
            <h2 class="view-title">Reserva: <?= h($xservReserva->codigo_reserva) ?></h2>
            <div class="view-actions">
                <a href="<?= $this->Url->build(['action' => 'edit', $xservReserva->id]) ?>" class="btn btn-primary">Editar</a>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Volver al Listado</a>
                <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $xservReserva->id], ['confirm' => '¿Está seguro?', 'class' => 'btn btn-danger']) ?>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Código Reserva</div>
                <div class="detail-value"><?= h($xservReserva->codigo_reserva) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Cliente</div>
                <div class="detail-value"><?= $xservReserva->hasValue('cliente') ? $this->Html->link(($xservReserva->cliente?->usuario?->nombre ?? $xservReserva->cliente?->usuario?->username ?? 'Sin nombre'), ['controller' => 'XservClientes', 'action' => 'view', $xservReserva->cliente->id]) : '<span style="color: #6b7280;">No asignado</span>' ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Servicio</div>
                <div class="detail-value"><?= $xservReserva->hasValue('servicio') ? $this->Html->link($xservReserva->servicio->nombre, ['controller' => 'XservServicios', 'action' => 'view', $xservReserva->servicio->id]) : '<span style="color: #6b7280;">No asignado</span>' ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Ruta</div>
                <div class="detail-value"><?= $xservReserva->hasValue('ruta') ? $this->Html->link('Ruta #' . $xservReserva->ruta->id, ['controller' => 'XservRutas', 'action' => 'view', $xservReserva->ruta->id]) : '<span style="color: #6b7280;">No asignado</span>' ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Punto Recogida</div>
                <div class="detail-value"><?= h($xservReserva->punto_recogida) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Punto Destino</div>
                <div class="detail-value"><?= h($xservReserva->punto_destino) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Estado</div>
                <div class="detail-value"><?= h($xservReserva->estado) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Estado Pago</div>
                <div class="detail-value"><?= h($xservReserva->estado_pago) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Pasajeros</div>
                <div class="detail-value"><?= $this->Number->format($xservReserva->pasajeros) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Precio Pactado</div>
                <div class="detail-value">$<?= $this->Number->format($xservReserva->precio_pactado) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">ITBMS Pactado</div>
                <div class="detail-value">$<?= $xservReserva->itbms_pactado === null ? '0.00' : $this->Number->format($xservReserva->itbms_pactado) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Fecha</div>
                <div class="detail-value"><?= h($xservReserva->fecha) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Hora</div>
                <div class="detail-value"><?= h($xservReserva->hora) ?></div>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <div class="detail-label">Observaciones</div>
                <div class="detail-value"><?= h($xservReserva->observaciones) ?></div>
            </div>
        </div>
    </div>
</div>