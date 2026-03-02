<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $user
 * @var int $totalReservas
 * @var int $totalChoferes
 * @var int $totalVehiculos
 * @var int $totalEvaluaciones
 * @var int $totalIncidencias
 */
$this->assign('header-title', 'Reportes');
?>

<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--dark-lighter);
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
    }

    .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-card-title {
        font-size: 0.875rem;
        color: var(--text-gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-card-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-white);
    }

    .stat-card-icon {
        width: 40px;
        height: 40px;
        background: rgba(201, 169, 98, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
    }

    .reports-section {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--dark-lighter);
        margin-bottom: 2rem;
    }

    .reports-title {
        font-size: 1.25rem;
        color: var(--text-white);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .reports-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .report-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background: var(--dark-bg);
        border-radius: 8px;
        border: 1px solid var(--dark-lighter);
        color: var(--text-white);
        text-decoration: none;
        transition: all 0.2s;
    }

    .report-link:hover {
        background: var(--dark-lighter);
        border-color: var(--gold);
    }

    .report-link-text {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .report-link-title {
        font-weight: 500;
        color: var(--text-white);
    }

    .report-link-desc {
        font-size: 0.75rem;
        color: var(--text-gray);
    }

    .icon-arrow {
        width: 20px;
        height: 20px;
        color: var(--gold);
    }

    .filter-bar {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 0.5rem 1rem;
        background: var(--dark-bg);
        border: 1px solid var(--dark-lighter);
        border-radius: 6px;
        color: var(--text-gray);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.875rem;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--gold);
        color: var(--dark-bg);
        border-color: var(--gold);
    }
</style>

<div class="dashboard-grid">
    <!-- Estadísticas Principales -->
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-title">Total Reservas</div>
            <div class="stat-card-icon">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 6h16v2H4V6zm0 4h16v2H4v-2zm0 4h16v2H4v-2z"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-value"><?= $totalReservas ?? 0 ?></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-title">Total Choferes</div>
            <div class="stat-card-icon">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-value"><?= $totalChoferes ?? 0 ?></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-title">Total Vehículos</div>
            <div class="stat-card-icon">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm11 0c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-value"><?= $totalVehiculos ?? 0 ?></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-title">Total Evaluaciones</div>
            <div class="stat-card-icon">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-value"><?= $totalEvaluaciones ?? 0 ?></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-title">Total Incidencias</div>
            <div class="stat-card-icon">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-value"><?= $totalIncidencias ?? 0 ?></div>
    </div>
</div>

<div class="reports-section">
    <h2 class="reports-title">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
        </svg>
        Opciones de Exportación
    </h2>

    <div class="reports-grid">
        <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'exportPdf']) ?>" class="report-link">
            <div class="report-link-text">
                <span class="report-link-title">Exportar PDF</span>
                <span class="report-link-desc">Descargar en PDF</span>
            </div>
            <svg class="icon-arrow" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
            </svg>
        </a>

        <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'exportExcel']) ?>" class="report-link">
            <div class="report-link-text">
                <span class="report-link-title">Exportar Excel</span>
                <span class="report-link-desc">Descargar en xlsx</span>
            </div>
            <svg class="icon-arrow" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
            </svg>
        </a>
    </div>
</div>
