<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservChofer $xservChofere
 * @var iterable<\App\Model\Entity\XservAsignacion> $viajes
 */
$this->assign('header-title', 'Historial de Viajes - ' . ($xservChofere->hasValue('usuario') ? h($xservChofere->usuario->nombre) : 'Chofer'));
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
        --green: #4ade80;
        --blue: #3b82f6;
        --yellow: #facc15;
    }

    * { box-sizing: border-box; }
    
    .page-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-white);
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
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

    .tabs {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        border-bottom: 2px solid var(--dark-lighter);
        flex-wrap: wrap;
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
    }

    .tab-link:hover {
        color: var(--text-white);
    }

    .tab-link.active {
        color: var(--gold);
        border-bottom-color: var(--gold);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--gold);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--text-gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .content-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-lighter);
        border-radius: 12px;
        overflow: hidden;
    }

    .viajes-container {
        max-height: 800px;
        overflow-y: auto;
    }

    .viaje-item {
        padding: 1.5rem;
        border-bottom: 1px solid var(--dark-lighter);
        transition: all 0.2s;
    }

    .viaje-item:hover {
        background: rgba(201, 169, 98, 0.05);
    }

    .viaje-item:last-child {
        border-bottom: none;
    }

    .viaje-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .viaje-id {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gold);
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

    .badge.programada {
        background: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .badge.en_curso {
        background: rgba(250, 204, 21, 0.15);
        color: var(--yellow);
        border: 1px solid rgba(250, 204, 21, 0.3);
    }

    .badge.finalizada {
        background: rgba(74, 222, 128, 0.15);
        color: var(--green);
        border: 1px solid rgba(74, 222, 128, 0.3);
    }

    .badge.cancelada {
        background: rgba(239, 68, 68, 0.15);
        color: var(--red);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .viaje-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 1rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-size: 0.75rem;
        color: var(--text-gray);
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .detail-value {
        font-size: 0.95rem;
        color: var(--text-white);
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-gray);
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        padding: 1.5rem;
        list-style: none;
        flex-wrap: wrap;
    }

    .pagination a, .pagination span {
        padding: 0.5rem 0.75rem;
        background: var(--dark-lighter);
        color: var(--text-white);
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.2s;
        font-size: 0.875rem;
    }

    .pagination a:hover {
        background: var(--gold);
        color: var(--dark-bg);
    }

    .pagination .active a {
        background: var(--gold);
        color: var(--dark-bg);
        font-weight: 600;
    }

    .pagination .disabled span {
        opacity: 0.5;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .page-container { padding: 0.75rem; }
        .page-header { flex-direction: column; align-items: stretch; }
        .btn { width: 100%; justify-content: center; }
        .tabs { gap: 0.5rem; }
        .tab-link { padding: 0.5rem 1rem; font-size: 0.8rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .viaje-details { gap: 0.75rem; }
        .viaje-item { padding: 1rem; }
    }

    @media (max-width: 480px) {
        .page-container { padding: 0.5rem; }
        .page-title { font-size: 1.25rem; }
        .stat-number { font-size: 1.5rem; }
        .tabs { gap: 0.25rem; }
        .tab-link { padding: 0.4rem 0.75rem; font-size: 0.75rem; }
        .stats-grid { grid-template-columns: 1fr; }
    }

    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: var(--dark-lighter);
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--text-gray);
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--gold);
    }
</style>

<div class="page-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: inline-block; margin-right: 0.5rem; vertical-align: middle;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <?= h($xservChofere->hasValue('usuario') ? $xservChofere->usuario->nombre : 'Chofer') ?>
        </h1>
        <a href="<?= $this->Url->build(['action' => 'view', $xservChofere->id]) ?>" class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <a href="<?= $this->Url->build(['action' => 'view', $xservChofere->id]) ?>" class="tab-link">Información</a>
        <a href="<?= $this->Url->build(['action' => 'viajesHistorial', $xservChofere->id]) ?>" class="tab-link active">Historial de Viajes</a>
        <a href="<?= $this->Url->build(['action' => 'valoraciones', $xservChofere->id]) ?>" class="tab-link">Valoraciones</a>
        <a href="<?= $this->Url->build(['action' => 'estadisticas', $xservChofere->id]) ?>" class="tab-link">Estadísticas</a>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number"><?= count($viajes) ?? 0 ?></div>
            <div class="stat-label">Viajes en Esta Página</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $this->Paginator->total() ?? 0 ?></div>
            <div class="stat-label">Total de Viajes</div>
        </div>
    </div>

    <!-- Viajes Content -->
    <div class="content-card">
        <?php if (isset($viajes) && is_countable($viajes) && count($viajes) > 0): ?>
            <div class="viajes-container">
                <?php foreach ($viajes as $viaje): ?>
                <div class="viaje-item">
                    <div class="viaje-header">
                        <span class="viaje-id">Viaje #<?= h($viaje->id) ?> - Reserva #<?= h($viaje->reserva_id) ?></span>
                        <span class="badge <?= h($viaje->estado_asignacion) ?>">
                            <?= h(ucfirst(str_replace('_', ' ', $viaje->estado_asignacion))) ?>
                        </span>
                    </div>
                    
                    <div class="viaje-details">
                        <div class="detail-item">
                            <span class="detail-label">Reserva</span>
                            <span class="detail-value">
                                <?= $viaje->hasValue('reserva') ? $this->Html->link(h($viaje->reserva->codigo_reserva), ['controller' => 'XservReservas', 'action' => 'view', $viaje->reserva->id]) : '—' ?>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Vehículo</span>
                            <span class="detail-value">
                                <?= $viaje->hasValue('vehiculo') ? h($viaje->vehiculo->nombre_unidad) : '—' ?>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Inicio Pactado</span>
                            <span class="detail-value">
                                <?= h($viaje->fecha_inicio_pactada->format('d/m/Y H:i')) ?>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Fin Pactado</span>
                            <span class="detail-value">
                                <?= h($viaje->fecha_fin_pactada->format('d/m/Y H:i')) ?>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Creado</span>
                            <span class="detail-value">
                                <?= h($viaje->created_at->format('d/m/Y' )) ?>
                            </span>
                        </div>
                    </div>

                    <?php if (!empty($viaje->observaciones_chofer)): ?>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--dark-lighter);">
                        <span class="detail-label">Observaciones del Chofer</span>
                        <p style="color: var(--text-gray); margin-top: 0.5rem; font-size: 0.875rem;">
                            <?= h($viaje->observaciones_chofer) ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?= $this->Paginator->first('«', ['escape' => false]) ?>
                <?= $this->Paginator->prev('‹', ['escape' => false]) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('›', ['escape' => false]) ?>
                <?= $this->Paginator->last('»', ['escape' => false]) ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p>No hay viajes registrados aún</p>
                <p style="font-size: 0.85rem; margin-top: 0.5rem; color: var(--text-gray);">
                    Cuando se asignen viajes a este chofer, aparecerán aquí
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
