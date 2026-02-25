<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservUbicacion> $xservUbicaciones
 * @var array $filters
 */
$this->assign('header-title', 'Gestion de Ubicaciones');
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
        min-width: 220px;
    }

    .filter-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-gray);
        font-size: 0.875rem;
        font-weight: 500;
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

    .select-input {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--dark-lighter);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        color: var(--text-white);
        font-size: 0.875rem;
    }

    .select-input:focus {
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
        font-size: 0.875rem;
    }

    .data-table tbody tr:hover {
        background: rgba(201, 169, 98, 0.05);
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

<div class="ubicaciones-container">
    <div class="page-actions">
        <div></div>
        <a href="/xserv-ubicaciones/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nueva Ubicacion
        </a>
    </div>

    <div class="filters-card">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="filters-row">
            <div class="filter-group">
                <label class="filter-label">Buscar por nombre</label>
                <input
                    type="text"
                    name="nombre"
                    class="search-input"
                    placeholder="Nombre de ubicacion..."
                    value="<?= h($filters['nombre'] ?? '') ?>"
                >
            </div>
            <div class="filter-group">
                <label class="filter-label">Provincia</label>
                <select
                    name="EN_PROVINCIAS"
                    class="select-input"
                >
                    <option value="">Todas las provincias</option>
                    <?php foreach ($provincias as $provincia): ?>
                    <option value="<?= h($provincia) ?>" <?= ($filters['EN_PROVINCIAS'] ?? '') === $provincia ? 'selected' : '' ?>>
                        <?= h($provincia) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <button type="submit" class="btn btn-secondary">Buscar</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <div class="data-table-card">
        <?php if (isset($xservUbicaciones) && is_countable($xservUbicaciones) && count($xservUbicaciones) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('nombre', 'Nombre') ?></th>
                    <th><?= $this->Paginator->sort('EN_PROVINCIAS', 'Provincia') ?></th>
                    <th><?= $this->Paginator->sort('direccion_gps', 'Direccion GPS') ?></th>
                    <th><?= $this->Paginator->sort('created_at', 'Creado') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservUbicaciones as $ubicacion): ?>
                <tr>
                    <td><strong><?= h($ubicacion->id) ?></strong></td>
                    <td><?= h($ubicacion->nombre) ?></td>
                    <td><?= h($ubicacion->EN_PROVINCIAS) ?></td>
                    <td><?= h($ubicacion->direccion_gps) ?></td>
                    <td><?= h($ubicacion->created_at) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-ubicaciones/view/<?= h($ubicacion->id) ?>" class="btn btn-secondary btn-sm">Ver</a>
                            <a href="/xserv-ubicaciones/edit/<?= h($ubicacion->id) ?>" class="btn btn-secondary btn-sm">Editar</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8"></path>
            </svg>
            <p>No se encontraron ubicaciones</p>
        </div>
        <?php endif; ?>
    </div>
</div>
