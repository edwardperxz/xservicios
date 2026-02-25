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
      --dark-bg: #0a0a0a;
      --dark-deep: #050505;
      --dark-card: #1a1a1a;
      --dark-lighter: #2a2a2a;
      --text-white: #ffffff;
      --text-gray: #a0a0a0;
      --text-muted: #7a7a7a;
      --green: #4ade80;
      --red: #ef4444;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-deep);
      color: var(--text-white);
      min-height: 100vh;
    }

    .page-hero {
      padding: 6.5rem 2rem 2rem;
      text-align: center;
      background: radial-gradient(circle at top, rgba(201, 169, 98, 0.18), transparent 55%);
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 2.5rem;
      font-weight: 500;
    }

    .hero-subtitle {
      margin-top: 0.6rem;
      color: var(--text-gray);
      font-size: 0.95rem;
    }

    .detail-section {
      padding: 1.5rem 1.5rem 3rem;
      display: flex;
      justify-content: center;
    }

    .detail-card {
      width: 100%;
      max-width: 1040px;
      background: radial-gradient(circle at top, rgba(201, 169, 98, 0.12), transparent 55%), var(--dark-card);
      border-radius: 18px;
      padding: 2.25rem;
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

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.25rem;
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

    .detail-value {
      font-size: 0.95rem;
      color: var(--text-white);
      font-weight: 500;
      line-height: 1.6;
      word-break: break-word;
    }

    .reserve-card {
      margin-top: 2rem;
      padding: 1.5rem;
      border-radius: 14px;
      border: 1px solid rgba(201, 169, 98, 0.3);
      background: linear-gradient(120deg, rgba(201, 169, 98, 0.12), rgba(10, 10, 10, 0.1));
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
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
        padding-top: 5.5rem;
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

      .detail-grid {
        grid-template-columns: 1fr;
      }

      .reserve-card {
        flex-direction: column;
        align-items: flex-start;
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
    <h1 class="hero-title" id="serviceTitle">Servicio</h1>
    <p class="hero-subtitle" id="serviceSubtitle">Detalle del servicio seleccionado.</p>
  </section>

  <section class="detail-section">
    <div class="detail-card">
      <div class="detail-header">
        <div>
          <div class="detail-title" id="serviceName">Servicio</div>
          <div class="detail-intro">Informacion general, condiciones y descripcion del servicio.</div>
        </div>
        <div class="detail-actions">
          <a href="/services" class="btn btn-secondary" data-i18n="btn.backServices">Volver a Servicios</a>
        </div>
      </div>

      <div class="pill-row">
        <span class="pill" id="serviceStatus">Estado</span>
        <span class="pill price" id="servicePrice">Precio base</span>
      </div>

      <div class="detail-grid">
        <div class="detail-item full">
          <div class="detail-label" data-i18n="services.description">Descripción</div>
          <div class="detail-value" id="serviceDesc">...</div>
        </div>
        <div class="detail-item full">
          <div class="detail-label" data-i18n="services.variants">Variantes</div>
          <div class="detail-value" id="serviceVariants">...</div>
        </div>
      </div>

      <div class="reserve-card">
        <div>
          <div class="reserve-title" data-i18n="services.reserveTitle">Reserva este servicio</div>
          <div class="reserve-text" data-i18n="services.reserveText">Acepta los terminos y condiciones para solicitar tu reserva.</div>
        </div>
        <button type="button" class="btn btn-primary" id="reserveBtn" data-i18n="btn.reserve">Reservar</button>
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
    const serviceDesc = document.getElementById('serviceDesc');
    const serviceVariants = document.getElementById('serviceVariants');
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

    let servicioData = null; // Almacenar los datos del servicio

    const renderService = () => {
      if (!servicioData) return;

      const t = window.translate ? window.translate : (key) => key;
      const lang = window.getCurrentLanguage ? window.getCurrentLanguage() : 'es';
      
      const servicio = servicioData;
      const status = String(servicio.estado || '').toLowerCase();
      const isActive = status === 'activo';

      setText(serviceTitle, servicio.nombre, 'Servicio');
      setText(serviceName, servicio.nombre, 'Servicio');
      
      // Mostrar descripción en el idioma actual en el mismo campo
      if (lang === 'en') {
        setText(serviceDesc, servicio.descripcion_en || servicio.descripcion_es || servicio.descripcion || '');
      } else {
        setText(serviceDesc, servicio.descripcion_es || servicio.descripcion_en || servicio.descripcion || '');
      }
      
      setText(serviceVariants, servicio.variantes || '');
      setText(servicePrice, `${t('service.basePrice')}: ${formatPrice(servicio.precio_base)}`);
      setText(serviceStatus, `${t('service.status')}: ${servicio.estado || 'N/A'}`);
      serviceStatus.classList.add(isActive ? 'active' : 'inactive');
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
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
</body>
</html>
