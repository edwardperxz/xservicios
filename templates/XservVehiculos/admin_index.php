<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservVehiculo> $xservVehiculos
 * @var array $filters
 */
$this->assign('header-title', 'Gestión de Flota');
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

    .badge.disponible {
        background: rgba(74, 222, 128, 0.2);
        color: var(--green);
    }

    .badge.mantenimiento {
        background: rgba(245, 158, 11, 0.2);
        color: var(--orange);
    }

    .badge.asignado {
        background: rgba(59, 130, 246, 0.2);
        color: var(--blue);
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
</style>

<div class="vehiculos-container">
    <!-- Page Actions -->
    <div class="page-actions">
        <div></div>
        <a href="/xserv-vehiculos/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Vehículo
        </a>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="filters-row">
            <!-- Filtro por Tipo -->
            <div class="filter-group">
                <label class="filter-label">Tipo de Vehículo</label>
                <div class="filter-buttons">
                    <button type="submit" name="tipo" value="" class="filter-btn <?= empty($filters['tipo']) ? 'active' : '' ?>">
                        Todos
                    </button>
                    <button type="submit" name="tipo" value="coaster" class="filter-btn <?= ($filters['tipo'] ?? '') === 'coaster' ? 'active' : '' ?>">
                        Coaster
                    </button>
                    <button type="submit" name="tipo" value="bus_15" class="filter-btn <?= ($filters['tipo'] ?? '') === 'bus_15' ? 'active' : '' ?>">
                        Bus 15
                    </button>
                </div>
            </div>

            <!-- Filtro por Estado Operativo -->
            <div class="filter-group">
                <label class="filter-label">Estado</label>
                <div class="filter-buttons">
                    <button type="submit" name="estado_operativo" value="" class="filter-btn <?= empty($filters['estado_operativo']) ? 'active' : '' ?>">
                        Todos
                    </button>
                    <button type="submit" name="estado_operativo" value="disponible" class="filter-btn <?= ($filters['estado_operativo'] ?? '') === 'disponible' ? 'active' : '' ?>">
                        Disponible
                    </button>
                    <button type="submit" name="estado_operativo" value="asignado" class="filter-btn <?= ($filters['estado_operativo'] ?? '') === 'asignado' ? 'active' : '' ?>">
                        Asignado
                    </button>
                    <button type="submit" name="estado_operativo" value="mantenimiento" class="filter-btn <?= ($filters['estado_operativo'] ?? '') === 'mantenimiento' ? 'active' : '' ?>">
                        Mantenimiento
                    </button>
                </div>
            </div>

            <!-- Búsqueda -->
            <div class="filter-group">
                <label class="filter-label">Buscar vehículo</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input 
                        type="text" 
                        name="placa" 
                        class="search-input" 
                        placeholder="Placa o nombre..." 
                        value="<?= h($filters['placa'] ?? '') ?>"
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
        <?php if (isset($xservVehiculos) && is_countable($xservVehiculos) && count($xservVehiculos) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('nombre_unidad', 'Nombre') ?></th>
                    <th><?= $this->Paginator->sort('tipo', 'Tipo') ?></th>
                    <th><?= $this->Paginator->sort('placa', 'Placa') ?></th>
                    <th><?= $this->Paginator->sort('capacidad_max', 'Capacidad') ?></th>
                    <th><?= $this->Paginator->sort('estado_operativo', 'Estado') ?></th>
                    <th><?= $this->Paginator->sort('kilometraje_actual', 'KM') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservVehiculos as $vehiculo): ?>
                <tr>
                    <td><strong><?= h($vehiculo->id) ?></strong></td>
                    <td><?= h($vehiculo->nombre_unidad ?? '-') ?></td>
                    <td><?= h(ucfirst($vehiculo->tipo)) ?></td>
                    <td><strong><?= h($vehiculo->placa) ?></strong></td>
                    <td><?= h($vehiculo->capacidad_max) ?> personas</td>
                    <td><span class="badge <?= h($vehiculo->estado_operativo) ?>"><?= h(ucfirst(str_replace('_', ' ', $vehiculo->estado_operativo))) ?></span></td>
                    <td><?= h($vehiculo->kilometraje_actual ?? 0) ?> km</td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-vehiculos/view/<?= h($vehiculo->id) ?>" class="btn btn-secondary btn-sm">
                                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Ver
                            </a>
                            <a href="/xserv-vehiculos/edit/<?= h($vehiculo->id) ?>" class="btn btn-secondary btn-sm">
                                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Editar
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
            </svg>
            <p>No se encontraron vehículos</p>
        </div>
        <?php endif; ?>
    </div>
</div>
