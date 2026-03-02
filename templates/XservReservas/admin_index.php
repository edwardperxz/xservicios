<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservReserva> $xservReservas
 * @var array $filters
 */
$this->assign('header-title', 'Gestión de Reservaciones');
?>

<style>
    .page-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
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

    .btn-primary {
        background: var(--gold);
        color: var(--dark-bg);
    }

    .btn-primary:hover {
        background: var(--gold-light);
    }

    .btn-secondary {
        background: var(--dark-lighter);
        color: var(--text-white);
        border: 1px solid var(--text-gray);
    }

    .btn-secondary:hover {
        background: var(--dark-card);
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.75rem;
    }

    .filters-card {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--dark-lighter);
        margin-bottom: 2rem;
    }

    .filters-row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-gray);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .filter-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        background: var(--dark-lighter);
        color: var(--text-gray);
        border: 1px solid var(--dark-lighter);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.875rem;
    }

    .filter-btn.active {
        background: var(--gold);
        color: var(--dark-bg);
        border-color: var(--gold);
    }

    .filter-btn:hover {
        border-color: var(--gold);
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--dark-lighter);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        color: var(--text-white);
        font-size: 0.875rem;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--gold);
    }

    .data-table-card {
        background: var(--dark-card);
        border-radius: 12px;
        border: 1px solid var(--dark-lighter);
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: var(--dark-lighter);
    }

    .data-table th {
        padding: 1rem;
        text-align: left;
        color: var(--text-gray);
        font-weight: 600;
        font-size: 0.875rem;
        border-bottom: 1px solid var(--dark-lighter);
    }

    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--dark-lighter);
        color: var(--text-white);
    }

    .data-table tbody tr:hover {
        background: rgba(201, 169, 98, 0.05);
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
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
        background: rgba(168, 139, 74, 0.2);
        color: var(--gold);
    }

    .badge.completada {
        background: rgba(74, 222, 128, 0.2);
        color: var(--green);
    }

    .badge.cancelada {
        background: rgba(239, 68, 68, 0.2);
        color: var(--red);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        padding: 1.5rem;
        list-style: none;
    }

    .pagination li {
        list-style: none;
    }

    .pagination a,
    .pagination span {
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
    }

    .pagination .disabled span {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-gray);
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .icon-sm {
        width: 16px;
        height: 16px;
    }

    .price {
        color: var(--gold);
        font-weight: 600;
    }
</style>

<div class="reservas-container">
    <!-- Filters -->
    <div class="filters-card">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="filters-row">
            <!-- Filtro por Estado -->
            <div class="filter-group">
                <label class="filter-label">Estado</label>
                <div class="filter-buttons">
                    <button type="submit" name="estado" value="" class="filter-btn <?= empty($filters['estado']) ? 'active' : '' ?>">
                        Todos
                    </button>
                    <button type="submit" name="estado" value="pendiente" class="filter-btn <?= ($filters['estado'] ?? '') === 'pendiente' ? 'active' : '' ?>">
                        Pendiente
                    </button>
                    <button type="submit" name="estado" value="confirmada" class="filter-btn <?= ($filters['estado'] ?? '') === 'confirmada' ? 'active' : '' ?>">
                        Confirmada
                    </button>
                    <button type="submit" name="estado" value="asignada" class="filter-btn <?= ($filters['estado'] ?? '') === 'asignada' ? 'active' : '' ?>">
                        Asignada
                    </button>
                    <button type="submit" name="estado" value="completada" class="filter-btn <?= ($filters['estado'] ?? '') === 'completada' ? 'active' : '' ?>">
                        Completada
                    </button>
                </div>
            </div>

            <!-- Búsqueda -->
            <div class="filter-group">
                <label class="filter-label">Buscar reserva</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input 
                        type="text" 
                        name="codigo" 
                        class="search-input" 
                        placeholder="Código de reserva..." 
                        value="<?= h($filters['codigo'] ?? '') ?>"
                    >
                    <button type="submit" class="btn btn-secondary">
                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Buscar
                    </button>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <!-- Data Table -->
    <div class="data-table-card">
        <?php if (isset($xservReservas) && is_countable($xservReservas) && count($xservReservas) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('codigo_reserva', 'Código') ?></th>
                    <th><?= $this->Paginator->sort('cliente_id', 'Cliente') ?></th>
                    <th><?= $this->Paginator->sort('servicio_id', 'Servicio') ?></th>
                    <th><?= $this->Paginator->sort('fecha', 'Fecha') ?></th>
                    <th><?= $this->Paginator->sort('hora', 'Hora') ?></th>
                    <th><?= $this->Paginator->sort('pasajeros', 'Pasajeros') ?></th>
                    <th>Total</th>
                    <th><?= $this->Paginator->sort('estado', 'Estado') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservReservas as $reserva): ?>
                <tr>
                    <td><strong><?= h($reserva->codigo_reserva) ?></strong></td>
                    <td><?= h($reserva->cliente?->usuario?->nombre ?? $reserva->cliente?->usuario?->username ?? 'N/A') ?></td>
                    <td><?= h($reserva->servicio->nombre ?? 'N/A') ?></td>
                    <td><?= h($reserva->fecha->format('d/m/Y')) ?></td>
                    <td><?= h($reserva->hora->format('H:i')) ?></td>
                    <td><?= h($reserva->pasajeros) ?></td>
                    <td><span class="price">$<?= h(number_format((float)$reserva->precio_pactado + (float)($reserva->itbms_pactado ?? 0), 2)) ?></span></td>
                    <td><span class="badge <?= h(str_replace('_', '-', $reserva->estado)) ?>"><?= h(ucfirst($reserva->estado)) ?></span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-reservas/view/<?= h($reserva->id) ?>" class="btn btn-secondary btn-sm">
                                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Ver
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?= $this->Paginator->first('«') ?>
            <?= $this->Paginator->prev('‹') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('›') ?>
            <?= $this->Paginator->last('»') ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p>No se encontraron reservaciones</p>
        </div>
        <?php endif; ?>
    </div>
</div>
