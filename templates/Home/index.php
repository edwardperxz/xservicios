<?php
/** @var \App\View\AppView $this */
/** @var bool $isAuthenticated */
/** @var \App\Model\Entity\XservUsuario|null $user */

$isAuthenticated = $isAuthenticated ?? false;
$user = $user ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrfToken" content="<?= $this->request->getAttribute('csrfToken') ?>">
  <title data-i18n="page.title.<?= $isAuthenticated ? 'dashboard' : 'home' ?>">
    <?= $isAuthenticated ? 'Xservicios - Dashboard' : 'Xservicios - Transporte Turístico de Lujo en Chiriquí' ?>
  </title>
  
  <!-- Pre-load language from localStorage to avoid flash -->
  <script src="/js/i18n-preload.js"></script>
  
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/header-auth.css">
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
      padding-top: 80px;
    }

    /* Header styles are injected by header-loader.js */

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

    .btn-secondary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.65rem 1.5rem;
      border: 1px solid var(--gold);
      color: var(--gold);
      font-weight: 600;
      font-size: 0.9rem;
      background: transparent;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
    }

    .btn-secondary:hover {
      background: rgba(201, 169, 98, 0.15);
      transform: translateY(-2px);
    }

    /* Hero Section */
    .hero {
      position: relative;
      height: 480px;
      background-image: url('/img/car-concept.jpeg');
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

    .hero-actions {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    /* Features Section */
    .features {
      padding: 3.5rem 3rem;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
    }

    .feature-card {
      background: var(--dark-card);
      padding: 2rem;
      border-radius: 8px;
      border: 1px solid var(--dark-lighter);
      transition: all 0.3s;
    }

    .feature-card:hover {
      border-color: var(--gold);
    }

    .feature-icon {
      width: 32px;
      height: 32px;
      color: var(--gold);
      margin-bottom: 1rem;
    }

    .feature-title {
      font-size: 1.125rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--text-white);
    }

    .feature-description {
      color: var(--text-gray);
      font-size: 0.9rem;
      line-height: 1.6;
    }

    /* CTA Section */
    .cta-section {
      padding: 3rem;
      text-align: center;
      background: linear-gradient(135deg, rgba(201, 169, 98, 0.1), transparent);
      border-top: 1px solid var(--dark-lighter);
      border-bottom: 1px solid var(--dark-lighter);
    }

    .cta-title {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .cta-description {
      color: var(--text-gray);
      margin-bottom: 2rem;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Tabs Section (para usuarios autenticados) */
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
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title" data-i18n="<?= $isAuthenticated ? 'homeLogin.heroTitle' : 'homePublic.heroTitle' ?>">Transporte turístico de lujo en Chiriquí</h1>
      <p class="hero-description" data-i18n="<?= $isAuthenticated ? 'homeLogin.heroDesc' : 'homePublic.heroDesc' ?>">Reserva un traslado seguro, puntual y de alta calidad con Xservicios.</p>
      
      <?php if ($isAuthenticated): ?>
        <a href="/services" class="btn-primary" data-i18n="homeLogin.newReservation">Nueva Reserva</a>
      <?php else: ?>
        <div class="hero-actions">
          <a href="/services" class="btn-primary" data-i18n="homePublic.newReservation">Nueva Reserva</a>
          <a href="#features" class="btn-secondary" data-i18n="homePublic.learnMore">Conocer Más</a>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <?php if ($isAuthenticated): ?>
    <!-- Tabs Section (para usuarios autenticados) -->
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
  <?php else: ?>
    <!-- Features Section (para usuarios no autenticados) -->
    <section class="features" id="features">
      <div class="feature-card">
        <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <h3 class="feature-title" data-i18n="homePublic.feature1Title">Disponibles 24/7</h3>
        <p class="feature-description" data-i18n="homePublic.feature1Desc">Servicio disponible todo el día, todos los días. Contáctanos cuando nos necesites.</p>
      </div>

      <div class="feature-card">
        <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <h3 class="feature-title" data-i18n="homePublic.feature2Title">Puntual y Seguro</h3>
        <p class="feature-description" data-i18n="homePublic.feature2Desc">Llegamos a tiempo con conductores profesionales y vehículos impecables.</p>
      </div>

      <div class="feature-card">
        <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
          <polyline points="12 6 8 10 10 12 14 8"></polyline>
        </svg>
        <h3 class="feature-title" data-i18n="homePublic.feature3Title">Calidad Garantizada</h3>
        <p class="feature-description" data-i18n="homePublic.feature3Desc">Vehículos de lujo mantenidos en excelentes condiciones.</p>
      </div>
    </section>

    <!-- CTA Section (para usuarios no autenticados) -->
    <section class="cta-section">
      <h2 class="cta-title" data-i18n="homePublic.ctaTitle">¿Listo para tu próximo viaje?</h2>
      <p class="cta-description" data-i18n="homePublic.ctaDesc">Reserva ahora y disfruta del transporte turístico más elegante de Chiriquí.</p>
      <div class="hero-actions" style="justify-content: center;">
        <a href="/services" class="btn-primary" data-i18n="homePublic.bookNow">Reservar Ahora</a>
        <a href="https://wa.me/507XXXXXXXXXXXX" class="btn-secondary" target="_blank" data-i18n="homePublic.support">Hablar con Soporte</a>
      </div>
    </section>
  <?php endif; ?>

  <!-- Scripts -->
  <!-- i18n-preload.js ya está cargado en el <head> -->
  <script src="/js/i18n.js"></script>
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
</body>
</html>
