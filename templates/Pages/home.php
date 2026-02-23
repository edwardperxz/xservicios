<style>
    /* Hero Section */
    .hero {
        position: relative;
        height: 480px;
        background: url('/img/login-bg.jpeg') center/cover no-repeat;
        display: flex;
        align-items: center;
        padding: 0 3rem;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.2) 100%);
    }

    .hero-content {
        position: relative;
        z-index: 10;
        max-width: 500px;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 3.25rem;
        font-weight: 400;
        line-height: 1.15;
        margin-bottom: 1.25rem;
        font-style: italic;
    }

    .hero-description {
        font-size: 1rem;
        color: var(--text-gray);
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2.5rem;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        color: var(--dark-bg);
        font-weight: 600;
        font-size: 1rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        transform: translateY(-2px);
    }

    /* Tabs Section */
    .tabs-section {
        padding: 2rem 3rem;
    }

    .tabs-nav {
        display: flex;
        align-items: center;
        gap: 3rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid var(--dark-lighter);
        padding-bottom: 1rem;
    }

    .tab-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        color: var(--text-gray);
        cursor: pointer;
        transition: color 0.3s;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid transparent;
        margin-bottom: -1rem;
    }

    .tab-item.active {
        color: var(--text-white);
        border-bottom-color: var(--gold);
    }

    .tab-item:hover {
        color: var(--gold);
    }

    .tab-icon {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        fill: none;
    }

    /* Content Card */
    .content-card {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .date-display {
        display: flex;
        align-items: baseline;
        gap: 0.5rem;
    }

    .date-day {
        font-size: 2rem;
        font-weight: 600;
        color: var(--gold);
    }

    .date-month {
        font-size: 1.125rem;
        color: var(--text-white);
    }

    .btn-history {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background: var(--dark-lighter);
        color: var(--text-white);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-history:hover {
        border-color: var(--gold);
        background: rgba(201, 169, 98, 0.1);
    }

    /* Service Items */
    .service-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .service-item {
        display: grid;
        grid-template-columns: auto 1fr auto auto auto;
        align-items: center;
        gap: 1.5rem;
        padding: 1rem;
        background: var(--dark-bg);
        border-radius: 8px;
    }

    .service-icon {
        width: 40px;
        height: 40px;
        background: var(--dark-lighter);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-icon svg {
        width: 20px;
        height: 20px;
        stroke: var(--gold);
        fill: none;
    }

    .service-route {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .route-text {
        font-size: 0.9rem;
        color: var(--text-white);
    }

    .route-date {
        font-size: 0.8rem;
        color: var(--text-gray);
    }

    .route-arrow {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        color: var(--gold);
    }

    .route-arrow svg {
        width: 20px;
        height: 6px;
    }

    .driver-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .driver-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4a4a4a, #2a2a2a);
        overflow: hidden;
    }

    .driver-name {
        font-size: 0.875rem;
        color: var(--text-white);
    }

    .vehicle-type {
        font-size: 0.875rem;
        color: var(--text-gray);
    }

    .status-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-badge.completed {
        background: rgba(74, 222, 128, 0.15);
        color: var(--green);
    }

    .status-badge.pending {
        background: rgba(245, 158, 11, 0.15);
        color: var(--orange);
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .service-arrow {
        width: 24px;
        height: 24px;
        stroke: var(--text-gray);
        cursor: pointer;
        transition: stroke 0.3s;
    }

    .service-arrow:hover {
        stroke: var(--gold);
    }

    /* Ver Más Button */
    .ver-mas-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 1rem;
    }

    .btn-ver-mas {
        padding: 0.75rem 1.5rem;
        background: transparent;
        color: var(--text-white);
        border: 1px solid var(--dark-lighter);
        border-radius: 8px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-ver-mas:hover {
        border-color: var(--gold);
        color: var(--gold);
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Transporte turístico de lujo en Chiriquí</h1>
        <p class="hero-description">Reserva un traslado seguro, puntual y de alta calidad con Xservicios.</p>
        <a href="<?= $this->Url->build(['controller' => 'XservReservas', 'action' => 'add']) ?>" class="btn-primary">Nueva Reserva</a>
    </div>
</section>

<!-- Tabs Section -->
<section class="tabs-section">
    <nav class="tabs-nav">
        <div class="tab-item active">
            <span>Resumen Rápido</span>
        </div>
        <div class="tab-item">
            <svg class="tab-icon" viewBox="0 0 24 24" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            <span>Nueva Reserva</span>
        </div>
        <div class="tab-item">
            <svg class="tab-icon" viewBox="0 0 24 24" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
            <span>Mis Reservas</span>
        </div>
        <div class="tab-item">
            <svg class="tab-icon" viewBox="0 0 24 24" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
            <span>Valorar Servicio</span>
        </div>
    </nav>

    <!-- Content Card -->
    <div class="content-card">
        <div class="card-header">
            <div class="date-display">
                <span class="date-day">29</span>
                <span class="date-month">Enero 2026</span>
            </div>
            <button class="btn-history">
                Historial de Servicios
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
        </div>

        <div class="service-list">
            <!-- Service Item 1 -->
            <div class="service-item">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>
                <div class="service-route">
                    <span class="route-text">Aeropuerto</span>
                    <span class="route-arrow">
                        <svg viewBox="0 0 20 6">
                            <line x1="0" y1="3" x2="16" y2="3" stroke="currentColor" stroke-width="2"/>
                            <polygon points="14,0 20,3 14,6" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="route-text">Bocas del Mar Resort</span>
                </div>
                <div class="driver-info">
                    <div class="driver-avatar">
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#6b7280,#374151);"></div>
                    </div>
                    <span class="driver-name">Roberto García</span>
                </div>
                <span class="vehicle-type">Vehículo</span>
                <div style="display:flex;align-items:center;gap:1rem;">
                    <span class="status-badge completed">
                        <span class="status-dot"></span>
                        Finalizada
                    </span>
                    <svg class="service-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>

            <!-- Service Item 2 -->
            <div class="service-item">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>
                <div class="service-route">
                    <span class="route-date">28 Enero 2026</span>
                    <span class="route-arrow">
                        <svg viewBox="0 0 20 6">
                            <line x1="0" y1="3" x2="16" y2="3" stroke="currentColor" stroke-width="2"/>
                            <polygon points="14,0 20,3 14,6" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="route-text">Hotel Finca Lérida</span>
                </div>
                <div class="driver-info">
                    <div class="driver-avatar">
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#78716c,#44403c);"></div>
                    </div>
                    <span class="driver-name">José Pérez</span>
                </div>
                <span class="vehicle-type">Vehículo</span>
                <div style="display:flex;align-items:center;gap:1rem;">
                    <span class="status-badge pending">
                        <span class="status-dot"></span>
                        Pendiente
                    </span>
                    <svg class="service-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="ver-mas-container">
            <button class="btn-ver-mas">Ver Más</button>
        </div>
    </div>
</section>
