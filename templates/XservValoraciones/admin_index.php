<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservValoracion> $xservValoraciones
 * @var array $filters
 */
$this->assign('header-title', 'Gestion de Valoraciones');
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

<div class="valoraciones-container">
    <div class="page-actions">
        <div></div>
        <a href="/xserv-valoraciones/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nueva Valoracion
        </a>
    </div>

    <div class="filters-card">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="filters-row">
            <div class="filter-group">
                <label class="filter-label">Mostrar en web</label>
                <div class="filter-buttons">
                    <button type="submit" name="mostrar_en_web" value="" class="filter-btn <?= empty($filters['mostrar_en_web']) ? 'active' : '' ?>">
                        Todos
                    </button>
                    <button type="submit" name="mostrar_en_web" value="1" class="filter-btn <?= ($filters['mostrar_en_web'] ?? '') === '1' ? 'active' : '' ?>">
                        Si
                    </button>
                    <button type="submit" name="mostrar_en_web" value="0" class="filter-btn <?= ($filters['mostrar_en_web'] ?? '') === '0' ? 'active' : '' ?>">
                        No
                    </button>
                </div>
            </div>
            <div class="filter-group">
                <label class="filter-label">Estado de moderacion</label>
                <select
                    name="estado_moderacion"
                    class="select-input"
                >
                    <option value="">Todos los estados</option>
                    <?php foreach ($estadosModeracion as $estado): ?>
                    <option value="<?= h($estado) ?>" <?= ($filters['estado_moderacion'] ?? '') === $estado ? 'selected' : '' ?>>
                        <?= h($estado) ?>
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
        <?php if (isset($xservValoraciones) && is_countable($xservValoraciones) && count($xservValoraciones) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('reserva_id', 'Reserva') ?></th>
                    <th><?= $this->Paginator->sort('calificacion', 'Calificacion') ?></th>
                    <th><?= $this->Paginator->sort('puntuacion_limpieza', 'Limpieza') ?></th>
                    <th><?= $this->Paginator->sort('puntuacion_puntualidad', 'Puntualidad') ?></th>
                    <th><?= $this->Paginator->sort('mostrar_en_web', 'Web') ?></th>
                    <th><?= $this->Paginator->sort('estado_moderacion', 'Moderacion') ?></th>
                    <th><?= $this->Paginator->sort('created_at', 'Creado') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservValoraciones as $valoracion): ?>
                <tr>
                    <td><strong><?= h($valoracion->id) ?></strong></td>
                    <td><?= $valoracion->hasValue('xserv_reserva') ? h($valoracion->xserv_reserva->codigo_reserva) : 'N/A' ?></td>
                    <td><?= h($valoracion->calificacion) ?></td>
                    <td><?= h($valoracion->puntuacion_limpieza) ?></td>
                    <td><?= h($valoracion->puntuacion_puntualidad) ?></td>
                    <td>
                        <span class="badge <?= $valoracion->mostrar_en_web ? 'si' : 'no' ?>">
                            <?= $valoracion->mostrar_en_web ? 'Si' : 'No' ?>
                        </span>
                    </td>
                    <td><?= h($valoracion->estado_moderacion) ?></td>
                    <td><?= h($valoracion->created_at) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-valoraciones/view/<?= h($valoracion->id) ?>" class="btn btn-secondary btn-sm">Ver</a>
                            <a href="/xserv-valoraciones/edit/<?= h($valoracion->id) ?>" class="btn btn-secondary btn-sm">Editar</a>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <p>No se encontraron valoraciones</p>
        </div>
        <?php endif; ?>
    </div>
</div>
