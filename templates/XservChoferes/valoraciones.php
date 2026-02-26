<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservChofer $xservChofere
 * @var iterable<\App\Model\Entity\XservValoracion> $valoraciones
 * @var array $estadisticas
 */
$this->assign('header-title', 'Valoraciones - ' . ($xservChofere->hasValue('usuario') ? h($xservChofere->usuario->nombre) : 'Chofer'));
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

    .star-rating {
        color: var(--yellow);
        font-size: 1.5rem;
        letter-spacing: 0.25rem;
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

    .valoraciones-container {
        max-height: 800px;
        overflow-y: auto;
    }

    .valoracion-item {
        padding: 1.5rem;
        border-bottom: 1px solid var(--dark-lighter);
        transition: all 0.2s;
    }

    .valoracion-item:hover {
        background: rgba(201, 169, 98, 0.05);
    }

    .valoracion-item:last-child {
        border-bottom: none;
    }

    .valoracion-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .valoracion-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .stars {
        color: var(--yellow);
        font-size: 1rem;
        letter-spacing: 0.1rem;
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

    .badge.aprobado {
        background: rgba(74, 222, 128, 0.15);
        color: var(--green);
        border: 1px solid rgba(74, 222, 128, 0.3);
    }

    .badge.pendiente {
        background: rgba(250, 204, 21, 0.15);
        color: var(--yellow);
        border: 1px solid rgba(250, 204, 21, 0.3);
    }

    .badge.rechazado {
        background: rgba(239, 68, 68, 0.15);
        color: var(--red);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .valoracion-meta {
        display: flex;
        gap: 1.5rem;
        font-size: 0.875rem;
        color: var(--text-gray);
        margin-bottom: 0.75rem;
    }

    .valoracion-texto {
        color: var(--text-white);
        line-height: 1.6;
        margin: 0.75rem 0;
    }

    .detalles-puntuacion {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--dark-lighter);
    }

    .detalle-item {
        display: flex;
        flex-direction: column;
    }

    .detalle-label {
        font-size: 0.7rem;
        color: var(--text-gray);
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 0.25rem;
    }

    .detalle-value {
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
        .detalles-puntuacion { gap: 0.75rem; }
        .valoracion-item { padding: 1rem; }
    }

    @media (max-width: 480px) {
        .page-container { padding: 0.5rem; }
        .page-title { font-size: 1.25rem; }
        .stat-number { font-size: 1.5rem; }
        .tabs { gap: 0.25rem; }
        .tab-link { padding: 0.4rem 0.75rem; font-size: 0.75rem; }
        .stats-grid { grid-template-columns: 1fr; }
        .valoracion-meta { flex-direction: column; gap: 0.25rem; }
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.381-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            Valoraciones de <?= h($xservChofere->hasValue('usuario') ? $xservChofere->usuario->nombre : 'Chofer') ?>
        </h1>
        <a href="<?= $this->Url->build(['action' => 'view', $xservChofere->id]) ?>" class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <a href="<?= $this->Url->build(['action' => 'view', $xservChofere->id]) ?>" class="tab-link">Información</a>
        <a href="<?= $this->Url->build(['action' => 'viajesHistorial', $xservChofere->id]) ?>" class="tab-link">Historial de Viajes</a>
        <a href="<?= $this->Url->build(['action' => 'valoraciones', $xservChofere->id]) ?>" class="tab-link active">Valoraciones</a>
        <a href="<?= $this->Url->build(['action' => 'estadisticas', $xservChofere->id]) ?>" class="tab-link">Estadísticas</a>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="star-rating">★★★★★</div>
            <div class="stat-number"><?= number_format($estadisticas['promedio_calificacion'], 1) ?></div>
            <div class="stat-label">Promedio General</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $estadisticas['total_valoraciones'] ?></div>
            <div class="stat-label">Total Valoraciones</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $estadisticas['total_viajes'] ?></div>
            <div class="stat-label">Total de Viajes</div>
        </div>
    </div>

    <!-- Valoraciones Content -->
    <div class="content-card">
        <?php if (isset($valoraciones) && is_countable($valoraciones) && count($valoraciones) > 0): ?>
            <div class="valoraciones-container">
                <?php foreach ($valoraciones as $valoracion): ?>
                <div class="valoracion-item">
                    <div class="valoracion-header">
                        <div class="valoracion-rating">
                            <span class="stars">
                                <?php
                                $calificacion = $valoracion->calificacion;
                                for ($i = 1; $i <= 5; $i++) {
                                    echo $i <= $calificacion ? '★' : '☆';
                                }
                                ?>
                            </span>
                            <strong><?= h($calificacion) ?>.0 / 5.0</strong>
                        </div>
                        <span class="badge <?= h($valoracion->estado_moderacion) ?>">
                            <?= h(ucfirst($valoracion->estado_moderacion)) ?>
                        </span>
                    </div>

                    <div class="valoracion-meta">
                        <span>
                            <strong>Reserva #<?= h($valoracion->reserva_id) ?></strong>
                        </span>
                        <span>
                            <?= h($valoracion->created_at->format('d/m/Y H:i')) ?>
                        </span>
                    </div>

                    <?php if (!empty($valoracion->comentarios)): ?>
                    <div class="valoracion-texto">
                        <p><?= nl2br(h($valoracion->comentarios)) ?></p>
                    </div>
                    <?php endif; ?>

                    <div class="detalles-puntuacion">
                        <div class="detalle-item">
                            <span class="detalle-label">Calificación General</span>
                            <span class="detalle-value"><?= h($valoracion->calificacion) ?>/5</span>
                        </div>
                        <?php if (!is_null($valoracion->puntuacion_limpieza)): ?>
                        <div class="detalle-item">
                            <span class="detalle-label">Limpieza</span>
                            <span class="detalle-value"><?= h($valoracion->puntuacion_limpieza) ?>/5</span>
                        </div>
                        <?php endif; ?>
                        <?php if (!is_null($valoracion->puntuacion_puntualidad)): ?>
                        <div class="detalle-item">
                            <span class="detalle-label">Puntualidad</span>
                            <span class="detalle-value"><?= h($valoracion->puntuacion_puntualidad) ?>/5</span>
                        </div>
                        <?php endif; ?>
                    </div>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.381-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <p>No hay valoraciones aún</p>
                <p style="font-size: 0.85rem; margin-top: 0.5rem; color: var(--text-gray);">
                    Los clientes podrán valorar este chofer después de completar un viaje
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
