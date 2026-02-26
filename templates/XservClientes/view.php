<?php
$this->assign('header-title', 'Detalle de Cliente');
?>

<style>
:root { --gold: #c9a962; --gold-light: #d4b978; --dark-bg: #0a0a0a; --dark-card: #1a1a1a; --dark-lighter: #2a2a2a; --text-white: #ffffff; --text-gray: #a0a0a0; --red: #ef4444; --blue: #3b82f6; --green: #4ade80; } .view-container { width: 100%; padding: 1.5rem; display: flex; justify-content: center; } .view-card { background: var(--dark-card, #1a1a1a); border-radius: 12px; padding: 2rem; border: 1px solid var(--dark-lighter, #2a2a2a); width: 100%; max-width: 1000px; } .view-header { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid var(--dark-lighter, #2a2a2a); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; } .view-title { font-size: 1.5rem; font-weight: 600; color: var(--text-white, #ffffff); } .view-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; } .btn { padding: 0.625rem 1.25rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; border: none; cursor: pointer; font-size: 0.875rem; white-space: nowrap; } .btn-primary { background: var(--gold, #c9a962); color: var(--dark-bg, #0a0a0a); } .btn-primary:hover { background: var(--gold-light, #d4b978); transform: translateY(-1px); } .btn-secondary { background: var(--dark-lighter, #2a2a2a); color: var(--text-white, #ffffff); border: 1px solid var(--text-gray, #a0a0a0); } .btn-secondary:hover { border-color: var(--gold, #c9a962); } .btn-danger { background: var(--red, #ef4444); color: var(--text-white, #ffffff); } .btn-danger:hover { background: #dc2626; transform: translateY(-1px); } .detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; } .detail-item { background: var(--dark-lighter, #2a2a2a); padding: 1rem; border-radius: 8px; } .detail-label { font-size: 0.75rem; color: var(--text-gray, #a0a0a0); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; } .detail-value { font-size: 1rem; color: var(--text-white, #ffffff); font-weight: 500; word-break: break-word; } .detail-value a { color: var(--gold, #c9a962); text-decoration: none; } .detail-value a:hover { text-decoration: underline; } @media (max-width: 768px) { .view-container { padding: 1rem; } .view-card { padding: 1.5rem; } .view-title { font-size: 1.25rem; } .view-header { flex-direction: column; align-items: flex-start; } .view-actions { width: 100%; } .btn { width: 100%; } .detail-grid { grid-template-columns: 1fr; gap: 1rem; } } @media (max-width: 480px) { .view-container { padding: 0.75rem; } .view-card { padding: 1rem; } .view-title { font-size: 1.125rem; } .btn { padding: 0.5rem 1rem; font-size: 0.8125rem; } }
</style>

<div class="view-container">
    <div class="view-card">
        <div class="view-header">
            <h2 class="view-title">Cliente: <?= h($xservCliente->usuario->nombre ?? 'Sin nombre') ?></h2>
            <div class="view-actions">
                <a href="<?= $this->Url->build(['action' => 'edit', $xservCliente->id]) ?>" class="btn btn-primary">Editar</a>
                <a href="<?= $this->Url->build(['controller' => 'XservReservas', 'action' => 'index', '?' => ['cliente_id' => $xservCliente->id]]) ?>" class="btn btn-secondary">Ver Reservas</a>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Volver al Listado</a>
                <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $xservCliente->id], ['confirm' => '¿Está seguro?', 'class' => 'btn btn-danger']) ?>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Usuario</div>
                <div class="detail-value"><?= $xservCliente->has('usuario') ? $this->Html->link($xservCliente->usuario->username, ['controller' => 'XservUsuarios', 'action' => 'view', $xservCliente->usuario->id]) : '' ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Nombre</div>
                <div class="detail-value"><?= h($xservCliente->usuario->nombre ?? '') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Correo</div>
                <div class="detail-value"><?= h($xservCliente->usuario->correo ?? '') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Teléfono</div>
                <div class="detail-value"><?= h($xservCliente->usuario->telefono ?? '') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Identificación</div>
                <div class="detail-value"><?= h($xservCliente->usuario->identificacion ?? '') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Identificación Fiscal</div>
                <div class="detail-value"><?= h($xservCliente->identificacion_fiscal) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Idioma Preferido</div>
                <div class="detail-value"><?= h($xservCliente->idioma_preferido) ?></div>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <div class="detail-label">Dirección Facturación</div>
                <div class="detail-value"><?= h($xservCliente->direccion_facturacion) ?></div>
            </div>
        </div>
    </div>
</div>