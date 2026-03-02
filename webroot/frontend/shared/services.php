<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.services">Xservicios - Nuestros Servicios | Tours y Traslados</title>
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
      --gold-soft: rgba(201, 169, 98, 0.2);
      --dark-bg: #0a0a0a;
      --dark-deep: #050505;
      --dark-card: #1a1a1a;
      --dark-lighter: #2a2a2a;
      --dark-glass: rgba(8, 8, 8, 0.6);
      --text-white: #ffffff;
      --text-gray: #a0a0a0;
      --text-dark: #1a1a1a;
      --green: #2d7a5f;
      --green-hover: #236349;
      --orange: #f4a261;
      --paper: #f7f1e6;
      --cream: #f5f0e8;
      --cream-dark: #e8e0d4;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: radial-gradient(circle at top, rgba(201, 169, 98, 0.18), transparent 45%),
        radial-gradient(circle at 15% 70%, rgba(244, 162, 97, 0.12), transparent 50%),
        linear-gradient(180deg, #070707 0%, #0c0c0c 45%, #050505 100%);
      color: var(--text-white);
      min-height: 100vh;
      position: relative;
    }

    /* Golden gradient overlays */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 150px;
      background: linear-gradient(to bottom, rgba(201, 169, 98, 0.15), transparent);
      pointer-events: none;
      z-index: 0;
    }

    body::after {
      content: '';
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      height: 150px;
      background: linear-gradient(to top, rgba(201, 169, 98, 0.15), transparent);
      pointer-events: none;
      z-index: 0;
    }

    /* Title Section */
    .title-section {
      padding: 4rem 2rem 2.5rem;
      background: linear-gradient(to bottom, var(--dark-deep), var(--dark-bg));
      position: relative;
      z-index: 1;
    }

    .title-inner {
      max-width: 1150px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.8fr);
      gap: 2.5rem;
      align-items: center;
    }

    .title-eyebrow {
      text-transform: uppercase;
      letter-spacing: 0.35em;
      font-size: 0.75rem;
      color: var(--gold-light);
      margin-bottom: 0.75rem;
    }

    .brand-logo {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      margin-bottom: 1.5rem;
    }

    .main-title {
      font-family: 'Playfair Display', serif;
      font-size: 3.1rem;
      font-weight: 500;
      line-height: 1.1;
      color: var(--text-white);
    }

    .main-title span {
      display: block;
      font-style: italic;
      color: var(--text-gray);
    }

    .title-lead {
      margin-top: 1rem;
      color: var(--text-gray);
      font-size: 1rem;
      line-height: 1.6;
    }

    .title-card {
      background: var(--dark-glass);
      border: 1px solid rgba(201, 169, 98, 0.2);
      border-radius: 18px;
      padding: 1.5rem;
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.35);
      display: grid;
      gap: 1rem;
      backdrop-filter: blur(6px);
    }

    .title-card h3 {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--text-white);
    }

    .title-card p {
      color: var(--text-gray);
      font-size: 0.9rem;
      line-height: 1.55;
    }

    .hero-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 0.6rem;
    }

    .hero-pill {
      padding: 0.35rem 0.75rem;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: var(--text-gray);
      font-size: 0.8rem;
    }

    /* Services Grid */
    .services-section {
      padding: 2rem 3rem 3.5rem;
      background: linear-gradient(to bottom, var(--dark-bg), var(--dark-deep));
      position: relative;
      z-index: 1;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .service-card {
      background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
      border-radius: 18px;
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
      border: 1.5px solid rgba(201, 169, 98, 0.35);
      box-shadow: 0 10px 28px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(201, 169, 98, 0.1);
      animation: card-fade 0.6s ease both;
      animation-delay: calc(var(--i, 0) * 60ms);
    }

    .service-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 44px rgba(201, 169, 98, 0.25), inset 0 1px 0 rgba(201, 169, 98, 0.15);
      border-color: var(--gold-light);
    }

    .service-media {
      position: relative;
      overflow: hidden;
    }

    .service-image {
      width: 100%;
      height: 210px;
      object-fit: cover;
      transition: transform 0.35s ease;
    }

    .service-card:hover .service-image {
      transform: scale(1.02);
    }

    .service-badges {
      position: absolute;
      inset: auto 1rem 1rem 1rem;
      display: flex;
      gap: 0.75rem;
      align-items: center;
    }

    .service-badge {
      padding: 0.35rem 0.75rem;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 600;
      backdrop-filter: blur(6px);
      border: 1px solid rgba(255, 255, 255, 0.45);
    }

    .service-badge.status {
      background: rgba(8, 8, 8, 0.55);
      color: #f1f1f1;
    }

    .service-badge.price {
      background: rgba(201, 169, 98, 0.9);
      color: #2c1d0f;
      padding: 0.5rem 1rem;
      font-size: 0.9rem;
      font-weight: 700;
    }

    .service-content {
      padding: 1.35rem 1.35rem 1.5rem;
    }

    .service-head {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 1rem;
      margin-bottom: 0.75rem;
    }

    .service-head .service-badge.price {
      flex-shrink: 0;
      white-space: nowrap;
    }


    .service-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--text-white);
      margin-bottom: 0.5rem;
    }

    .service-description {
      font-size: 0.85rem;
      color: #a0a0a0;
      line-height: 1.55;
      margin-bottom: 1rem;
      min-height: 48px;
    }



    .service-actions {
      margin-top: 0.75rem;
    }

    .btn-more {
      display: block;
      width: 100%;
      padding: 0.875rem;
      background: var(--gold);
      color: var(--text-dark);
      font-weight: 600;
      font-size: 0.9rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
      text-decoration: none;
    }

    .btn-more:hover {
      background: var(--gold-light);
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(201, 169, 98, 0.3);
    }

    @keyframes card-fade {
      from {
        opacity: 0;
        transform: translateY(16px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Features Section */
    .features-section {
      padding: 3rem 2rem;
      background: var(--dark-deep);
      border-top: 1px solid rgba(201, 169, 98, 0.2);
      position: relative;
      z-index: 1;
    }

    .features-grid {
      display: flex;
      justify-content: center;
      gap: 4rem;
      max-width: 900px;
      margin: 0 auto;
    }

    .feature-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.75rem;
      text-align: center;
    }

    .feature-icon {
      width: 32px;
      height: 32px;
      stroke: var(--gold);
      fill: none;
    }

    .feature-text {
      font-size: 0.85rem;
      color: var(--text-gray);
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .title-inner {
        grid-template-columns: 1fr;
      }

      .services-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .features-grid {
        gap: 2rem;
      }
    }

    @media (max-width: 768px) {
      .main-title {
        font-size: 2.2rem;
      }

      .services-section {
        padding: 1.5rem;
      }

      .services-grid {
        grid-template-columns: 1fr;
      }

      .features-grid {
        flex-wrap: wrap;
        gap: 1.5rem;
      }

      .feature-item {
        flex: 1 1 40%;
      }
    }
  </style>
  <link rel="stylesheet" href="/css/header-auth.css">
</head>
<body>
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <!-- Title Section -->
  <section class="title-section">
    <div class="title-inner">
      <div>
        <div class="title-eyebrow">Xservicios</div>
        <h1 class="main-title" data-i18n="services.title">
          Servicios exclusivos
          <span>de transporte turístico</span>
        </h1>
        <p class="title-lead" data-i18n="services.lead">Explora experiencias pensadas para reservar rápido: precio base, disponibilidad y detalles claros antes de elegir.</p>
      </div>
      <div class="title-card">
        <h3 data-i18n="services.cardTitle">Reserva con confianza</h3>
        <p data-i18n="services.cardText">Compara opciones, revisa condiciones y asegura tu servicio en menos pasos.</p>
        <div class="hero-pills">
          <span class="hero-pill" data-i18n="services.pill1">Confirmación rápida</span>
          <span class="hero-pill" data-i18n="services.pill2">Precios claros</span>
          <span class="hero-pill" data-i18n="services.pill3">Soporte 24/7</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Grid -->
  <section class="services-section">
    <div class="services-grid" id="servicesGrid">
      <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--text-gray);">
        <p data-i18n="services.loading">Cargando servicios...</p>
      </div>
    </div>
    
    <!-- Botón Cargar Más -->
    <div id="loadMoreContainer" style="text-align: center; margin: 2rem 0; display: none;">
      <button id="loadMoreBtn" style="
        padding: 0.75rem 2rem;
        background-color: var(--gold);
        color: var(--dark-bg);
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.3s ease;
      " 
      onmouseover="this.style.backgroundColor='var(--gold-light)'; this.style.transform='scale(1.05)'"
      onmouseout="this.style.backgroundColor='var(--gold)'; this.style.transform='scale(1)'"
      data-i18n="btn.loadMore">
        Cargar más servicios
      </button>
      <div id="loadingSpinner" style="display: none; margin-top: 1rem; color: var(--gold);">
        <p data-i18n="common.loading">Cargando...</p>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features-section">
    <div class="features-grid">
      <div class="feature-item">
        <svg class="feature-icon" viewBox="0 0 24 24" strokeWidth="2">
          <path d="M12 2L2 7l10 5 10-5-10-5z"/>
          <path d="M2 17l10 5 10-5"/>
          <path d="M2 12l10 5 10-5"/>
        </svg>
        <span class="feature-text" data-i18n="features.premium">Servicio de lujo</span>
      </div>
      <div class="feature-item">
        <svg class="feature-icon" viewBox="0 0 24 24" strokeWidth="2">
          <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>
        </svg>
        <span class="feature-text" data-i18n="features.satisfied">Clientes satisfechos</span>
      </div>
      <div class="feature-item">
        <svg class="feature-icon" viewBox="0 0 24 24" strokeWidth="2">
          <circle cx="12" cy="12" r="10"/>
          <polyline points="12 6 12 12 16 14"/>
        </svg>
        <span class="feature-text" data-i18n="features.punctual">Siempre puntuales</span>
      </div>
      <div class="feature-item">
        <svg class="feature-icon" viewBox="0 0 24 24" strokeWidth="2">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
          <polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        <span class="feature-text" data-i18n="features.luxury">Lujo y confort</span>
      </div>
    </div>
  </section>

  <script src="/js/i18n.js"></script>
  <script>
    const API_SERVICIOS = '/xserv-servicios.json';
    const servicesGrid = document.getElementById('servicesGrid');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const loadMoreContainer = document.getElementById('loadMoreContainer');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    let serviciosCache = [];
    let currentPage = 1;
    let totalPages = 1;
    let isLoading = false;

    const imagenesServicios = [
      'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=400&h=300&fit=crop',
      'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=400&h=300&fit=crop',
      'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=400&h=300&fit=crop',
      'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop',
      'https://images.unsplash.com/photo-1563720223185-11003d516935?w=400&h=300&fit=crop',
      'https://images.unsplash.com/photo-1519741497674-611481863552?w=400&h=300&fit=crop',
    ];

    const getImagenServicio = (servicio, index) => {
      return servicio.imagen || servicio.image || imagenesServicios[index % imagenesServicios.length];
    };

    const formatPrice = (precio) => {
      const value = Number(precio);
      if (!Number.isFinite(value) || value <= 0) return null;
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0,
      }).format(value);
    };

    const buildServiceCard = (servicio, index, lang) => {
      // Usar la función de traducción global que está siempre disponible
      const t = window.t || window.__translate || ((key) => key);
      const nombre = servicio.nombre || servicio.titulo || t('services.defaultName');
      const descriptionKey = `service.${servicio.id}.description`;
      const descripcion = t(descriptionKey) || t('services.defaultDesc');
      const precio = formatPrice(servicio.precio_base ?? servicio.precio ?? servicio.costo);
      const precioTexto = precio || t('services.consult');
      const showFrom = Boolean(precio);
      const href = servicio.id ? `/services/${servicio.id}` : '/services';
      const estado = String(servicio.estado || '').toLowerCase();
      const activeLabel = t('service.active');
      const inactiveLabel = t('service.inactive');
      const activeText = activeLabel && activeLabel !== 'service.active' ? activeLabel : 'Activo';
      const inactiveText = inactiveLabel && inactiveLabel !== 'service.inactive' ? inactiveLabel : 'Inactivo';
      const estadoTexto = estado === 'activo' ? activeText : inactiveText;
      return `
        <div class="service-card" style="--i: ${index};">
          <div class="service-media">
            <img src="${getImagenServicio(servicio, index)}" alt="${nombre}" class="service-image">
            <div class="service-badges">
              <span class="service-badge status">${estadoTexto}</span>
            </div>
          </div>
          <div class="service-content">
            <div class="service-head">
              <h3 class="service-title">${nombre}</h3>
              <span class="service-badge price">${precioTexto}</span>
            </div>
            <p class="service-description">${descripcion}</p>
            <div class="service-actions">
              <a href="${href}" class="btn-more">${t('btn.viewMore')}</a>
            </div>
          </div>
        </div>
      `;
    };

    const renderServicios = (append = false) => {
      if (!servicesGrid) return;
      // Usar la función de traducción global que está siempre disponible
      const t = window.t || window.__translate || ((key) => key);
      const lang = window.getCurrentLanguage ? window.getCurrentLanguage() : 'es';

      if (!serviciosCache.length) {
        if (!append) {
          servicesGrid.innerHTML = `<div style="grid-column: 1 / -1; text-align: center; color: var(--text-gray);">${t('services.none')}</div>`;
        }
        return;
      }

      const html = serviciosCache.map((servicio, index) => buildServiceCard(servicio, index, lang)).join('');
      
      if (append) {
        servicesGrid.innerHTML += html;
      } else {
        servicesGrid.innerHTML = html;
      }
    };

    const handleLanguageChange = () => {
      renderServicios(false);
    };

    const updateLoadMoreButton = () => {
      const hasMore = currentPage < totalPages;
      loadMoreContainer.style.display = serviciosCache.length > 0 ? 'block' : 'none';
      loadMoreBtn.style.display = hasMore ? 'block' : 'none';
      loadingSpinner.style.display = 'none';
    };

    const cargarServicios = async (page = 1) => {
      if (isLoading) return;
      isLoading = true;
      
      if (page === 1) {
        loadingSpinner.style.display = 'block';
      }

      try {
        const url = new URL(API_SERVICIOS, window.location.origin);
        url.searchParams.set('page', page);
        
        const res = await fetch(url.toString(), {
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        
        if (!res.ok) {
          renderServicios();
          updateLoadMoreButton();
          isLoading = false;
          return;
        }
        
        const data = await res.json();
        const servicios = Array.isArray(data.xservServicios) ? data.xservServicios : [];
        const paginacion = data.pagination || {};
        
        totalPages = paginacion.pageCount || 1;
        currentPage = paginacion.page || 1;
        
        const serviciosFiltrados = servicios.filter((servicio) => String(servicio.estado ?? '1') !== '0');
        
        if (page === 1) {
          serviciosCache = serviciosFiltrados;
          renderServicios(false);
        } else {
          serviciosCache = serviciosCache.concat(serviciosFiltrados);
          renderServicios(true);
        }
        
        updateLoadMoreButton();
      } catch (error) {
        console.error('Error cargando servicios:', error);
        if (currentPage === 1) {
          renderServicios();
        }
        updateLoadMoreButton();
      } finally {
        isLoading = false;
      }
    };

    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', async () => {
        await cargarServicios(currentPage + 1);
      });
    }

    cargarServicios(1);
    window.addEventListener('languageChanged', handleLanguageChange);
  </script>
  <script src="/js/i18n.js" defer></script>
  <script src="/js/header-loader.js" defer></script>
  <script src="/js/header-dynamic.js" defer></script>
</body>
</html>