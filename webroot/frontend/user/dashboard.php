<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.dashboard">Xservicios - Panel de Control</title>
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
      --dark-bg: #0d0d0d;
      --dark-card: #1a1a1a;
      --dark-lighter: #2a2a2a;
      --text-white: #ffffff;
      --text-gray: #a0a0a0;
      --green: #4ade80;
      --orange: #f59e0b;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-bg);
      color: var(--text-white);
      min-height: 100vh;
    }

    /* Header */
    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 2.5rem;
      background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.25rem;
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      font-size: 1.5rem;
      letter-spacing: 2px;
      color: var(--text-white);
    }

    .logo-x {
      color: var(--gold);
      font-size: 1.8rem;
      font-weight: 700;
    }

    .nav-menu {
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .nav-item {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      min-width: 90px;
      color: var(--text-gray);
      text-decoration: none;
      font-size: 0.875rem;
      transition: color 0.3s;
    }

    .nav-item:hover,
    .nav-item.active {
      color: var(--gold);
    }

    .nav-icon {
      width: 18px;
      height: 18px;
      stroke: currentColor;
      fill: none;
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }

    .lang-selector {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-gray);
      font-size: 0.875rem;
    }

    .lang-selector span.active {
      color: var(--text-white);
    }

    .header-icon {
      width: 20px;
      height: 20px;
      stroke: var(--gold);
      fill: none;
      cursor: pointer;
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
      gap: 0.75rem;
      cursor: pointer;
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.875rem;
      font-weight: 600;
    }

    .user-name {
      font-size: 0.875rem;
      color: var(--text-white);
    }

    /* Hero Section */
    .hero {
      position: relative;
      height: 480px;
      background: url('/img/car-concept.jpeg') center/cover no-repeat;
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

    .driver-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
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

    /* Ver Mas Button */
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
      text-decoration: none;
    }

    .btn-ver-mas:hover {
      border-color: var(--gold);
      color: var(--gold);
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .header {
        padding: 1rem;
      }

      .nav-menu {
        display: none;
      }

      .hero {
        padding: 0 1.5rem;
      }

      .hero-title {
        font-size: 2.5rem;
      }

      .tabs-section {
        padding: 1.5rem;
      }

      .tabs-nav {
        gap: 1.5rem;
        overflow-x: auto;
      }

      .service-item {
        grid-template-columns: 1fr;
        gap: 1rem;
      }

      .service-route {
        flex-wrap: wrap;
      }
    }

    @media (max-width: 640px) {
      .hero-title {
        font-size: 2rem;
      }

      .tabs-nav {
        gap: 1rem;
      }

      .tab-item span {
        display: none;
      }

      .tab-item.active span {
        display: inline;
      }
    }
  </style>
  <link rel="stylesheet" href="/css/header-auth.css">
</head>
<body>
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title" data-i18n="homeLogin.heroTitle">Transporte turistico de lujo en Chiriqui</h1>
      <p class="hero-description" data-i18n="homeLogin.heroDesc">Reserva un traslado seguro, puntual y de alta calidad con Xservicios.</p>
      <a href="/newreservation" class="btn-primary" data-i18n="homeLogin.newReservation">Nueva Reserva</a>
    </div>
  </section>

  <!-- Tabs Section -->
  <section class="tabs-section">
    <nav class="tabs-nav">
      <div class="tab-item active">
        <span data-i18n="homeLogin.quickSummary">Resumen Rapido</span>
      </div>
      <div class="tab-item">
        <svg class="tab-icon" viewBox="0 0 24 24" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
          <line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/>
          <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        <span data-i18n="homeLogin.newReservation">Nueva Reserva</span>
      </div>
      <div class="tab-item">
        <svg class="tab-icon" viewBox="0 0 24 24" stroke-width="2">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="16" y1="13" x2="8" y2="13"/>
          <line x1="16" y1="17" x2="8" y2="17"/>
        </svg>
        <span data-i18n="homeLogin.myReservations">Mis Reservas</span>
      </div>
      <div class="tab-item">
        <svg class="tab-icon" viewBox="0 0 24 24" stroke-width="2">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
        <span data-i18n="homeLogin.rateService">Valorar Servicio</span>
      </div>
    </nav>

    <!-- Content Card -->
    <div class="content-card">
      <div class="card-header">
        <div class="date-display">
          <span class="date-day" id="resumenDia">25</span>
          <span class="date-month" id="resumenMes">Abril 2026</span>
        </div>
        <button class="btn-history">
          <span data-i18n="homeLogin.serviceHistory">Historial de Servicios</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9 18 15 12 9 6"/>
          </svg>
        </button>
      </div>

      <div class="service-list" id="serviceList">
        <!-- Contenido dinamico -->
      </div>

      <div class="ver-mas-container">
        <a class="btn-ver-mas" href="/myreservations" data-i18n="homeLogin.seeMore">Ver Mas</a>
      </div>
    </div>
  </section>

  <!-- Scripts: El orden es importante -->
  <script src="/js/i18n.js"></script>
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
  <script>
    const API_ME = '/xserv-usuarios/me';
    const API_RESERVAS = '/xserv-reservas?api=json';

    const serviceList = document.getElementById('serviceList');
    const userNameEl = document.getElementById('userName');
    const userAvatarEl = document.getElementById('userAvatar');
    const resumenDiaEl = document.getElementById('resumenDia');
    const resumenMesEl = document.getElementById('resumenMes');

    const getInitials = (name) => {
      if (!name) return 'US';
      const parts = name.trim().split(/\s+/).slice(0, 2);
      return parts.map((part) => part.charAt(0).toUpperCase()).join('');
    };

    const formatDisplayName = (name) => {
      if (!name) return 'Usuario';
      const parts = name.trim().split(/\s+/).filter(Boolean);
      const first = parts[0] || 'Usuario';
      const lastInitial = parts[1] ? `${parts[1].charAt(0).toUpperCase()}.` : '';
      return lastInitial ? `${first} ${lastInitial}` : first;
    };

    const formatFecha = (value) => {
      if (!value) return null;
      const date = new Date(value);
      if (Number.isNaN(date.getTime())) return null;
      const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
      return {
        day: String(date.getDate()),
        month: `${months[date.getMonth()]} ${date.getFullYear()}`,
      };
    };

    const buildServiceItem = (reserva) => {
      const servicio = reserva.xserv_servicio || {};
      const ruta = reserva.xserv_ruta || {};
      const chofer = reserva.xserv_chofer || {};
      const vehiculo = reserva.xserv_vehiculo || {};
      const estadoRaw = (reserva.estado || reserva.status || '').toString().toLowerCase();
      const completada = ['finalizada', 'completada', 'completado'].includes(estadoRaw);
      const estadoLabel = completada ? 'Finalizada' : (estadoRaw ? estadoRaw : 'Pendiente');
      const statusClass = completada ? 'completed' : 'pending';
      const origen = ruta.origen || reserva.origen || '';
      const destino = ruta.destino || reserva.destino || '';
      const rutaTexto = (origen && destino) ? `${origen}` : (servicio.nombre || servicio.titulo || 'Servicio');
      const destinoTexto = (origen && destino) ? `${destino}` : '';
      const driverName = chofer.nombre || chofer.name || 'Sin asignar';
      const vehicleType = vehiculo.tipo || vehiculo.modelo || 'Vehiculo';

      return `
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
            <span class="route-text">${rutaTexto}</span>
            <span class="route-arrow">
              <svg viewBox="0 0 20 6">
                <line x1="0" y1="3" x2="16" y2="3" stroke="currentColor" stroke-width="2"/>
                <polygon points="14,0 20,3 14,6" fill="currentColor"/>
              </svg>
            </span>
            <span class="route-text">${destinoTexto}</span>
          </div>
          <div class="driver-info">
            <div class="driver-avatar">
              <div style="width:100%;height:100%;background:linear-gradient(135deg,#6b7280,#374151);"></div>
            </div>
            <span class="driver-name">${driverName}</span>
          </div>
          <span class="vehicle-type">${vehicleType}</span>
          <div style="display:flex;align-items:center;gap:1rem;">
            <span class="status-badge ${statusClass}">
              <span class="status-dot"></span>
              ${estadoLabel}
            </span>
            <svg class="service-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2">
              <polyline points="9 18 15 12 9 6"/>
            </svg>
          </div>
        </div>
      `;
    };

    const cargarUsuario = async () => {
      try {
        const res = await fetch(API_ME, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });

        if (!res.ok) {
          if (res.status === 401) {
            window.location.href = '/home';
          }
          return null;
        }

        const data = await res.json();
        if (!data.success) {
          return null;
        }

        const nombreRaw = data.user?.nombre || data.user?.username || 'Usuario';
        userNameEl.textContent = formatDisplayName(nombreRaw);
        userAvatarEl.textContent = getInitials(nombreRaw);
        return data.user;
      } catch (error) {
        console.error('Error cargando usuario:', error);
        return null;
      }
    };

    const cargarReservas = async () => {
      try {
        const res = await fetch(API_RESERVAS, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        if (!res.ok) return [];
        
        const contentType = res.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
          console.warn('Respuesta no es JSON, retornando array vacío');
          return [];
        }
        
        const data = await res.json();
        return Array.isArray(data.xservReservas) ? data.xservReservas : [];
      } catch (error) {
        console.error('Error cargando reservas:', error);
        return [];
      }
    };

    const renderReservas = (reservas) => {
      if (!serviceList) return;
      if (!reservas.length) {
        serviceList.innerHTML = '<p style="color: var(--text-gray);">No hay reservas recientes.</p>';
        return;
      }

      const fechaBase = formatFecha(reservas[0]?.fecha_servicio || reservas[0]?.fecha || reservas[0]?.created);
      if (fechaBase) {
        resumenDiaEl.textContent = fechaBase.day;
        resumenMesEl.textContent = fechaBase.month;
      }

      serviceList.innerHTML = reservas.slice(0, 3).map(buildServiceItem).join('');
    };

    const cargarHomeLogin = async () => {
      try {
        const user = await cargarUsuario();
        if (!user) {
          return;
        }
        const reservas = await cargarReservas();
        renderReservas(reservas);
      } catch (error) {
        console.error('Error cargando dashboard:', error);
      }
    };

    cargarHomeLogin();
  </script>
</body>
</html>
