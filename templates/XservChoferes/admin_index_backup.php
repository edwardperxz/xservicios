<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservChofer> $xservChoferes
 * @var array $filters
 */
$this->assign('header-title', 'Gestión de Choferes');
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

    .badge.disponible {
        background: rgba(74, 222, 128, 0.2);
        color: var(--green);
    }

    .badge.asignado {
        background: rgba(59, 130, 246, 0.2);
        color: var(--blue);
    }

    .badge.no_disponible {
        background: rgba(245, 158, 11, 0.2);
        color: var(--orange);
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

<div class="choferes-container">
    <!-- Page Actions -->
    <div class="page-actions">
        <div></div>
        <a href="/xserv-choferes/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Chofer
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
                        Activo
                    </button>
                    <button type="submit" name="estado" value="inactivo" class="filter-btn <?= ($filters['estado'] ?? '') === 'inactivo' ? 'active' : '' ?>">
                        Inactivo
                    </button>
                </div>
            </div>

            <!-- Filtro por Disponibilidad -->
            <div class="filter-group">
                <label class="filter-label">Disponibilidad</label>
                <div class="filter-buttons">
                    <button type="submit" name="disponibilidad" value="" class="filter-btn <?= empty($filters['disponibilidad']) ? 'active' : '' ?>">
                        Todos
                    </button>
                    <button type="submit" name="disponibilidad" value="disponible" class="filter-btn <?= ($filters['disponibilidad'] ?? '') === 'disponible' ? 'active' : '' ?>">
                        Disponible
                    </button>
                    <button type="submit" name="disponibilidad" value="asignado" class="filter-btn <?= ($filters['disponibilidad'] ?? '') === 'asignado' ? 'active' : '' ?>">
                        Asignado
                    </button>
                </div>
            </div>

            <!-- Búsqueda -->
            <div class="filter-group">
                <label class="filter-label">Buscar chofer</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input 
                        type="text" 
                        name="nombre" 
                        class="search-input" 
                        placeholder="Nombre o usuario..." 
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
        <?php if (isset($xservChoferes) && is_countable($xservChoferes) && count($xservChoferes) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('usuario_id', 'Nombre') ?></th>
                    <th><?= $this->Paginator->sort('usuario_id', 'Usuario') ?></th>
                    <th><?= $this->Paginator->sort('estado', 'Estado') ?></th>
                    <th><?= $this->Paginator->sort('disponibilidad', 'Disponibilidad') ?></th>
                    <th><?= $this->Paginator->sort('fecha_ingreso', 'Desde') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservChoferes as $chofer): ?>
                <tr>
                    <td><strong><?= h($chofer->id) ?></strong></td>
                    <td><?= $chofer->hasValue('usuario') ? h($chofer->usuario->nombre) : '—' ?></td>
                    <td><?= $chofer->hasValue('usuario') ? h($chofer->usuario->username) : '—' ?></td>
                    <td><span class="badge <?= h($chofer->estado) ?>"><?= h(ucfirst($chofer->estado)) ?></span></td>
                    <td><span class="badge <?= h($chofer->disponibilidad) ?>"><?= h(ucfirst(str_replace('_', ' ', $chofer->disponibilidad))) ?></span></td>
                    <td><?= h($chofer->fecha_ingreso) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-choferes/view/<?= h($chofer->id) ?>" class="btn btn-secondary btn-sm">
                                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Ver
                            </a>
                            <a href="/xserv-choferes/edit/<?= h($chofer->id) ?>" class="btn btn-secondary btn-sm">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a3 3 0 11-6 0 3 3 0 016 0zM6 20h12v-2a9 9 0 00-12 0v2z"></path>
            </svg>
            <p>No se encontraron choferes</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    :root {
        --gold: #c9a962;
        --gold-light: #d4b978;
        --dark-bg: #0a0a0a;
        --dark-card: #1a1a1a;
        --dark-lighter: #2a2a2a;
        --text-white: #ffffff;
        --text-gray: #a0a0a0;
        --red: #ef4444;
        --green: #4ade80;
        --blue: #3b82f6;
    }

    body { background: var(--dark-bg); color: var(--text-white); }
    
    .choferes-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    .page-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
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
        white-space: nowrap;
    }

    .btn-primary {
        background: var(--gold);
        color: var(--dark-bg);
    }

    .btn-primary:hover {
        background: var(--gold-light);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 169, 98, 0.2);
    }

    .btn-secondary {
        background: var(--dark-lighter);
        color: var(--text-white);
        border: 1px solid var(--text-gray);
    }

    .btn-secondary:hover {
        background: var(--dark-card);
        border-color: var(--gold);
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
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-gray);
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
        font-size: 0.75rem;
        white-space: nowrap;
    }

    .filter-btn.active {
        background: var(--gold);
        color: var(--dark-bg);
        border-color: var(--gold);
        font-weight: 600;
    }

    .filter-btn:hover {
        border-color: var(--gold);
        transform: translateY(-1px);
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--dark-lighter);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        color: var(--text-white);
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--gold);
        background: var(--dark-bg);
        box-shadow: 0 0 0 3px rgba(201, 169, 98, 0.1);
    }

    .search-row {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 0.5rem;
        align-items: flex-end;
    }

    .data-table-card {
        background: var(--dark-card);
        border-radius: 12px;
        border: 1px solid var(--dark-lighter);
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: linear-gradient(135deg, var(--dark-lighter) 0%, var(--dark-card) 100%);
        border-bottom: 2px solid var(--gold);
    }

    .data-table th {
        padding: 1rem;
        text-align: left;
        color: var(--text-white);
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--dark-lighter);
        color: var(--text-white);
    }

    .data-table tbody tr {
        transition: all 0.2s;
    }

    .data-table tbody tr:hover {
        background: rgba(201, 169, 98, 0.05);
        transform: scale(1.01);
        box-shadow: inset 0 0 0 1px rgba(201, 169, 98, 0.2);
    }

    .badge {
        display: inline-block;
        padding: 0.35rem 0.85rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .badge.disponible {
        background: rgba(74, 222, 128, 0.15);
        color: #4ade80;
        border: 1px solid rgba(74, 222, 128, 0.3);
    }

    .badge.no_disponible {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .badge.asignado {
        background: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .badge.activo {
        background: rgba(74, 222, 128, 0.15);
        color: #4ade80;
        border: 1px solid rgba(74, 222, 128, 0.3);
    }

    .badge.inactivo {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        background: var(--dark-lighter);
        color: var(--text-white);
        border: 1px solid var(--text-gray);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.75rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .btn-action:hover {
        background: var(--blue);
        border-color: var(--blue);
        color: var(--text-white);
    }

    .btn-action.delete:hover {
        background: var(--red);
        border-color: var(--red);
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        padding: 1.5rem;
        list-style: none;
        flex-wrap: wrap;
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
        transform: translateY(-2px);
    }

    .pagination .active a {
        background: var(--gold);
        color: var(--dark-bg);
        font-weight: 600;
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
        display: inline-block;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gold);
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--text-gray);
        margin-top: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    @media (max-width: 1024px) {
        .choferes-container { padding: 1rem; }
        .filters-row { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); }
        .data-table { font-size: 0.875rem; }
        .data-table th, .data-table td { padding: 0.75rem 0.5rem; }
    }

    @media (max-width: 768px) {
        .choferes-container { padding: 0.75rem; }
        .page-actions { flex-direction: column-reverse; align-items: stretch; }
        .btn { width: 100%; justify-content: center; }
        .filters-card { padding: 1rem; }
        .filters-row { grid-template-columns: 1fr; gap: 1rem; }
        .search-row { grid-template-columns: 1fr; }
        .search-row .btn { margin-top: 0.5rem; }
        
        .data-table {
            font-size: 0.75rem;
            display: block;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .data-table th, .data-table td { 
            padding: 0.75rem; 
        }

        .data-table th:nth-child(n+4),
        .data-table td:nth-child(n+4) {
            display: none;
        }

        .action-buttons { flex-direction: column; gap: 0.25rem; }
        .btn-action { width: 100%; justify-content: center; }
        
        .stats-row { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 480px) {
        .choferes-container { padding: 0.5rem; }
        .filters-card { padding: 0.75rem; }
        .data-table th, .data-table td { padding: 0.5rem; }
        .badge { font-size: 0.65rem; padding: 0.25rem 0.5rem; }
        .btn { padding: 0.5rem 1rem; font-size: 0.75rem; }
        .stats-row { grid-template-columns: 1fr; }
        .filter-buttons { gap: 0.25rem; }
        .filter-btn { padding: 0.4rem 0.75rem; font-size: 0.7rem; }
    }
</style>

<div class="choferes-container">
    <!-- Estadísticas -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-number"><?= isset($xservChoferes) && is_countable($xservChoferes) ? count($xservChoferes) : 0 ?></div>
            <div class="stat-label">En esta Página</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= h($this->Paginator->total() ?? 0) ?></div>
            <div class="stat-label">Total de Choferes</div>
        </div>
    </div>

    <!-- Page Actions -->
    <div class="page-actions">
        <div></div>
        <a href="/xserv-choferes/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Chofer
        </a>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <?= $this->Form->create(null, ['type' => 'get', 'id' => 'filter-form']) ?>
        <div class="filters-row">
            <!-- Filtro por Disponibilidad -->
            <div class="filter-group">
                <label class="filter-label">Disponibilidad</label>
                <div class="filter-buttons">
                    <button type="submit" name="disponibilidad" value="" class="filter-btn <?= empty($filters['disponibilidad']) ? 'active' : '' ?>">
                        Todos
                    </button>
                    <button type="submit" name="disponibilidad" value="disponible" class="filter-btn <?= ($filters['disponibilidad'] ?? '') === 'disponible' ? 'active' : '' ?>">
                        Disponible
                    </button>
                    <button type="submit" name="disponibilidad" value="asignado" class="filter-btn <?= ($filters['disponibilidad'] ?? '') === 'asignado' ? 'active' : '' ?>">
                        Asignado
                    </button>
                    <button type="submit" name="disponibilidad" value="no_disponible" class="filter-btn <?= ($filters['disponibilidad'] ?? '') === 'no_disponible' ? 'active' : '' ?>">
                        No Disponible
                    </button>
                </div>
            </div>

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

            <!-- Búsqueda por Nombre -->
            <div class="filter-group">
                <label class="filter-label">Buscar Chofer</label>
                <div class="search-row">
                    <input 
                        type="text" 
                        name="nombre" 
                        class="search-input" 
                        placeholder="Nombre del chofer..." 
                        value="<?= h($filters['nombre'] ?? '') ?>"
                    >
                    <button type="submit" class="btn btn-secondary btn-sm">
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
        <?php if (isset($xservChoferes) && is_countable($xservChoferes) && count($xservChoferes) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Teléfono</th>
                    <th>Licencia</th>
                    <th>Disponibilidad</th>
                    <th>Estado</th>
                    <th>Fecha Ingreso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservChoferes as $chofer): ?>
                <tr>
                    <td><strong>#<?= h($chofer->id) ?></strong></td>
                    <td>
                        <strong>
                            <?= $chofer->hasValue('usuario') ? $this->Html->link(h($chofer->usuario->nombre), ['controller' => 'XservUsuarios', 'action' => 'view', $chofer->usuario->id]) : '<span style="color: #6b7280;">No asignado</span>' ?>
                        </strong>
                    </td>
                    <td><?= $chofer->hasValue('usuario') ? h($chofer->usuario->identificacion) : '-' ?></td>
                    <td><?= $chofer->hasValue('usuario') ? h($chofer->usuario->telefono) : '-' ?></td>
                    <td><?= h($chofer->tipo_licencia ?: '-') ?></td>
                    <td><span class="badge <?= h($chofer->disponibilidad) ?>"><?= h(ucfirst(str_replace('_', ' ', $chofer->disponibilidad))) ?></span></td>
                    <td><span class="badge <?= h($chofer->estado) ?>"><?= h(ucfirst($chofer->estado)) ?></span></td>
                    <td><?= h($chofer->created_at->format('d/m/Y')) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-choferes/view/<?= h($chofer->id) ?>" class="btn-action" title="Ver Detalles">
                                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Ver
                            </a>
                            <a href="/xserv-choferes/edit/<?= h($chofer->id) ?>" class="btn-action" title="Editar">
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
            <?= $this->Paginator->first('«', ['escape' => false]) ?>
            <?= $this->Paginator->prev('‹', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('›', ['escape' => false]) ?>
            <?= $this->Paginator->last('»', ['escape' => false]) ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <p>No se encontraron choferes</p>
            <p style="font-size: 0.85rem; margin-top: 0.5rem;">
                <a href="/xserv-choferes/add" style="color: var(--gold); text-decoration: none;">Crear primer chofer</a>
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="choferes-container">
    <!-- Page Actions -->
    <div class="page-actions">
        <div></div>
        <a href="/xserv-choferes/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Chofer
        </a>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="filters-row">
            <!-- Filtro por Disponibilidad -->
            <div class="filter-group">
                <label class="filter-label">Disponibilidad</label>
                <div class="filter-buttons">
                    <button type="submit" name="disponibilidad" value="" class="filter-btn <?= empty($filters['disponibilidad']) ? 'active' : '' ?>">
                        Todos
                    </button>
                    <button type="submit" name="disponibilidad" value="disponible" class="filter-btn <?= ($filters['disponibilidad'] ?? '') === 'disponible' ? 'active' : '' ?>">
                        Disponible
                    </button>
                    <button type="submit" name="disponibilidad" value="no_disponible" class="filter-btn <?= ($filters['disponibilidad'] ?? '') === 'no_disponible' ? 'active' : '' ?>">
                        No Disponible
                    </button>
                    <button type="submit" name="disponibilidad" value="asignado" class="filter-btn <?= ($filters['disponibilidad'] ?? '') === 'asignado' ? 'active' : '' ?>">
                        Asignado
                    </button>
                </div>
            </div>

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
                <label class="filter-label">Buscar chofer</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input 
                        type="text" 
                        name="tipo_licencia" 
                        class="search-input" 
                        placeholder="Buscar por tipo de licencia..." 
                        value="<?= h($filters['tipo_licencia'] ?? '') ?>"
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
        <?php if (isset($xservChoferes) && is_countable($xservChoferes) && count($xservChoferes) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('usuario_id', 'Usuario') ?></th>
                    <th><?= $this->Paginator->sort('tipo_licencia', 'Licencia') ?></th>
                    <th><?= $this->Paginator->sort('disponibilidad', 'Disponibilidad') ?></th>
                    <th><?= $this->Paginator->sort('estado', 'Estado') ?></th>
                    <th><?= $this->Paginator->sort('created_at', 'Fecha Ingreso') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservChoferes as $chofer): ?>
                <tr>
                    <td><strong><?= h($chofer->id) ?></strong></td>
                    <td><?= $chofer->hasValue('usuario') ? $this->Html->link(h($chofer->usuario->nombre), ['controller' => 'XservUsuarios', 'action' => 'view', $chofer->usuario->id]) : '<span style="color: #6b7280;">No asignado</span>' ?></td>
                    <td><?= h($chofer->tipo_licencia ?: '-') ?></td>
                    <td><span class="badge <?= h($chofer->disponibilidad) ?>"><?= h(ucfirst(str_replace('_', ' ', $chofer->disponibilidad))) ?></span></td>
                    <td><span class="badge <?= h($chofer->estado) ?>"><?= h(ucfirst($chofer->estado)) ?></span></td>
                    <td><?= h($chofer->created_at->format('d/m/Y')) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-choferes/view/<?= h($chofer->id) ?>" class="btn btn-secondary btn-sm">
                                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Ver
                            </a>
                            <a href="/xserv-choferes/edit/<?= h($chofer->id) ?>" class="btn btn-secondary btn-sm">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <p>No se encontraron choferes</p>
        </div>
        <?php endif; ?>
    </div>
</div>
