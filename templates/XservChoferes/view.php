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
    --yellow: #facc15;
} 

* { box-sizing: border-box; }

body { background: var(--dark-bg); color: var(--text-white); }

.view-container { 
    width: 100%; 
    max-width: 1200px;
    margin: 0 auto;
    padding: 1.5rem; 
}

.view-header { 
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    margin-bottom: 2rem; 
    flex-wrap: wrap;
    gap: 1rem;
} 

.view-title { 
    font-size: 2rem; 
    font-weight: 700; 
    color: var(--text-white);
    display: flex;
    align-items: center;
    gap: 1rem;
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
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(201, 169, 98, 0.2);
} 

.btn-secondary { 
    background: var(--dark-lighter); 
    color: var(--text-white); 
    border: 1px solid var(--text-gray); 
} 

.btn-secondary:hover { 
    border-color: var(--gold); 
    background: var(--dark-card);
} 

.btn-danger { 
    background: var(--red); 
    color: var(--text-white); 
} 

.btn-danger:hover { 
    background: #dc2626; 
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
}

.tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    border-bottom: 2px solid var(--dark-lighter);
    flex-wrap: wrap;
    overflow-x: auto;
}

.tab-link {
    padding: 0.75rem 1.5rem;
    border: none;
    background: transparent;
    color: var(--text-gray);
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 500;
    border-bottom: 3px solid transparent;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
}

.tab-link:hover {
    color: var(--text-white);
}

.tab-link.active {
    color: var(--gold);
    border-bottom-color: var(--gold);
}

.detail-grid { 
    display: grid; 
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
    gap: 1.5rem;
    margin-bottom: 2rem;
} 

.detail-item { 
    background: var(--dark-card);
    border: 1px solid var(--dark-lighter);
    padding: 1.5rem; 
    border-radius: 8px; 
    transition: all 0.2s;
} 

.detail-item:hover {
    border-color: var(--gold);
    box-shadow: 0 2px 8px rgba(201, 169, 98, 0.1);
}

.detail-label { 
    font-size: 0.75rem; 
    color: var(--text-gray); 
    text-transform: uppercase; 
    letter-spacing: 0.5px; 
    margin-bottom: 0.5rem; 
} 

.detail-value { 
    font-size: 1.125rem; 
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
    margin-top: 2rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--dark-lighter);
    border: 1px solid var(--dark-lighter);
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

@media (max-width: 1024px) {
    .view-container { padding: 1rem; }
    .detail-grid { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); }
    .view-title { font-size: 1.5rem; }
}

@media (max-width: 768px) {
    .view-container { padding: 0.75rem; }
    .view-header { flex-direction: column; align-items: stretch; }
    .view-actions { width: 100%; flex-direction: column; }
    .btn { width: 100%; justify-content: center; }
    .detail-grid { grid-template-columns: 1fr; }
    .tabs { gap: 0.5rem; overflow-x: auto; }
    .tab-link { padding: 0.5rem 1rem; font-size: 0.8rem; }
    .view-title { font-size: 1.25rem; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 480px) {
    .view-container { padding: 0.5rem; }
    .view-title { font-size: 1.125rem; gap: 0.5rem; }
    .btn { padding: 0.5rem 1rem; font-size: 0.75rem; }
    .tabs { gap: 0.25rem; }
    .tab-link { padding: 0.4rem 0.75rem; font-size: 0.7rem; }
    .detail-value { font-size: 1rem; }
    .stats-grid { grid-template-columns: 1fr; }
}
</style>

<div class="view-container">
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

    <!-- Tabs -->
    <div class="tabs">
        <a href="<?= $this->Url->build(['action' => 'view', $xservChofere->id]) ?>" class="tab-link active">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Información
        </a>
        <a href="<?= $this->Url->build(['action' => 'viajesHistorial', $xservChofere->id]) ?>" class="tab-link">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Viajes
        </a>
        <a href="<?= $this->Url->build(['action' => 'valoraciones', $xservChofere->id]) ?>" class="tab-link">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.381-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            Valoraciones
        </a>
        <a href="<?= $this->Url->build(['action' => 'estadisticas', $xservChofere->id]) ?>" class="tab-link">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Estadísticas
        </a>
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
                <?= $xservChofere->hasValue('usuario') ? $this->Html->link($xservChofere->usuario->username, ['controller' => 'XservUsuarios', 'action' => 'view', $xservChofere->usuario->id]) : '<span style="color: #6b7280;">No asignado</span>' ?>
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
            <div class="detail-label">Tipo de Licencia</div>
            <div class="detail-value">
                <?= h($xservChofere->tipo_licencia ?: '—') ?>
            </div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Fecha de Ingreso</div>
            <div class="detail-value">
                <?= h($xservChofere->fecha_ingreso->format('d/m/Y (l)')) ?>
            </div>
        </div>
    </div>

    <!-- Danger Zone -->
    <div style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 8px; padding: 2rem; margin-top: 2rem;">
        <h3 style="color: var(--red); margin-bottom: 1rem; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.5px;">
            Zona de Peligro
        </h3>
        <p style="color: var(--text-gray); margin-bottom: 1.5rem; font-size: 0.875rem;">
            Esta acción no se puede deshacer. Eliminar un chofer eliminará toda la información asociada.
        </p>
        <?= $this->Form->postLink('Eliminar este Chofer', ['action' => 'delete', $xservChofere->id], ['confirm' => '¿Está seguro que desea eliminar este chofer de forma permanente?', 'class' => 'btn btn-danger']) ?>
    </div>
</div>
