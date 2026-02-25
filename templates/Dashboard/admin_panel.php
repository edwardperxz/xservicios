<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $user
 */
$this->assign('header-title', 'Dashboard');
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
        align-items: center;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon.gold {
        background: rgba(201, 169, 98, 0.2);
        color: var(--gold);
    }

    .stat-icon.green {
        background: rgba(74, 222, 128, 0.2);
        color: var(--green);
    }

    .stat-icon.blue {
        background: rgba(59, 130, 246, 0.2);
        color: var(--blue);
    }

    .stat-icon.orange {
        background: rgba(245, 158, 11, 0.2);
        color: var(--orange);
    }

    .stat-icon svg {
        width: 24px;
        height: 24px;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-gray);
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-white);
        margin-bottom: 0.5rem;
    }

    .stat-change {
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .stat-change.positive {
        color: var(--green);
    }

    .stat-change.negative {
        color: var(--red);
    }

    .section-card {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--dark-lighter);
        margin-bottom: 2rem;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-white);
    }

    .btn-link {
        color: var(--gold);
        text-decoration: none;
        font-size: 0.875rem;
        transition: color 0.2s;
    }

    .btn-link:hover {
        color: var(--gold-light);
    }

    .status-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
    }

    .status-item {
        text-align: center;
        padding: 1rem;
        background: var(--dark-lighter);
        border-radius: 8px;
    }

    .status-count {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .status-label {
        font-size: 0.75rem;
        color: var(--text-gray);
        text-transform: uppercase;
    }

    .reservas-table {
        width: 100%;
        border-collapse: collapse;
    }

    .reservas-table th {
        text-align: left;
        padding: 0.75rem;
        border-bottom: 1px solid var(--dark-lighter);
        color: var(--text-gray);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .reservas-table td {
        padding: 0.75rem;
        border-bottom: 1px solid var(--dark-lighter);
        font-size: 0.875rem;
    }

    .reservas-table tr:hover {
        background: var(--dark-lighter);
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge.pendiente {
        background: rgba(245, 158, 11, 0.2);
        color: var(--orange);
    }

    .badge.confirmada {
        background: rgba(59, 130, 246, 0.2);
        color: var(--blue);
    }

    .badge.asignada {
        background: rgba(168, 85, 247, 0.2);
        color: #a855f7;
    }

    .badge.en-ejecucion {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
    }

    .badge.completada {
        background: rgba(74, 222, 128, 0.2);
        color: var(--green);
    }

    .badge.cancelada {
        background: rgba(239, 68, 68, 0.2);
        color: var(--red);
    }

    .alert-box {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--dark-lighter);
        border-radius: 8px;
        margin-bottom: 0.75rem;
    }

    .alert-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .alert-icon.warning {
        background: rgba(245, 158, 11, 0.2);
        color: var(--orange);
    }

    .alert-icon.danger {
        background: rgba(239, 68, 68, 0.2);
        color: var(--red);
    }

    .alert-content {
        flex: 1;
    }

    .alert-title {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .alert-text {
        font-size: 0.875rem;
        color: var(--text-gray);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-gray);
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>

<div class="dashboard-container">
    <!-- KPI Cards -->
    <div class="dashboard-grid">
        <!-- Reservas Hoy -->
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon gold">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-label">Reservas Hoy</div>
            <div class="stat-value"><?= h($reservasHoy) ?></div>
            <div class="stat-change">
                <span>Esta semana: <?= h($reservasSemana) ?></span>
            </div>
        </div>

        <!-- Reservas Mes -->
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-label">Reservas Este Mes</div>
            <div class="stat-value"><?= h($reservasMes) ?></div>
            <div class="stat-change">
                <span>Servicios completados: <?= h($serviciosCompletados) ?></span>
            </div>
        </div>

        <!-- Ocupación Flota -->
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-label">Ocupación de Flota</div>
            <div class="stat-value"><?= h($tasaOcupacion) ?>%</div>
            <div class="stat-change">
                <span><?= h($vehiculosAsignados) ?> de <?= h($totalVehiculos) ?> asignados</span>
            </div>
        </div>

        <!-- Calificación Promedio -->
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-icon orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-label">Calificación Promedio</div>
            <div class="stat-value"><?= h($calificacionPromedio) ?> <span style="font-size: 1rem; color: var(--text-gray);">/ 5.0</span></div>
            <div class="stat-change">
                <span>Basado en valoraciones</span>
            </div>
        </div>
    </div>

    <!-- Reservas por Estado -->
    <div class="section-card">
        <div class="section-header">
            <h2 class="section-title">Estado de Reservas</h2>
            <a href="/xserv-reservas" class="btn-link">Ver todas →</a>
        </div>
        <div class="status-grid">
            <?php 
            $estadosDefault = ['pendiente' => 0, 'confirmada' => 0, 'asignada' => 0, 'en_ejecucion' => 0, 'completada' => 0, 'cancelada' => 0];
            foreach ($reservasPorEstado as $item):
                $estadosDefault[$item->estado] = $item->total;
            endforeach;
            ?>
            <?php foreach ($estadosDefault as $estado => $total): ?>
            <div class="status-item">
                <div class="status-count"><?= h($total) ?></div>
                <div class="status-label"><?= h(ucfirst(str_replace('_', ' ', $estado))) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Alertas -->
    <?php if ($incidenciasAbiertas > 0 || $vehiculosMantenimiento > 0): ?>
    <div class="section-card">
        <div class="section-header">
            <h2 class="section-title">Alertas</h2>
        </div>
        
        <?php if ($incidenciasAbiertas > 0): ?>
        <div class="alert-box">
            <div class="alert-icon danger">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 24px; height: 24px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div class="alert-content">
                <div class="alert-title">Incidencias Abiertas</div>
                <div class="alert-text">Hay <?= h($incidenciasAbiertas) ?> incidencia(s) que requieren atención</div>
            </div>
            <a href="/xserv-incidencias-viaje" class="btn-link">Ver →</a>
        </div>
        <?php endif; ?>

        <?php if ($vehiculosMantenimiento > 0): ?>
        <div class="alert-box">
            <div class="alert-icon warning">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 24px; height: 24px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div class="alert-content">
                <div class="alert-title">Vehículos en Mantenimiento</div>
                <div class="alert-text"><?= h($vehiculosMantenimiento) ?> vehículo(s) no disponibles</div>
            </div>
            <a href="/xserv-vehiculos" class="btn-link">Ver →</a>
        </div>
        <?php endif; ?>

        <div class="alert-box">
            <div class="alert-icon green">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 24px; height: 24px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="alert-content">
                <div class="alert-title">Choferes Disponibles</div>
                <div class="alert-text"><?= h($choferesDisponibles) ?> chofer(es) disponibles para asignación</div>
            </div>
            <a href="/xserv-choferes" class="btn-link">Ver →</a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Próximas Reservas -->
    <div class="section-card">
        <div class="section-header">
            <h2 class="section-title">Próximas Reservas</h2>
            <a href="/xserv-reservas" class="btn-link">Ver todas →</a>
        </div>
        
        <?php if (count($proximasReservas) > 0): ?>
        <table class="reservas-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Fecha y Hora</th>
                    <th>Pasajeros</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proximasReservas as $reserva): ?>
                <tr>
                    <td><strong><?= h($reserva->codigo_reserva) ?></strong></td>
                    <td><?= h($reserva->cliente->nombre ?? 'N/A') ?></td>
                    <td><?= h($reserva->servicio->nombre ?? 'N/A') ?></td>
                    <td><?= h($reserva->fecha->format('d/m/Y')) ?> <?= h($reserva->hora->format('H:i')) ?></td>
                    <td><?= h($reserva->pasajeros) ?></td>
                    <td><span class="badge <?= h(str_replace('_', '-', $reserva->estado)) ?>"><?= h(ucfirst($reserva->estado)) ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p>No hay reservas próximas</p>
        </div>
        <?php endif; ?>
    </div>
</div>
