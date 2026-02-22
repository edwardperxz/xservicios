<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.about">Xservicios - Quiénes Somos | Transporte Turístico de Lujo</title>
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

    .nav-item:hover,
    .nav-item.active {
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
      transition: all 0.3s;
      font-size: 0.8rem;
      font-weight: 500;
      padding: 0.25rem 0.5rem;
      border-radius: 4px;
      background: transparent;
    }

    .lang-text:hover {
      color: var(--gold);
      background: rgba(201, 169, 98, 0.1);
    }

    .lang-text.active {
      color: var(--gold);
      background: rgba(201, 169, 98, 0.15);
      font-weight: 600;
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

    /* Hero Section */
    .hero-section {
      position: relative;
      height: 500px;
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

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 3.5rem;
      font-weight: 600;
      color: var(--text-white);
      margin-bottom: 1.5rem;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-title span {
      color: var(--gold);
    }

    .btn-primary {
      display: inline-block;
      padding: 1rem 2.5rem;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      color: var(--dark-bg);
      font-weight: 600;
      font-size: 1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
      box-shadow: 0 4px 20px rgba(201, 169, 98, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 30px rgba(201, 169, 98, 0.5);
    }

    .hero-arrows {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding: 0 1rem;
      z-index: 3;
    }

    .hero-arrow {
      width: 40px;
      height: 40px;
      background: rgba(201, 169, 98, 0.2);
      border: 1px solid var(--gold);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s;
    }

    .hero-arrow:hover {
      background: var(--gold);
    }

    .hero-arrow svg {
      width: 20px;
      height: 20px;
      stroke: var(--gold);
      fill: none;
    }

    .hero-arrow:hover svg {
      stroke: var(--dark-bg);
    }

    /* About Section */
    .about-section {
      padding: 5rem 3rem;
      background: var(--dark-deep);
      position: relative;
      z-index: 1;
    }

    .about-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .about-image {
      border-radius: 12px;
      overflow: hidden;
      border: 2px solid var(--gold);
      box-shadow: 0 10px 40px rgba(201, 169, 98, 0.2);
    }

    .about-image img {
      width: 100%;
      height: 400px;
      object-fit: cover;
    }

    .about-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: 2.5rem;
      color: var(--gold);
      margin-bottom: 1.5rem;
    }

    .about-content p {
      font-size: 1rem;
      line-height: 1.8;
      color: var(--text-gray);
      margin-bottom: 2rem;
    }

    .btn-secondary {
      display: inline-block;
      padding: 0.875rem 2rem;
      background: transparent;
      color: var(--gold);
      font-weight: 600;
      font-size: 0.9rem;
      border: 2px solid var(--gold);
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
    }

    .btn-secondary:hover {
      background: var(--gold);
      color: var(--dark-bg);
    }

    /* Gallery Section */
    .gallery-section {
      padding: 4rem 3rem;
      background: linear-gradient(to bottom, var(--dark-deep), var(--dark-bg));
      position: relative;
      z-index: 1;
    }

    .gallery-title {
      text-align: center;
      font-family: 'Playfair Display', serif;
      font-size: 2.25rem;
      color: var(--text-white);
      margin-bottom: 1rem;
    }

    .gallery-subtitle {
      text-align: center;
      color: var(--text-gray);
      margin-bottom: 3rem;
      font-size: 1rem;
    }

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .gallery-item {
      border-radius: 12px;
      overflow: hidden;
      border: 2px solid var(--gold);
      transition: all 0.3s;
    }

    .gallery-item:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 30px rgba(201, 169, 98, 0.3);
    }

    .gallery-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    /* Fleet Section */
    .fleet-section {
      padding: 5rem 3rem;
      background: var(--dark-bg);
      position: relative;
      z-index: 1;
    }

    .fleet-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .fleet-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: 2.25rem;
      color: var(--gold);
      margin-bottom: 1.5rem;
    }

    .fleet-content p {
      font-size: 1rem;
      line-height: 1.8;
      color: var(--text-gray);
    }

    .fleet-image {
      border-radius: 12px;
      overflow: hidden;
      border: 2px solid var(--gold);
      box-shadow: 0 10px 40px rgba(201, 169, 98, 0.2);
    }

    .fleet-image img {
      width: 100%;
      height: 350px;
      object-fit: cover;
    }

    /* Team Section */
    .team-section {
      position: relative;
      padding: 6rem 3rem;
      z-index: 1;
      overflow: hidden;
    }

    .team-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(0.3);
    }

    .team-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to right, rgba(5, 5, 5, 0.9), rgba(5, 5, 5, 0.7));
    }

    .team-content {
      position: relative;
      z-index: 2;
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
    }

    .team-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: 2.75rem;
      color: var(--gold);
      margin-bottom: 1.5rem;
    }

    .team-content p {
      font-size: 1rem;
      line-height: 1.8;
      color: var(--text-gray);
      margin-bottom: 2rem;
    }

    /* Features Section */
    .features-section {
      padding: 4rem 2rem;
      background: var(--dark-deep);
      border-top: 1px solid rgba(201, 169, 98, 0.2);
      position: relative;
      z-index: 1;
    }

    .features-grid {
      display: flex;
      justify-content: center;
      gap: 5rem;
      max-width: 1000px;
      margin: 0 auto;
    }

    .feature-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      text-align: center;
    }

    .feature-icon-wrapper {
      width: 70px;
      height: 70px;
      background: rgba(201, 169, 98, 0.1);
      border: 2px solid var(--gold);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .feature-icon {
      width: 32px;
      height: 32px;
      stroke: var(--gold);
      fill: none;
    }

    .feature-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
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
      .about-container,
      .fleet-container {
        grid-template-columns: 1fr;
        gap: 2rem;
      }

      .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .features-grid {
        gap: 2rem;
        flex-wrap: wrap;
      }

      .feature-item {
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

      .about-content h2,
      .fleet-content h2,
      .team-content h2 {
        font-size: 1.75rem;
      }

      .gallery-grid {
        grid-template-columns: 1fr;
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
    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1600&h=900&fit=crop" alt="Paisaje turístico" class="hero-bg">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="hero-title"><span data-i18n="hero.titlePart1">Transporte Turístico</span> <span data-i18n="hero.titlePart2">de Lujo</span></h1>
      <a href="/newreservation" class="btn-primary" data-i18n="hero.bookNow">Reservar Ahora</a>
    </div>
    <div class="hero-arrows">
      <div class="hero-arrow">
        <svg viewBox="0 0 24 24" strokeWidth="2">
          <polyline points="15 18 9 12 15 6"/>
        </svg>
      </div>
      <div class="hero-arrow">
        <svg viewBox="0 0 24 24" strokeWidth="2">
          <polyline points="9 18 15 12 9 6"/>
        </svg>
      </div>
    </div>
  </section>

  <!-- About Section - Quiénes Somos -->
  <section class="about-section">
    <div class="about-container">
      <div class="about-image">
        <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=600&h=500&fit=crop" alt="Equipo Xservicios" >
      </div>
      <div class="about-content">
        <h2 data-i18n="about.title">Quiénes Somos</h2>
        <p data-i18n="about.description">En Xservicios somos un sistema de transporte turístico de lujo enfocado en ofrecer traslados seguros, eficientes y de alta calidad. Nuestra operación está diseñada para atender a clientes que valoran el confort, la puntualidad y un servicio confiable, brindando una experiencia de movilidad alineada con estándares premium en cada recorrido.</p>
        <a href="#" class="btn-secondary" data-i18n="about.button">Conoce Nuestra Historia</a>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="gallery-section">
    <h2 class="gallery-title" data-i18n="gallery.title">Nuestros Destinos</h2>
    <p class="gallery-subtitle" data-i18n="gallery.subtitle">Descubre los lugares más hermosos de Chiriquí con nosotros</p>
    <div class="gallery-grid">
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400&h=300&fit=crop" alt="Destino turístico 1">
      </div>
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=400&h=300&fit=crop" alt="Destino turístico 2">
      </div>
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=400&h=300&fit=crop" alt="Destino turístico 3">
      </div>
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=400&h=300&fit=crop" alt="Destino turístico 4">
      </div>
    </div>
  </section>

  <!-- Fleet Section - Acerca de Nuestra Flota -->
  <section class="fleet-section">
    <div class="fleet-container">
      <div class="fleet-content">
        <h2 data-i18n="fleet.title">Acerca de Nuestra Flota</h2>
        <p data-i18n="fleet.description">Nuestra flota está compuesta por unidades modernas y cuidadosamente mantenidas, pensadas para garantizar comodidad y seguridad en todo momento. Contamos con dos buses tipo Coaster y dos buses con capacidad para 15 pasajeros, lo que nos permite atender traslados turísticos y corporativos con eficiencia, adaptándonos a diferentes necesidades sin comprometer la calidad del servicio.</p>
      </div>
      <div class="fleet-image">
        <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=600&h=450&fit=crop" alt="Nuestra flota de buses">
      </div>
    </div>
  </section>

  <!-- Team Section - Nuestros Colaboradores -->
  <section class="team-section">
    <img src="https://images.unsplash.com/photo-1449965408869-euj32f9b8d0?w=1600&h=700&fit=crop" alt="Nuestros colaboradores" class="team-bg">
    <div class="team-overlay"></div>
    <div class="team-content">
      <h2 data-i18n="team.title">Nuestros Colaboradores</h2>
      <p data-i18n="team.description">Nuestros choferes son profesionales responsables, transparentes y comprometidos con su labor. Cada colaborador representa los valores de Xservicios, destacándose por su puntualidad, trato respetuoso y enfoque en la seguridad, asegurando que cada traslado se realice con el profesionalismo y la confianza que nuestros clientes esperan.</p>
      <a href="#" class="btn-secondary" data-i18n="team.button">Conocer al Equipo</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features-section">
    <div class="features-grid">
      <div class="feature-item">
        <div class="feature-icon-wrapper">
          <svg class="feature-icon" viewBox="0 0 24 24" strokeWidth="2">
            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
            <path d="M2 17l10 5 10-5"/>
            <path d="M2 12l10 5 10-5"/>
          </svg>
        </div>
        <span class="feature-title" data-i18n="features.premium">Servicio Premium</span>
      </div>
      <div class="feature-item">
        <div class="feature-icon-wrapper">
          <svg class="feature-icon" viewBox="0 0 24 24" strokeWidth="2">
            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>
          </svg>
        </div>
        <span class="feature-title" data-i18n="features.satisfied">Clientes Satisfechos</span>
      </div>
      <div class="feature-item">
        <div class="feature-icon-wrapper">
          <svg class="feature-icon" viewBox="0 0 24 24" strokeWidth="2">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <span class="feature-title" data-i18n="features.punctual">Siempre Puntuales</span>
      </div>
      <div class="feature-item">
        <div class="feature-icon-wrapper">
          <svg class="feature-icon" viewBox="0 0 24 24" strokeWidth="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
          </svg>
        </div>
        <span class="feature-title" data-i18n="features.quality">Alta Calidad</span>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p class="footer-text" data-i18n="footer.text">© 2026 <span>Xservicios</span> - Transporte Turístico de Lujo. Todos los derechos reservados.</p>
  </footer>
  
  <!-- Scripts: El orden es importante - i18n.js debe cargar primero -->
  <script src="/js/i18n.js"></script>
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
</body>
</html>