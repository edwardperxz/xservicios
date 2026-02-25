<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservServicio> $xservServicios
 * @var array $filters
 */
$this->assign('header-title', 'Gestión de Servicios');
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

    .badge.activo {
        background: rgba(74, 222, 128, 0.2);
        color: var(--green);
    }

    .badge.inactivo {
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

    .description {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: var(--text-gray);
        font-size: 0.875rem;
    }
</style>

<div class="servicios-container">
    <!-- Page Actions -->
    <div class="page-actions">
        <div></div>
        <a href="/xserv-servicios/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Servicio
        </a>
    </div>

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
                    <button type="submit" name="estado" value="activo" class="filter-btn <?= ($filters['estado'] ?? '') === 'activo' ? 'active' : '' ?>">
                        Activos
                    </button>
                    <button type="submit" name="estado" value="inactivo" class="filter-btn <?= ($filters['estado'] ?? '') === 'inactivo' ? 'active' : '' ?>">
                        Inactivos
                    </button>
                </div>
            </div>

            <!-- Búsqueda -->
            <div class="filter-group">
                <label class="filter-label">Buscar servicio</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input 
                        type="text" 
                        name="nombre" 
                        class="search-input" 
                        placeholder="Nombre del servicio..." 
                        value="<?= h($filters['nombre'] ?? '') ?>"
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
        <?php if (isset($xservServicios) && is_countable($xservServicios) && count($xservServicios) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('nombre', 'Servicio') ?></th>
                    <th>Descripción</th>
                    <th><?= $this->Paginator->sort('precio_base', 'Precio Base') ?></th>
                    <th><?= $this->Paginator->sort('estado', 'Estado') ?></th>
                    <th><?= $this->Paginator->sort('created_at', 'Creado') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservServicios as $servicio): ?>
                <tr>
                    <td><strong><?= h($servicio->id) ?></strong></td>
                    <td><?= h($servicio->nombre) ?></td>
                    <td><span class="description"><?= h($servicio->descripcion_es) ?></span></td>
                    <td><strong>$<?= h(number_format((float)$servicio->precio_base, 2)) ?></strong></td>
                    <td><span class="badge <?= h($servicio->estado) ?>"><?= h(ucfirst($servicio->estado)) ?></span></td>
                    <td><?= h($servicio->created_at->format('d/m/Y')) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-servicios/view/<?= h($servicio->id) ?>" class="btn btn-secondary btn-sm">
                                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Ver
                            </a>
                            <a href="/xserv-servicios/edit/<?= h($servicio->id) ?>" class="btn btn-secondary btn-sm">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <p>No se encontraron servicios</p>
        </div>
        <?php endif; ?>
    </div>
</div>
