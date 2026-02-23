<?php
/** @var \App\View\AppView $this */
/** @var \App\Model\Entity\XservUsuario|null $user */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrfToken" content="<?= $this->request->getAttribute('csrfToken') ?>">
  <title data-i18n="page.title.dashboard">Xservicios - Dashboard</title>
  
  <!-- Pre-load language from localStorage to avoid flash -->
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
    .xserv-header {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.75rem 2.5rem 1rem 2.5rem;
      background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
    }

    .xserv-logo {
      display: flex;
      align-items: center;
      gap: 0.25rem;
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      font-size: 1.5rem;
      letter-spacing: 2px;
      color: var(--text-white);
      text-decoration: none;
      position: absolute;
      left: 2.5rem;
    }

    .xserv-logo-x {
      color: var(--gold);
      font-size: 1.8rem;
      font-weight: 700;
    }

    .xserv-nav-menu {
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .xserv-nav-item {
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

    .xserv-nav-item:hover,
    .xserv-nav-item.active {
      color: var(--gold);
    }

    .xserv-user-actions {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      position: absolute;
      right: 2.5rem;
    }

    .xserv-lang-button {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.5rem 0.75rem;
      background: rgba(201, 169, 98, 0.1);
      border: 1px solid rgba(201, 169, 98, 0.3);
      border-radius: 6px;
      color: var(--text-white);
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .xserv-lang-button:hover {
      background: rgba(201, 169, 98, 0.2);
      border-color: var(--gold);
      transform: translateY(-2px);
    }

    .xserv-lang-button .lang-icon {
      width: 18px;
      height: 18px;
      stroke: var(--gold);
    }

    .xserv-lang-button .lang-code {
      color: var(--gold);
      font-family: 'Inter', sans-serif;
    }

    .xserv-auth-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.65rem 1.5rem;
      min-width: 130px;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      color: var(--dark-bg);
      font-weight: 600;
      font-size: 0.9rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
    }

    .xserv-auth-button:hover {
      background: linear-gradient(135deg, var(--gold-light), var(--gold));
      transform: translateY(-2px);
    }

    .xserv-user-profile {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
      padding: 0.4rem 0.75rem;
      background: rgba(201, 169, 98, 0.1);
      border-radius: 25px;
      transition: background 0.3s;
      position: relative;
    }

    .xserv-user-profile:hover {
      background: rgba(201, 169, 98, 0.2);
    }

    .xserv-user-avatar {
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
      font-family: 'Inter', sans-serif;
    }

    .xserv-user-name {
      color: var(--text-white);
      font-size: 0.85rem;
      font-family: 'Inter', sans-serif;
    }

    .xserv-dropdown-icon {
      width: 14px;
      height: 14px;
      stroke: var(--text-gray);
      fill: none;
      transition: transform 0.3s;
    }

    .xserv-user-profile.open .xserv-dropdown-icon {
      transform: rotate(180deg);
    }

    .xserv-dropdown-menu {
      position: absolute;
      top: calc(100% + 0.5rem);
      right: 0;
      background: var(--dark-card);
      border: 1px solid rgba(201, 169, 98, 0.3);
      border-radius: 8px;
      min-width: 200px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s;
    }

    .xserv-user-profile.open .xserv-dropdown-menu {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .xserv-dropdown-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1rem;
      color: var(--text-gray);
      text-decoration: none;
      font-size: 0.85rem;
      transition: all 0.3s;
      border-bottom: 1px solid rgba(201, 169, 98, 0.1);
      font-family: 'Inter', sans-serif;
      background: none;
      border-left: none;
      border-right: none;
      border-top: none;
      cursor: pointer;
      width: 100%;
      text-align: left;
    }

    .xserv-dropdown-item:last-child {
      border-bottom: none;
    }

    .xserv-dropdown-item:hover {
      background: rgba(201, 169, 98, 0.1);
      color: var(--gold);
    }

    .xserv-dropdown-item svg {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      fill: none;
    }

    .xserv-dropdown-item.danger {
      color: #ef4444;
    }

    .xserv-dropdown-item.danger:hover {
      background: rgba(239, 68, 68, 0.1);
      color: #ef4444;
    }

    .is-hidden {
      display: none !important;
    }

    /* Hero Section */
    .hero {
      position: relative;
      height: 480px;
      background-image: url('/img/login-bg.jpeg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
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

    .empty-message {
      color: var(--text-gray);
      text-align: center;
      padding: 2rem;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="xserv-header">
    <a href="/home" class="xserv-logo">
      <span class="xserv-logo-x">X</span>SERVICIOS
    </a>
    
    <nav class="xserv-nav-menu">
      <a href="/home" class="xserv-nav-item active">
        <span data-i18n="nav.home">Inicio</span>
      </a>
      <a href="/fleet" class="xserv-nav-item">
        <span data-i18n="nav.fleet">Ver flota</span>
      </a>
      <a href="/services" class="xserv-nav-item">
        <span data-i18n="nav.services">Servicios</span>
      </a>
      <a href="/about" class="xserv-nav-item">
        <span data-i18n="nav.about">Nosotros</span>
      </a>
    </nav>

    <div class="xserv-user-actions">
      <!-- Language Toggle Button -->
      <button class="xserv-lang-button" id="langToggle" aria-label="Change language">
        <svg class="lang-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"/>
          <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
        <span class="lang-code">EN</span>
      </button>

      <!-- Login Button (shown when not authenticated) -->
      <a class="xserv-auth-button" href="/xserv-usuarios/login" id="xservLoginBtn" data-i18n="auth.login">Iniciar Sesión</a>

      <!-- User Profile (shown when authenticated) -->
      <div class="xserv-user-profile is-hidden" id="xservUserProfile">
        <div class="xserv-user-avatar" id="xservUserAvatar">US</div>
        <span class="xserv-user-name" id="xservUserName">Usuario</span>
        <svg class="xserv-dropdown-icon" viewBox="0 0 24 24" strokeWidth="2">
          <polyline points="6 9 12 15 18 9"/>
        </svg>

        <!-- Dropdown Menu -->
        <div class="xserv-dropdown-menu">
          <a href="/profile" class="xserv-dropdown-item">
            <svg viewBox="0 0 24 24" strokeWidth="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            <span data-i18n="profile.myProfile">Mi Perfil</span>
          </a>
          <a href="/myreservations" class="xserv-dropdown-item">
            <svg viewBox="0 0 24 24" strokeWidth="2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
              <line x1="16" y1="2" x2="16" y2="6"/>
              <line x1="8" y1="2" x2="8" y2="6"/>
              <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            <span data-i18n="profile.myReservations">Mis Reservas</span>
          </a>
          <a href="/rateservice" class="xserv-dropdown-item">
            <svg viewBox="0 0 24 24" strokeWidth="2">
              <polygon points="12 2 15.09 10.26 24 10.26 17.82 16.74 20.91 25 12 19.54 3.09 25 6.18 16.74 0 10.26 8.91 10.26 12 2"></polygon>
            </svg>
            <span data-i18n="rateService.title">Valorar Servicio</span>
          </a>
          <a href="/settings" class="xserv-dropdown-item">
            <svg viewBox="0 0 24 24" strokeWidth="2">
              <circle cx="12" cy="12" r="3"/>
              <path d="M12 1v6m0 6v6M5.6 5.6l4.2 4.2m4.2 4.2l4.2 4.2M1 12h6m6 0h6M5.6 18.4l4.2-4.2m4.2-4.2l4.2-4.2"/>
            </svg>
            <span data-i18n="profile.settings">Configuración</span>
          </a>
          <a href="#" class="xserv-dropdown-item danger" id="xservLogoutBtn">
            <svg viewBox="0 0 24 24" strokeWidth="2">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
              <polyline points="16 17 21 12 16 7"/>
              <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            <span data-i18n="profile.logout">Cerrar Sesión</span>
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title" data-i18n="homeLogin.heroTitle">Transporte turístico de lujo en Chiriquí</h1>
      <p class="hero-description" data-i18n="homeLogin.heroDesc">Reserva un traslado seguro, puntual y de alta calidad con Xservicios.</p>
      <a href="/newreservation" class="btn-primary" data-i18n="homeLogin.newReservation">Nueva Reserva</a>
    </div>
  </section>

  <!-- Tabs Section -->
  <section class="tabs-section">
    <nav class="tabs-nav">
      <div class="tab-item active">
        <span data-i18n="homeLogin.quickSummary">Resumen Rápido</span>
      </div>
      <div class="tab-item">
        <span data-i18n="homeLogin.newReservation">Nueva Reserva</span>
      </div>
      <div class="tab-item">
        <span data-i18n="homeLogin.myReservations">Mis Reservas</span>
      </div>
      <div class="tab-item">
        <span data-i18n="homeLogin.rateService">Valorar Servicio</span>
      </div>
    </nav>

    <!-- Content Card -->
    <div class="content-card">
      <div class="card-header">
        <div class="date-display">
          <span class="date-day" id="resumenDia"><?= date('d') ?></span>
          <span class="date-month" id="resumenMes"><?= strftime('%B %Y', time()) ?></span>
        </div>
        <button class="btn-history" data-i18n="homeLogin.serviceHistory">
          Historial de Servicios
        </button>
      </div>

      <div class="service-list" id="serviceList">
        <p class="empty-message" data-i18n="homeLogin.emptyRecent">No hay reservas recientes.</p>
      </div>

      <div style="display: flex; justify-content: flex-end; margin-top: 1rem;">
        <a href="/myreservations" style="padding: 0.75rem 1.5rem; background: transparent; color: var(--text-white); border: 1px solid var(--dark-lighter); border-radius: 8px; font-size: 0.875rem; text-decoration: none; transition: all 0.3s;" data-i18n="homeLogin.seeMore">Ver Más</a>
      </div>
    </div>
  </section>

  <!-- Scripts cargados al final del archivo -->
  <script src="/js/i18n.js"></script>
  <script src="/js/header-dynamic.js"></script>
</body>
</html>
