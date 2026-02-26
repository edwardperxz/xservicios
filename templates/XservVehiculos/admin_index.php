<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservVehiculo> $xservVehiculos
 * @var array $filters
 */
$this->assign('header-title', 'Gestión de Flota');
?>

<style>
    :root {
        --gold: #c9a962;
        --gold-light: #d4b978;
        --dark-bg: #0a0a0a;
        --dark-card: #1a1a1a;
        --dark-lighter: #2a2a2a;
        --text-white: #ffffff;
        --text-gray: #a0a0a0;
        --green: #4ade80;
        --orange: #f59e0b;
        --blue: #3b82f6;
    }

    .vehiculos-container {
        padding: 1.5rem;
    }

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
        transform: translateY(-2px);
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

    .vehicles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .vehicle-card {
        background: var(--dark-card);
        border-radius: 12px;
        border: 1px solid var(--dark-lighter);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .vehicle-card:hover {
        border-color: var(--gold);
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(201, 169, 98, 0.15);
    }

    .vehicle-image-container {
        width: 100%;
        height: 180px;
        background: var(--dark-lighter);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .vehicle-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vehicle-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--dark-lighter) 0%, var(--dark-card) 100%);
        color: var(--text-gray);
        font-size: 0.875rem;
    }

    .vehicle-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .vehicle-header {
        margin-bottom: 1rem;
    }

    .vehicle-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-white);
        margin-bottom: 0.25rem;
    }

    .vehicle-placa {
        font-size: 0.75rem;
        color: var(--text-gray);
        font-weight: 500;
        letter-spacing: 1px;
    }

    .vehicle-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.7rem;
        color: var(--text-gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-size: 0.875rem;
        color: var(--text-white);
        font-weight: 500;
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

    .vehicle-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: auto;
    }

    .vehicle-actions .btn {
        flex: 1;
        justify-content: center;
        padding: 0.5rem 0.75rem;
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

    @media (max-width: 768px) {
        .vehiculos-container {
            padding: 1rem;
        }

        .vehicles-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1rem;
        }

        .vehicle-card {
            border-radius: 8px;
        }

        .vehicle-image-container {
            height: 150px;
        }

        .vehicle-content {
            padding: 1rem;
        }

        .vehicle-name {
            font-size: 1rem;
        }

        .filters-row {
            flex-direction: column;
        }

        .filter-group {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .vehiculos-container {
            padding: 0.75rem;
        }

        .vehicles-grid {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .page-actions {
            flex-direction: column;
            gap: 1rem;
        }

        .page-actions .btn {
            width: 100%;
        }

        .vehicle-info {
            grid-template-columns: 1fr;
        }
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

    <!-- Vehicles Grid -->
    <?php if (isset($xservVehiculos) && is_countable($xservVehiculos) && count($xservVehiculos) > 0): ?>
    <div class="vehicles-grid">
        <?php foreach ($xservVehiculos as $vehiculo): ?>
        <div class="vehicle-card">
            <!-- Imagen -->
            <div class="vehicle-image-container">
                <?php if (!empty($vehiculo->foto_url)): ?>
                    <img src="<?= h($vehiculo->foto_url) ?>" alt="<?= h($vehiculo->nombre_unidad ?? 'Vehículo') ?>" class="vehicle-image">
                <?php else: ?>
                    <div class="vehicle-placeholder">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 48px; height: 48px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Contenido -->
            <div class="vehicle-content">
                <div class="vehicle-header">
                    <div class="vehicle-name"><?= h($vehiculo->nombre_unidad ?? 'Sin nombre') ?></div>
                    <div class="vehicle-placa"><?= h($vehiculo->placa) ?></div>
                </div>

                <div class="vehicle-info">
                    <div class="info-item">
                        <div class="info-label">Tipo</div>
                        <div class="info-value"><?= h(ucfirst(str_replace('_', ' ', $vehiculo->tipo))) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Capacidad</div>
                        <div class="info-value"><?= h($vehiculo->capacidad_max) ?> personas</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Año</div>
                        <div class="info-value"><?= h($vehiculo->anio ?? '-') ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">KM Actual</div>
                        <div class="info-value"><?= h($vehiculo->kilometraje_actual ?? 0) ?> km</div>
                    </div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <span class="badge <?= h($vehiculo->estado_operativo) ?>"><?= h(ucfirst(str_replace('_', ' ', $vehiculo->estado_operativo))) ?></span>
                </div>

                <div class="vehicle-actions">
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
            </div>
        </div>
        <?php endforeach; ?>
    </div>

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
