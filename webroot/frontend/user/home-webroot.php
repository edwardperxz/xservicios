<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.home">Xservicios - Transporte Turístico de Lujo en Chiriquí</title>
  <script src="/js/i18n-preload.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
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
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-deep);
      color: var(--text-white);
      min-height: 100vh;
      position: relative;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 150px;
      background: linear-gradient(to bottom, rgba(201, 169, 98, 0.1), transparent);
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
      background: linear-gradient(to top, rgba(201, 169, 98, 0.1), transparent);
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
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
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

    .nav-item:hover {
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

    .auth-actions {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-left: auto;
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-left: auto;
    }

    .auth-link {
      padding: 0.5rem 1.1rem;
      border: 1px solid var(--gold);
      border-radius: 20px;
      color: var(--gold);
      font-size: 0.8rem;
      text-decoration: none;
      transition: all 0.3s;
      white-space: nowrap;
    }

    .auth-link:hover {
      background: rgba(201, 169, 98, 0.15);
    }

    .auth-link.primary {
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      color: var(--dark-bg);
      border-color: transparent;
      font-weight: 600;
    }

    .auth-link.primary:hover {
      background: linear-gradient(135deg, var(--gold-light), var(--gold));
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
      transition: color 0.3s;
      font-size: 0.8rem;
    }

    .lang-text:hover {
      color: var(--gold);
    }

    .lang-divider {
      color: var(--dark-lighter);
    }

    .header-icon {
      width: 20px;
      height: 20px;
      stroke: var(--gold);
      fill: none;
      cursor: pointer;
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
      height: 100vh;
      min-height: 700px;
      overflow: hidden;
      margin-top: 60px;
    }

    .hero-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(0.6);
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(5, 5, 5, 0.3), rgba(5, 5, 5, 0.7));
    }

    .hero-content {
      position: relative;
      z-index: 2;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 4rem;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 5rem;
      font-weight: 900;
      color: var(--text-white);
      line-height: 1;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.5);
    }

    .hero-title span {
      color: var(--gold);
    }

    .year-indicator {
      position: absolute;
      right: 4rem;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 0.5rem;
      font-size: 0.9rem;
      color: var(--text-gray);
    }

    .year-indicator .active {
      color: var(--gold);
      font-weight: 600;
      position: relative;
    }

    .year-indicator .active::after {
      content: '';
      position: absolute;
      left: -40px;
      top: 50%;
      width: 35px;
      height: 2px;
      background: var(--gold);
    }

    .hero-descriptions {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin-top: 3rem;
      max-width: 1000px;
    }

    .hero-desc {
      font-size: 0.8rem;
      line-height: 1.6;
      color: var(--text-gray);
    }

    .hero-desc strong {
      color: var(--gold);
    }

    .swipe-indicator {
      margin-top: 2rem;
      color: var(--gold);
      font-weight: 600;
      font-size: 0.9rem;
      letter-spacing: 1px;
    }

    /* Destinations Section */
    .destinations-section {
      padding: 4rem;
      background: var(--dark-deep);
      position: relative;
      z-index: 1;
    }

    .section-divider {
      width: 100%;
      height: 4px;
      background: linear-gradient(to right, var(--gold), var(--gold-dark));
      margin-bottom: 3rem;
    }

    .destinations-header {
      text-align: center;
      margin-bottom: 3rem;
    }

    .destinations-header p {
      font-size: 1rem;
      color: var(--text-gray);
      margin-bottom: 0.5rem;
    }

    .destinations-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1.75rem;
      color: var(--text-white);
    }

    .destinations-header h2 span {
      color: var(--gold);
    }

    .destinations-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.5rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .destination-card {
      position: relative;
      height: 280px;
      border-radius: 12px;
      overflow: hidden;
      border: 2px solid var(--gold);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .destination-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(201, 169, 98, 0.3);
    }

    .destination-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s;
    }

    .destination-card:hover img {
      transform: scale(1.1);
    }

    .destination-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 1.5rem;
      background: linear-gradient(to top, rgba(5, 5, 5, 0.95), transparent);
    }

    .destination-rank {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--gold);
    }

    .destination-name {
      font-size: 0.9rem;
      color: var(--text-white);
      margin-top: 0.25rem;
    }

    /* Reviews Section */
    .reviews-section {
      padding: 4rem;
      background: var(--dark-bg);
      position: relative;
      z-index: 1;
    }

    .reviews-title {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: var(--text-white);
      text-align: center;
      margin-bottom: 3rem;
    }

    .reviews-title span {
      color: var(--gold);
    }

    .reviews-container {
      max-width: 800px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .review-card {
      display: flex;
      gap: 1.5rem;
      padding: 1.5rem;
      background: var(--dark-card);
      border-radius: 12px;
      border: 1px solid rgba(201, 169, 98, 0.2);
      transition: border-color 0.3s, transform 0.3s;
    }

    .review-card:hover {
      border-color: var(--gold);
      transform: translateX(5px);
    }

    .review-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      border: 2px solid var(--gold);
      object-fit: cover;
      flex-shrink: 0;
    }

    .review-content {
      flex: 1;
    }

    .review-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 0.5rem;
    }

    .review-stars {
      display: flex;
      gap: 0.2rem;
    }

    .review-stars svg {
      width: 16px;
      height: 16px;
      fill: var(--gold);
    }

    .review-rating {
      color: var(--gold);
      font-weight: 600;
      font-size: 0.9rem;
    }

    .review-username {
      color: var(--gold);
      font-weight: 600;
      font-size: 1rem;
      margin-bottom: 0.5rem;
    }

    .review-text {
      color: var(--text-gray);
      font-size: 0.9rem;
      line-height: 1.6;
    }

    /* Travel Section */
    .travel-section {
      padding: 4rem;
      background: var(--dark-deep);
      position: relative;
      z-index: 1;
    }

    .travel-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      max-width: 1200px;
      margin: 0 auto;
      align-items: center;
    }

    .travel-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: 3rem;
      font-weight: 800;
      color: var(--text-white);
      line-height: 1.1;
      margin-bottom: 1.5rem;
    }

    .travel-content h2 span {
      color: var(--gold);
    }

    .travel-subtitle {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      color: var(--gold);
      font-size: 1rem;
      margin-bottom: 1rem;
    }

    .travel-subtitle svg {
      width: 20px;
      height: 20px;
      stroke: var(--gold);
      fill: none;
    }

    .travel-text {
      color: var(--text-gray);
      font-size: 0.9rem;
      line-height: 1.8;
    }

    .travel-images {
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-template-rows: 1fr 1fr;
      gap: 1rem;
    }

    .travel-image-card {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      border: 2px solid var(--gold);
      cursor: pointer;
      transition: transform 0.3s;
    }

    .travel-image-card:first-child {
      grid-row: span 2;
    }

    .travel-image-card:hover {
      transform: scale(1.02);
    }

    .travel-image-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .play-button {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 50px;
      height: 50px;
      background: rgba(201, 169, 98, 0.9);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.3s, transform 0.3s;
    }

    .play-button:hover {
      background: var(--gold);
      transform: translate(-50%, -50%) scale(1.1);
    }

    .play-button svg {
      width: 20px;
      height: 20px;
      fill: var(--dark-bg);
      margin-left: 3px;
    }

    /* Footer */
    .footer {
      padding: 2rem 4rem;
      background: var(--dark-bg);
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

    /* Quote Form Section */
    .quote-section {
      padding: 4rem;
      background: var(--dark-card);
      border-top: 2px solid var(--gold);
      border-bottom: 2px solid var(--gold);
      position: relative;
      z-index: 1;
    }

    .quote-container {
      max-width: 600px;
      margin: 0 auto;
      background: var(--dark-lighter);
      padding: 2rem;
      border-radius: 12px;
      border: 1px solid rgba(201, 169, 98, 0.3);
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
      font-size: 0.9rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(201, 169, 98, 0.3);
      border-radius: 6px;
      color: var(--text-white);
      font-family: 'Inter', sans-serif;
      font-size: 0.9rem;
      transition: border-color 0.3s;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
      color: var(--text-gray);
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--gold);
      background: rgba(255, 255, 255, 0.08);
    }

    .passengers-group {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .passengers-container {
      display: flex;
      align-items: center;
      border: 1px solid rgba(201, 169, 98, 0.3);
      border-radius: 6px;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.05);
      flex-grow: 1;
    }

    .counter-button {
      background: transparent;
      border: none;
      color: var(--gold);
      font-size: 1.25rem;
      padding: 0.5rem 0.75rem;
      cursor: pointer;
      transition: background 0.3s;
    }

    .counter-button:hover {
      background: rgba(201, 169, 98, 0.2);
    }

    .passengers-input {
      border: none !important;
      background: transparent !important;
      width: 60px;
      text-align: center;
      color: var(--text-white);
      font-weight: 600;
      padding: 0.5rem 0 !important;
    }

    .passengers-input:focus {
      outline: none;
    }

    .passengers-error {
      color: #ef4444;
      font-size: 0.75rem;
      display: none;
      margin-child-start: 0;
    }

    .passengers-error.show {
      display: block;
    }

    .btn-primary {
      width: 100%;
      padding: 0.75rem 1.5rem;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      color: var(--dark-bg);
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 1rem;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, var(--gold-light), var(--gold));
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(201, 169, 98, 0.3);
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .hero-title {
        font-size: 3.5rem;
      }

      .hero-descriptions {
        grid-template-columns: 1fr;
        gap: 1rem;
      }

      .destinations-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .travel-container {
        grid-template-columns: 1fr;
      }

      .travel-content h2 {
        font-size: 2.5rem;
      }

      .year-indicator {
        display: none;
      }
    }

    @media (max-width: 768px) {
      .header {
        padding: 1rem;
        flex-wrap: wrap;
      }

      .nav-menu {
        margin: 1rem 0;
        gap: 1rem;
        order: 3;
        width: 100%;
        justify-content: center;
      }

      .nav-item span {
        display: none;
      }

      .hero-section {
        height: auto;
        min-height: 100vh;
      }

      .hero-content {
        padding: 2rem;
      }

      .hero-title {
        font-size: 2.5rem;
      }

      .destinations-section,
      .reviews-section,
      .travel-section {
        padding: 2rem;
      }

      .destinations-grid {
        grid-template-columns: 1fr;
      }

      .travel-images {
        grid-template-columns: 1fr;
      }

      .travel-image-card:first-child {
        grid-row: span 1;
      }

      .review-card {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
    }
  </style>
  <link rel="stylesheet" href="/css/header-auth.css">
</head>
<body>
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <!-- Hero Section -->
  <section class="hero-section">
    <img src="https://images.unsplash.com/photo-1590523741831-ab7e8b8f9c7f?w=1920&h=1080&fit=crop" alt="Bocas del Toro" class="hero-image">
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
      <h1 class="hero-title" data-i18n="homeHero.title">VISITA<br><span>BOCAS DEL TORO</span></h1>
      
      <div class="hero-descriptions">
        <p class="hero-desc" data-i18n="homeHero.desc1">
          <strong>Bocas del Toro</strong> es un archipiélago paradisíaco ubicado en el Caribe panameño, conocido por sus aguas cristalinas de tonos turquesa y su exuberante biodiversidad marina y terrestre.
        </p>
        <p class="hero-desc">
          Sus islas ofrecen <strong>playas vírgenes</strong>, manglares y una cultura caribeña única que fusiona tradiciones afroantillanas e indígenas, creando una experiencia auténtica e inolvidable.
        </p>
        <p class="hero-desc">
          Desde el avistamiento de <strong>delfines y estrellas de mar</strong> hasta el surf en Playa Bluff, Bocas del Toro es el destino perfecto para los amantes de la naturaleza y la aventura.
        </p>
      </div>
      
      <div class="swipe-indicator">EXPLORAR >></div>
    </div>
    
    <div class="year-indicator">
      <span>18</span>
      <span>19</span>
      <span class="active">20</span>
      <span>21</span>
      <span>22</span>
    </div>
  </section>

  <!-- Destinations Section -->
  <section class="destinations-section">
    <div class="section-divider"></div>
    
    <div class="destinations-header">
      <p>Encuentra tu lugar favorito</p>
      <h2>en nuestro hermoso <span>Panamá</span></h2>
    </div>
    
    <div class="destinations-grid">
      <div class="destination-card">
        <img src="https://images.unsplash.com/photo-1567597243073-3c64c4c75de3?w=400&h=500&fit=crop" alt="Boca Chica">
        <div class="destination-overlay">
          <div class="destination-rank">1er lugar</div>
          <div class="destination-name">Boca Chica</div>
        </div>
      </div>
      
      <div class="destination-card">
        <img src="https://images.unsplash.com/photo-1559128010-7c1ad6e1b6a5?w=400&h=500&fit=crop" alt="Cangilones de Gualaca">
        <div class="destination-overlay">
          <div class="destination-rank">2do lugar</div>
          <div class="destination-name">Los Cangilones de Gualaca</div>
        </div>
      </div>
      
      <div class="destination-card">
        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=500&fit=crop" alt="Volcán Barú">
        <div class="destination-overlay">
          <div class="destination-rank">3er lugar</div>
          <div class="destination-name">Volcán Barú</div>
        </div>
      </div>
      
      <div class="destination-card">
        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400&h=500&fit=crop" alt="San Blas">
        <div class="destination-overlay">
          <div class="destination-rank">4to lugar</div>
          <div class="destination-name">Islas de San Blas</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Reviews Section -->
  <section class="reviews-section">
    <h2 class="reviews-title">Algunas <span>reseñas</span> de nuestros usuarios más fieles</h2>
    
    <div class="reviews-container">
      <div class="review-card">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop" alt="Usuario" class="review-avatar">
        <div class="review-content">
          <div class="review-header">
            <div class="review-stars">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="review-rating">5.0</span>
          </div>
          <div class="review-username">María González</div>
          <p class="review-text">Excelente servicio de transporte. Los choferes son muy profesionales y puntuales. El viaje a Bocas del Toro fue increíble, los buses son muy cómodos y el trato fue de primera clase.</p>
        </div>
      </div>
      
      <div class="review-card">
        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop" alt="Usuario" class="review-avatar">
        <div class="review-content">
          <div class="review-header">
            <div class="review-stars">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="review-rating">5.0</span>
          </div>
          <div class="review-username">Roberto Méndez</div>
          <p class="review-text">Contraté el servicio para un grupo de 12 personas hacia los Cangilones de Gualaca. Todo perfecto, desde la reserva hasta el regreso. Muy recomendado para tours grupales.</p>
        </div>
      </div>
      
      <div class="review-card">
        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="Usuario" class="review-avatar">
        <div class="review-content">
          <div class="review-header">
            <div class="review-stars">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24" style="fill: var(--dark-lighter);"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="review-rating">4.0</span>
          </div>
          <div class="review-username">Ana Castillo</div>
          <p class="review-text">Viajamos en familia al Volcán Barú. El conductor conocía muy bien la ruta y nos dio información turística durante el camino. Una experiencia muy agradable.</p>
        </div>
      </div>
      
      <div class="review-card">
        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" alt="Usuario" class="review-avatar">
        <div class="review-content">
          <div class="review-header">
            <div class="review-stars">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="review-rating">5.0</span>
          </div>
          <div class="review-username">Pedro Sánchez</div>
          <p class="review-text">Servicio impecable. Usé Xservicios para el traslado al aeropuerto y llegué con tiempo de sobra. El vehículo estaba impecable y con aire acondicionado. Definitivamente volveré a usar sus servicios.</p>
        </div>
      </div>
      
      <div class="review-card">
        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop" alt="Usuario" class="review-avatar">
        <div class="review-content">
          <div class="review-header">
            <div class="review-stars">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <svg viewBox="0 0 24 24" style="fill: var(--dark-lighter);"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="review-rating">4.0</span>
          </div>
          <div class="review-username">Laura Rodríguez</div>
          <p class="review-text">Organicé una excursión corporativa a San Blas con 30 personas. Xservicios coordinó todo perfectamente con dos buses. El equipo fue muy profesional y atento a nuestras necesidades.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Travel Section -->
  <section class="travel-section">
    <div class="travel-container">
      <div class="travel-content">
        <h2>VIAJA Y<br>DISFRUTA TUS<br><span>VACACIONES</span></h2>
        
        <div class="travel-subtitle">
          <svg viewBox="0 0 24 24" strokeWidth="2">
            <circle cx="12" cy="12" r="10"/>
            <polygon points="10 8 16 12 10 16 10 8" fill="currentColor"/>
          </svg>
          elige un destino agradable
        </div>
        
        <p class="travel-text">
          Viajar es más que desplazarse de un lugar a otro; es una oportunidad para desconectarte de la rutina, descubrir nuevas culturas y crear recuerdos que durarán toda la vida. En Xservicios entendemos que cada viaje es especial, por eso nos esforzamos en brindarte una experiencia de transporte que complemente tu aventura. Porque tus vacaciones merecen comenzar desde el momento en que subes a nuestros vehículos, con la tranquilidad de saber que estás en manos de profesionales comprometidos con tu comodidad y seguridad.
        </p>
      </div>
      
      <div class="travel-images">
        <div class="travel-image-card">
          <img src="https://images.unsplash.com/photo-1580060839134-75a5edca2e99?w=400&h=600&fit=crop" alt="Playa Panamá">
          <div class="play-button">
            <svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
          </div>
        </div>
        <div class="travel-image-card">
          <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?w=400&h=280&fit=crop" alt="Costa panameña">
          <div class="play-button">
            <svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
          </div>
        </div>
        <div class="travel-image-card">
          <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=280&fit=crop" alt="Playa tropical">
          <div class="play-button">
            <svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Quote Form Section -->
  <section class="quote-section">
    <div class="quote-container" id="quoteContainer">
      <h2 class="quote-title" data-i18n="fleet.quoteTitle">Solicita tu Cotización</h2>
      <p class="quote-subtitle" data-i18n="fleet.quoteSubtitle">Completa el formulario y te contactaremos pronto</p>
      <form>
        <div class="form-group">
          <input type="text" id="quoteName" placeholder="Tu nombre completo" data-i18n-placeholder="fleet.quoteName">
        </div>
        <div class="form-group">
          <input type="email" id="quoteEmail" placeholder="Correo electrónico" data-i18n-placeholder="fleet.quoteEmail">
        </div>
        <div class="form-group">
          <input type="text" id="quoteDestination" placeholder="Destino deseado" data-i18n-placeholder="fleet.quoteDestination">
        </div>
        <div class="form-group">
          <textarea id="quoteNotes" rows="3" placeholder="Notas adicionales"></textarea>
        </div>
        <div class="form-group passengers-group">
          <div class="passengers-container">
            <button type="button" class="counter-button minus" id="minusBtn" onclick="decrementPassengers(event)">−</button>
            <input type="number" id="passengersInput" class="passengers-input" placeholder="0" data-i18n-placeholder="fleet.quotePassengers" min="1" max="99" value="1">
            <button type="button" class="counter-button plus" id="plusBtn" onclick="incrementPassengers(event)">+</button>
          </div>
          <span class="passengers-error" id="passengersError" data-i18n="fleet.quotePassengersError">Mínimo 1 pasajero requerido</span>
        </div>
        <button type="submit" class="btn-primary" data-i18n="fleet.quoteSubmit">Solicitar Cotización</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p class="footer-text" data-i18n="footer.text">© 2026 <span>Xservicios</span> - Transporte Turístico de Lujo. Todos los derechos reservados.</p>
  </footer>
  
  <!-- Scripts: El orden es importante -->
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
  <script src="/js/i18n.js"></script>
  
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

      if (isNaN(value) || value < 1) {
        input.value = 1;
        errorMsg.classList.add('show');
        return false;
      } else {
        errorMsg.classList.remove('show');
        return true;
      }
    }
  </script>
</body>
</html>
