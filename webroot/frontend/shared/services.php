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
      --dark-bg: #0a0a0a;
      --dark-deep: #050505;
      --dark-card: #1a1a1a;
      --dark-lighter: #2a2a2a;
      --text-white: #ffffff;
      --text-gray: #a0a0a0;
      --text-dark: #1a1a1a;
      --green: #2d7a5f;
      --green-hover: #236349;
      --cream: #f5f0e8;
      --cream-dark: #e8e0d4;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-deep);
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

    /* Header - Original Design */
    .header {
      display: flex;
      align-items: center;
      padding: 1rem 2.5rem;
      background: linear-gradient(to bottom, rgba(10, 10, 10, 0.98), rgba(5, 5, 5, 0.95));
      border-bottom: 1px solid rgba(201, 169, 98, 0.3);
      position: relative;
      z-index: 10;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0;
      flex-shrink: 0;
    }

    .logo-x {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--gold);
      text-shadow: 0 0 10px rgba(201, 169, 98, 0.5);
    }

    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--text-white);
      letter-spacing: 0.5px;
    }

    .nav-menu {
      display: flex;
      align-items: center;
      gap: 2rem;
      margin-left: 4rem;
      margin-right: 4rem;
    }

    .nav-item {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.4rem;
      min-width: 90px;
      color: var(--text-gray);
      text-decoration: none;
      font-size: 0.85rem;
      transition: color 0.3s;
      white-space: nowrap;
    }

    .nav-item:hover {
      color: var(--gold);
    }

    .nav-icon {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      fill: none;
      flex-shrink: 0;
    }

    .user-actions {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      margin-left: auto;
    }

    .lang-selector {
      display: flex;
      align-items: center;
      gap: 0.4rem;
      color: var(--text-gray);
      font-size: 0.8rem;
    }

    .lang-icon {
      width: 14px;
      height: 14px;
      stroke: var(--gold);
      fill: none;
    }

    .lang-text {
      color: var(--text-gray);
      cursor: pointer;
      transition: color 0.3s;
      font-size: 0.8rem;
    }

    .lang-text:hover {
      color: var(--gold);
    }

    .lang-divider {
      color: var(--dark-lighter);
    }

    .notification-icon {
      cursor: pointer;
      transition: color 0.3s;
    }

    .notification-icon svg {
      width: 18px;
      height: 18px;
      stroke: var(--text-gray);
      fill: none;
    }

    .notification-icon:hover svg {
      stroke: var(--gold);
    }

    .auth-button {
      padding: 0.5rem 1.1rem;
      border: 1px solid var(--gold);
      border-radius: 20px;
      color: var(--gold);
      font-size: 0.8rem;
      text-decoration: none;
      transition: all 0.3s;
      white-space: nowrap;
    }

    .auth-button:hover {
      background: rgba(201, 169, 98, 0.15);
    }

    .is-hidden {
      display: none !important;
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
      padding: 0.4rem 0.75rem;
      background: rgba(201, 169, 98, 0.1);
      border-radius: 25px;
      transition: background 0.3s;
    }

    .user-profile:hover {
      background: rgba(201, 169, 98, 0.2);
    }

    .user-avatar {
      width: 28px;
      height: 28px;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.7rem;
      font-weight: 600;
      color: var(--dark-bg);
    }

    .user-name {
      color: var(--text-white);
      font-size: 0.85rem;
    }

    .dropdown-icon {
      width: 14px;
      height: 14px;
      stroke: var(--text-gray);
      fill: none;
    }

    /* Title Section */
    .title-section {
      text-align: center;
      padding: 3rem 2rem 2rem;
      background: linear-gradient(to bottom, var(--dark-deep), var(--dark-bg));
      position: relative;
      z-index: 1;
    }

    .brand-logo {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      margin-bottom: 1.5rem;
    }

    .brand-icon {
      width: 24px;
      height: 24px;
      stroke: var(--gold);
      fill: none;
    }

    .brand-name {
      font-size: 0.875rem;
      letter-spacing: 3px;
      color: var(--gold);
      font-weight: 500;
    }

    .main-title {
      font-family: 'Playfair Display', serif;
      font-size: 2.75rem;
      font-weight: 400;
      line-height: 1.2;
      color: var(--text-white);
    }

    .main-title span {
      display: block;
      font-style: italic;
      color: var(--text-gray);
    }

    /* Services Grid */
    .services-section {
      padding: 2rem 3rem 3rem;
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
      background: var(--cream);
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
      border: 2px solid var(--gold);
      box-shadow: 0 4px 20px rgba(201, 169, 98, 0.15);
    }

    .service-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(201, 169, 98, 0.25);
      border-color: var(--gold-light);
    }

    .service-image {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .service-content {
      padding: 1.25rem;
    }

    .service-title {
      font-size: 1.125rem;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 0.5rem;
    }

    .service-description {
      font-size: 0.8rem;
      color: #666;
      line-height: 1.5;
      margin-bottom: 1rem;
      min-height: 48px;
    }

    .service-price {
      margin-bottom: 1rem;
    }

    .price-amount {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--green);
    }

    .price-label {
      font-size: 0.8rem;
      color: #888;
      margin-left: 0.25rem;
    }

    .btn-reservar {
      display: block;
      width: 100%;
      padding: 0.875rem;
      background: var(--green);
      color: white;
      font-weight: 600;
      font-size: 0.9rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s;
      text-align: center;
      text-decoration: none;
    }

    .btn-reservar:hover {
      background: var(--green-hover);
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
      .services-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .features-grid {
        gap: 2rem;
      }

      .header {
        flex-wrap: wrap;
        gap: 1rem;
      }

      .nav-menu {
        order: 3;
        width: 100%;
        justify-content: center;
        gap: 1.5rem;
      }
    }

    @media (max-width: 768px) {
      .nav-menu {
        gap: 1rem;
      }

      .nav-item span {
        display: none;
      }

      .main-title {
        font-size: 2rem;
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

      .logo-text {
        font-size: 1.25rem;
      }
    }
  </style>
  <link rel="stylesheet" href="/css/header-auth.css">
</head>
<body>
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <!-- Title Section -->
  <section class="title-section">
    <div class="brand-logo">
      <svg class="brand-icon" viewBox="0 0 24 24" strokeWidth="2">
        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9L18 10l-1.9-4.6c-.3-.7-1-1.4-1.8-1.4H9.7c-.8 0-1.5.5-1.8 1.2L6 10l-2.5 1.1C2.7 11.3 2 12.1 2 13v3c0 .6.4 1 1 1h2"/>
        <circle cx="7" cy="17" r="2"/>
        <circle cx="17" cy="17" r="2"/>
      </svg>
    </div>
    <h1 class="main-title" data-i18n="services.title">
      Servicios exclusivos
      <span>de transporte turístico</span>
    </h1>
  </section>

  <!-- Services Grid -->
  <section class="services-section">
    <div class="services-grid" id="servicesGrid">
      <!-- Card 1: Traslados Privados -->
      <div class="service-card">
        <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=400&h=300&fit=crop" alt="Traslados Privados" class="service-image">
        <div class="service-content">
          <h3 class="service-title" data-i18n="services.card1Title">Traslados Privados</h3>
          <p class="service-description" data-i18n="services.card1Desc">Recogidas y traslados privados a cualquier hotel resort o destino turístico. Comodidad y puntualidad aseguradas.</p>
          <div class="service-price">
            <span class="price-amount">$80</span>
            <span class="price-label" data-i18n="services.from">desde</span>
          </div>
          <a href="/newreservation" class="btn-reservar" data-i18n="btn.reserve">Reservar</a>
        </div>
      </div>

      <!-- Card 2: Traslados Aeropuerto -->
      <div class="service-card">
        <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=400&h=300&fit=crop" alt="Traslados Aeropuerto" class="service-image">
        <div class="service-content">
          <h3 class="service-title" data-i18n="services.card2Title">Traslados desde y hacia el Aeropuerto</h3>
          <p class="service-description" data-i18n="services.card2Desc">Traslados puntuales y seguros predilados, y hacia el aeropuerto, puerta a puerta y sin esperas.</p>
          <div class="service-price">
            <span class="price-amount">$100</span>
            <span class="price-label" data-i18n="services.from">desde</span>
          </div>
          <a href="/newreservation" class="btn-reservar" data-i18n="btn.reserve">Reservar</a>
        </div>
      </div>

      <!-- Card 3: Tours por la Ciudad -->
      <div class="service-card">
        <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=400&h=300&fit=crop" alt="Tours por la Ciudad" class="service-image">
        <div class="service-content">
          <h3 class="service-title" data-i18n="services.card3Title">Tours por la Ciudad</h3>
          <p class="service-description" data-i18n="services.card3Desc">Explora Chiriquí con nuestros tours personalizables. Conoce los mejores lugares turísticos con estilo.</p>
          <div class="service-price">
            <span class="price-amount">$120</span>
            <span class="price-label" data-i18n="services.from">desde</span>
          </div>
          <a href="/newreservation" class="btn-reservar" data-i18n="btn.reserve">Reservar</a>
        </div>
      </div>

      <!-- Card 4: Excursiones -->
      <div class="service-card">
        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop" alt="Excursiones" class="service-image">
        <div class="service-content">
          <h3 class="service-title" data-i18n="services.card4Title">Excursiones</h3>
          <p class="service-description" data-i18n="services.card4Desc">Descubre playas paradisíacas, montañas y cascadas con nuestros choferes expertos.</p>
          <div class="service-price">
            <span class="price-amount">$150</span>
            <span class="price-label" data-i18n="services.from">desde</span>
          </div>
          <a href="/newreservation" class="btn-reservar" data-i18n="btn.reserve">Reservar</a>
        </div>
      </div>

      <!-- Card 5: Servicio por Hora -->
      <div class="service-card">
        <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?w=400&h=300&fit=crop" alt="Servicio por Hora" class="service-image">
        <div class="service-content">
          <h3 class="service-title" data-i18n="services.card5Title">Servicio por Hora</h3>
          <p class="service-description" data-i18n="services.card5Desc">Disposición por horas para negocios, eventos o recorridos personalizados a tu ritmo.</p>
          <div class="service-price">
            <span class="price-amount">$80</span>
            <span class="price-label" data-i18n="services.from">desde</span>
          </div>
          <a href="/newreservation" class="btn-reservar" data-i18n="btn.reserve">Reservar</a>
        </div>
      </div>

      <!-- Card 6: Eventos Especiales -->
      <div class="service-card">
        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=400&h=300&fit=crop" alt="Eventos Especiales" class="service-image">
        <div class="service-content">
          <h3 class="service-title" data-i18n="services.card6Title">Eventos Especiales</h3>
          <p class="service-description" data-i18n="services.card6Desc">Traslados elegantes para bodas, cenas, reuniones o cualquier evento especial.</p>
          <div class="service-price">
            <span class="price-amount">$120</span>
            <span class="price-label" data-i18n="services.from">desde</span>
          </div>
          <a href="/newreservation" class="btn-reservar" data-i18n="btn.reserve">Reservar</a>
        </div>
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
    let serviciosCache = [];

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

    const getDescripcion = (servicio, lang) => {
      if (lang === 'en') {
        return servicio.descripcion_en || servicio.descripcion_es || servicio.descripcion || servicio.detalle || '';
      }
      return servicio.descripcion_es || servicio.descripcion_en || servicio.descripcion || servicio.detalle || '';
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
      const t = window.translate ? window.translate : (key) => key;
      const nombre = servicio.nombre || servicio.titulo || t('services.defaultName');
      const descripcion = getDescripcion(servicio, lang) || t('services.defaultDesc');
      const precio = formatPrice(servicio.precio_base ?? servicio.precio ?? servicio.costo);
      const precioTexto = precio || t('services.consult');
      const showFrom = Boolean(precio);
      const href = servicio.id ? `/newreservation?service_id=${servicio.id}` : '/newreservation';

      return `
        <div class="service-card">
          <img src="${getImagenServicio(servicio, index)}" alt="${nombre}" class="service-image">
          <div class="service-content">
            <h3 class="service-title">${nombre}</h3>
            <p class="service-description">${descripcion}</p>
            <div class="service-price">
              <span class="price-amount">${precioTexto}</span>
              ${showFrom ? `<span class="price-label">${t('services.from')}</span>` : ''}
            </div>
            <a href="${href}" class="btn-reservar">${t('btn.reserve')}</a>
          </div>
        </div>
      `;
    };

    const renderServicios = () => {
      if (!servicesGrid) return;
      const t = window.translate ? window.translate : (key) => key;
      const lang = window.getCurrentLanguage ? window.getCurrentLanguage() : 'es';

      if (!serviciosCache.length) {
        servicesGrid.innerHTML = `<p style="color: var(--text-gray);">${t('services.none')}</p>`;
        return;
      }

      servicesGrid.innerHTML = serviciosCache.map((servicio, index) => buildServiceCard(servicio, index, lang)).join('');
    };

    const cargarServicios = async () => {
      if (!servicesGrid) return;

      try {
        const res = await fetch(API_SERVICIOS, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        if (!res.ok) {
          renderServicios();
          return;
        }
        const data = await res.json();
        const servicios = Array.isArray(data.xservServicios) ? data.xservServicios : [];
        serviciosCache = servicios.filter((servicio) => String(servicio.estado ?? '1') !== '0');
        renderServicios();
      } catch (error) {
        console.error('Error cargando servicios:', error);
        renderServicios();
      }
    };

    cargarServicios();
    window.addEventListener('languageChanged', renderServicios);
  </script>
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
</body>
</html>