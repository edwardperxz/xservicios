<?php
/** @var \App\View\AppView $this */
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

    .btn-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.65rem 1.5rem;
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
      <?= $this->Html->link('Iniciar Sesión', '/xserv-usuarios/login', ['class' => 'btn-primary']) ?>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title">Transporte turístico de lujo en Chiriquí</h1>
      <p class="hero-description">Reserva un traslado seguro, puntual y de alta calidad con Xservicios.</p>
      <div class="hero-actions">
        <?= $this->Html->link('Nueva Reserva', '/newreservation', ['class' => 'btn-primary']) ?>
        <?= $this->Html->link('Conocer Más', '#features', ['class' => 'btn-secondary']) ?>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features" id="features">
    <div class="feature-card">
      <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"></circle>
        <polyline points="12 6 12 12 16 14"></polyline>
      </svg>
      <h3 class="feature-title">Disponibles 24/7</h3>
      <p class="feature-description">Servicio disponible todo el día, todos los días. Contáctanos cuando nos necesites.</p>
    </div>

    <div class="feature-card">
      <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
        <polyline points="12 6 12 12 16 14"></polyline>
      </svg>
      <h3 class="feature-title">Puntual y Seguro</h3>
      <p class="feature-description">Llegamos a tiempo con conductores profesionales y vehículos impecables.</p>
    </div>

    <div class="feature-card">
      <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
        <polyline points="12 6 8 10 10 12 14 8"></polyline>
      </svg>
      <h3 class="feature-title">Calidad Garantizada</h3>
      <p class="feature-description">Vehículos de lujo mantenidos en excelentes condiciones.</p>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section">
    <h2 class="cta-title">¿Listo para tu próximo viaje?</h2>
    <p class="cta-description">Reserva ahora y disfruta del transporte turístico más elegante de Chiriquí.</p>
    <div class="hero-actions" style="justify-content: center;">
      <?= $this->Html->link('Reservar Ahora', '/newreservation', ['class' => 'btn-primary']) ?>
      <?= $this->Html->link('Hablar con Soporte', 'https://wa.me/507XXXXXXXXXXXX', ['class' => 'btn-secondary', 'target' => '_blank']) ?>
    </div>
  </section>
</body>
</html>
