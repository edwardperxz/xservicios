<?php
/** @var \App\View\AppView $this */
/** @var bool $isAuthenticated */
/** @var \App\Model\Entity\XservUsuario|null $user */

$isAuthenticated = $isAuthenticated ?? false;
$user = $user ?? null;

// Cargar variables de EmailJS desde el .env
$emailjsPublicKey = getenv('public_key') ?: '';
$emailjsServiceId = getenv('service_id') ?: '';
$emailjsTemplateConsultUs = getenv('template_id_consult_us') ?: '';
$emailjsTemplateAutoReply = getenv('template_id_autoreply') ?: '';
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

    /* Quote Form Section */
    .quote-section {
      padding: 3.5rem 3rem;
      background: var(--dark-card);
      border-top: 1px solid var(--dark-lighter);
      border-bottom: 1px solid var(--dark-lighter);
    }

    .quote-container {
      max-width: 640px;
      margin: 0 auto;
      background: var(--dark-lighter);
      padding: 2rem;
      border-radius: 12px;
      border: 1px solid rgba(201, 169, 98, 0.25);
    }

    .quote-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.75rem;
      color: var(--text-white);
      text-align: center;
      margin-bottom: 0.5rem;
    }

    .quote-subtitle {
      text-align: center;
      color: var(--text-gray);
      margin-bottom: 1.5rem;
      font-size: 0.95rem;
    }

    .quote-section .form-group {
      margin-bottom: 1rem;
    }

    .quote-section .form-group input,
    .quote-section .form-group textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(201, 169, 98, 0.3);
      border-radius: 6px;
      color: var(--text-white);
      font-family: 'Inter', sans-serif;
      font-size: 0.95rem;
      transition: border-color 0.3s;
    }

    .quote-section .form-group input::placeholder,
    .quote-section .form-group textarea::placeholder {
      color: var(--text-gray);
    }

    .quote-section .form-group input:focus,
    .quote-section .form-group textarea:focus {
      outline: none;
      border-color: var(--gold);
      background: rgba(255, 255, 255, 0.08);
    }

    .quote-section .passengers-group {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .quote-section .passengers-container {
      display: flex;
      align-items: center;
      border: 1px solid rgba(201, 169, 98, 0.3);
      border-radius: 6px;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.05);
      flex-grow: 1;
    }

    .quote-section .counter-button {
      background: transparent;
      border: none;
      color: var(--gold);
      font-size: 1.25rem;
      padding: 0.5rem 0.75rem;
      cursor: pointer;
      transition: background 0.3s;
    }

    .quote-section .counter-button:hover {
      background: rgba(201, 169, 98, 0.2);
    }

    .quote-section .passengers-input {
      border: none;
      background: transparent;
      width: 60px;
      text-align: center;
      color: var(--text-white);
      font-weight: 600;
      padding: 0.5rem 0;
    }

    .quote-section .passengers-input:focus {
      outline: none;
    }

    .quote-section .passengers-error {
      color: #ef4444;
      font-size: 0.8rem;
      display: none;
    }

    .quote-section .passengers-error.show {
      display: block;
    }

    .quote-section .quote-submit {
      width: 100%;
      padding: 0.85rem 1.5rem;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      color: var(--dark-bg);
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 0.95rem;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 1rem;
    }

    .quote-section .quote-submit:hover {
      background: linear-gradient(135deg, var(--gold-light), var(--gold));
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(201, 169, 98, 0.3);
    }

    .quote-section .is-hidden {
      display: none;
    }

    .quote-section .form-label {
      display: block;
      font-size: 0.85rem;
      color: var(--text-gray);
      margin-bottom: 0.35rem;
      font-weight: 500;
      letter-spacing: 0.3px;
    }

    /* Quitar flechas del input type="number" */
    .quote-section input[type="number"]::-webkit-outer-spin-button,
    .quote-section input[type="number"]::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .quote-section input[type="number"] {
      -moz-appearance: textfield;
    }

    /* Mejoras estéticas generales */
    .quote-section .form-group {
      position: relative;
    }

    .quote-section .form-group input,
    .quote-section .form-group textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      background: rgba(255, 255, 255, 0.05);
      border: 1.5px solid rgba(201, 169, 98, 0.3);
      border-radius: 8px;
      color: var(--text-white);
      font-family: 'Inter', sans-serif;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .quote-section .form-group input:hover,
    .quote-section .form-group textarea:hover {
      border-color: rgba(201, 169, 98, 0.5);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .quote-section .form-group input:focus,
    .quote-section .form-group textarea:focus {
      outline: none;
      border-color: var(--gold);
      background: rgba(255, 255, 255, 0.08);
      box-shadow: 0 0 12px rgba(201, 169, 98, 0.25);
    }

    .quote-section .passengers-label {
      display: block;
      font-size: 0.85rem;
      color: var(--text-gray);
      margin-bottom: 0.5rem;
      font-weight: 500;
      letter-spacing: 0.3px;
    }

    .quote-section .passengers-container {
      display: flex;
      align-items: center;
      border: 1.5px solid rgba(201, 169, 98, 0.3);
      border-radius: 8px;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.05);
      flex-grow: 1;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .quote-section .passengers-container:hover {
      border-color: rgba(201, 169, 98, 0.5);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .quote-section .passengers-container:focus-within {
      border-color: var(--gold);
      box-shadow: 0 0 12px rgba(201, 169, 98, 0.25);
    }

    .quote-section .counter-button {
      background: transparent;
      border: none;
      color: var(--gold);
      font-size: 1.25rem;
      padding: 0.65rem 0.85rem;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 600;
    }

    .quote-section .counter-button:hover {
      background: rgba(201, 169, 98, 0.15);
      transform: scale(1.1);
    }

    .quote-section .counter-button:active {
      transform: scale(0.95);
    }

    .quote-section .passengers-input {
      border: none !important;
      background: transparent !important;
      width: 70px;
      text-align: center;
      color: var(--text-white);
      font-weight: 700;
      padding: 0.65rem 0;
      font-size: 1.1rem;
      box-shadow: none !important;
      cursor: text;
    }

    .quote-section .passengers-input:focus {
      outline: none !important;
      background: transparent !important;
      border: none !important;
      box-shadow: none !important;
    }

    .quote-section .passengers-input::-webkit-outer-spin-button,
    .quote-section .passengers-input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* ===================== DESTINOS TURISTICOS CHIRIQUI ===================== */
    .destinations-section {
      padding: 4rem 3rem;
      background: var(--dark-bg);
    }

    .destinations-header {
      text-align: center;
      margin-bottom: 3rem;
    }

    .destinations-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 2.5rem;
      font-weight: 400;
      color: var(--text-white);
      margin-bottom: 0.75rem;
    }

    .destinations-header h2 span {
      color: var(--gold);
      font-style: italic;
    }

    .destinations-header p {
      color: var(--text-gray);
      font-size: 1rem;
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .destinations-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .destination-card {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      height: 320px;
      cursor: pointer;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .destination-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(201, 169, 98, 0.2);
    }

    .destination-card.large {
      grid-column: span 2;
      height: 380px;
    }

    .destination-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .destination-card:hover img {
      transform: scale(1.08);
    }

    .destination-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.1) 100%);
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 1.5rem;
      transition: background 0.3s ease;
    }

    .destination-card:hover .destination-overlay {
      background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.2) 100%);
    }

    .destination-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      background: rgba(201, 169, 98, 0.9);
      color: var(--dark-bg);
      padding: 0.3rem 0.75rem;
      border-radius: 20px;
      font-size: 0.7rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      width: fit-content;
      margin-bottom: 0.75rem;
    }

    .destination-tag svg {
      width: 12px;
      height: 12px;
    }

    .destination-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      font-weight: 500;
      color: var(--text-white);
      margin-bottom: 0.5rem;
    }

    .destination-card.large .destination-name {
      font-size: 1.85rem;
    }

    .destination-desc {
      color: var(--text-gray);
      font-size: 0.85rem;
      line-height: 1.5;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s ease;
    }

    .destination-card:hover .destination-desc {
      opacity: 1;
      transform: translateY(0);
    }

    .destination-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      margin-top: 1rem;
      padding: 0.6rem 1.2rem;
      background: transparent;
      border: 1px solid var(--gold);
      color: var(--gold);
      font-size: 0.8rem;
      font-weight: 500;
      border-radius: 6px;
      text-decoration: none;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s ease;
    }

    .destination-card:hover .destination-btn {
      opacity: 1;
      transform: translateY(0);
    }

    .destination-btn:hover {
      background: var(--gold);
      color: var(--dark-bg);
    }

    .destination-btn svg {
      width: 14px;
      height: 14px;
    }

    /* Segunda fila de destinos */
    .destinations-row-2 {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.5rem;
      max-width: 1200px;
      margin: 1.5rem auto 0;
    }

    .destinations-row-2 .destination-card {
      height: 280px;
    }

    .destinations-row-2 .destination-card.large {
      grid-column: span 1;
      height: 280px;
    }

    /* Seccion de info destacada */
    .chiriqui-highlight {
      padding: 3rem;
      background: linear-gradient(135deg, rgba(201, 169, 98, 0.08), transparent);
      border-top: 1px solid var(--dark-lighter);
      border-bottom: 1px solid var(--dark-lighter);
      margin-top: 2rem;
    }

    .highlight-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      align-items: center;
    }

    .highlight-content h3 {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: var(--text-white);
      margin-bottom: 1rem;
    }

    .highlight-content h3 span {
      color: var(--gold);
    }

    .highlight-content p {
      color: var(--text-gray);
      line-height: 1.7;
      margin-bottom: 1.5rem;
    }

    .highlight-features {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .highlight-feature {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      color: var(--text-white);
      font-size: 0.9rem;
    }

    .highlight-feature svg {
      width: 20px;
      height: 20px;
      color: var(--gold);
      flex-shrink: 0;
    }

    .highlight-image {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      height: 350px;
    }

    .highlight-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .highlight-image::after {
      content: '';
      position: absolute;
      inset: 0;
      border: 2px solid var(--gold);
      border-radius: 12px;
      opacity: 0.5;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .destinations-grid {
        grid-template-columns: 1fr 1fr;
      }
      .destination-card.large {
        grid-column: span 2;
      }
      .destinations-row-2 {
        grid-template-columns: repeat(2, 1fr);
      }
      .highlight-container {
        grid-template-columns: 1fr;
        gap: 2rem;
      }
    }

    @media (max-width: 768px) {
      .destinations-section {
        padding: 3rem 1.5rem;
      }
      .destinations-header h2 {
        font-size: 1.75rem;
      }
      .destinations-grid,
      .destinations-row-2 {
        grid-template-columns: 1fr;
      }
      .destination-card,
      .destination-card.large,
      .destinations-row-2 .destination-card {
        grid-column: span 1;
        height: 280px;
      }
      .highlight-features {
        grid-template-columns: 1fr;
      }
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

    <!-- Destinos Turisticos de Chiriqui -->
    <section class="destinations-section" id="destinos">
      <div class="destinations-header">
        <h2>Descubre <span>Chiriqui</span></h2>
        <p>La tierra de la eterna primavera te espera. Explora los destinos mas impresionantes del occidente de Panama con nuestro servicio de transporte de lujo.</p>
      </div>

      <!-- Primera fila: 3 columnas con una grande -->
      <div class="destinations-grid">
        <div class="destination-card large">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/38/Telephoto_shot_of_Volcan_Baru_as_seen_from_the_town_of_Volcan.jpg/1280px-Telephoto_shot_of_Volcan_Baru_as_seen_from_the_town_of_Volcan.jpg" alt="Volcan Baru, Chiriqui">
          <div class="destination-overlay">
            <span class="destination-tag">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              Destino Emblematico
            </span>
            <h3 class="destination-name">Volcan Baru</h3>
            <p class="destination-desc">El punto mas alto de Panama (3,475 m). Desde su cumbre puedes ver ambos oceanos en un dia despejado. Ideal para senderismo y avistamiento de estrellas.</p>
            <a href="/services?destination=volcan-baru" class="destination-btn">
              Reservar Traslado
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://upload.wikimedia.org/wikipedia/commons/5/56/DirkvdM_sendero_quetzales.jpg" alt="Boquete, Chiriqui">
          <div class="destination-overlay">
            <span class="destination-tag">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              Mas Popular
            </span>
            <h3 class="destination-name">Boquete</h3>
            <p class="destination-desc">Pueblo de montana famoso por su cafe de clase mundial, clima primaveral y el Sendero de los Quetzales.</p>
            <a href="/services?destination=boquete" class="destination-btn">
              Reservar Traslado
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Segunda fila: 4 columnas iguales -->
      <div class="destinations-row-2">
        <div class="destination-card">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ed/Los_Cangilones_de_Gualaca.png/1280px-Los_Cangilones_de_Gualaca.png" alt="Los Cangilones de Gualaca">
          <div class="destination-overlay">
            <span class="destination-tag">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              Aventura
            </span>
            <h3 class="destination-name">Los Cangilones</h3>
            <p class="destination-desc">Canon natural de aguas cristalinas perfecto para nadar y saltar desde las rocas.</p>
            <a href="/services?destination=cangilones" class="destination-btn">
              Reservar
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://upload.wikimedia.org/wikipedia/commons/7/76/Playas_Las_Lajas_Chiriqui.jpg" alt="Playa La Barqueta">
          <div class="destination-overlay">
            <span class="destination-tag">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/></svg>
              Playa
            </span>
            <h3 class="destination-name">Playa La Barqueta</h3>
            <p class="destination-desc">Extensa playa de arena oscura ideal para surfear y observar tortugas marinas.</p>
            <a href="/services?destination=la-barqueta" class="destination-btn">
              Reservar
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://upload.wikimedia.org/wikipedia/commons/4/4c/Boca_Chica_Chiriqu%C3%ADpma.jpg" alt="Boca Chica, Chiriqui">
          <div class="destination-overlay">
            <span class="destination-tag">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Islas
            </span>
            <h3 class="destination-name">Boca Chica</h3>
            <p class="destination-desc">Puerta de entrada al Parque Nacional Marino Golfo de Chiriqui y sus islas paradisiacas.</p>
            <a href="/services?destination=boca-chica" class="destination-btn">
              Reservar
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
          </div>
        </div>

        <div class="destination-card">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Cerro_Punta_aerial.jpg/1280px-Cerro_Punta_aerial.jpg" alt="Cerro Punta, Chiriqui">
          <div class="destination-overlay">
            <span class="destination-tag">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>
              Montana
            </span>
            <h3 class="destination-name">Cerro Punta</h3>
            <p class="destination-desc">El pueblo mas alto de Panama, conocido por sus fresas, hortalizas y clima fresco todo el ano.</p>
            <a href="/services?destination=cerro-punta" class="destination-btn">
              Reservar
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Seccion destacada sobre Chiriqui -->
      <div class="chiriqui-highlight">
        <div class="highlight-container">
          <div class="highlight-content">
            <h3>Tu aventura en <span>Chiriqui</span> comienza aqui</h3>
            <p>Chiriqui es conocida como la "Tierra de los Valles y las Flores", ofreciendo una diversidad unica de paisajes: desde playas virgenes en el Pacifico hasta bosques nubosos en las tierras altas. Con Xservicios, viaja con la comodidad y seguridad que mereces.</p>
            <div class="highlight-features">
              <div class="highlight-feature">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Conductores locales expertos</span>
              </div>
              <div class="highlight-feature">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Vehiculos climatizados</span>
              </div>
              <div class="highlight-feature">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Rutas personalizadas</span>
              </div>
              <div class="highlight-feature">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Servicio 24/7</span>
              </div>
            </div>
          </div>
          <div class="highlight-image">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Playa_Blanca_Resort.jpg" alt="Playa Blanca, Chiriqui">
          </div>
        </div>
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

  <!-- Quote Form Section -->
  <section class="quote-section" id="quote-section">
    <div class="quote-container" id="quoteContainer">
      <h2 class="quote-title" data-i18n="fleet.quoteTitle">Solicita tu Cotizacion</h2>
      <p class="quote-subtitle" data-i18n="fleet.quoteSubtitle">Completa el formulario y te contactaremos pronto</p>
      <form id="quoteForm">
        <input type="hidden" id="quoteServiceId" name="service_id" value="">
        <div class="form-group">
          <input type="text" id="quoteName" name="quoteName" placeholder="Tu nombre completo" data-i18n-placeholder="fleet.quoteName" required>
        </div>
        <div class="form-group">
          <input type="email" id="quoteEmail" name="quoteEmail" placeholder="Correo electronico" data-i18n-placeholder="fleet.quoteEmail" required>
        </div>
        <div id="defaultFields">
          <div class="form-group">
            <input type="text" id="quoteDestination" name="destination" placeholder="Destino deseado" data-i18n-placeholder="fleet.quoteDestination">
          </div>
          <div class="form-group">
            <textarea id="quoteNotes" name="notes" rows="3" placeholder="Notas adicionales"></textarea>
          </div>
        </div>
        <div id="customFields" class="is-hidden">
          <div class="form-group">
            <label class="form-label" for="quoteServiceName">Servicio seleccionado</label>
            <input type="text" id="quoteServiceName" name="serviceName" placeholder="Servicio" readonly>
          </div>
          <div class="form-group">
            <label class="form-label" for="quotePickup">Punto de recogida</label>
            <input type="text" id="quotePickup" name="pickup" placeholder="Escribe el punto de recogida">
          </div>
          <div class="form-group">
            <label class="form-label" for="quoteDropoff">Punto de destino</label>
            <input type="text" id="quoteDropoff" name="dropoff" placeholder="Escribe el destino final">
          </div>
          <div class="form-group">
            <label class="form-label" for="quoteDate">Fecha deseada</label>
            <input type="date" id="quoteDate" name="date">
          </div>
          <div class="form-group">
            <label class="form-label" for="quoteTime">Hora deseada</label>
            <input type="time" id="quoteTime" name="time">
          </div>
          <div class="form-group">
            <textarea id="quoteCustomNotes" name="customNotes" rows="3" placeholder="Detalles de personalizacion"></textarea>
          </div>
        </div>
        <div class="form-group passengers-group" style="flex-direction: column; align-items: flex-start; gap: 0.5rem;">
          <label class="passengers-label" for="passengersInput" data-i18n="fleet.quotePassengers">Número de Pasajeros</label>
          <div class="passengers-container" style="width: 100%;">
            <button type="button" class="counter-button minus" id="minusBtn" onclick="decrementPassengers(event)">−</button>
            <input type="number" id="passengersInput" name="passengers" class="passengers-input" data-i18n-placeholder="fleet.quotePassengers" min="1" max="99" value="1" onchange="validatePassengers()" oninput="validatePassengersInput(event)" onpaste="event.preventDefault()">
            <button type="button" class="counter-button plus" id="plusBtn" onclick="incrementPassengers(event)">+</button>
          </div>
          <span class="passengers-error" id="passengersError" data-i18n="fleet.quotePassengersError">Minimo 1 pasajero requerido</span>
        </div>
        <button type="submit" class="quote-submit" id="submitBtn" data-i18n="fleet.quoteSubmit">Solicitar Cotizacion</button>
      </form>
    </div>
  </section>

  <!-- Scripts -->
  <!-- i18n-preload.js ya está cargado en el <head> -->
  <script src="/js/i18n.js"></script>
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
  <!-- EmailJS v4 - Sin defer para cargar primero -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
  <script>
    // Esperar a que EmailJS esté disponible antes de inicializar
    function waitForEmailJS() {
      if (typeof emailjs !== 'undefined') {
        const publicKey = '<?= $emailjsPublicKey ?>';
        if (publicKey) {
          emailjs.init({
            publicKey: publicKey
          });
          console.log('EmailJS inicializado correctamente');
        } else {
          console.warn('EmailJS public key no disponible. Revisa la configuración del servidor.');
        }
      } else {
        setTimeout(waitForEmailJS, 50);
      }
    }
    waitForEmailJS();
  </script>
  <script defer>
    function loadScriptFrom(src) {
      return new Promise((resolve) => {
        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.dataset.emailjs = 'true';
        script.onload = resolve;
        script.onerror = resolve;
        document.head.appendChild(script);
      });
    }

    function loadEmailJSScript() {
      return new Promise(async (resolve) => {
        if (typeof emailjs !== 'undefined') {
          resolve();
          return;
        }

        const existing = document.querySelector('script[data-emailjs]');
        if (existing) {
          existing.addEventListener('load', resolve, { once: true });
          existing.addEventListener('error', resolve, { once: true });
          return;
        }

        const sources = [
          'https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js',
          'https://unpkg.com/@emailjs/browser@4/dist/email.min.js',
          '/js/emailjs.min.js'
        ];

        for (let i = 0; i < sources.length; i += 1) {
          await loadScriptFrom(sources[i]);
          if (typeof emailjs !== 'undefined') {
            resolve();
            return;
          }
        }

        resolve();
      });
    }

    // Función helper para esperar a que EmailJS esté listo
    function ensureEmailJSReady() {
      return new Promise(async (resolve) => {
        if (typeof emailjs !== 'undefined') {
          resolve();
          return;
        }

        await loadEmailJSScript();

        const start = Date.now();
        const checkInterval = setInterval(() => {
          if (typeof emailjs !== 'undefined') {
            clearInterval(checkInterval);
            resolve();
          } else if (Date.now() - start > 5000) {
            clearInterval(checkInterval);
            resolve();
          }
        }, 50);
      });
    }

    function applyQuoteMode() {
      const params = new URLSearchParams(window.location.search);
      const serviceId = params.get('service_id');
      const serviceName = params.get('service_name');
      const defaultFields = document.getElementById('defaultFields');
      const customFields = document.getElementById('customFields');
      const title = document.querySelector('.quote-title');
      const subtitle = document.querySelector('.quote-subtitle');
      const serviceIdInput = document.getElementById('quoteServiceId');
      const serviceNameInput = document.getElementById('quoteServiceName');

      if (serviceId) {
        defaultFields.classList.add('is-hidden');
        customFields.classList.remove('is-hidden');
        if (title) title.textContent = 'Personaliza tu servicio';
        if (subtitle) subtitle.textContent = 'Cuéntanos los detalles y te enviaremos una propuesta a medida.';
        if (serviceIdInput) serviceIdInput.value = serviceId;
        if (serviceNameInput) serviceNameInput.value = serviceName ? serviceName.replace(/\+/g, ' ') : '';
      } else {
        defaultFields.classList.remove('is-hidden');
        customFields.classList.add('is-hidden');
        if (title) title.textContent = 'Solicita tu Cotizacion';
        if (subtitle) subtitle.textContent = 'Completa el formulario y te contactaremos pronto';
        if (serviceIdInput) serviceIdInput.value = '';
        if (serviceNameInput) serviceNameInput.value = '';
      }
    }

    function incrementPassengers(e) {
      e.preventDefault();
      const input = document.getElementById('passengersInput');
      const currentValue = parseInt(input.value, 10) || 1;
      if (currentValue < 99) {
        input.value = currentValue + 1;
        validatePassengers();
      }
    }

    function decrementPassengers(e) {
      e.preventDefault();
      const input = document.getElementById('passengersInput');
      const currentValue = parseInt(input.value, 10) || 1;
      if (currentValue > 1) {
        input.value = currentValue - 1;
        validatePassengers();
      }
    }

    function validatePassengersInput(e) {
      const input = e.target;
      let value = input.value;

      // Remover cualquier carácter que no sea número
      value = value.replace(/[^0-9]/g, '');

      // Si está vacío, poner 1
      if (value === '' || value === '0') {
        input.value = '1';
        return;
      }

      // Convertir a número y validar rango
      let numValue = parseInt(value, 10);

      // Si es mayor a 99, limitarlo a 99
      if (numValue > 99) {
        input.value = '99';
      } else if (numValue < 1) {
        input.value = '1';
      } else {
        input.value = numValue;
      }

      validatePassengers();
    }

    function validatePassengers() {
      const input = document.getElementById('passengersInput');
      const errorMsg = document.getElementById('passengersError');
      let value = parseInt(input.value, 10);

      // Si no es un número válido, poner 1
      if (isNaN(value) || value < 1) {
        input.value = 1;
        errorMsg.classList.add('show');
        return false;
      }

      // Si es mayor a 99, limitarlo a 99
      if (value > 99) {
        input.value = 99;
      }

      errorMsg.classList.remove('show');
      return true;
    }

    function getFormData() {
      const isCustomMode = document.getElementById('defaultFields').classList.contains('is-hidden');
      const name = document.getElementById('quoteName').value.trim();
      const email = document.getElementById('quoteEmail').value.trim();
      const passengers = document.getElementById('passengersInput').value;

      let data = {
        name: name,
        email: email,
        passengers: passengers
      };

      if (!isCustomMode) {
        // Modo default
        data.destination = document.getElementById('quoteDestination').value.trim();
        data.notes = document.getElementById('quoteNotes').value.trim();
        data.service = 'Cotización General';
        data.pickup = '';
        data.dropoff = '';
        data.date = '';
        data.time = '';
        data.customNotes = '';
      } else {
        // Modo custom
        data.service = document.getElementById('quoteServiceName').value.trim();
        data.pickup = document.getElementById('quotePickup').value.trim();
        data.dropoff = document.getElementById('quoteDropoff').value.trim();
        data.date = document.getElementById('quoteDate').value || 'No especificada';
        data.time = document.getElementById('quoteTime').value || 'No especificada';
        data.customNotes = document.getElementById('quoteCustomNotes').value.trim();
        data.destination = data.pickup + ' → ' + data.dropoff;
        data.notes = data.customNotes;
      }

      return data;
    }

    function validateQuoteForm() {
      const name = document.getElementById('quoteName').value.trim();
      const email = document.getElementById('quoteEmail').value.trim();
      const passengers = parseInt(document.getElementById('passengersInput').value, 10);
      const isCustomMode = document.getElementById('defaultFields').classList.contains('is-hidden');

      if (!name || name.length < 3) {
        alert('Por favor ingresa un nombre válido (mínimo 3 caracteres)');
        return false;
      }

      if (!email || !email.includes('@')) {
        alert('Por favor ingresa un correo electrónico válido');
        return false;
      }

      if (isNaN(passengers) || passengers < 1 || passengers > 99) {
        alert('Por favor ingresa un número válido de pasajeros (1-99)');
        return false;
      }

      if (!isCustomMode) {
        const destination = document.getElementById('quoteDestination').value.trim();
        if (!destination) {
          alert('Por favor ingresa un destino deseado');
          return false;
        }
      } else {
        const pickup = document.getElementById('quotePickup').value.trim();
        const dropoff = document.getElementById('quoteDropoff').value.trim();
        if (!pickup || !dropoff) {
          alert('Por favor ingresa punto de recogida y destino');
          return false;
        }
      }

      return true;
    }

    async function sendQuoteEmail(e) {
      e.preventDefault();

      if (!validateQuoteForm()) {
        return;
      }

      const submitBtn = document.getElementById('submitBtn');
      const originalText = submitBtn.textContent;
      submitBtn.disabled = true;
      submitBtn.textContent = 'Enviando...';

      try {
        // Asegurar que EmailJS esté disponible antes de intentar usarlo
        await ensureEmailJSReady();

        // Verificar que EmailJS se inicializó correctamente
        if (typeof emailjs === 'undefined') {
          throw new Error('EmailJS no se pudo cargar. Por favor recarga la página.');
        }

        const data = getFormData();
        let adminSuccess = false;
        let userSuccess = false;

        // Preparar parámetros para el admin
        const adminParams = {
          to_email: 'admin@xservicios.com',
          customer_name: data.name,
          customer_email: data.email,
          service: data.service,
          destination: data.destination,
          pickup: data.pickup,
          dropoff: data.dropoff,
          passengers: data.passengers,
          date: data.date,
          time: data.time,
          notes: data.notes,
          customNotes: data.customNotes
        };

        // Intentar enviar email al admin
        try {
          await emailjs.send(
            '<?= $emailjsServiceId ?>',
            '<?= $emailjsTemplateConsultUs ?>',
            adminParams
          );
          adminSuccess = true;
        } catch (adminError) {
          console.warn('No se pudo enviar notificación al admin:', adminError);
        }

        // Preparar parámetros para confirmación al usuario
        const userParams = {
          user_email: data.email,
          user_name: data.name,
          service: data.service,
          destination: data.destination,
          pickup: data.pickup,
          dropoff: data.dropoff,
          passengers: data.passengers,
          date: data.date,
          time: data.time
        };

        // Intentar enviar confirmación al usuario
        try {
          await emailjs.send(
            '<?= $emailjsServiceId ?>',
            '<?= $emailjsTemplateAutoReply ?>',
            userParams
          );
          userSuccess = true;
        } catch (userError) {
          console.warn('No se pudo enviar confirmación al usuario:', userError);
        }

        // Si al menos uno de los envíos fue exitoso, considerar exitosa la operación
        if (adminSuccess || userSuccess) {
          // Limpiar formulario
          document.getElementById('quoteForm').reset();
          document.getElementById('passengersInput').value = '1';

          // Mostrar mensaje de éxito
          alert('¡Cotización enviada exitosamente! Te contactaremos pronto.');
        } else {
          // Si ambos fallaron, mostrar error
          throw new Error('No se pudo enviar la cotización');
        }

        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      } catch (error) {
        console.error('Error crítico al enviar cotización:', error);
        alert('Hubo un error al enviar tu cotización. Por favor intenta de nuevo.');
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      applyQuoteMode();
      const quoteForm = document.getElementById('quoteForm');
      if (quoteForm) {
        quoteForm.addEventListener('submit', sendQuoteEmail);
      }
    });
  </script>
</body>
</html>
