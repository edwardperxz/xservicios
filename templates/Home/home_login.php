<?php
/** @var \App\View\AppView $this */
/** @var \App\Model\Entity\XservUsuario|null $user */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Xservicios - Transporte Turístico de Lujo en Chiriquí</title>
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
      gap: 0.5rem;
      color: var(--text-gray);
      text-decoration: none;
      font-size: 0.875rem;
      transition: color 0.3s;
    }

    .nav-item:hover,
    .nav-item.active {
      color: var(--gold);
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

    /* User Menu Dropdown */
    .user-menu {
      position: relative;
    }

    .user-menu-trigger {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      cursor: pointer;
      padding: 0.5rem;
      border-radius: 8px;
      transition: background 0.3s;
    }

    .user-menu-trigger:hover {
      background: rgba(201, 169, 98, 0.1);
    }

    .user-menu-trigger.active {
      background: rgba(201, 169, 98, 0.15);
    }

    .dropdown-menu {
      position: absolute;
      top: 100%;
      right: 0;
      background: var(--dark-card);
      border: 1px solid var(--dark-lighter);
      border-radius: 8px;
      min-width: 200px;
      margin-top: 0.5rem;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s ease;
      z-index: 1000;
    }

    .dropdown-menu.active {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .dropdown-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.875rem 1.25rem;
      color: var(--text-gray);
      text-decoration: none;
      font-size: 0.9rem;
      transition: all 0.3s;
      border: none;
      background: none;
      cursor: pointer;
      width: 100%;
      text-align: left;
    }

    .dropdown-item:first-child {
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

    .dropdown-item:last-child {
      border-bottom-left-radius: 8px;
      border-bottom-right-radius: 8px;
    }

    .dropdown-item:hover {
      background: rgba(201, 169, 98, 0.15);
      color: var(--gold);
    }

    .dropdown-item-icon {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    .dropdown-divider {
      height: 1px;
      background: var(--dark-lighter);
      margin: 0.5rem 0;
    }

    .dropdown-item.danger {
      color: #ef4444;
    }

    .dropdown-item.danger:hover {
      background: rgba(239, 68, 68, 0.15);
      color: #ef4444;
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
  <header class="header">
    <div class="logo">
      <span class="logo-x">X</span>SERVICIOS
    </div>

    <nav class="nav-menu">
      <a href="/home" class="nav-item active">Inicio</a>
      <a href="/fleet" class="nav-item">Ver flota</a>
      <a href="/services" class="nav-item">Servicios</a>
      <a href="/about" class="nav-item">Nosotros</a>
    </nav>

    <div class="header-right">
      <div class="lang-selector">
        <span class="active">ES</span>
        <span>|</span>
        <span>EN</span>
      </div>
      <div class="user-menu">
        <div class="user-menu-trigger" onclick="toggleUserMenu(event)">
          <div class="user-avatar"><?= substr($user->nombre ?? $user->username, 0, 2) ?></div>
          <span class="user-name"><?= h($user->nombre ?? $user->username) ?></span>
        </div>
        <div class="dropdown-menu" id="userDropdown">
          <a href="#" class="dropdown-item">
            <svg class="dropdown-item-icon" viewBox="0 0 24 24">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            Mi Perfil
          </a>
          <a href="/myreservations" class="dropdown-item">
            <svg class="dropdown-item-icon" viewBox="0 0 24 24">
              <path d="M6 9l6 6 6-6"></path>
              <path d="M6 3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path>
            </svg>
            Mis Reservas
          </a>
          <a href="/rateservice" class="dropdown-item">
            <svg class="dropdown-item-icon" viewBox="0 0 24 24">
              <polygon points="12 2 15.09 10.26 24 10.26 17.82 16.74 20.91 25 12 19.54 3.09 25 6.18 16.74 0 10.26 8.91 10.26 12 2"></polygon>
            </svg>
            Valorar Servicio
          </a>
          <div class="dropdown-divider"></div>
          <button onclick="logout()" class="dropdown-item danger">
            <svg class="dropdown-item-icon" viewBox="0 0 24 24">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            Cerrar Sesión
          </button>
        </div>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title">Transporte turístico de lujo en Chiriquí</h1>
      <p class="hero-description">Reserva un traslado seguro, puntual y de alta calidad con Xservicios.</p>
      <a href="/newreservation" class="btn-primary">Nueva Reserva</a>
    </div>
  </section>

  <!-- Tabs Section -->
  <section class="tabs-section">
    <nav class="tabs-nav">
      <div class="tab-item active">
        <span>Resumen Rápido</span>
      </div>
      <div class="tab-item">
        <span>Nueva Reserva</span>
      </div>
      <div class="tab-item">
        <span>Mis Reservas</span>
      </div>
      <div class="tab-item">
        <span>Valorar Servicio</span>
      </div>
    </nav>

    <!-- Content Card -->
    <div class="content-card">
      <div class="card-header">
        <div class="date-display">
          <span class="date-day" id="resumenDia"><?= date('d') ?></span>
          <span class="date-month" id="resumenMes"><?= strftime('%B %Y', time()) ?></span>
        </div>
        <button class="btn-history">
          Historial de Servicios
        </button>
      </div>

      <div class="service-list" id="serviceList">
        <p class="empty-message">No hay reservas recientes.</p>
      </div>

      <div style="display: flex; justify-content: flex-end; margin-top: 1rem;">
        <a href="/myreservations" style="padding: 0.75rem 1.5rem; background: transparent; color: var(--text-white); border: 1px solid var(--dark-lighter); border-radius: 8px; font-size: 0.875rem; text-decoration: none; transition: all 0.3s;">Ver Más</a>
      </div>
    </div>
  </section>

  <script>
    // Toggle user menu dropdown
    function toggleUserMenu(event) {
      event.stopPropagation();
      const dropdown = document.getElementById('userDropdown');
      const trigger = event.currentTarget;
      
      dropdown.classList.toggle('active');
      trigger.classList.toggle('active');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById('userDropdown');
      const userMenu = document.querySelector('.user-menu');
      
      if (!userMenu.contains(event.target)) {
        dropdown.classList.remove('active');
        document.querySelector('.user-menu-trigger').classList.remove('active');
      }
    });

    // Close dropdown when clicking on an item
    document.querySelectorAll('.dropdown-item').forEach(item => {
      item.addEventListener('click', function(event) {
        if (this.onclick) {
          // Button logout
          return;
        }
        // Close dropdown for links
        document.getElementById('userDropdown').classList.remove('active');
        document.querySelector('.user-menu-trigger').classList.remove('active');
      });
    });
  </script>

  <script src="/js/header-auth.js"></script>
</body>
</html>
