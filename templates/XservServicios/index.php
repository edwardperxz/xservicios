<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservServicio> $xservServicios
 */
$this->assign('header-title', 'Servicios Disponibles');
?>

<style>
    * {
        box-sizing: border-box;
    }

    :root {
        --gold: #c9a962;
        --gold-light: #d4b978;
        --dark-bg: #0a0a0a;
        --dark-card: #1a1a1a;
        --dark-lighter: #2a2a2a;
        --text-white: #ffffff;
        --text-gray: #a0a0a0;
        --text-muted: #7a7a7a;
    }

    html, body {
        width: 100%;
        overflow-x: hidden;
    }

    .servicios-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
        min-height: 100vh;
    }

    .servicios-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .servicios-title {
        font-size: 2rem;
        font-weight: 600;
        color: var(--text-white);
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
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
        transform: translateY(-1px);
    }

    .servicios-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
        list-style: none;
        padding: 0;
    }

    .service-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-lighter);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .service-card:hover {
        border-color: var(--gold);
        box-shadow: 0 8px 24px rgba(201, 169, 98, 0.15);
        transform: translateY(-2px);
    }

    .service-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--dark-lighter);
    }

    .service-title {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--text-white);
        margin: 0 0 0.5rem;
        word-break: break-word;
        hyphens: auto;
    }

    .service-meta {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .meta-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .badge-active {
        background: rgba(74, 222, 128, 0.2);
        color: #86efac;
    }

    .badge-inactive {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
    }

    .badge-price {
        background: rgba(201, 169, 98, 0.2);
        color: var(--gold);
    }

    .service-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .service-description {
        color: var(--text-gray);
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        flex: 1;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .service-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--dark-lighter);
    }

    .service-price {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .price-label {
        font-size: 0.7rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .price-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gold);
    }

    .service-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-view {
        padding: 0.5rem 1rem;
        background: var(--gold);
        color: var(--dark-bg);
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-view:hover {
        background: var(--gold-light);
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-gray);
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .empty-state h2 {
        margin: 1rem 0 0.5rem;
        font-size: 1.5rem;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        padding: 2rem 1rem;
        flex-wrap: wrap;
        width: 100%;
    }

    .pagination-container a,
    .pagination-container span {
        padding: 0.5rem 0.75rem;
        background: var(--dark-lighter);
        color: var(--text-white);
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.2s;
        font-size: 0.875rem;
        border: 1px solid transparent;
    }

    .pagination-container a:hover {
        background: var(--gold);
        color: var(--dark-bg);
        border-color: var(--gold);
    }

    .pagination-container .active {
        background: var(--gold);
        color: var(--dark-bg);
    }

    .pagination-info {
        text-align: center;
        color: var(--text-gray);
        font-size: 0.875rem;
        width: 100%;
        margin-top: 1rem;
    }

    @media (max-width: 1200px) {
        .servicios-container { 
            padding: 1.75rem 1.25rem; 
        }
        .servicios-grid { 
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
            gap: 1.25rem; 
        }
        .servicios-title { 
            font-size: 1.75rem; 
        }
    }

    @media (max-width: 1024px) {
        .servicios-container { 
            padding: 1.5rem 1rem; 
        }
        .servicios-grid { 
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
            gap: 1.125rem; 
        }
        .servicios-title { 
            font-size: 1.6rem; 
        }
        .service-header { 
            padding: 1.25rem; 
        }
        .service-body { 
            padding: 1.25rem; 
        }
        .service-description { 
            font-size: 0.8125rem; 
        }
    }

    @media (max-width: 768px) {
        .servicios-container { 
            padding: 1.25rem 1rem; 
        }
        .servicios-header { 
            margin-bottom: 1.5rem; 
            gap: 0.75rem;
        }
        .servicios-title { 
            font-size: 1.35rem; 
            flex-basis: 100%;
        }
        .header-actions { 
            width: 100%;
            justify-content: flex-end;
        }
        .servicios-grid { 
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); 
            gap: 1rem; 
        }
        .service-card { 
            border-radius: 10px; 
        }
        .service-header { 
            padding: 1.125rem; 
        }
        .service-title { 
            font-size: 1rem; 
            margin-bottom: 0.375rem;
        }
        .service-body { 
            padding: 1.125rem; 
        }
        .service-description { 
            font-size: 0.8rem; 
            margin-bottom: 0.875rem;
        }
        .service-footer { 
            padding-top: 0.875rem; 
        }
        .price-value { 
            font-size: 1.15rem; 
        }
        .btn-view { 
            padding: 0.45rem 0.875rem; 
            font-size: 0.75rem; 
        }
        .meta-badge { 
            padding: 0.3rem 0.625rem; 
            font-size: 0.7rem; 
        }
    }

    @media (max-width: 640px) {
        .servicios-container { 
            padding: 1rem 0.75rem; 
        }
        .servicios-header { 
            flex-direction: column;
            align-items: stretch;
            gap: 0.75rem; 
            margin-bottom: 1.25rem; 
        }
        .servicios-title { 
            font-size: 1.2rem; 
            flex-basis: auto;
        }
        .header-actions { 
            width: 100%;
        }
        .servicios-grid { 
            grid-template-columns: 1fr; 
            gap: 0.875rem; 
        }
        .service-card { 
            border-radius: 8px; 
        }
        .service-header { 
            padding: 1rem; 
        }
        .service-title { 
            font-size: 0.95rem; 
            margin-bottom: 0.375rem;
        }
        .service-body { 
            padding: 1rem; 
        }
        .service-description { 
            font-size: 0.8rem; 
            margin-bottom: 0.875rem;
            -webkit-line-clamp: 3;
        }
        .service-footer { 
            flex-direction: row;
            padding-top: 0.75rem; 
            gap: 0.875rem;
        }
        .service-price {
            min-width: 80px;
        }
        .price-label { 
            font-size: 0.65rem; 
        }
        .price-value { 
            font-size: 1rem; 
        }
        .service-actions { 
            flex: 1;
        }
        .btn-view { 
            padding: 0.4rem 0.75rem; 
            font-size: 0.7rem; 
            width: 100%;
            text-align: center;
        }
        .meta-badge { 
            padding: 0.3rem 0.6rem; 
            font-size: 0.7rem; 
        }
        .btn { 
            padding: 0.625rem 1rem; 
            font-size: 0.8rem; 
        }
        .pagination-container { 
            gap: 0.375rem; 
            padding: 1.5rem 0.75rem; 
        }
        .pagination-container a, 
        .pagination-container span { 
            padding: 0.4rem 0.6rem; 
            font-size: 0.8rem; 
        }
    }

    @media (max-width: 500px) {
        .servicios-container { 
            padding: 0.875rem 0.625rem; 
        }
        .servicios-header { 
            gap: 0.5rem; 
            margin-bottom: 1rem; 
        }
        .servicios-title { 
            font-size: 1.1rem; 
        }
        .servicios-grid { 
            gap: 0.75rem; 
            margin-bottom: 1.5rem;
        }
        .service-header { 
            padding: 0.875rem; 
        }
        .service-title { 
            font-size: 0.9rem; 
        }
        .service-body { 
            padding: 0.875rem; 
        }
        .service-description { 
            font-size: 0.75rem; 
            margin-bottom: 0.75rem;
            -webkit-line-clamp: 2;
        }
        .service-footer { 
            gap: 0.625rem;
        }
        .price-label { 
            font-size: 0.6rem; 
        }
        .price-value { 
            font-size: 0.95rem; 
        }
        .btn-view { 
            padding: 0.375rem 0.625rem; 
            font-size: 0.65rem; 
        }
        .btn { 
            padding: 0.6rem 0.875rem; 
            font-size: 0.7rem; 
        }
        .meta-badge { 
            font-size: 0.65rem; 
            padding: 0.25rem 0.5rem; 
        }
        .pagination-container { 
            padding: 1rem 0.5rem; 
        }
        .pagination-container a, 
        .pagination-container span { 
            padding: 0.35rem 0.5rem; 
            font-size: 0.7rem; 
        }
        .pagination-info {
            font-size: 0.75rem;
        }
    }

    @media (max-width: 380px) {
        .servicios-container { 
            padding: 0.75rem 0.5rem; 
        }
        .servicios-title { 
            font-size: 1rem; 
        }
        .service-header { 
            padding: 0.75rem; 
        }
        .service-body { 
            padding: 0.75rem; 
        }
        .service-description { 
            font-size: 0.7rem; 
        }
        .btn-view { 
            padding: 0.35rem 0.5rem; 
            font-size: 0.6rem; 
        }
        .btn { 
            padding: 0.5rem 0.75rem; 
            font-size: 0.65rem; 
        }
        .price-value { 
            font-size: 0.9rem; 
        }
        .pagination-container a, 
        .pagination-container span { 
            padding: 0.3rem 0.4rem; 
            font-size: 0.65rem; 
        }
    }
</style>

<div class="servicios-container">
    <div class="servicios-header">
        <h1 class="servicios-title">Servicios Disponibles</h1>
        <div class="header-actions">
            <?= $this->Language->languageSelector() ?>
        </div>
    </div>

    <?php if ($xservServicios && count($xservServicios) > 0): ?>
        <div class="servicios-grid" role="list">
            <?php foreach ($xservServicios as $servicio): ?>
            <article class="service-card" role="listitem">
                <div class="service-header">
                    <h2 class="service-title"><?= h($servicio->nombre) ?></h2>
                    <div class="service-meta">
                        <span class="meta-badge <?= strtolower($servicio->estado) === 'activo' ? 'badge-active' : 'badge-inactive' ?>" title="Estado: <?= ucfirst(h($servicio->estado)) ?>">
                            <?= ucfirst(h($servicio->estado)) ?>
                        </span>
                        <span class="meta-badge badge-price" title="Precio base" data-i18n="service.basePrice">
                            $<?= $this->Number->format($servicio->precio_base) ?>
                        </span>
                    </div>
                </div>
                <div class="service-body">
                    <?php if (!empty($servicio->descripcion)): ?>
                    <p class="service-description"><?= h($servicio->descripcion) ?></p>
                    <?php else: ?>
                    <p class="service-description" style="color: var(--text-muted);">(Sin descripción disponible)</p>
                    <?php endif; ?>
                </div>
                <div class="service-footer">
                    <div class="service-price">
                        <span class="price-label" data-i18n="service.basePrice">Precio base</span>
                        <span class="price-value">$<?= $this->Number->format($servicio->precio_base) ?></span>
                    </div>
                    <div class="service-actions">
                        <a href="<?= $this->Url->build(['action' => 'view', $servicio->id]) ?>" class="btn-view" aria-label="Ver detalles de <?= h($servicio->nombre) ?>">Ver Detalle</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <nav class="pagination-container" aria-label="Paginación">
            <?= $this->Paginator->first('<< Primero') ?>
            <?= $this->Paginator->prev('< Anterior') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('Siguiente >') ?>
            <?= $this->Paginator->last('Último >>') ?>
        </nav>
        <div class="pagination-info" aria-live="polite">
            <?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} total')) ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h2>No hay servicios disponibles</h2>
            <p>En este momento no contamos con servicios disponibles. Por favor intenta más tarde.</p>
        </div>
    <?php endif; ?>
</div>