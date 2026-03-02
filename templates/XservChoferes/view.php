<?php
$this->assign('header-title', 'Detalle de Chofer');
?>

<style>
:root { 
    --gold: #c9a962; 
    --gold-light: #d4b978; 
    --dark-bg: #0a0a0a; 
    --dark-card: #1a1a1a; 
    --dark-lighter: #2a2a2a; 
    --text-white: #ffffff; 
    --text-gray: #a0a0a0; 
    --red: #ef4444; 
    --blue: #3b82f6; 
    --green: #4ade80; 
}

.view-container { 
    width: 100%; 
    padding: 1.5rem; 
    display: flex; 
    justify-content: center; 
}

.view-card { 
    background: var(--dark-card); 
    border-radius: 12px; 
    padding: 2rem; 
    border: 1px solid var(--dark-lighter); 
    width: 100%; 
    max-width: 1000px; 
}

.view-header { 
    margin-bottom: 2rem; 
    padding-bottom: 1rem; 
    border-bottom: 1px solid var(--dark-lighter); 
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    flex-wrap: wrap; 
    gap: 1rem; 
}

.view-title { 
    font-size: 1.5rem; 
    font-weight: 600; 
    color: var(--text-white); 
    display: flex; 
    align-items: center; 
    gap: 0.75rem; 
}

.view-actions { 
    display: flex; 
    gap: 0.75rem; 
    flex-wrap: wrap; 
}

.btn { 
    padding: 0.625rem 1.25rem; 
    border-radius: 8px; 
    font-weight: 500; 
    text-decoration: none; 
    display: inline-flex; 
    align-items: center; 
    justify-content: center; 
    transition: all 0.2s; 
    border: none; 
    cursor: pointer; 
    font-size: 0.875rem; 
    white-space: nowrap; 
}

.btn-primary { 
    background: var(--gold); 
    color: var(--dark-bg); 
}

.btn-primary:hover { 
    background: var(--gold-light); 
    transform: translateY(-1px); 
}

.btn-secondary { 
    background: var(--dark-lighter); 
    color: var(--text-white); 
    border: 1px solid var(--text-gray); 
}

.btn-secondary:hover { 
    border-color: var(--gold); 
}

.btn-danger { 
    background: var(--red); 
    color: var(--text-white); 
}

.btn-danger:hover { 
    background: #dc2626; 
    transform: translateY(-1px); 
}

.detail-grid { 
    display: grid; 
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
    gap: 1.5rem; 
}

.detail-item { 
    background: var(--dark-lighter); 
    padding: 1rem; 
    border-radius: 8px; 
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.detail-item:hover {
    border-color: var(--gold);
}

.detail-label { 
    font-size: 0.75rem; 
    color: var(--text-gray); 
    text-transform: uppercase; 
    letter-spacing: 0.5px; 
    margin-bottom: 0.5rem; 
}

.detail-value { 
    font-size: 1rem; 
    color: var(--text-white); 
    font-weight: 500; 
    word-break: break-word; 
}

.detail-value a { 
    color: var(--gold); 
    text-decoration: none; 
}

.detail-value a:hover { 
    text-decoration: underline; 
}

.badge { 
    display: inline-block; 
    padding: 0.35rem 0.85rem; 
    border-radius: 20px; 
    font-size: 0.7rem; 
    font-weight: 600; 
    text-transform: uppercase; 
    letter-spacing: 0.3px; 
}

.badge.disponible { 
    background: rgba(74, 222, 128, 0.15); 
    color: var(--green); 
    border: 1px solid rgba(74, 222, 128, 0.3); 
}

.badge.no_disponible { 
    background: rgba(239, 68, 68, 0.15); 
    color: var(--red); 
    border: 1px solid rgba(239, 68, 68, 0.3); 
}

.badge.asignado { 
    background: rgba(59, 130, 246, 0.15); 
    color: var(--blue); 
    border: 1px solid rgba(59, 130, 246, 0.3); 
}

.badge.activo { 
    background: rgba(74, 222, 128, 0.15); 
    color: var(--green); 
    border: 1px solid rgba(74, 222, 128, 0.3); 
}

.badge.inactivo { 
    background: rgba(239, 68, 68, 0.15); 
    color: var(--red); 
    border: 1px solid rgba(239, 68, 68, 0.3); 
}

.stats-grid { 
    display: grid; 
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); 
    gap: 1rem; 
    margin-bottom: 2rem; 
}

.stat-card { 
    background: var(--dark-lighter); 
    border: 1px solid rgba(255, 255, 255, 0.05); 
    border-radius: 8px; 
    padding: 1rem; 
    text-align: center; 
}

.stat-number { 
    font-size: 1.5rem; 
    font-weight: 700; 
    color: var(--gold); 
    margin-bottom: 0.25rem; 
}

.stat-label { 
    font-size: 0.75rem; 
    color: var(--text-gray); 
    text-transform: uppercase; 
    letter-spacing: 0.3px; 
}

.danger-zone {
    background: rgba(239, 68, 68, 0.05);
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-radius: 8px;
    padding: 2rem;
    margin-top: 2rem;
}

.danger-title {
    color: var(--red);
    margin-bottom: 1rem;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.danger-description {
    color: var(--text-gray);
    margin-bottom: 1.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
}

@media (max-width: 768px) { 
    .view-container { padding: 1rem; } 
    .view-card { padding: 1.5rem; } 
    .view-header { flex-direction: column; align-items: flex-start; } 
    .view-actions { width: 100%; flex-direction: column; } 
    .btn { width: 100%; justify-content: center; } 
    .detail-grid { grid-template-columns: 1fr; gap: 1rem; } 
    .view-title { font-size: 1.25rem; } 
    .stats-grid { grid-template-columns: repeat(2, 1fr); } 
}

@media (max-width: 480px) { 
    .view-container { padding: 0.75rem; } 
    .view-card { padding: 1rem; } 
    .view-title { font-size: 1.125rem; } 
    .btn { padding: 0.5rem 1rem; font-size: 0.8125rem; } 
    .detail-value { font-size: 0.875rem; } 
    .stats-grid { grid-template-columns: 1fr; } 
}
</style>

<div class="view-container">
    <div class="view-card">
        <div class="view-header">
            <h2 class="view-title">
                <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink: 0;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <?= $xservChofere->hasValue('usuario') ? h($xservChofere->usuario->nombre) : 'Sin usuario asignado' ?>
            </h2>
            <div class="view-actions">
                <a href="<?= $this->Url->build(['action' => 'edit', $xservChofere->id]) ?>" class="btn btn-primary">Editar</a>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Volver</a>
            </div>
        </div>

        <!-- Status Badges -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Estado</div>
                <div style="margin-top: 0.5rem;">
                    <span class="badge <?= h($xservChofere->estado) ?>">
                        <?= h(ucfirst($xservChofere->estado)) ?>
                    </span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Disponibilidad</div>
                <div style="margin-top: 0.5rem;">
                    <span class="badge <?= h($xservChofere->disponibilidad) ?>">
                        <?= h(ucfirst(str_replace('_', ' ', $xservChofere->disponibilidad))) ?>
                    </span>
                </div>
            </div>
            <?php if ($totalValoraciones > 0): ?>
            <div class="stat-card">
                <div class="stat-label">Calificación Promedio</div>
                <div style="margin-top: 0.5rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="color: var(--gold);">
                        <path d="M12 1.27l3.82 7.75h8.51l-6.88 5 2.63 8.63-7.38-5.36-7.38 5.36 2.63-8.63-6.88-5h8.51L12 1.27z"/>
                    </svg>
                    <span style="color: var(--gold); font-weight: 600; font-size: 1.25rem;">
                        <?= number_format($promedioCalificacion, 1) ?>
                    </span>
                    <span style="color: var(--text-gray); font-size: 0.875rem;">
                        (<?= $totalValoraciones ?> <?= $totalValoraciones == 1 ? 'valoración' : 'valoraciones' ?>)
                    </span>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Details Grid -->
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">ID del Chofer</div>
                <div class="detail-value">#<?= h($xservChofere->id) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Usuario Sistema</div>
                <div class="detail-value">
                    <?= $xservChofere->hasValue('usuario') ? $this->Html->link(h($xservChofere->usuario->username), ['controller' => 'XservUsuarios', 'action' => 'view', $xservChofere->usuario->id]) : '<span style="color: #6b7280;">No asignado</span>' ?>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Nombre Completo</div>
                <div class="detail-value">
                    <?= $xservChofere->hasValue('usuario') ? h($xservChofere->usuario->nombre) : '<span style="color: #6b7280;">—</span>' ?>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Identificación</div>
                <div class="detail-value">
                    <?= $xservChofere->hasValue('usuario') ? h($xservChofere->usuario->identificacion) : '<span style="color: #6b7280;">—</span>' ?>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Teléfono</div>
                <div class="detail-value">
                    <?= $xservChofere->hasValue('usuario') ? h($xservChofere->usuario->telefono) : '<span style="color: #6b7280;">—</span>' ?>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Correo Electrónico</div>
                <div class="detail-value">
                    <?= $xservChofere->hasValue('usuario') ? h($xservChofere->usuario->correo) : '<span style="color: #6b7280;">—</span>' ?>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Fecha de Ingreso</div>
                <div class="detail-value">
                    <?= h($xservChofere->fecha_ingreso->format('d/m/Y')) ?>
                </div>
            </div>
            <?php if (!empty($xservChofere->foto_url)): ?>
            <div class="detail-item">
                <div class="detail-label">Fotografía</div>
                <div style="margin-top: 0.5rem; width: 100%; max-width: 200px; height: 150px; border-radius: 6px; overflow: hidden;">
                    <img src="<?= h($xservChofere->foto_url) ?>" alt="Foto del chofer" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Danger Zone -->
        <div class="danger-zone">
            <h3 class="danger-title">Zona de Peligro</h3>
            <p class="danger-description">
                Esta acción no se puede deshacer. Eliminar un chofer eliminará toda la información asociada.
            </p>
            <?= $this->Form->postLink('Eliminar este Chofer', ['action' => 'delete', $xservChofere->id], ['confirm' => '¿Está seguro que desea eliminar este chofer de forma permanente?', 'class' => 'btn btn-danger']) ?>
        </div>
    </div>
</div>
