<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservEjecucionViaje> $xservEjecucionViajes
 * @var array $filters
 */
$this->assign('header-title', 'Control Operativo');
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

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
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

    .info-text {
        color: var(--text-gray);
    }
</style>

<div class="ejecucion-container">
    <div class="page-actions">
        <div></div>
        <a href="/xserv-ejecucion-viajes/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Registro
        </a>
    </div>

    <div class="filters-card">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="filters-row">
            <div class="filter-group">
                <label class="filter-label">Estado de ejecucion</label>
                <select
                    name="estado_ejecucion"
                    class="select-input"
                >
                    <option value="">Todos los estados</option>
                    <?php foreach ($estados as $estado): ?>
                    <option value="<?= h($estado) ?>" <?= ($filters['estado_ejecucion'] ?? '') === $estado ? 'selected' : '' ?>>
                        <?= h($estado) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">Asignacion</label>
                <select
                    name="asignacion_id"
                    class="select-input"
                >
                    <option value="">Todas las asignaciones</option>
                    <?php foreach ($asignaciones as $id => $nombre): ?>
                    <option value="<?= h($id) ?>" <?= ($filters['asignacion_id'] ?? '') == $id ? 'selected' : '' ?>>
                        <?= h($nombre) ?>
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
        <?php if (isset($xservEjecucionViajes) && is_countable($xservEjecucionViajes) && count($xservEjecucionViajes) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('asignacion_id', 'Asignacion') ?></th>
                    <th><?= $this->Paginator->sort('estado_ejecucion', 'Estado') ?></th>
                    <th><?= $this->Paginator->sort('hora_inicio_real', 'Inicio') ?></th>
                    <th><?= $this->Paginator->sort('hora_fin_real', 'Fin') ?></th>
                    <th><?= $this->Paginator->sort('km_inicio', 'KM Inicio') ?></th>
                    <th><?= $this->Paginator->sort('km_fin', 'KM Fin') ?></th>
                    <th><?= $this->Paginator->sort('created_at', 'Creado') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservEjecucionViajes as $ejecucion): ?>
                <tr>
                    <td><strong><?= h($ejecucion->id) ?></strong></td>
                    <td>
                        <?= $ejecucion->hasValue('asignacion') ? h($ejecucion->asignacion->id) : 'N/A' ?>
                    </td>
                    <td><span class="badge"><?= h($ejecucion->estado_ejecucion) ?></span></td>
                    <td><span class="info-text"><?= h($ejecucion->hora_inicio_real) ?></span></td>
                    <td><span class="info-text"><?= h($ejecucion->hora_fin_real) ?></span></td>
                    <td><?= h($ejecucion->km_inicio) ?></td>
                    <td><?= h($ejecucion->km_fin) ?></td>
                    <td><?= h($ejecucion->created_at) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-ejecucion-viajes/view/<?= h($ejecucion->id) ?>" class="btn btn-secondary btn-sm">Ver</a>
                            <a href="/xserv-ejecucion-viajes/edit/<?= h($ejecucion->id) ?>" class="btn btn-secondary btn-sm">Editar</a>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"></path>
            </svg>
            <p>No se encontraron registros de ejecucion</p>
        </div>
        <?php endif; ?>
    </div>
</div>
