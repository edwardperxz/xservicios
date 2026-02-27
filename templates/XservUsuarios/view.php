<?php
$this->assign('header-title', 'Detalle de Usuario');
?>

<style>
:root { --gold: #c9a962; --gold-light: #d4b978; --dark-bg: #0a0a0a; --dark-card: #1a1a1a; --dark-lighter: #2a2a2a; --text-white: #ffffff; --text-gray: #a0a0a0; --red: #ef4444; --blue: #3b82f6; --green: #4ade80; } .view-container { width: 100%; padding: 1.5rem; display: flex; justify-content: center; } .view-card { background: var(--dark-card, #1a1a1a); border-radius: 12px; padding: 2rem; border: 1px solid var(--dark-lighter, #2a2a2a); width: 100%; max-width: 1000px; } .view-header { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid var(--dark-lighter, #2a2a2a); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; } .view-title { font-size: 1.5rem; font-weight: 600; color: var(--text-white, #ffffff); } .view-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; } .btn { padding: 0.625rem 1.25rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; border: none; cursor: pointer; font-size: 0.875rem; white-space: nowrap; } .btn-primary { background: var(--gold, #c9a962); color: var(--dark-bg, #0a0a0a); } .btn-primary:hover { background: var(--gold-light, #d4b978); transform: translateY(-1px); } .btn-secondary { background: var(--dark-lighter, #2a2a2a); color: var(--text-white, #ffffff); border: 1px solid var(--text-gray, #a0a0a0); } .btn-secondary:hover { border-color: var(--gold, #c9a962); } .btn-danger { background: var(--red, #ef4444); color: var(--text-white, #ffffff); } .btn-danger:hover { background: #dc2626; transform: translateY(-1px); } .detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem; } .detail-item { background: var(--dark-lighter, #2a2a2a); padding: 1rem; border-radius: 8px; } .detail-label { font-size: 0.75rem; color: var(--text-gray, #a0a0a0); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; } .detail-value { font-size: 1rem; color: var(--text-white, #ffffff); font-weight: 500; word-break: break-word; } .detail-value a { color: var(--gold, #c9a962); text-decoration: none; } .detail-value a:hover { text-decoration: underline; } .badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; } .badge-success { background: rgba(74, 222, 128, 0.2); color: var(--green); } .badge-danger { background: rgba(239, 68, 68, 0.2); color: var(--red); } .badge-info { background: rgba(59, 130, 246, 0.2); color: var(--blue); } .section-title { font-size: 1.125rem; font-weight: 600; color: var(--text-white); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--dark-lighter); } @media (max-width: 768px) { .view-container { padding: 1rem; } .view-card { padding: 1.5rem; } .view-title { font-size: 1.25rem; } .view-header { flex-direction: column; align-items: flex-start; } .view-actions { width: 100%; } .btn { width: 100%; } .detail-grid { grid-template-columns: 1fr; gap: 1rem; } } @media (max-width: 480px) { .view-container { padding: 0.75rem; } .view-card { padding: 1rem; } .view-title { font-size: 1.125rem; } .btn { padding: 0.5rem 1rem; font-size: 0.8125rem; } }
</style>

<div class="view-container">
    <div class="view-card">
        <div class="view-header">
            <h2 class="view-title">Usuario: <?= h($xservUsuario->nombre) ?></h2>
            <div class="view-actions">
                <a href="<?= $this->Url->build(['action' => 'edit', $xservUsuario->id]) ?>" class="btn btn-primary">Editar</a>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Volver al Listado</a>
                <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $xservUsuario->id], ['confirm' => '¿Está seguro?', 'class' => 'btn btn-danger']) ?>
            </div>
        </div>

        <h3 class="section-title">Información General</h3>
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">ID</div>
                <div class="detail-value"><?= h($xservUsuario->id) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Username</div>
                <div class="detail-value"><?= h($xservUsuario->username) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Nombre Completo</div>
                <div class="detail-value"><?= h($xservUsuario->nombre) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Correo Electrónico</div>
                <div class="detail-value"><?= h($xservUsuario->correo) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Teléfono</div>
                <div class="detail-value"><?= h($xservUsuario->telefono) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Identificación</div>
                <div class="detail-value"><?= h($xservUsuario->identificacion ?? 'No registrado') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Rol</div>
                <div class="detail-value">
                    <span class="badge badge-info"><?= h(ucfirst($xservUsuario->rol)) ?></span>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Estado</div>
                <div class="detail-value">
                    <span class="badge <?= $xservUsuario->estado === 'activo' ? 'badge-success' : 'badge-danger' ?>">
                        <?= h(ucfirst($xservUsuario->estado ?? 'activo')) ?>
                    </span>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Fecha de Registro</div>
                <div class="detail-value"><?= h($xservUsuario->created_at ? $xservUsuario->created_at->format('d/m/Y H:i') : 'N/A') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Última Actualización</div>
                <div class="detail-value"><?= h($xservUsuario->updated_at ? $xservUsuario->updated_at->format('d/m/Y H:i') : 'N/A') ?></div>
            </div>
        </div>

        <?php if (!empty($xservUsuario->xserv_choferes)): ?>
        <h3 class="section-title">Información de Chofer</h3>
        <div class="detail-grid">
            <?php foreach ($xservUsuario->xserv_choferes as $chofer): ?>
            <div class="detail-item">
                <div class="detail-label">ID Chofer</div>
                <div class="detail-value">
                    <a href="<?= $this->Url->build(['controller' => 'XservChoferes', 'action' => 'view', $chofer->id]) ?>">
                        #<?= h($chofer->id) ?>
                    </a>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Fecha Ingreso</div>
                <div class="detail-value"><?= h($chofer->fecha_ingreso ? $chofer->fecha_ingreso->format('d/m/Y') : 'N/A') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Tipo Licencia</div>
                <div class="detail-value"><?= h($chofer->tipo_licencia ?? 'N/A') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Disponibilidad</div>
                <div class="detail-value">
                    <span class="badge <?= $chofer->disponibilidad === 'disponible' ? 'badge-success' : 'badge-info' ?>">
                        <?= h(ucfirst($chofer->disponibilidad ?? 'N/A')) ?>
                    </span>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Estado Chofer</div>
                <div class="detail-value">
                    <span class="badge <?= $chofer->estado === 'activo' ? 'badge-success' : 'badge-danger' ?>">
                        <?= h(ucfirst($chofer->estado ?? 'N/A')) ?>
                    </span>
                </div>
            </div>
            <?php if (!empty($chofer->foto_url)): ?>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <div class="detail-label">Foto</div>
                <div class="detail-value">
                    <img src="<?= h($chofer->foto_url) ?>" alt="Foto del chofer" style="max-width: 300px; border-radius: 8px; margin-top: 0.5rem;">
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($xservUsuario->xserv_clientes)): ?>
        <h3 class="section-title">Información de Cliente</h3>
        <div class="detail-grid">
            <?php foreach ($xservUsuario->xserv_clientes as $cliente): ?>
            <div class="detail-item">
                <div class="detail-label">ID Cliente</div>
                <div class="detail-value">
                    <a href="<?= $this->Url->build(['controller' => 'XservClientes', 'action' => 'view', $cliente->id]) ?>">
                        #<?= h($cliente->id) ?>
                    </a>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Identificación Fiscal</div>
                <div class="detail-value"><?= h($cliente->identificacion_fiscal ?? 'N/A') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Idioma Preferido</div>
                <div class="detail-value"><?= h(strtoupper($cliente->idioma_preferido ?? 'ES')) ?></div>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <div class="detail-label">Dirección de Facturación</div>
                <div class="detail-value"><?= h($cliente->direccion_facturacion ?? 'No registrada') ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>