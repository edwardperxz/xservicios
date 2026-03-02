<?php
$this->assign('title', 'Panel de Operador');
?>

<div class="dashboard-header">
    <h1>Panel de Operador</h1>
    <p>Gestiona reservas, asignaciones y recursos</p>
</div>

<!-- Tarjetas de estadísticas -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(251, 146, 60, 0.15);">
            <svg viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Reservas Pendientes</div>
            <div class="stat-value"><?= h($reservasPendientes) ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.15);">
            <svg viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Asignaciones Activas</div>
            <div class="stat-value"><?= h($asignacionesActivas) ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(74, 222, 128, 0.15);">
            <svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Choferes Disponibles</div>
            <div class="stat-value"><?= h($choferesDisponibles) ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(201, 169, 98, 0.15);">
            <svg viewBox="0 0 24 24" fill="none" stroke="#c9a962" stroke-width="2">
                <path d="M19 17h2v2h-2z"/>
                <path d="M9 17H7v2h2z"/>
                <path d="M20 16H4a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2z"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Vehículos Disponibles</div>
            <div class="stat-value"><?= h($vehiculosDisponibles) ?></div>
        </div>
    </div>
</div>

<!-- Acciones rápidas -->
<div class="quick-actions">
    <h2>Acciones Rápidas</h2>
    <div class="action-buttons">
        <a href="<?= $this->Url->build(['controller' => 'XservReservas', 'action' => 'index']) ?>" class="action-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            <span>Ver Reservas</span>
        </a>
        <a href="<?= $this->Url->build(['controller' => 'XservAsignaciones', 'action' => 'index']) ?>" class="action-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <span>Gestionar Asignaciones</span>
        </a>
        <a href="<?= $this->Url->build(['controller' => 'XservChoferes', 'action' => 'index']) ?>" class="action-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <span>Ver Choferes</span>
        </a>
        <a href="<?= $this->Url->build(['controller' => 'XservVehiculos', 'action' => 'index']) ?>" class="action-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 17h2v2h-2z"/>
                <path d="M9 17H7v2h2z"/>
                <path d="M20 16H4a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2z"/>
            </svg>
            <span>Ver Vehículos</span>
        </a>
    </div>
</div>

<!-- Reservas de hoy -->
<?php if (!empty($reservasHoy)): ?>
<div class="today-reservations">
    <h2>Reservas de Hoy</h2>
    <div class="reservations-list">
        <?php foreach ($reservasHoy as $reserva): ?>
            <div class="reservation-item">
                <div class="reservation-time">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#c9a962" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <?= h($reserva->hora->format('H:i')) ?>
                </div>
                <div class="reservation-info">
                    <div class="reservation-client">
                        Cliente: <?= h($reserva->cliente->usuario->nombre ?? 'N/A') ?>
                    </div>
                    <div class="reservation-service">
                        <?= h($reserva->servicio->nombre ?? 'Servicio') ?>
                    </div>
                    <div class="reservation-route">
                        <?= h($reserva->punto_recogida) ?> → <?= h($reserva->punto_destino) ?>
                    </div>
                </div>
                <div class="reservation-status">
                    <span class="status-badge status-<?= h(strtolower($reserva->estado)) ?>">
                        <?= h(ucfirst($reserva->estado)) ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php else: ?>
<div class="empty-state">
    <svg viewBox="0 0 24 24" fill="none" stroke="#c9a962" stroke-width="2">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
        <line x1="16" y1="2" x2="16" y2="6"/>
        <line x1="8" y1="2" x2="8" y2="6"/>
        <line x1="3" y1="10" x2="21" y2="10"/>
    </svg>
    <p>No hay reservas programadas para hoy</p>
</div>
<?php endif; ?>

<style>
    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        color: var(--text-white);
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }

    .dashboard-header p {
        color: var(--text-gray);
        font-size: 0.95rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--dark-card);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s;
    }

    .stat-card:hover {
        border-color: var(--gold);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon svg {
        width: 24px;
        height: 24px;
    }

    .stat-label {
        color: var(--text-gray);
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        color: var(--text-white);
        font-size: 1.5rem;
        font-weight: 700;
    }

    .quick-actions {
        margin-bottom: 2rem;
    }

    .quick-actions h2 {
        color: var(--text-white);
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .action-btn {
        background: var(--dark-card);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        color: var(--text-white);
        transition: all 0.3s;
    }

    .action-btn:hover {
        background: var(--dark-lighter);
        border-color: var(--gold);
        transform: translateY(-2px);
    }

    .action-btn svg {
        width: 28px;
        height: 28px;
        stroke: var(--gold);
    }

    .action-btn span {
        font-size: 0.9rem;
        text-align: center;
    }

    .today-reservations h2 {
        color: var(--text-white);
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    .reservations-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .reservation-item {
        background: var(--dark-card);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 1rem 1.25rem;
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 1.5rem;
        align-items: center;
        transition: all 0.3s;
    }

    .reservation-item:hover {
        border-color: var(--gold);
    }

    .reservation-time {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        color: var(--gold);
        font-size: 1rem;
    }

    .reservation-time svg {
        width: 18px;
        height: 18px;
    }

    .reservation-client {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-white);
        margin-bottom: 0.25rem;
    }

    .reservation-service {
        font-size: 0.85rem;
        color: var(--gold);
        margin-bottom: 0.25rem;
    }

    .reservation-route {
        font-size: 0.8rem;
        color: var(--text-gray);
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pendiente {
        background: rgba(251, 146, 60, 0.15);
        color: #f59e0b;
    }

    .status-confirmada {
        background: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
    }

    .status-asignada {
        background: rgba(74, 222, 128, 0.15);
        color: #4ade80;
    }

    .empty-state {
        background: var(--dark-card);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 3rem 2rem;
        text-align: center;
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin: 0 auto 1rem;
        opacity: 0.4;
    }

    .empty-state p {
        color: var(--text-gray);
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }

        .reservation-item {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .reservation-status {
            text-align: left;
        }
    }
</style>
