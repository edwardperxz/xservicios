<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.myReservations">Xservicios - Mis Reservas</title>
  <script src="/js/i18n-preload.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --gold: #c9a962;
      --gold-light: #d4b978;
      --gold-dark: #a88b4a;
      --dark-bg: #0a0a0a;
      --dark-deep: #050505;
      --dark-card: #1a1a1a;
      --dark-lighter: #2a2a2a;
      --text-white: #ffffff;
      --text-gray: #a0a0a0;
      --green: #2d7a5f;
      --green-hover: #236349;
      --red: #c94a4a;
      --orange: #d97706;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-deep);
      color: var(--text-white);
      min-height: 100vh;
    }

    .content {
      padding: 2rem 2.5rem;
      max-width: 1400px;
      margin: 0 auto;
    }

    .page-title {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: var(--text-white);
      margin-bottom: 0.5rem;
    }

    .page-title span {
      color: var(--gold);
    }

    .page-subtitle {
      color: var(--text-gray);
      font-size: 0.9rem;
      margin-bottom: 2rem;
    }

    /* Tabs/Categorías */
    .category-tabs {
      display: flex;
      gap: 1rem;
      margin-bottom: 2.5rem;
      border-bottom: 2px solid var(--dark-lighter);
      padding-bottom: 1rem;
      flex-wrap: wrap;
    }

    .category-tab {
      padding: 0.75rem 1.5rem;
      background: transparent;
      border: 2px solid var(--dark-lighter);
      border-bottom: none;
      border-radius: 8px 8px 0 0;
      color: var(--text-gray);
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      position: relative;
    }

    .category-tab:hover {
      border-color: var(--gold);
      color: var(--gold);
    }

    .category-tab.active {
      background: linear-gradient(to bottom, rgba(201, 169, 98, 0.1), transparent);
      border-color: var(--gold);
      color: var(--gold);
      border-bottom-color: var(--dark-deep);
    }

    .category-count {
      background: rgba(201, 169, 98, 0.2);
      padding: 0.2rem 0.6rem;
      border-radius: 10px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .category-tab.active .category-count {
      background: var(--gold);
      color: var(--dark-bg);
    }

    /* Estado Badge styles */
    .estado-badge {
      display: inline-flex;
      align-items: center;
      padding: 0.35rem 0.75rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      gap: 0.4rem;
    }

    .estado-badge.pendiente {
      background: rgba(217, 119, 6, 0.2);
      color: var(--orange);
      border: 1px solid var(--orange);
    }

    .estado-badge.confirmada {
      background: rgba(45, 122, 95, 0.2);
      color: var(--green);
      border: 1px solid var(--green);
    }

    .estado-badge.completada {
      background: rgba(45, 122, 95, 0.2);
      color: var(--green);
      border: 1px solid var(--green);
    }

    .estado-badge.cancelada {
      background: rgba(201, 74, 74, 0.2);
      color: var(--red);
      border: 1px solid var(--red);
    }

    /* Reservations List */
    .reservations-container {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .reservation-card {
      background: linear-gradient(135deg, var(--dark-card) 0%, rgba(26, 26, 26, 0.8) 100%);
      border: 1px solid var(--dark-lighter);
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s;
      cursor: pointer;
    }

    .reservation-card:hover {
      border-color: var(--gold);
      box-shadow: 0 8px 32px rgba(201, 169, 98, 0.15);
      transform: translateY(-2px);
    }

    .reservation-card.expanded {
      border-color: var(--gold);
    }

    /* Reservation Header */
    .reservation-header {
      display: flex;
      align-items: center;
      gap: 2rem;
      padding: 1.5rem;
      justify-content: space-between;
    }

    .reservation-route {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      flex: 1;
    }

    .route-segment {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .route-label {
      font-size: 0.7rem;
      color: var(--text-gray);
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .route-location {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--text-white);
    }

    .route-arrow {
      color: var(--gold);
      font-size: 1.5rem;
    }

    .reservation-meta {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 0.5rem;
      text-align: right;
    }

    .reservation-date {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--gold);
    }

    .reservation-time {
      font-size: 0.85rem;
      color: var(--text-gray);
    }

    .reservation-code {
      font-size: 0.8rem;
      color: var(--text-gray);
      font-family: 'Courier New', monospace;
    }

    .expand-arrow {
      width: 24px;
      height: 24px;
      color: var(--text-gray);
      transition: transform 0.3s;
      flex-shrink: 0;
    }

    .reservation-card.expanded .expand-arrow {
      transform: rotate(180deg);
    }

    /* Expanded Details */
    .reservation-details {
      display: none;
      border-top: 1px dashed var(--dark-lighter);
      padding: 2rem;
      background: linear-gradient(to bottom, rgba(10, 10, 10, 0.3), transparent);
    }

    .reservation-card.expanded .reservation-details {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
    }

    .detail-section {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .detail-section-title {
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: var(--gold);
      padding-bottom: 0.75rem;
      border-bottom: 1px solid var(--dark-lighter);
      font-weight: 600;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5rem 0;
      font-size: 0.9rem;
    }

    .detail-label {
      color: var(--text-gray);
    }

    .detail-value {
      color: var(--text-white);
      font-weight: 500;
    }

    /* Unit & Driver Cards */
    .unit-driver-cards {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-top: 1rem;
    }

    .card-mini {
      background: linear-gradient(135deg, rgba(31, 31, 31, 0.8), rgba(21, 21, 21, 0.6));
      border: 2px solid var(--gold);
      border-radius: 10px;
      padding: 1rem;
      display: flex;
      gap: 1rem;
    }

    .card-mini-image {
      width: 70px;
      height: 70px;
      border-radius: 8px;
      object-fit: cover;
      border: 1px solid var(--gold);
    }

    .card-mini-image.driver {
      border-radius: 50%;
    }

    .card-mini-info {
      flex: 1;
    }

    .card-mini-title {
      font-size: 0.85rem;
      color: var(--gold);
      font-weight: 600;
      margin-bottom: 0.4rem;
    }

    .card-mini-detail {
      font-size: 0.75rem;
      color: var(--text-gray);
      margin-bottom: 0.2rem;
    }

    .card-mini-rating {
      display: flex;
      align-items: center;
      gap: 0.4rem;
      margin-top: 0.4rem;
      font-size: 0.75rem;
    }

    .stars {
      display: flex;
      gap: 0.1rem;
      color: var(--gold);
    }

    .rating-value {
      color: var(--gold);
      font-weight: 600;
      font-size: 0.8rem;
    }

    /* Transports List */
    .transports-list {
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
      margin-top: 0.5rem;
    }

    .transport-tag {
      background: rgba(201, 169, 98, 0.15);
      border: 1px solid var(--gold);
      padding: 0.35rem 0.75rem;
      border-radius: 15px;
      font-size: 0.75rem;
      color: var(--gold);
    }

    /* Total Amount */
    .reservation-total {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 2rem;
      padding-top: 1.5rem;
      border-top: 2px dashed var(--gold);
    }

    .total-label {
      font-size: 0.95rem;
      color: var(--text-white);
      font-weight: 600;
    }

    .total-amount {
      font-size: 1.75rem;
      color: var(--gold);
      font-weight: 700;
      font-family: 'Playfair Display', serif;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
      color: var(--text-gray);
    }

    .empty-state svg {
      width: 80px;
      height: 80px;
      stroke: var(--dark-lighter);
      fill: none;
      margin-bottom: 1.5rem;
      opacity: 0.5;
    }

    .empty-state p {
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .empty-state small {
      font-size: 0.85rem;
      color: var(--text-gray);
      opacity: 0.7;
    }

    /* Loading State */
    .loading {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 3rem;
      color: var(--text-gray);
    }

    .spinner {
      width: 40px;
      height: 40px;
      border: 3px solid var(--dark-lighter);
      border-top-color: var(--gold);
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .reservation-details {
        grid-template-columns: 1fr;
      }

      .unit-driver-cards {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      .content {
        padding: 1.5rem;
      }

      .reservation-header {
        flex-wrap: wrap;
        gap: 1rem;
      }

      .reservation-route {
        width: 100%;
        flex-direction: column;
        gap: 0.75rem;
      }

      .reservation-meta {
        width: 100%;
        align-items: flex-start;
        text-align: left;
      }

      .route-arrow {
        display: none;
      }

      .category-tabs {
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 0.5rem;
      }

      .category-tab {
        white-space: nowrap;
        padding: 0.5rem 1rem;
      }

      .page-title {
        font-size: 1.5rem;
      }

      .reservation-details {
        padding: 1.5rem;
      }

      .card-mini-image {
        width: 60px;
        height: 60px;
      }
    }
  </style>
  <link rel="stylesheet" href="/css/header-auth.css">
</head>
<body>
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <div class="page-container">
    <!-- Content -->
    <main class="content" style="margin-top: 2rem;">
      <h1 class="page-title" data-i18n="reservations.pageTitle">Mis <span>Reservas</span></h1>
      <p class="page-subtitle" data-i18n="reservations.subtitle">Gestiona y visualiza tus reservas de transporte</p>

      <!-- Categorías -->
      <div class="category-tabs">
        <button class="category-tab active" data-category="proximos">
          <span data-i18n="reservations.upcoming">Próximos Viajes</span>
          <span class="category-count" id="count-proximos">0</span>
        </button>
        <button class="category-tab" data-category="completadas">
          <span data-i18n="reservations.completed">Completadas</span>
          <span class="category-count" id="count-completadas">0</span>
        </button>
        <button class="category-tab" data-category="canceladas">
          <span data-i18n="reservations.cancelled">Canceladas</span>
          <span class="category-count" id="count-canceladas">0</span>
        </button>
      </div>

      <!-- Reservations List -->
      <div class="reservations-container" id="reservations-container">
        <div class="loading">
          <div class="spinner"></div>
        </div>
      </div>
    </main>
  </div>

  <script>
    let currentCategory = 'proximos';
    let expandedReservation = null;
    let reservationsData = {
      proximos: [],
      completadas: [],
      canceladas: []
    };

    // Cargar reservas del servidor
    async function loadReservations() {
      try {
        const response = await fetch('/xserv-reservas/my-reservations.json', {
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        if (!response.ok) {
          if (response.status === 401) {
            window.location.href = '/login';
            return;
          }
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        
        if (data.success && data.reservations) {
          reservationsData = data.reservations;
          updateCounts();
          renderReservations(currentCategory);
        }
      } catch (error) {
        console.error('Error loading reservations:', error);
        document.getElementById('reservations-container').innerHTML = `
          <div class="empty-state">
            <svg viewBox="0 0 24 24" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <p data-i18n="reservations.error">Error al cargar las reservas</p>
            <small data-i18n="reservations.errorMessage">Intenta nuevamente en unos momentos</small>
          </div>
        `;
      }
    }

    // Actualizar contadores
    function updateCounts() {
      document.getElementById('count-proximos').textContent = reservationsData.proximos.length;
      document.getElementById('count-completadas').textContent = reservationsData.completadas.length;
      document.getElementById('count-canceladas').textContent = reservationsData.canceladas.length;
    }

    // Formatear fecha
    function formatDate(dateString) {
      const date = new Date(dateString);
      const lang = window.getCurrentLanguage ? window.getCurrentLanguage() : 'es';
      const options = {
        weekday: 'short',
        day: 'numeric',
        month: 'short',
        year: 'numeric'
      };
      return date.toLocaleDateString(lang === 'es' ? 'es-ES' : 'en-US', options);
    }

    // Renderizar reservas
    function renderReservations(category) {
      const reservations = reservationsData[category] || [];
      const container = document.getElementById('reservations-container');
      const t = window.translate ? window.translate : (key) => key;

      if (reservations.length === 0) {
        container.innerHTML = `
          <div class="empty-state">
            <svg viewBox="0 0 24 24" stroke-width="2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
              <line x1="16" y1="2" x2="16" y2="6" />
              <line x1="8" y1="2" x2="8" y2="6" />
              <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
            <p data-i18n="reservations.empty">No hay reservas en esta categoría</p>
            <small data-i18n="reservations.bookNow">
              ${category === 'proximos' ? 'Crea tu primera reserva' : ''}
            </small>
          </div>
        `;
        return;
      }

      container.innerHTML = reservations.map(res => {
        const isExpanded = expandedReservation === res.id;
        const statusClass = res.estado.toLowerCase();
        
        return `
          <div class="reservation-card ${isExpanded ? 'expanded' : ''}" data-id="${res.id}">
            <div class="reservation-header" onclick="toggleExpand(${res.id})">
              <div class="reservation-route">
                <div class="route-segment">
                  <span class="route-label">${t('reservations.origin')}</span>
                  <span class="route-location">${res.punto_recogida || 'Origen'}</span>
                </div>
                <span class="route-arrow">→</span>
                <div class="route-segment">
                  <span class="route-label">${t('reservations.destination')}</span>
                  <span class="route-location">${res.punto_destino || 'Destino'}</span>
                </div>
              </div>
              
              <div class="reservation-meta">
                <div class="reservation-date">${formatDate(res.fecha)}</div>
                <div class="reservation-time">${res.hora}</div>
                <div class="reservation-code">${res.codigo_reserva}</div>
              </div>

              <svg class="expand-arrow" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 10l5 5 5-5z"/>
              </svg>
            </div>

            ${isExpanded ? `
              <div class="reservation-details">
                <div class="detail-section">
                  <div class="detail-section-title">${t('reservations.tripDetails')}</div>
                  
                  <div class="detail-row">
                    <span class="detail-label">${t('reservations.origin')}</span>
                    <span class="detail-value">${res.punto_recogida}</span>
                  </div>
                  
                  <div class="detail-row">
                    <span class="detail-label">${t('reservations.destination')}</span>
                    <span class="detail-value">${res.punto_destino}</span>
                  </div>
                  
                  <div class="detail-row">
                    <span class="detail-label">${t('reservations.date')}</span>
                    <span class="detail-value">${formatDate(res.fecha)}</span>
                  </div>
                  
                  <div class="detail-row">
                    <span class="detail-label">${t('reservations.time')}</span>
                    <span class="detail-value">${res.hora}</span>
                  </div>

                  <div class="detail-row">
                    <span class="detail-label">${t('reservations.passengers')}</span>
                    <span class="detail-value">${res.pasajeros}</span>
                  </div>

                  <div class="detail-row">
                    <span class="detail-label">${t('reservations.status')}</span>
                    <span class="estado-badge ${statusClass}">
                      <span>●</span>
                      <span>${t('reservations.status.') + statusClass}</span>
                    </span>
                  </div>

                  ${res.observaciones ? `
                    <div class="detail-row" style="flex-direction: column; align-items: flex-start; gap: 0.5rem;">
                      <span class="detail-label">${t('reservations.notes')}</span>
                      <span class="detail-value" style="font-size: 0.85rem; line-height: 1.4;">${res.observaciones}</span>
                    </div>
                  ` : ''}
                </div>

                <div class="detail-section">
                  <div class="detail-section-title">${t('reservations.serviceInfo')}</div>
                  
                  ${res.servicio && res.servicio.nombre ? `
                    <div class="detail-row">
                      <span class="detail-label">${t('reservations.service')}</span>
                      <span class="detail-value">${res.servicio.nombre}</span>
                    </div>
                  ` : ''}

                  <div class="detail-section-title" style="margin-top: 1.5rem;">${t('reservations.pricing')}</div>
                  
                  <div class="detail-row">
                    <span class="detail-label">${t('reservations.basePrice')}</span>
                    <span class="detail-value">$${parseFloat(res.precio_pactado).toFixed(2)}</span>
                  </div>

                  ${res.itbms_pactado ? `
                    <div class="detail-row">
                      <span class="detail-label">${t('reservations.itbms')}</span>
                      <span class="detail-value">$${parseFloat(res.itbms_pactado).toFixed(2)}</span>
                    </div>
                  ` : ''}

                  <div class="reservation-total">
                    <span class="total-label">${t('reservations.total')}</span>
                    <span class="total-amount">$${(parseFloat(res.precio_pactado) + (parseFloat(res.itbms_pactado) || 0)).toFixed(2)}</span>
                  </div>

                  <div class="detail-section-title" style="margin-top: 1.5rem;">${t('reservations.paymentStatus')}</div>
                  
                  <div class="detail-row">
                    <span class="detail-label">${t('reservations.paymentStatus')}</span>
                    <span class="detail-value">${res.estado_pago ? res.estado_pago.charAt(0).toUpperCase() + res.estado_pago.slice(1) : 'Pendiente'}</span>
                  </div>
                </div>
              </div>
            ` : ''}
          </div>
        `;
      }).join('');
    }

    // Toggle expand
    function toggleExpand(id) {
      expandedReservation = expandedReservation === id ? null : id;
      renderReservations(currentCategory);
    }

    // Event listeners para tabs
    document.querySelectorAll('.category-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        currentCategory = this.dataset.category;
        expandedReservation = null;
        renderReservations(currentCategory);
      });
    });

    // Actualizar idioma
    window.addEventListener('languageChanged', () => {
      renderReservations(currentCategory);
    });

    // Cargar reservas al iniciar
    loadReservations();
  </script>
  <script src="/js/i18n.js"></script>
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
</body>
</html>
