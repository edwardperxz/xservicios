<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservUsuario> $xservUsuarios
 * @var array $filters
 */
$this->assign('header-title', 'Gestión de Usuarios');
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

    .btn-danger {
        background: var(--red);
        color: var(--text-white);
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

    .filter-btn:hover {
        border-color: var(--gold);
        color: var(--text-white);
    }

    .filter-btn.active {
        background: var(--gold);
        color: var(--dark-bg);
        border-color: var(--gold);
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--dark-lighter);
        border: 1px solid var(--dark-lighter);
        border-radius: 6px;
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
        text-align: left;
        padding: 1rem;
        color: var(--text-gray);
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table td {
        padding: 1rem;
        border-top: 1px solid var(--dark-lighter);
        font-size: 0.875rem;
    }

    .data-table tbody tr {
        transition: background 0.2s;
    }

    .data-table tbody tr:hover {
        background: var(--dark-lighter);
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge.admin {
        background: rgba(168, 85, 247, 0.2);
        color: #a855f7;
    }

    .badge.operador {
        background: rgba(59, 130, 246, 0.2);
        color: var(--blue);
    }

    .badge.chofer {
        background: rgba(74, 222, 128, 0.2);
        color: var(--green);
    }

    .badge.cliente {
        background: rgba(156, 163, 175, 0.2);
        color: #9ca3af;
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
</style>

<div class="usuarios-container">
    <!-- Page Actions -->
    <div class="page-actions">
        <div></div>
        <a href="/xserv-usuarios/add" class="btn btn-primary">
            <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Usuario
        </a>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="filters-row">
            <!-- Filtro por Rol -->
            <div class="filter-group">
                <label class="filter-label">Rol</label>
                <div class="filter-buttons">
                    <button type="submit" name="rol" value="" class="filter-btn <?= empty($filters['rol']) ? 'active' : '' ?>">
                        Todos
                    </button>
                    <button type="submit" name="rol" value="admin" class="filter-btn <?= ($filters['rol'] ?? '') === 'admin' ? 'active' : '' ?>">
                        Admin
                    </button>
                    <button type="submit" name="rol" value="operador" class="filter-btn <?= ($filters['rol'] ?? '') === 'operador' ? 'active' : '' ?>">
                        Operador
                    </button>
                    <button type="submit" name="rol" value="chofer" class="filter-btn <?= ($filters['rol'] ?? '') === 'chofer' ? 'active' : '' ?>">
                        Chofer
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
                <label class="filter-label">Buscar usuario</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input 
                        type="text" 
                        name="username" 
                        class="search-input" 
                        placeholder="Nombre de usuario..." 
                        value="<?= h($filters['username'] ?? '') ?>"
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
        <?php if (isset($xservUsuarios) && is_countable($xservUsuarios) && count($xservUsuarios) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('username', 'Usuario') ?></th>
                    <th><?= $this->Paginator->sort('correo', 'Correo') ?></th>
                    <th><?= $this->Paginator->sort('rol', 'Rol') ?></th>
                    <th><?= $this->Paginator->sort('estado', 'Estado') ?></th>
                    <th><?= $this->Paginator->sort('created_at', 'Fecha Creación') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservUsuarios as $usuario): ?>
                <tr>
                    <td><strong><?= h($usuario->id) ?></strong></td>
                    <td><?= h($usuario->username) ?></td>
                    <td><?= h($usuario->correo ?: '-') ?></td>
                    <td><span class="badge <?= h($usuario->rol) ?>"><?= h(ucfirst($usuario->rol)) ?></span></td>
                    <td><span class="badge <?= h($usuario->estado) ?>"><?= h(ucfirst($usuario->estado)) ?></span></td>
                    <td><?= h($usuario->created_at->format('d/m/Y H:i')) ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/xserv-usuarios/view/<?= h($usuario->id) ?>" class="btn btn-secondary btn-sm">
                                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Ver
                            </a>
                            <a href="/xserv-usuarios/edit/<?= h($usuario->id) ?>" class="btn btn-secondary btn-sm">
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
            <p>No se encontraron usuarios</p>
        </div>
        <?php endif; ?>
    </div>
</div>
