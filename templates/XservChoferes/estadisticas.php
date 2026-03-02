<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservChofer $xservChofere
 * @var array $estadisticas
 * @var iterable<\App\Model\Entity\XservAsignacion> $asignacionesActuales
 */
$this->assign('header-title', 'Estadísticas - ' . ($xservChofere->hasValue('usuario') ? h($xservChofere->usuario->nombre) : 'Chofer'));
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
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-lighter);
        border-radius: 12px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.2s;
    }

    .stat-card:hover {
        border-color: var(--gold);
        box-shadow: 0 4px 12px rgba(201, 169, 98, 0.15);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(201, 169, 98, 0.1);
        border-radius: 8px;
        color: var(--gold);
    }

    .stat-number {
        font-size: 2.5rem;
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

    .stat-percentage {
        font-size: 0.875rem;
        color: var(--green);
        margin-top: 0.5rem;
        font-weight: 600;
    }

    .progress-bar {
        width: 100%;
        height: 8px;
        background: var(--dark-lighter);
        border-radius: 4px;
        overflow: hidden;
        margin-top: 1rem;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--gold), var(--gold-light));
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .content-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-lighter);
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .content-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-white);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--dark-lighter);
    }

    .asignaciones-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .asignacion-item {
        background: var(--dark-lighter);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        padding: 1.5rem;
        transition: all 0.2s;
    }

    .asignacion-item:hover {
        border-color: var(--gold);
        box-shadow: 0 2px 8px rgba(201, 169, 98, 0.1);
    }

    .asignacion-id {
        font-size: 0.875rem;
        color: var(--gold);
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .asignacion-details {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
    }

    .detail-label {
        color: var(--text-gray);
    }

    .detail-value {
        color: var(--text-white);
        font-weight: 500;
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

    .badge.en_curso {
        background: rgba(250, 204, 21, 0.15);
        color: var(--yellow);
        border: 1px solid rgba(250, 204, 21, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--text-gray);
    }

    .empty-state svg {
        width: 48px;
        height: 48px;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    @media (max-width: 768px) {
        .page-container { padding: 0.75rem; }
        .page-header { flex-direction: column; align-items: stretch; }
        .btn { width: 100%; justify-content: center; }
        .tabs { gap: 0.5rem; }
        .tab-link { padding: 0.5rem 1rem; font-size: 0.8rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .stat-number { font-size: 1.75rem; }
        .content-card { padding: 1.5rem; }
        .asignaciones-container { grid-template-columns: 1fr; }
    }

    @media (max-width: 480px) {
        .page-container { padding: 0.5rem; }
        .page-title { font-size: 1.25rem; }
        .stats-grid { grid-template-columns: 1fr; gap: 0.75rem; }
        .stat-number { font-size: 1.5rem; }
        .tabs { gap: 0.25rem; }
        .tab-link { padding: 0.4rem 0.75rem; font-size: 0.75rem; }
        .content-card { padding: 1rem; }
    }
</style>

<div class="page-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: inline-block; margin-right: 0.5rem; vertical-align: middle;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Estadísticas de <?= h($xservChofere->hasValue('usuario') ? $xservChofere->usuario->nombre : 'Chofer') ?>
        </h1>
        <a href="<?= $this->Url->build(['action' => 'view', $xservChofere->id]) ?>" class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <a href="<?= $this->Url->build(['action' => 'view', $xservChofere->id]) ?>" class="tab-link">Información</a>
        <a href="<?= $this->Url->build(['action' => 'viajesHistorial', $xservChofere->id]) ?>" class="tab-link">Historial de Viajes</a>
        <a href="<?= $this->Url->build(['action' => 'valoraciones', $xservChofere->id]) ?>" class="tab-link">Valoraciones</a>
        <a href="<?= $this->Url->build(['action' => 'estadisticas', $xservChofere->id]) ?>" class="tab-link active">Estadísticas</a>
    </div>

    <!-- Main Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="stat-number"><?= $estadisticas['total_viajes'] ?></div>
            <div class="stat-label">Viajes Totales</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div class="stat-number"><?= $estadisticas['viajes_completados'] ?></div>
            <div class="stat-label">Viajes Completados</div>
            <div class="stat-percentage"><?= number_format($estadisticas['porcentaje_completacion'], 1) ?>%</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?= $estadisticas['porcentaje_completacion'] ?>%"></div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.381-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            </div>
            <div class="stat-number"><?= number_format($estadisticas['promedio_calificacion'], 1) ?></div>
            <div class="stat-label">Calificación Promedio</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="stat-number"><?= $estadisticas['asignaciones_actuales'] ?></div>
            <div class="stat-label">Asignaciones Actuales</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
            <div class="stat-number"><?= $estadisticas['total_valoraciones'] ?></div>
            <div class="stat-label">Valoraciones Recibidas</div>
        </div>
    </div>

    <!-- Current Assignments -->
    <?php if ($estadisticas['asignaciones_actuales'] > 0): ?>
    <div class="content-card">
        <h2 class="content-title">Asignaciones en Curso</h2>
        <div class="asignaciones-container">
            <?php foreach ($asignacionesActuales as $asignacion): ?>
            <div class="asignacion-item">
                <div class="asignacion-id">Asignación #<?= h($asignacion->id) ?></div>
                <div class="asignacion-details">
                    <div class="detail-row">
                        <span class="detail-label">Reserva:</span>
                        <span class="detail-value">#<?= h($asignacion->reserva_id) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Vehículo:</span>
                        <span class="detail-value">
                            <?= $asignacion->hasValue('vehiculo') ? h($asignacion->vehiculo->nombre_unidad) : '—' ?>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Estado:</span>
                        <span class="badge en_curso">En Curso</span>
                    </div>
                    <div class="detail-row" style="margin-top: 0.75rem;">
                        <span class="detail-label">Inicio:</span>
                        <span class="detail-value">
                            <?= h($asignacion->fecha_inicio_pactada->format('d/m H:i')) ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php else: ?>
    <div class="content-card">
        <h2 class="content-title">Asignaciones en Curso</h2>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <p>No hay asignaciones en curso</p>
        </div>
    </div>
    <?php endif; ?>
</div>
