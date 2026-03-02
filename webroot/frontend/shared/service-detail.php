<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.serviceDetail">Xservicios - Detalle del Servicio</title>
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
      --gold-soft: rgba(201, 169, 98, 0.2);
      --gold-strong: #b98b4a;
      --dark-bg: #0a0a0a;
      --dark-deep: #050505;
      --dark-card: #1a1a1a;
      --dark-lighter: #2a2a2a;
      --dark-glass: rgba(10, 10, 10, 0.65);
      --text-white: #ffffff;
      --text-gray: #a0a0a0;
      --text-muted: #7a7a7a;
      --green: #4ade80;
      --red: #ef4444;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: radial-gradient(circle at top, rgba(201, 169, 98, 0.18), transparent 55%),
        radial-gradient(circle at 15% 70%, rgba(185, 139, 74, 0.12), transparent 55%),
        linear-gradient(180deg, #060606 0%, #0b0b0b 55%, #050505 100%);
      color: var(--text-white);
      min-height: 100vh;
    }

    .page-hero {
      padding: 6.5rem 2rem 2.5rem;
    }

    .hero-shell {
      max-width: 1140px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
      gap: 2.5rem;
      align-items: center;
    }

    .hero-eyebrow {
      text-transform: uppercase;
      letter-spacing: 0.35em;
      font-size: 0.75rem;
      color: var(--gold-light);
      margin-bottom: 0.8rem;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 2.9rem;
      font-weight: 500;
      line-height: 1.1;
    }

    .hero-subtitle {
      margin-top: 0.75rem;
      color: var(--text-gray);
      font-size: 1rem;
      line-height: 1.6;
    }

    .hero-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
      margin-top: 1.25rem;
    }

    .hero-pill {
      padding: 0.4rem 0.85rem;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: var(--text-gray);
      font-size: 0.82rem;
      font-weight: 600;
    }

    .hero-pill.active {
      background: rgba(74, 222, 128, 0.18);
      border-color: rgba(74, 222, 128, 0.4);
      color: #86efac;
    }

    .hero-pill.inactive {
      background: rgba(239, 68, 68, 0.18);
      border-color: rgba(239, 68, 68, 0.4);
      color: #fca5a5;
    }

    .hero-pill.price {
      background: rgba(201, 169, 98, 0.2);
      border-color: rgba(201, 169, 98, 0.5);
      color: var(--gold-light);
    }

    .hero-media {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      min-height: 320px;
      background: var(--dark-card);
      border: 1px solid rgba(201, 169, 98, 0.25);
      box-shadow: 0 22px 50px rgba(0, 0, 0, 0.45);
    }

    .hero-media img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .hero-media::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.65));
    }

    .hero-meta {
      position: absolute;
      inset: auto 1.25rem 1.25rem 1.25rem;
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 0.75rem;
      z-index: 2;
    }

    .hero-meta-item {
      background: var(--dark-glass);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 12px;
      padding: 0.75rem 0.9rem;
      color: var(--text-white);
    }

    .hero-meta-item span {
      display: block;
      font-size: 0.7rem;
      color: var(--text-gray);
      text-transform: uppercase;
      letter-spacing: 0.2em;
      margin-bottom: 0.3rem;
    }

    .hero-meta-item strong {
      font-size: 0.95rem;
      font-weight: 600;
    }

    .detail-section {
      padding: 1.5rem 1.5rem 3.5rem;
      display: flex;
      justify-content: center;
    }

    .detail-card {
      width: 100%;
      max-width: 1140px;
      background: radial-gradient(circle at top, rgba(201, 169, 98, 0.12), transparent 55%), var(--dark-card);
      border-radius: 22px;
      padding: 2.35rem;
      border: 1px solid rgba(201, 169, 98, 0.2);
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.45);
    }

    .detail-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 1.25rem;
      padding-bottom: 1.25rem;
      border-bottom: 1px solid var(--dark-lighter);
      margin-bottom: 1.5rem;
    }

    .detail-title {
      font-size: 1.75rem;
      font-weight: 600;
    }

    .detail-intro {
      font-size: 0.875rem;
      color: var(--text-muted);
      margin-top: 0.35rem;
    }

    .detail-actions {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .btn {
      padding: 0.625rem 1.25rem;
      border-radius: 999px;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      border: none;
      cursor: pointer;
      font-size: 0.875rem;
      white-space: nowrap;
    }

    .btn-primary {
      background: var(--gold);
      color: var(--dark-bg);
      box-shadow: 0 10px 20px rgba(201, 169, 98, 0.2);
    }

    .btn-primary:hover {
      background: var(--gold-light);
      transform: translateY(-1px);
    }

    .btn-secondary {
      background: transparent;
      color: var(--text-white);
      border: 1px solid var(--dark-lighter);
    }

    .btn-secondary:hover {
      border-color: var(--gold);
      color: var(--gold);
    }

    .pill-row {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
    }

    .pill {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.4rem 0.85rem;
      border-radius: 999px;
      font-size: 0.8rem;
      font-weight: 600;
      background: rgba(255, 255, 255, 0.06);
      color: var(--text-gray);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .pill.active {
      background: rgba(74, 222, 128, 0.2);
      color: #86efac;
      border-color: rgba(74, 222, 128, 0.4);
    }

    .pill.inactive {
      background: rgba(239, 68, 68, 0.2);
      color: #fca5a5;
      border-color: rgba(239, 68, 68, 0.4);
    }

    .pill.price {
      background: var(--gold-soft);
      color: var(--gold);
      border-color: rgba(201, 169, 98, 0.5);
    }

    .detail-layout {
      display: grid;
      grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.8fr);
      gap: 2rem;
    }

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.1rem;
    }

    .detail-item {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.05);
      padding: 1rem 1.1rem;
      border-radius: 12px;
    }

    .detail-item.full {
      grid-column: 1 / -1;
    }

    .detail-label {
      font-size: 0.7rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.6px;
      margin-bottom: 0.5rem;
    }

    .detail-text {
      font-size: 0.85rem;
      color: var(--text-gray);
      line-height: 1.6;
      margin-bottom: 0.75rem;
    }

    .detail-value {
      font-size: 0.95rem;
      color: var(--text-white);
      font-weight: 500;
      line-height: 1.6;
      word-break: break-word;
    }

    .detail-list {
      display: grid;
      gap: 0.5rem;
      margin: 0;
      padding-left: 1rem;
      color: var(--text-gray);
      font-size: 0.9rem;
      line-height: 1.6;
    }

    .detail-highlight {
      background: rgba(201, 169, 98, 0.12);
      border: 1px solid rgba(201, 169, 98, 0.25);
    }

    .reserve-card {
      margin-top: 0;
      padding: 1.5rem;
      border-radius: 14px;
      border: 1px solid rgba(201, 169, 98, 0.3);
      background: linear-gradient(120deg, rgba(201, 169, 98, 0.12), rgba(10, 10, 10, 0.1));
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      flex-direction: column;
      align-items: flex-start;
    }

    .customize-card {
      margin-top: 1.25rem;
      padding: 1.4rem;
      border-radius: 14px;
      border: 1px solid rgba(255, 255, 255, 0.08);
      background: var(--dark-glass);
      display: grid;
      gap: 0.75rem;
    }

    .customize-title {
      font-size: 1rem;
      font-weight: 600;
      color: var(--text-white);
    }

    .customize-text {
      color: var(--text-gray);
      font-size: 0.85rem;
      line-height: 1.6;
    }

    .reserve-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--text-white);
      margin-bottom: 0.25rem;
    }

    .reserve-text {
      font-size: 0.85rem;
      color: var(--text-gray);
    }

    .terms-modal {
      position: fixed;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
    }

    .terms-modal.is-hidden {
      display: none;
    }

    .terms-backdrop {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.68);
      backdrop-filter: blur(2px);
    }

    .terms-dialog {
      position: relative;
      width: min(540px, 92vw);
      background: var(--dark-card);
      border: 1px solid var(--dark-lighter);
      border-radius: 16px;
      padding: 1.75rem;
      z-index: 1;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
    }

    .terms-title {
      font-size: 1.25rem;
      margin-bottom: 0.75rem;
      color: var(--text-white);
    }

    .terms-body {
      font-size: 0.875rem;
      color: var(--text-gray);
      line-height: 1.6;
    }

    .terms-check {
      display: flex;
      gap: 0.5rem;
      align-items: flex-start;
      margin-top: 1rem;
      color: var(--text-gray);
      font-size: 0.875rem;
    }

    .terms-check input {
      margin-top: 0.2rem;
    }

    .terms-actions {
      display: flex;
      gap: 0.75rem;
      justify-content: flex-end;
      margin-top: 1.25rem;
      flex-wrap: wrap;
    }

    .state {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .state.error {
      color: #fca5a5;
    }

    @media (max-width: 768px) {
      .page-hero {
        padding-top: 100px;
      }

      .hero-shell {
        grid-template-columns: 1fr;
      }

      .detail-section {
        padding: 1rem 1rem 2.5rem;
      }

      .detail-card {
        padding: 1.5rem;
      }

      .detail-title {
        font-size: 1.35rem;
      }

      .detail-actions {
        width: 100%;
      }

      .btn {
        width: 100%;
      }

      .detail-layout {
        grid-template-columns: 1fr;
      }

      .detail-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 480px) {
      .page-hero {
        padding: 5rem 1rem 1.5rem;
      }

      .hero-title {
        font-size: 2rem;
      }

      .detail-card {
        padding: 1.25rem;
      }

      .btn {
        padding: 0.55rem 1rem;
        font-size: 0.8125rem;
      }
    }
  </style>
  <link rel="stylesheet" href="/css/header-auth.css">
</head>
<body>
  <section class="page-hero">
    <div class="hero-shell">
      <div>
        <div class="hero-eyebrow">Xservicios</div>
        <h1 class="hero-title" id="serviceTitle">Servicio</h1>
        <p class="hero-subtitle" id="serviceSubtitle">Detalle del servicio seleccionado.</p>
        <div class="hero-pills">
          <span class="hero-pill" id="serviceStatus">Estado</span>
          <span class="hero-pill price" id="servicePrice">Precio base</span>
        </div>
      </div>
      <div class="hero-media">
        <img id="serviceHeroImage" alt="Imagen del servicio" loading="lazy">
        <div class="hero-meta">
          <div class="hero-meta-item">
            <span>Precio base</span>
            <strong id="servicePriceValue">...</strong>
          </div>
          <div class="hero-meta-item">
            <span>Estado</span>
            <strong id="serviceStatusValue">...</strong>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="detail-section">
    <div class="detail-card">
      <div class="detail-header">
        <div>
          <div class="detail-title" id="serviceName">Servicio</div>
          <div class="detail-intro" data-i18n="services.detailIntro">Informacion general y descripcion del servicio.</div>
        </div>
        <div class="detail-actions">
          <a href="/services" class="btn btn-secondary" data-i18n="btn.backServices">Volver a Servicios</a>
        </div>
      </div>

      <div class="detail-layout">
        <div class="detail-grid">
          <div class="detail-item">
            <div class="detail-label" data-i18n="service.status">Estado</div>
            <div class="detail-value" id="serviceStatusValueInline">...</div>
          </div>
          <div class="detail-item">
            <div class="detail-label" data-i18n="service.basePrice">Precio base</div>
            <div class="detail-value" id="servicePriceValueInline">...</div>
          </div>
          <div class="detail-item full">
            <div class="detail-label" data-i18n="services.description">Descripción</div>
            <div class="detail-value" id="serviceDesc">...</div>
          </div>
          <div class="detail-item full">
            <div class="detail-label" data-i18n="services.variants">Variantes disponibles</div>
            <div class="detail-text" data-i18n="services.variantsHint">Selecciona las opciones disponibles que se adapten a tus necesidades. Cada variante puede incluir cambios de ruta, horarios o servicios adicionales.</div>
            <ul class="detail-list" id="serviceVariantsList"></ul>
          </div>
        </div>

        <div>
          <div class="reserve-card">
            <div>
              <div class="reserve-title" data-i18n="services.reserveTitle">Reserva este servicio</div>
              <div class="reserve-text" data-i18n="services.reserveText">Acepta los terminos y condiciones para solicitar tu reserva.</div>
            </div>
            <button type="button" class="btn btn-primary" id="reserveBtn" data-i18n="btn.reserve">Reservar</button>
          </div>
          <div class="customize-card">
            <div class="customize-title" data-i18n="services.customizeTitle">Personaliza tu servicio</div>
            <div class="customize-text" data-i18n="services.customizeText">Cuéntanos cambios de ruta, variantes o condiciones especiales. Te enviamos una propuesta a medida.</div>
            <a href="/home#quoteContainer" class="btn btn-secondary" id="customizeBtn" data-i18n="btn.requestCustomization">Solicitar personalizacion</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="terms-modal is-hidden" id="termsModal" aria-hidden="true">
    <div class="terms-backdrop" data-close="true"></div>
    <div class="terms-dialog" role="dialog" aria-modal="true" aria-labelledby="termsTitle">
      <div class="terms-title" id="termsTitle" data-i18n="terms.title">Terminos y condiciones</div>
      <div class="terms-body" data-i18n="terms.body">
        Al continuar, aceptas que la disponibilidad esta sujeta a confirmacion y que los tiempos pueden variar segun el servicio. Te notificaremos cualquier cambio.
      </div>
      <label class="terms-check">
        <input type="checkbox" id="termsAccept">
        <span data-i18n="terms.accept">Acepto los terminos y condiciones del servicio.</span>
      </label>
      <div class="terms-actions">
        <button type="button" class="btn btn-secondary" id="cancelTermsBtn" data-i18n="btn.cancel">Cancelar</button>
        <button type="button" class="btn btn-primary" id="confirmReserveBtn" disabled data-i18n="btn.requestReservation">Solicitar reserva</button>
      </div>
    </div>
  </div>

  <script src="/js/i18n.js"></script>
  <script>
    const serviceId = window.location.pathname.split('/').filter(Boolean).pop();
    const serviceTitle = document.getElementById('serviceTitle');
    const serviceSubtitle = document.getElementById('serviceSubtitle');
    const serviceName = document.getElementById('serviceName');
    const serviceStatus = document.getElementById('serviceStatus');
    const servicePrice = document.getElementById('servicePrice');
    const serviceHeroImage = document.getElementById('serviceHeroImage');
    const serviceDesc = document.getElementById('serviceDesc');
    const serviceStatusValue = document.getElementById('serviceStatusValue');
    const servicePriceValue = document.getElementById('servicePriceValue');
    const serviceStatusValueInline = document.getElementById('serviceStatusValueInline');
    const servicePriceValueInline = document.getElementById('servicePriceValueInline');
    const serviceVariantsList = document.getElementById('serviceVariantsList');
    const customizeBtn = document.getElementById('customizeBtn');
    const reserveBtn = document.getElementById('reserveBtn');
    const modal = document.getElementById('termsModal');
    const backdrop = modal ? modal.querySelector('.terms-backdrop') : null;
    const accept = document.getElementById('termsAccept');
    const confirmBtn = document.getElementById('confirmReserveBtn');
    const cancelBtn = document.getElementById('cancelTermsBtn');

    const setText = (el, value, fallback = '-') => {
      if (!el) return;
      el.textContent = value || fallback;
    };

    const formatPrice = (value) => {
      const number = Number(value);
      if (!Number.isFinite(number) || number <= 0) return 'Consultar';
      return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', minimumFractionDigits: 0 }).format(number);
    };

    const imagenesServicios = [
      'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1563720223185-11003d516935?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1519741497674-611481863552?w=900&h=600&fit=crop'
    ];

    const getHeroImage = (servicio) => {
      if (servicio && (servicio.imagen || servicio.image)) {
        return servicio.imagen || servicio.image;
      }
      const numericId = Number(servicio?.id ?? serviceId) || 0;
      return imagenesServicios[numericId % imagenesServicios.length];
    };

    let servicioData = null; // Almacenar los datos del servicio

    const renderService = () => {
      if (!servicioData) return;

      // Usar la función de traducción global que está siempre disponible
      const t = window.t || window.__translate || ((key) => key);
      
      const servicio = servicioData;
      const status = String(servicio.estado || '').toLowerCase();
      const isActive = status === 'activo';

      setText(serviceTitle, servicio.nombre, 'Servicio');
      setText(serviceName, servicio.nombre, 'Servicio');
      setText(serviceSubtitle, servicio.nombre || 'Detalle del servicio seleccionado.');
      
      // Usar la descripción desde i18n con clave service.{id}.description
      const descKey = `service.${servicio.id}.description`;
      const description = t(descKey);
      setText(serviceDesc, description || t('services.defaultDesc'));
      
      const activeLabel = t('service.active');
      const inactiveLabel = t('service.inactive');
      const activeText = activeLabel && activeLabel !== 'service.active' ? activeLabel : 'Activo';
      const inactiveText = inactiveLabel && inactiveLabel !== 'service.inactive' ? inactiveLabel : 'Inactivo';
      const estadoTexto = isActive ? activeText : inactiveText;

      setText(servicePrice, `${t('service.basePrice')}: ${formatPrice(servicio.precio_base)}`);
      setText(serviceStatus, `${t('service.status')}: ${estadoTexto}`);
      setText(serviceStatusValue, estadoTexto);
      setText(servicePriceValue, formatPrice(servicio.precio_base));
      setText(serviceStatusValueInline, estadoTexto);
      setText(servicePriceValueInline, formatPrice(servicio.precio_base));
      serviceStatus.classList.add(isActive ? 'active' : 'inactive');

      if (serviceHeroImage) {
        serviceHeroImage.src = getHeroImage(servicio);
      }

      if (serviceVariantsList) {
        // Usar variantes desde i18n con clave service.{id}.variants
        const variantsKey = `service.${servicio.id}.variants`;
        const variantsRaw = t(variantsKey) || servicio.variantes || '';
        const variants = variantsRaw
          .split(/\r?\n|\s*;\s*|\s*,\s*/)
          .map((item) => item.trim())
          .filter(Boolean);
        serviceVariantsList.innerHTML = variants.length
          ? variants.map((item) => `<li>${item}</li>`).join('')
          : `<li>${t('services.noVariants') || 'No hay variantes registradas'}</li>`;
      }

      if (customizeBtn) {
        const params = new URLSearchParams();
        if (servicio.id) params.set('service_id', servicio.id);
        if (servicio.nombre) params.set('service_name', servicio.nombre);
        const query = params.toString();
        customizeBtn.href = query ? `/home?${query}#quoteContainer` : '/home#quoteContainer';
      }
    };

    const loadService = async () => {
      if (!serviceId || !serviceId.match(/^\d+$/)) {
        setText(serviceName, 'Servicio no encontrado');
        return;
      }

      try {
        const res = await fetch(`/xserv-servicios/view/${serviceId}.json`, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });
        if (!res.ok) {
          setText(serviceName, 'Servicio no encontrado');
          return;
        }
        const data = await res.json();
        servicioData = data && data.xservServicio ? data.xservServicio : null;
        
        if (!servicioData) {
          setText(serviceName, 'Servicio no encontrado');
          return;
        }

        // Renderizar con el idioma actual
        renderService();
      } catch (error) {
        setText(serviceName, 'Servicio no encontrado');
      }
    };

    const openModal = () => {
      modal.classList.remove('is-hidden');
      modal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
      modal.classList.add('is-hidden');
      modal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
      accept.checked = false;
      confirmBtn.disabled = true;
    };

    const isAuthenticated = async () => {
      try {
        const res = await fetch('/xserv-usuarios/me', {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });
        if (!res.ok) {
          return false;
        }
        const data = await res.json();
        return Boolean(data && data.success);
      } catch (error) {
        return false;
      }
    };

    if (reserveBtn && modal && accept && confirmBtn && cancelBtn && backdrop) {
      reserveBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        // Verificar autenticación ANTES de abrir el modal
        if (!(await isAuthenticated())) {
          window.location.href = '/xserv-usuarios/login';
          return;
        }
        // Si está autenticado, abrir el modal de términos
        openModal();
      });
      backdrop.addEventListener('click', closeModal);
      cancelBtn.addEventListener('click', closeModal);
      accept.addEventListener('change', () => {
        confirmBtn.disabled = !accept.checked;
      });
      confirmBtn.addEventListener('click', async () => {
        const target = serviceId ? `/newreservation?service_id=${serviceId}` : '/newreservation';
        window.location.href = target;
      });
    }

    loadService();
    
    // Escuchar cambios de idioma para re-renderizar los datos del servicio
    window.addEventListener('languageChanged', renderService);
  </script>
  <script src="/js/header-loader.js" defer></script>
  <script src="/js/header-dynamic.js" defer></script>
  <script src="/js/i18n.js" defer></script>
</body>
</html>
