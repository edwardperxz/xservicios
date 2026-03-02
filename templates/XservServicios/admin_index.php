<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservServicio> $xservServicios
 * @var array $filters
 */
$this->assign('header-title', 'Gestión de Servicios');
?>

<style>
    /* CSS Variables y Reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    
    body {
        overflow-x: hidden;
    }

    /* Contenedor Principal */
    .servicios-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Botones */
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
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

    .icon-sm {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    /* Acciones */
    .page-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    /* Estadísticas */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-lighter);
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        border-color: var(--gold);
        background: rgba(201, 169, 98, 0.05);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .stat-icon.blue { background: rgba(59, 130, 246, 0.15); color: #60a5fa; }
    .stat-icon.green { background: rgba(74, 222, 128, 0.15); color: #86efac; }
    .stat-icon.red { background: rgba(239, 68, 68, 0.15); color: #fca5a5; }
    .stat-icon.gold { background: rgba(201, 169, 98, 0.15); color: #c9a962; }

    .stat-info h3 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-white);
        margin: 0;
        line-height: 1.2;
    }

    .stat-info p {
        font-size: 0.75rem;
        color: var(--text-gray);
        margin: 0.25rem 0 0 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Filtros */
    .filters-card {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--dark-lighter);
        margin-bottom: 2rem;
    }

    .filters-row {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-label {
        display: block;
        margin-bottom: 0.75rem;
        color: var(--text-gray);
        font-size: 0.875rem;
        font-weight: 600;
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
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.875rem;
        white-space: nowrap;
    }

    .filter-btn.active {
        background: var(--gold);
        color: var(--dark-bg);
        border-color: var(--gold);
    }

    .filter-btn:hover {
        border-color: var(--gold);
        color: var(--text-white);
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--dark-lighter);
        border: 1px solid transparent;
        border-radius: 8px;
        color: var(--text-white);
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--gold);
        background: var(--dark-lighter);
    }

    .clear-filters {
        background: transparent;
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.5);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .clear-filters:hover {
        background: rgba(59, 130, 246, 0.15);
        border-color: #60a5fa;
    }

    /* Tabla */
    .data-table-card {
        background: var(--dark-card);
        border-radius: 12px;
        border: 1px solid var(--dark-lighter);
        overflow: hidden;
    }

    .data-table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
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

    .data-table tbody tr {
        transition: background-color 0.2s;
    }

    .data-table tbody tr:hover {
        background: rgba(201, 169, 98, 0.08);
    }

    /* Badges */
    .badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge.activo {
        background: rgba(74, 222, 128, 0.2);
        color: #86efac;
    }

    .badge.inactivo {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
    }

    /* Acciones de Tabla */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Info de Resultados */
    .results-info {
        padding: 1rem 1.5rem;
        background: rgba(59, 130, 246, 0.1);
        border-bottom: 1px solid rgba(59, 130, 246, 0.2);
        color: #60a5fa;
        font-size: 0.875rem;
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    /* Paginación */
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
        min-width: 36px;
        text-align: center;
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

    /* Estado Vacío */
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

    /* RESPONSIVE - Tablet */
    @media (max-width: 1024px) {
        .servicios-container {
            padding: 1.5rem 1.25rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.25rem;
        }

        .stat-card {
            padding: 1.25rem;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }

        .stat-info h3 {
            font-size: 1.5rem;
        }

        .stat-info p {
            font-size: 0.7rem;
        }

        .page-actions {
            margin-bottom: 1.5rem;
        }

        .btn {
            padding: 0.65rem 1.25rem;
            font-size: 0.8rem;
        }

        .filters-card {
            padding: 1.25rem;
        }

        .filters-row {
            gap: 1rem;
        }

        .filter-label {
            margin-bottom: 0.5rem;
            font-size: 0.8rem;
        }

        .filter-btn {
            padding: 0.4rem 0.875rem;
            font-size: 0.75rem;
        }

        .search-input {
            padding: 0.625rem 0.875rem;
            font-size: 0.8rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.875rem;
            font-size: 0.8rem;
        }
    }

    /* RESPONSIVE - Tablet Pequeña */
    @media (max-width: 768px) {
        .servicios-container {
            padding: 1.25rem 1rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.875rem;
        }

        .stat-card {
            padding: 0.875rem;
            gap: 0.75rem;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            font-size: 1.1rem;
        }

        .stat-info h3 {
            font-size: 1.25rem;
        }

        .stat-info p {
            font-size: 0.65rem;
        }

        .page-actions {
            flex-direction: column;
            align-items: stretch;
            margin-bottom: 1.25rem;
        }

        .btn {
            width: 100%;
            padding: 0.625rem 1rem;
            font-size: 0.8rem;
        }

        .filters-card {
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .filters-row {
            flex-direction: column;
            gap: 1rem;
        }

        .filter-group {
            min-width: 100%;
        }

        .filter-label {
            font-size: 0.8rem;
        }

        .filter-buttons {
            gap: 0.4rem;
        }

        .filter-btn {
            padding: 0.4rem 0.75rem;
            font-size: 0.7rem;
        }

        .search-input {
            padding: 0.625rem 0.875rem;
            font-size: 0.8rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.75rem;
            font-size: 0.75rem;
        }

        .col-hide-tablet {
            display: none !important;
        }

        .action-buttons {
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.35rem 0.6rem;
            font-size: 0.65rem;
        }

        .results-info {
            padding: 0.875rem 1rem;
            font-size: 0.75rem;
            flex-direction: column;
            gap: 0.5rem;
        }

        .pagination {
            padding: 1rem;
            gap: 0.375rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.4rem 0.6rem;
            font-size: 0.7rem;
            min-width: 32px;
        }
    }

    /* RESPONSIVE - Móvil Grande */
    @media (max-width: 640px) {
        .servicios-container {
            padding: 1rem 0.875rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.625rem;
        }

        .stat-card {
            padding: 0.75rem;
            gap: 0.625rem;
        }

        .stat-icon {
            width: 32px;
            height: 32px;
            font-size: 1rem;
        }

        .stat-info h3 {
            font-size: 1.15rem;
        }

        .stat-info p {
            font-size: 0.6rem;
        }

        .page-actions {
            margin-bottom: 1rem;
        }

        .filters-card {
            padding: 1rem;
            margin-bottom: 1.25rem;
        }

        .filter-label {
            margin-bottom: 0.4rem;
            font-size: 0.75rem;
        }

        .filter-btn {
            padding: 0.35rem 0.65rem;
            font-size: 0.65rem;
        }

        .search-input {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.625rem 0.5rem;
            font-size: 0.65rem;
        }

        .col-hide-mobile {
            display: none !important;
        }

        .btn-sm {
            padding: 0.3rem 0.45rem;
            font-size: 0.6rem;
            width: auto;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }

        .btn-sm {
            width: 100%;
        }

        .results-info {
            padding: 0.75rem 0.875rem;
            font-size: 0.7rem;
        }

        .pagination {
            padding: 1rem 0.75rem;
            gap: 0.25rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.35rem 0.5rem;
            font-size: 0.65rem;
            min-width: 28px;
        }
    }

    /* RESPONSIVE - Móvil Pequeño */
    @media (max-width: 480px) {
        .servicios-container {
            padding: 0.875rem 0.75rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }

        .stat-card {
            flex-direction: column;
            text-align: center;
            padding: 0.75rem;
            gap: 0.5rem;
        }

        .stat-icon {
            width: 30px;
            height: 30px;
            font-size: 0.9rem;
            margin: 0 auto;
        }

        .stat-info h3 {
            font-size: 1.1rem;
        }

        .stat-info p {
            font-size: 0.55rem;
        }

        .page-actions {
            margin-bottom: 0.875rem;
        }

        .btn {
            padding: 0.55rem 0.875rem;
            font-size: 0.7rem;
        }

        .filters-card {
            padding: 0.875rem;
            margin-bottom: 1rem;
        }

        .filter-label {
            font-size: 0.7rem;
            margin-bottom: 0.35rem;
        }

        .filter-buttons {
            gap: 0.25rem;
        }

        .filter-btn {
            padding: 0.3rem 0.6rem;
            font-size: 0.6rem;
        }

        .search-input {
            padding: 0.45rem 0.65rem;
            font-size: 0.7rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.5rem 0.375rem;
            font-size: 0.6rem;
        }

        .badge {
            padding: 0.25rem 0.5rem;
            font-size: 0.55rem;
        }

        .btn-sm {
            padding: 0.25rem 0.4rem;
            font-size: 0.55rem;
        }

        .results-info {
            padding: 0.625rem 0.75rem;
            font-size: 0.65rem;
        }

        .pagination {
            padding: 0.75rem;
            gap: 0.2rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.3rem 0.4rem;
            font-size: 0.6rem;
            min-width: 24px;
        }

        .icon-sm {
            width: 12px;
            height: 12px;
        }

        .empty-state {
            padding: 2rem 1rem;
        }

        .empty-state svg {
            width: 48px;
            height: 48px;
        }
    }

    /* RESPONSIVE - Extra Pequeño */
    @media (max-width: 360px) {
        .servicios-container {
            padding: 0.75rem 0.625rem;
        }

        .stats-grid {
            gap: 0.375rem;
        }

        .stat-card {
            padding: 0.625rem;
            gap: 0.375rem;
        }

        .stat-icon {
            width: 28px;
            height: 28px;
            font-size: 0.8rem;
        }

        .stat-info h3 {
            font-size: 1rem;
        }

        .stat-info p {
            font-size: 0.5rem;
        }

        .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.65rem;
        }

        .filters-card {
            padding: 0.75rem;
            margin-bottom: 0.875rem;
        }

        .filter-label {
            font-size: 0.65rem;
            margin-bottom: 0.3rem;
        }

        .filter-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.55rem;
        }

        .search-input {
            padding: 0.4rem 0.6rem;
            font-size: 0.65rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.375rem 0.25rem;
            font-size: 0.55rem;
        }

        .btn-sm {
            padding: 0.2rem 0.35rem;
            font-size: 0.5rem;
        }
    }

</style>

<div class="servicios-container">
    <!-- Statistics Cards -->
    <?php
    $totalServicios = isset($xservServicios) && is_countable($xservServicios) ? count($xservServicios) : 0;
    $serviciosActivos = 0;
    $serviciosInactivos = 0;
    $precioPromedio = 0;
    if ($totalServicios > 0) {
        $sumaPrecio = 0;
        foreach ($xservServicios as $s) {
            if (strtolower($s->estado) === 'activo') $serviciosActivos++;
            if (strtolower($s->estado) === 'inactivo') $serviciosInactivos++;
            $sumaPrecio += (float)$s->precio_base;
        }
        $precioPromedio = $sumaPrecio / $totalServicios;
    }
    ?>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">S</div>
            <div class="stat-info">
                <h3><?= $totalServicios ?></h3>
                <p>Total Servicios</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">A</div>
            <div class="stat-info">
                <h3><?= $serviciosActivos ?></h3>
                <p>Servicios Activos</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red">I</div>
            <div class="stat-info">
                <h3><?= $serviciosInactivos ?></h3>
                <p>Servicios Inactivos</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold">$</div>
            <div class="stat-info">
                <h3>$<?= number_format($precioPromedio, 2) ?></h3>
                <p>Precio Promedio</p>
            </div>
        </div>
    </div>

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
                    <?php if (!empty($filters['nombre']) || !empty($filters['estado'])): ?>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="clear-filters">Limpiar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <!-- Data Table -->
    <div class="data-table-card">
        <?php if (isset($xservServicios) && is_countable($xservServicios) && count($xservServicios) > 0): ?>
        <div class="results-info">
            <span>Mostrando <strong><?= count($xservServicios) ?></strong> servicio(s)</span>
            <?php if (!empty($filters['nombre']) || !empty($filters['estado'])): ?>
            <span>Filtros activos: 
                <?php if (!empty($filters['nombre'])): ?>
                    <strong>"<?= h($filters['nombre']) ?>"</strong>
                <?php endif; ?>
                <?php if (!empty($filters['estado'])): ?>
                    <strong><?= ucfirst(h($filters['estado'])) ?></strong>
                <?php endif; ?>
            </span>
            <?php endif; ?>
        </div>
        <div class="data-table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                        <th><?= $this->Paginator->sort('nombre', 'Servicio') ?></th>
                        <th class="col-hide-tablet">Descripción</th>
                        <th class="col-hide-tablet">Variantes</th>
                        <th><?= $this->Paginator->sort('precio_base', 'Precio') ?></th>
                        <th><?= $this->Paginator->sort('estado', 'Estado') ?></th>
                        <th class="col-hide-mobile">Creado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($xservServicios as $servicio): ?>
                    <tr>
                        <td><strong><?= h($servicio->id) ?></strong></td>
                        <td><strong><?= h($servicio->nombre) ?></strong></td>
                        <td class="col-hide-tablet"><span class="description"><?= h($servicio->descripcion ?? '(Sin descripcion)') ?></span></td>
                        <td class="col-hide-tablet"><span class="description"><?= h($servicio->variantes ?? '(Sin variantes)') ?></span></td>
                        <td>
                            <strong style="color: var(--gold);">$<?= h(number_format((float)$servicio->precio_base, 2)) ?></strong>
                            <br>
                            <span style="font-size: 0.7rem; color: var(--text-muted);">+ ITBMS: $<?= number_format((float)$servicio->precio_base * 1.07, 2) ?></span>
                        </td>
                        <td>
                            <span class="badge <?= h($servicio->estado) ?>">
                                <?= h(ucfirst($servicio->estado)) ?>
                            </span>
                        </td>
                        <td class="col-hide-mobile"><?= h($servicio->created_at ? $servicio->created_at->format('d/m/Y') : 'N/A') ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="/xserv-servicios/view/<?= h($servicio->id) ?>" class="btn btn-secondary btn-sm" title="Ver <?= h($servicio->nombre) ?>">
                                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Ver
                                </a>
                                <a href="/xserv-servicios/edit/<?= h($servicio->id) ?>" class="btn btn-secondary btn-sm" title="Editar <?= h($servicio->nombre) ?>">
                                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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
        </div>

        <!-- Pagination -->
        <nav class="pagination" aria-label="Paginación">
            <?= $this->Paginator->first('«') ?>
            <?= $this->Paginator->prev('‹') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('›') ?>
            <?= $this->Paginator->last('»') ?>
        </nav>
        <?php else: ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <p>No se encontraron servicios</p>
        </div>
        <?php endif; ?>
    </div>
</div>
