<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.fleet">Xservicios - Nuestra Flota | Vehículos de Lujo</title>
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

    /* Header */
    .header {
      display: flex;
      align-items: center;
      justify-content: center;
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
      position: absolute;
      left: 2.5rem;
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

    .user-actions {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      position: absolute;
      right: 2.5rem;
    }

    .lang-button {
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

    .lang-button:hover {
      background: rgba(201, 169, 98, 0.2);
      border-color: var(--gold);
      transform: translateY(-2px);
    }

    .lang-button .lang-icon {
      width: 18px;
      height: 18px;
      stroke: var(--gold);
      fill: none;
    }

    .lang-button .lang-code {
      color: var(--gold);
      font-family: 'Inter', sans-serif;
    }

    .lang-selector .lang-separator {
      color: var(--text-gray);
      user-select: none;
    }

    .auth-button {
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

    .auth-button:hover {
      background: linear-gradient(135deg, var(--gold-light), var(--gold));
      transform: translateY(-2px);
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

    /* Hero Section */
    .hero-section {
      position: relative;
      height: 450px;
      overflow: hidden;
      z-index: 1;
    }

    .hero-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(0.4);
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(5, 5, 5, 0.3), rgba(5, 5, 5, 0.8));
    }

    .hero-content {
      position: relative;
      z-index: 2;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 2rem;
    }

    .hero-subtitle {
      font-size: 1rem;
      color: var(--gold);
      letter-spacing: 3px;
      text-transform: uppercase;
      margin-bottom: 1rem;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 3.5rem;
      font-weight: 600;
      color: var(--text-white);
      margin-bottom: 1rem;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-description {
      font-size: 1.1rem;
      color: var(--text-gray);
      max-width: 600px;
      line-height: 1.6;
    }

    /* Quote Form Section */
    .quote-section {
      padding: 4rem 3rem;
      background: var(--dark-bg);
      position: relative;
      z-index: 1;
    }

    .quote-container {
      max-width: 500px;
      margin: 0 auto;
      background: var(--dark-card);
      border: 2px solid var(--gold);
      border-radius: 16px;
      padding: 2.5rem;
      box-shadow: 0 10px 40px rgba(201, 169, 98, 0.15);
      margin-top: -100px;
      position: relative;
      z-index: 5;
    }

    .quote-container.is-custom {
      border-color: rgba(74, 222, 128, 0.7);
      box-shadow: 0 12px 42px rgba(74, 222, 128, 0.2);
    }

    .quote-mode {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      padding: 0.35rem 0.75rem;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 600;
      margin: 0 auto 1rem;
      color: var(--text-white);
      background: rgba(201, 169, 98, 0.2);
      border: 1px solid rgba(201, 169, 98, 0.4);
      width: fit-content;
    }

    .quote-mode.custom {
      background: rgba(74, 222, 128, 0.2);
      border-color: rgba(74, 222, 128, 0.4);
      color: #86efac;
    }

    .quote-container.is-custom .quote-default-only {
      display: none;
    }

    .quote-container:not(.is-custom) .quote-custom-only {
      display: none;
    }

    .quote-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--gold);
      margin-bottom: 0.5rem;
      text-align: center;
    }

    .quote-subtitle {
      color: var(--text-gray);
      font-size: 0.9rem;
      text-align: center;
      margin-bottom: 2rem;
    }

    .form-group {
      margin-bottom: 1.25rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 0.875rem 1rem;
      background: var(--dark-lighter);
      border: 1px solid rgba(201, 169, 98, 0.3);
      border-radius: 8px;
      color: var(--text-white);
      font-size: 0.9rem;
      transition: border-color 0.3s;
    }

    .form-group textarea {
      resize: vertical;
      min-height: 90px;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
      color: var(--text-gray);
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--gold);
    }

    .btn-primary {
      display: block;
      width: 100%;
      padding: 1rem;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      color: var(--dark-bg);
      font-weight: 600;
      font-size: 1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
      text-align: center;
      box-shadow: 0 4px 20px rgba(201, 169, 98, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 30px rgba(201, 169, 98, 0.5);
    }

    /* Passengers Counter */
    .form-group.passengers-group {
      position: relative;
    }

    .passengers-container {
      display: flex;
      align-items: center;
      gap: 0;
      width: 100%;
    }

    .passengers-input {
      flex: 1;
      padding: 0.875rem 1rem !important;
      background: var(--dark-lighter) !important;
      border: 1px solid rgba(201, 169, 98, 0.3) !important;
      border-radius: 8px !important;
      color: var(--text-white) !important;
      font-size: 0.9rem !important;
      text-align: center;
      font-weight: 600;
    }

    /* Hide native number input arrows */
    .passengers-input::-webkit-outer-spin-button,
    .passengers-input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .passengers-input[type=number] {
      -moz-appearance: textfield;
    }

    .passengers-input:focus {
      outline: none !important;
      border-color: var(--gold) !important;
    }

    .counter-button {
      width: 44px;
      height: 44px;
      background: rgba(201, 169, 98, 0.2);
      border: 1px solid rgba(201, 169, 98, 0.3);
      color: var(--gold);
      font-size: 1.2rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .counter-button:hover {
      background: rgba(201, 169, 98, 0.4);
      border-color: var(--gold);
    }

    .counter-button:active {
      background: var(--gold);
      color: var(--dark-bg);
    }

    .counter-button.minus {
      border-radius: 8px 0 0 8px;
      border-right: none;
    }

    .counter-button.plus {
      border-radius: 0 8px 8px 0;
      border-left: none;
    }

    .passengers-error {
      display: none;
      color: #ff6b6b;
      font-size: 0.75rem;
      margin-top: 0.25rem;
      padding-left: 1rem;
    }

    .passengers-error.show {
      display: block;
    }

    /* Features Section */
    .features-section {
      padding: 4rem 3rem;
      background: linear-gradient(to bottom, var(--dark-bg), var(--dark-deep));
      position: relative;
      z-index: 1;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .feature-card {
      background: var(--dark-card);
      border: 2px solid var(--gold);
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s;
    }

    .feature-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(201, 169, 98, 0.2);
    }

    .feature-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .feature-content {
      padding: 1.5rem;
    }

    .feature-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      color: var(--gold);
      margin-bottom: 0.75rem;
    }

    .feature-text {
      font-size: 0.9rem;
      color: var(--text-gray);
      line-height: 1.6;
      margin-bottom: 1rem;
    }

    .feature-link {
      color: var(--gold);
      font-size: 0.85rem;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: gap 0.3s;
    }

    .feature-link:hover {
      gap: 0.75rem;
    }

    .feature-link svg {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      fill: none;
    }

    /* Vehicle Park Section */
    .vehicle-section {
      padding: 4rem 3rem;
      background: var(--dark-deep);
      position: relative;
      z-index: 1;
    }

    .section-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1200px;
      margin: 0 auto 2rem;
    }

    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: var(--text-white);
    }

    .section-title span {
      color: var(--gold);
    }

    .nav-arrows {
      display: flex;
      gap: 0.75rem;
    }

    .nav-arrow {
      width: 40px;
      height: 40px;
      background: rgba(201, 169, 98, 0.1);
      border: 1px solid var(--gold);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s;
    }

    .nav-arrow:hover {
      background: var(--gold);
    }

    .nav-arrow svg {
      width: 20px;
      height: 20px;
      stroke: var(--gold);
      fill: none;
    }

    .nav-arrow:hover svg {
      stroke: var(--dark-bg);
    }

    .vehicle-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.25rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .vehicle-card {
      border-radius: 12px;
      overflow: hidden;
      border: 2px solid var(--gold);
      transition: all 0.3s;
      position: relative;
    }

    .vehicle-card:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 30px rgba(201, 169, 98, 0.3);
    }

    .vehicle-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .vehicle-label {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 0.75rem;
      background: linear-gradient(to top, rgba(5, 5, 5, 0.9), transparent);
      color: var(--text-white);
      font-size: 0.85rem;
      font-weight: 500;
    }

    /* Drivers Section */
    .drivers-section {
      padding: 5rem 3rem;
      background: linear-gradient(to bottom, var(--dark-deep), var(--dark-bg));
      position: relative;
      z-index: 1;
    }

    .drivers-header {
      text-align: center;
      margin-bottom: 3rem;
    }

    .drivers-title {
      font-family: 'Playfair Display', serif;
      font-size: 2.5rem;
      color: var(--text-white);
      margin-bottom: 0.75rem;
    }

    .drivers-title span {
      color: var(--gold);
    }

    .drivers-subtitle {
      color: var(--text-gray);
      font-size: 1rem;
      max-width: 600px;
      margin: 0 auto;
    }

    .drivers-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.5rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .driver-card {
      background: var(--dark-card);
      border: 2px solid var(--gold);
      border-radius: 16px;
      overflow: hidden;
      transition: all 0.3s;
    }

    .driver-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(201, 169, 98, 0.25);
    }

    .driver-card.hidden {
      display: none;
    }

    .driver-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      object-position: top;
    }

    .driver-info {
      padding: 1.25rem;
    }

    .driver-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      color: var(--gold);
      margin-bottom: 0.25rem;
    }

    .driver-role {
      font-size: 0.8rem;
      color: var(--text-gray);
      margin-bottom: 0.75rem;
    }

    .driver-experience {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.8rem;
      color: var(--text-gray);
      margin-bottom: 0.75rem;
    }

    .driver-experience svg {
      width: 14px;
      height: 14px;
      stroke: var(--gold);
      fill: none;
    }

    .driver-rating {
      display: flex;
      align-items: center;
      gap: 0.25rem;
    }

    .star {
      width: 16px;
      height: 16px;
      fill: var(--gold);
    }

    .star.empty {
      fill: var(--dark-lighter);
    }

    .rating-text {
      font-size: 0.8rem;
      color: var(--text-gray);
      margin-left: 0.5rem;
    }

    .btn-ver-mas {
      display: block;
      width: fit-content;
      margin: 3rem auto 0;
      padding: 1rem 3rem;
      background: transparent;
      color: var(--gold);
      font-weight: 600;
      font-size: 1rem;
      border: 2px solid var(--gold);
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-ver-mas:hover {
      background: var(--gold);
      color: var(--dark-bg);
    }

    /* Info Features */
    .info-section {
      padding: 4rem 3rem;
      background: var(--dark-bg);
      border-top: 1px solid rgba(201, 169, 98, 0.2);
      position: relative;
      z-index: 1;
    }

    .info-grid {
      display: flex;
      justify-content: center;
      gap: 5rem;
      max-width: 1000px;
      margin: 0 auto;
    }

    .info-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      text-align: center;
    }

    .info-icon-wrapper {
      width: 70px;
      height: 70px;
      background: rgba(201, 169, 98, 0.1);
      border: 2px solid var(--gold);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .info-icon {
      width: 32px;
      height: 32px;
      stroke: var(--gold);
      fill: none;
    }

    .info-title {
      font-family: 'Playfair Display', serif;
      font-size: 1rem;
      color: var(--text-white);
      font-weight: 600;
    }

    /* Footer */
    .footer {
      padding: 2rem 3rem;
      background: var(--dark-deep);
      border-top: 1px solid rgba(201, 169, 98, 0.2);
      text-align: center;
      position: relative;
      z-index: 1;
    }

    .footer-text {
      color: var(--text-gray);
      font-size: 0.85rem;
    }

    .footer-text span {
      color: var(--gold);
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .features-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .vehicle-grid,
      .drivers-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .info-grid {
        gap: 2rem;
        flex-wrap: wrap;
      }

      .info-item {
        flex: 1 1 40%;
      }

      .nav-menu {
        gap: 1.5rem;
        margin-left: 2rem;
        margin-right: 2rem;
      }
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }

      .features-grid {
        grid-template-columns: 1fr;
      }

      .vehicle-grid,
      .drivers-grid {
        grid-template-columns: 1fr;
      }

      .quote-container {
        margin-top: -50px;
        padding: 1.5rem;
      }

      .nav-item span {
        display: none;
      }

      .user-name {
        display: none;
      }

      .header {
        padding: 1rem 1.5rem;
      }

      .nav-menu {
        margin-left: 1.5rem;
        margin-right: 1.5rem;
        gap: 1rem;
      }
    }
  </style>
  <link rel="stylesheet" href="/css/header-auth.css">
</head>
<body>
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <!-- Hero Section -->
  <section class="hero-section">
    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1600&h=900&fit=crop" alt="Transporte de pasajeros" class="hero-bg">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <span class="hero-subtitle" data-i18n="fleet.heroSubtitle">Transporte Premium</span>
      <h1 class="hero-title" data-i18n="fleet.heroTitle">Nuestra Flota</h1>
      <p class="hero-description" data-i18n="fleet.heroDesc">Unidades modernas, cuidadosamente mantenidas para garantizar comodidad y seguridad en cada viaje.</p>
    </div>
  </section>

  <!-- Vehicle Park Section -->
  <section class="vehicle-section">
    <div class="section-header">
      <h2 class="section-title"><span data-i18n="fleet.vehicleTitle">Parque <span>Vehicular</span></span></h2>
      <div class="nav-arrows">
        <div class="nav-arrow">
          <svg viewBox="0 0 24 24" strokeWidth="2">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
        </div>
        <div class="nav-arrow">
          <svg viewBox="0 0 24 24" strokeWidth="2">
            <polyline points="9 18 15 12 9 6"/>
          </svg>
        </div>
      </div>
    </div>
    <div class="vehicle-grid">
      <?php if (!empty($vehiculos) && is_array($vehiculos)): ?>
        <?php foreach ($vehiculos as $vehiculo): ?>
          <div class="vehicle-card">
            <?php 
            // Determinar imagen a mostrar
            if (!empty($vehiculo->foto_url)):
                $imagenVehiculo = h($vehiculo->foto_url);
            elseif ($vehiculo->tipo === 'coaster'):
                $imagenVehiculo = '../img/vehiculos/coaster_xservicios.png';
            elseif ($vehiculo->tipo === 'bus_15'):
                $imagenVehiculo = '../img/vehiculos/bus15_xservicios.png';
            else:
                $imagenVehiculo = null;
            endif;
            ?>
            <?php if ($imagenVehiculo): ?>
              <img src="<?= $imagenVehiculo ?>" alt="<?= h($vehiculo->nombre_unidad) ?>" style="width: 100%; height: 200px; object-fit: cover;">
            <?php else: ?>
              <div style="width: 100%; height: 200px; background: #2a2a2a; display: flex; align-items: center; justify-content: center; color: #a0a0a0;">Sin imagen</div>
            <?php endif; ?>
            <span class="vehicle-label"><?= h($vehiculo->nombre_unidad) ?> - <?= h($vehiculo->capacidad_max) ?> pasajeros</span>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="color: #a0a0a0; text-align: center; padding: 2rem;">No hay vehículos disponibles</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Drivers Section -->
  <section class="drivers-section">
    <div class="drivers-header">
      <h2 class="drivers-title"><span data-i18n="fleet.driversTitle">Nuestros <span>Choferes</span></span></h2>
      <p class="drivers-subtitle" data-i18n="fleet.driversSubtitle">Profesionales responsables, transparentes y comprometidos con brindar el mejor servicio</p>
    </div>
    <div class="drivers-grid" id="driversGrid">
      <?php if (!empty($choferes) && is_array($choferes)): ?>
        <?php foreach ($choferes as $index => $chofer): ?>
          <div class="driver-card <?= ($index >= 4) ? 'hidden' : '' ?>">
            <?php if (!empty($chofer->foto_url)): ?>
              <img src="<?= h($chofer->foto_url) ?>" alt="<?= h($chofer->usuario->nombre ?? 'Chofer') ?>" class="driver-image" style="width: 100%; height: 250px; object-fit: cover;">
            <?php else: ?>
              <div class="driver-image" style="width: 100%; height: 250px; background: #2a2a2a; display: flex; align-items: center; justify-content: center; color: #a0a0a0;">Sin foto</div>
            <?php endif; ?>
            <div class="driver-info">
              <h3 class="driver-name"><?= h($chofer->usuario->nombre ?? 'N/A') ?></h3>
              <p class="driver-role"><?= h($chofer->tipo_licencia ?? 'Chofer') ?></p>
              <div class="driver-experience">
                <svg viewBox="0 0 24 24" strokeWidth="2">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
                Desde <?= h($chofer->fecha_ingreso->format('Y')) ?>
              </div>
              <div class="driver-rating">
                <svg class="star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg class="star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <span class="rating-text">5.0</span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="color: #a0a0a0; text-align: center; padding: 2rem; grid-column: 1/-1;">No hay choferes disponibles</p>
      <?php endif; ?>
    </div>
    <?php if (!empty($choferes) && is_array($choferes) && count($choferes) > 4): ?>
      <button class="btn-ver-mas" id="btnVerMas" onclick="toggleDrivers()">Ver más</button>
    <?php endif; ?>
  </section>

  <!-- Info Section -->
  <section class="info-section">
    <div class="info-grid">
      <div class="info-item">
        <div class="info-icon-wrapper">
          <svg class="info-icon" viewBox="0 0 24 24" strokeWidth="2">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <span class="info-title">Siempre Puntuales</span>
      </div>
      <div class="info-item">
        <div class="info-icon-wrapper">
          <svg class="info-icon" viewBox="0 0 24 24" strokeWidth="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <span class="info-title">100% Seguro</span>
      </div>
      <div class="info-item">
        <div class="info-icon-wrapper">
          <svg class="info-icon" viewBox="0 0 24 24" strokeWidth="2">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
          </svg>
        </div>
        <span class="info-title">Servicio Premium</span>
      </div>
      <div class="info-item">
        <div class="info-icon-wrapper">
          <svg class="info-icon" viewBox="0 0 24 24" strokeWidth="2">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
          </svg>
        </div>
        <span class="info-title">Clientes Satisfechos</span>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p class="footer-text">2026 <span>Xservicios</span>. Todos los derechos reservados.</p>
  </footer>

  <script>
    // Passengers counter functionality
    function incrementPassengers(e) {
      e.preventDefault();
      const input = document.getElementById('passengersInput');
      const currentValue = parseInt(input.value) || 0;
      if (currentValue < 99) {
        input.value = currentValue + 1;
        validatePassengers();
      }
    }

    function decrementPassengers(e) {
      e.preventDefault();
      const input = document.getElementById('passengersInput');
      const currentValue = parseInt(input.value) || 0;
      if (currentValue > 1) {
        input.value = currentValue - 1;
        validatePassengers();
      }
    }

    function validatePassengers() {
      const input = document.getElementById('passengersInput');
      const errorMsg = document.getElementById('passengersError');
      const value = parseInt(input.value);

      // Only accept positive integers >= 1
      if (isNaN(value) || value < 1) {
        input.value = 1;
        errorMsg.classList.add('show');
        return false;
      } else {
        errorMsg.classList.remove('show');
        return true;
      }
    }

    // Set initial value and validate on input
    document.addEventListener('DOMContentLoaded', function() {
      const input = document.getElementById('passengersInput');
      
      // Prevent negative numbers and zero
      input.addEventListener('input', function(e) {
        let value = e.target.value.trim();
        
        // Remove non-numeric characters
        value = value.replace(/[^0-9]/g, '');
        
        // Ensure not empty and >= 1
        if (value === '' || parseInt(value) < 1) {
          e.target.value = '1';
        } else if (parseInt(value) > 99) {
          e.target.value = '99';
        } else {
          e.target.value = parseInt(value); // Remove leading zeros
        }
        
        validatePassengers();
      });

      // Validate on blur
      input.addEventListener('blur', function(e) {
        validatePassengers();
      });

      // Initialize validation
      validatePassengers();
    });

    let showingAll = false;
    
    function toggleDrivers() {
      const hiddenCards = document.querySelectorAll('.driver-card.hidden');
      const allCards = document.querySelectorAll('.driver-card');
      const btn = document.getElementById('btnVerMas');
      
      if (!showingAll) {
        allCards.forEach(card => card.classList.remove('hidden'));
        btn.textContent = 'Ver menos';
        showingAll = true;
      } else {
        allCards.forEach((card, index) => {
          if (index >= 4) {
            card.classList.add('hidden');
          }
        });
        btn.textContent = 'Ver más';
        showingAll = false;
      }
    }
  </script>
  <script src="/js/i18n.js"></script>
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
  <script>
    (function preselectService() {
      const params = new URLSearchParams(window.location.search);
      const serviceId = params.get('service_id');
      const serviceName = params.get('service_name');
      const serviceNameInput = document.getElementById('selectedServiceName');
      const serviceIdInput = document.getElementById('selectedServiceId');
      const quoteContainer = document.getElementById('quoteContainer');

      if (quoteContainer) {
        quoteContainer.classList.toggle('is-custom', Boolean(serviceId || serviceName));
      }

      if (serviceNameInput) {
        if (serviceName) {
          serviceNameInput.value = decodeURIComponent(serviceName);
          serviceNameInput.readOnly = true;
        } else {
          serviceNameInput.placeholder = 'Servicio a personalizar';
        }
      }

      if (serviceIdInput && serviceId) {
        serviceIdInput.value = serviceId;
      }
    })();
  </script>
</body>
</html>