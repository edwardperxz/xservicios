<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservIncidenciaViaje> $xservIncidenciasViaje
 * @var array $filters
 */
$this->assign('header-title', 'Gestion de Incidencias');
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

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge.si {
        background: rgba(74, 222, 128, 0.2);
        color: var(--green);
    }

    .badge.no {
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
</style>

<div class="incidencias-container">
    <div class="page-actions">
        <div></div>
        <a href="/xserv-incidencias-viaje/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nueva Incidencia
        </a>
    </div>

    <div class="filters-card">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="filters-row">
            <div class="filter-group">
                <label class="filter-label">Resuelto</label>
                <div class="filter-buttons">
                    <button type="submit" name="resuelto" value="" class="filter-btn <?= empty($filters['resuelto']) ? 'active' : '' ?>">
                        Todos
                    </button>
                    <button type="submit" name="resuelto" value="1" class="filter-btn <?= ($filters['resuelto'] ?? '') === '1' ? 'active' : '' ?>">
                        Si
                    </button>
                    <button type="submit" name="resuelto" value="0" class="filter-btn <?= ($filters['resuelto'] ?? '') === '0' ? 'active' : '' ?>">
                        No
                    </button>
                </div>
            </div>
            <div class="filter-group">
                <label class="filter-label">Tipo de incidencia</label>
                <select
                    name="tipo_incidencia"
                    class="select-input"
                >
                    <option value="">Todos los tipos</option>
                    <?php foreach ($tiposIncidencia as $tipo): ?>
                    <option value="<?= h($tipo) ?>" <?= ($filters['tipo_incidencia'] ?? '') === $tipo ? 'selected' : '' ?>>
                        <?= h($tipo) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">Severidad</label>
                <select
                    name="severidad"
                    class="select-input"
                >
                    <option value="">Todas las severidades</option>
                    <?php foreach ($severidades as $severidad): ?>
                    <option value="<?= h($severidad) ?>" <?= ($filters['severidad'] ?? '') === $severidad ? 'selected' : '' ?>>
                        <?= h($severidad) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <button type="submit" class="btn btn-secondary">Filtrar</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <div class="data-table-card">
        <?php if (isset($xservIncidenciasViaje) && is_countable($xservIncidenciasViaje) && count($xservIncidenciasViaje) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('ejecucion_id', 'Ejecucion') ?></th>
                    <th><?= $this->Paginator->sort('tipo_incidencia', 'Tipo') ?></th>
                    <th><?= $this->Paginator->sort('severidad', 'Severidad') ?></th>
                    <th><?= $this->Paginator->sort('resuelto', 'Resuelto') ?></th>
                    <th><?= $this->Paginator->sort('created_at', 'Creado') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservIncidenciasViaje as $incidencia): ?>
                <tr>
                    <td><strong><?= h($incidencia->id) ?></strong></td>
                    <td><?= $incidencia->hasValue('ejecucion') ? h($incidencia->ejecucion->id) : 'N/A' ?></td>
                    <td><?= h($incidencia->tipo_incidencia) ?></td>
                    <td><?= h($incidencia->severidad) ?></td>
                    <td>
                        <span class="badge <?= $incidencia->resuelto ? 'si' : 'no' ?>">
                            <?= $incidencia->resuelto ? 'Si' : 'No' ?>
                        </span>
                    </td>
                    <td><?= h($incidencia->created_at) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-incidencias-viaje/view/<?= h($incidencia->id) ?>" class="btn btn-secondary btn-sm">Ver</a>
                            <a href="/xserv-incidencias-viaje/edit/<?= h($incidencia->id) ?>" class="btn btn-secondary btn-sm">Editar</a>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-1.414-1.414L5.636 15.536l1.414 1.414z"></path>
            </svg>
            <p>No se encontraron incidencias</p>
        </div>
        <?php endif; ?>
    </div>
</div>
