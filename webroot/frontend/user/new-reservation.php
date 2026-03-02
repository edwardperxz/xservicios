<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.newReservation">Xservicios - Nueva Reserva</title>
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
      --green: #2d7a5f;
      --green-hover: #236349;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-deep);
      color: var(--text-white);
      min-height: 100vh;
    }

    /* Header Principal */
    .header {
      display: flex;
      align-items: center;
      padding: 1rem 2.5rem;
      background: linear-gradient(to bottom, rgba(10, 10, 10, 0.98), rgba(5, 5, 5, 0.95));
      border-bottom: 1px solid rgba(201, 169, 98, 0.3);
      position: sticky;
      top: 0;
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

    .lang-selector {
      display: flex;
      align-items: center;
      gap: 0.4rem;
      color: var(--text-gray);
      font-size: 0.8rem;
    }

    .notification-icon {
      cursor: pointer;
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

    /* Main Content */
    .main-content {
      padding: 1.5rem 2.5rem;
    }

    .title-section {
      padding: 1rem 0 0;
    }

    .main-title {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      font-weight: 600;
      color: var(--text-white);
      margin-bottom: 0.5rem;
    }

    .main-subtitle {
      color: var(--text-gray);
      font-size: 0.95rem;
      margin-bottom: 1.5rem;
    }

    .services-section {
      padding-bottom: 2.5rem;
    }

    .service-detail {
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      gap: 1.75rem;
      background: rgba(26, 26, 26, 0.9);
      border: 1px solid rgba(201, 169, 98, 0.2);
      border-radius: 16px;
      padding: 1.75rem;
    }

    .service-detail-media {
      display: flex;
      align-items: stretch;
    }

    .service-detail-image {
      width: 100%;
      height: 100%;
      min-height: 280px;
      object-fit: cover;
      border-radius: 12px;
      border: 1px solid rgba(201, 169, 98, 0.25);
    }

    .service-detail-content {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .service-detail-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
    }

    .service-detail-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem;
      font-weight: 600;
      color: var(--text-white);
    }

    .service-detail-status {
      padding: 0.35rem 0.8rem;
      border-radius: 999px;
      font-size: 0.7rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border: 1px solid transparent;
    }

    .service-detail-status.is-active {
      color: #1f6b49;
      background: rgba(45, 122, 95, 0.18);
      border-color: rgba(45, 122, 95, 0.4);
    }

    .service-detail-status.is-inactive {
      color: #b16464;
      background: rgba(177, 100, 100, 0.2);
      border-color: rgba(177, 100, 100, 0.45);
    }

    .service-detail-description {
      color: var(--text-gray);
      font-size: 0.95rem;
      line-height: 1.6;
    }

    .service-detail-price {
      display: flex;
      align-items: baseline;
      gap: 0.5rem;
      color: var(--gold);
      font-weight: 600;
      font-size: 1.2rem;
    }

    .service-detail-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(201, 169, 98, 0.15);
      border-radius: 10px;
      padding: 0.75rem 1rem;
    }

    .meta-label {
      color: var(--text-gray);
      font-size: 0.8rem;
      letter-spacing: 0.02em;
    }

    .meta-value {
      color: var(--text-white);
      font-weight: 600;
      font-size: 0.9rem;
    }

    .service-detail-variants {
      background: rgba(255, 255, 255, 0.02);
      border: 1px solid rgba(201, 169, 98, 0.12);
      border-radius: 10px;
      padding: 0.75rem 1rem;
    }

    .variant-list {
      margin: 0.5rem 0 0;
      padding-left: 1.1rem;
      color: var(--text-white);
      font-size: 0.85rem;
      line-height: 1.5;
    }

    .variant-empty {
      margin-top: 0.5rem;
      color: var(--text-gray);
      font-size: 0.85rem;
    }

    .service-detail-actions {
      margin-top: auto;
    }

    .service-detail-empty {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.75rem;
      background: rgba(26, 26, 26, 0.8);
      border-radius: 16px;
      border: 1px dashed rgba(201, 169, 98, 0.3);
      padding: 2.5rem 1.5rem;
      text-align: center;
      color: var(--text-gray);
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1.5rem;
    }

    .service-card {
      background: rgba(26, 26, 26, 0.85);
      border: 1px solid rgba(201, 169, 98, 0.2);
      border-radius: 14px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 18px 28px rgba(0, 0, 0, 0.35);
    }

    .service-image {
      width: 100%;
      height: 180px;
      object-fit: cover;
      display: block;
    }

    .service-content {
      padding: 1.25rem;
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .service-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.15rem;
      color: var(--text-white);
    }

    .service-description {
      color: var(--text-gray);
      font-size: 0.9rem;
      line-height: 1.5;
      min-height: 3.6em;
    }

    .service-price {
      display: flex;
      align-items: baseline;
      gap: 0.4rem;
      color: var(--gold);
      font-weight: 600;
    }

    .price-amount {
      font-size: 1.1rem;
    }

    .price-label {
      font-size: 0.75rem;
      color: var(--text-gray);
      font-weight: 400;
    }

    .btn-reservar {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      padding: 0.65rem 1.2rem;
      border-radius: 8px;
      background: var(--gold);
      color: var(--dark-bg);
      text-decoration: none;
      font-weight: 600;
      font-size: 0.85rem;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-reservar:hover {
      background: var(--gold-light);
      transform: translateY(-2px);
    }

    /* Map Section */
    .map-section {
      width: 100%;
      height: 350px;
      border-radius: 12px;
      overflow: hidden;
      border: 2px solid var(--gold);
      margin-bottom: 1.5rem;
      position: relative;
      background: var(--dark-card);
    }

    .map-placeholder {
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #1a2e1a 0%, #0d1f0d 100%);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .map-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('https://images.unsplash.com/photo-1524661135-423995f22d0b?w=1200&h=400&fit=crop') center/cover;
      opacity: 0.3;
    }

    .map-content {
      position: relative;
      z-index: 1;
      text-align: center;
    }

    .map-icon {
      width: 60px;
      height: 60px;
      stroke: var(--gold);
      fill: none;
      margin-bottom: 1rem;
    }

    .map-text {
      color: var(--text-white);
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .map-subtext {
      color: var(--text-gray);
      font-size: 0.85rem;
    }

    /* Two Columns Layout */
    .columns-container {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      gap: 1.5rem;
    }

    /* Left Column - Fichas */
    .left-column {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .ficha-placeholder {
      background: var(--dark-card);
      border: 2px dashed var(--dark-lighter);
      border-radius: 12px;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 180px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .ficha-placeholder:hover {
      border-color: var(--gold);
      background: rgba(201, 169, 98, 0.05);
    }

    .ficha-placeholder.active {
      border-style: solid;
      border-color: var(--gold);
    }

    .ficha-plus {
      width: 50px;
      height: 50px;
      background: rgba(201, 169, 98, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
    }

    .ficha-plus svg {
      width: 28px;
      height: 28px;
      stroke: var(--gold);
      fill: none;
    }

    .ficha-label {
      color: var(--text-gray);
      font-size: 0.9rem;
    }

    /* Ficha Card */
    .ficha-card {
      background: linear-gradient(145deg, #faf8f5 0%, #f0ebe3 100%);
      border-radius: 12px;
      padding: 1rem;
      border: 3px solid;
      border-image: linear-gradient(135deg, var(--gold), #6b4423, var(--gold)) 1;
      position: relative;
    }

    .ficha-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 0.75rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #d4c4a8;
    }

    .ficha-title {
      font-size: 0.7rem;
      color: var(--gold-dark);
      font-weight: 600;
      letter-spacing: 1px;
    }

    .ficha-badge {
      font-size: 0.6rem;
      padding: 0.2rem 0.5rem;
      background: var(--gold);
      color: #1a1a1a;
      border-radius: 4px;
      font-weight: 600;
    }

    .ficha-content {
      display: flex;
      gap: 0.75rem;
    }

    .ficha-image {
      width: 70px;
      height: 70px;
      border-radius: 8px;
      object-fit: cover;
      border: 2px solid var(--gold);
    }

    .ficha-info {
      flex: 1;
    }

    .ficha-name {
      font-size: 0.85rem;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 0.25rem;
    }

    .ficha-detail {
      font-size: 0.7rem;
      color: #666;
      margin-bottom: 0.15rem;
    }

    .ficha-detail span {
      color: var(--gold-dark);
      font-weight: 500;
    }

    .ficha-close {
      position: absolute;
      top: 8px;
      right: 8px;
      width: 20px;
      height: 20px;
      background: #e74c3c;
      border-radius: 50%;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .ficha-close svg {
      width: 12px;
      height: 12px;
      stroke: white;
      fill: none;
    }

    /* Right Column - Booking Details */
    .right-column {
      background: var(--dark-card);
      border-radius: 12px;
      padding: 1.5rem;
      border: 1px solid var(--dark-lighter);
    }

    .location-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-bottom: 1.25rem;
    }

    .location-input {
      background: var(--dark-lighter);
      border: 1px solid var(--dark-lighter);
      border-radius: 8px;
      padding: 0.75rem 1rem;
      transition: all 0.3s;
    }

    .location-input:focus-within {
      border-color: var(--gold);
    }

    .location-label {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.75rem;
      color: var(--text-gray);
      margin-bottom: 0.5rem;
    }

    .location-label svg {
      width: 14px;
      height: 14px;
      stroke: var(--gold);
      fill: none;
    }

    .location-input input {
      width: 100%;
      background: transparent;
      border: none;
      color: var(--text-white);
      font-size: 0.9rem;
      outline: none;
    }

    .location-input input::placeholder {
      color: var(--text-gray);
    }

    .info-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-bottom: 1.25rem;
    }

    .info-box {
      background: var(--dark-lighter);
      border-radius: 8px;
      padding: 0.75rem 1rem;
    }

    .info-label {
      font-size: 0.75rem;
      color: var(--text-gray);
      margin-bottom: 0.25rem;
    }

    .info-value {
      font-size: 1rem;
      color: var(--gold);
      font-weight: 600;
    }

    .time-input {
      background: var(--dark-lighter);
      border: 1px solid var(--dark-lighter);
      border-radius: 8px;
      padding: 0.75rem 1rem;
      margin-bottom: 1.25rem;
      transition: all 0.3s;
    }

    .time-input:focus-within {
      border-color: var(--gold);
    }

    .time-input input {
      width: 100%;
      background: transparent;
      border: none;
      color: var(--text-white);
      font-size: 0.9rem;
      outline: none;
      color-scheme: dark;
    }

    /* Transport Tags */
    .transport-section {
      margin-bottom: 1.25rem;
    }

    .transport-label {
      font-size: 0.85rem;
      color: var(--text-gray);
      margin-bottom: 0.75rem;
    }

    .transport-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .transport-tag {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(201, 169, 98, 0.15);
      border: 1px solid var(--gold);
      border-radius: 20px;
      padding: 0.5rem 0.75rem;
      font-size: 0.8rem;
      color: var(--gold);
    }

    .transport-tag-info {
      display: flex;
      flex-direction: column;
    }

    .transport-tag-name {
      font-weight: 500;
    }

    .transport-tag-price {
      font-size: 0.7rem;
      color: var(--text-gray);
    }

    .transport-tag-remove {
      width: 18px;
      height: 18px;
      background: rgba(231, 76, 60, 0.8);
      border-radius: 50%;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.3s;
    }

    .transport-tag-remove:hover {
      background: #e74c3c;
    }

    .transport-tag-remove svg {
      width: 10px;
      height: 10px;
      stroke: white;
      fill: none;
    }

    .add-transport-btn {
      display: flex;
      align-items: center;
      gap: 0.4rem;
      background: transparent;
      border: 1px dashed var(--dark-lighter);
      border-radius: 20px;
      padding: 0.5rem 0.75rem;
      font-size: 0.8rem;
      color: var(--text-gray);
      cursor: pointer;
      transition: all 0.3s;
    }

    .add-transport-btn:hover {
      border-color: var(--gold);
      color: var(--gold);
    }

    .add-transport-btn svg {
      width: 14px;
      height: 14px;
      stroke: currentColor;
      fill: none;
    }

    /* Price Section */
    .price-section {
      background: linear-gradient(135deg, rgba(201, 169, 98, 0.1), rgba(201, 169, 98, 0.05));
      border: 1px solid var(--gold);
      border-radius: 12px;
      padding: 1rem;
      margin-bottom: 1.25rem;
      text-align: center;
    }

    .price-label {
      font-size: 0.85rem;
      color: var(--text-gray);
      margin-bottom: 0.25rem;
    }

    .price-value {
      font-size: 2rem;
      font-weight: 700;
      color: var(--gold);
    }

    .price-breakdown {
      font-size: 0.75rem;
      color: var(--text-gray);
      margin-top: 0.5rem;
    }

    /* Agendar Button */
    .agendar-btn {
      width: 100%;
      padding: 1rem;
      background: var(--green);
      color: white;
      font-size: 1rem;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .agendar-btn:hover {
      background: var(--green-hover);
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(45, 122, 95, 0.4);
    }

    .agendar-btn svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      fill: none;
    }

    @media (max-width: 1024px) {
      .columns-container {
        grid-template-columns: 1fr;
      }

      .service-detail {
        grid-template-columns: 1fr;
      }

      .services-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .left-column {
        flex-direction: row;
      }

      .ficha-placeholder {
        flex: 1;
      }
    }

    @media (max-width: 768px) {
      .header, .main-content {
        padding-left: 1rem;
        padding-right: 1rem;
      }

      .nav-menu {
        display: none;
      }

      .left-column {
        flex-direction: column;
      }

      .location-row, .info-row {
        grid-template-columns: 1fr;
      }

      .services-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
    <link rel="stylesheet" href="/css/header-auth.css">
</head>
<body>
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <!-- Main Content -->
  <main class="main-content" style="margin-top: 2rem;">
    <section class="title-section">
      <h1 class="main-title" data-i18n="newReservation.detailTitle">Detalle del servicio</h1>
      <p class="main-subtitle" data-i18n="newReservation.detailSubtitle">Revisa la informacion completa antes de reservar.</p>
    </section>

    <section class="service-detail" id="serviceDetail"></section>
    <section class="service-detail-empty" id="serviceDetailEmpty" style="display: none;">
      <h2 data-i18n="newReservation.noServiceTitle">Servicio no disponible</h2>
      <p data-i18n="newReservation.noServiceDesc">Selecciona un servicio para ver sus detalles.</p>
      <a href="/services" class="btn-reservar" data-i18n="newReservation.goToServices">Ver servicios</a>
    </section>
  </main>

  <script src="/js/i18n.js"></script>
  <script>
    const API_SERVICIOS = '/xserv-servicios.json';
    const serviceDetail = document.getElementById('serviceDetail');
    const serviceDetailEmpty = document.getElementById('serviceDetailEmpty');
    let servicioActual = null;

    const imagenesServicios = [
      'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1563720223185-11003d516935?w=900&h=600&fit=crop',
      'https://images.unsplash.com/photo-1519741497674-611481863552?w=900&h=600&fit=crop',
    ];

    const getImagenServicio = (servicio, index) => {
      return servicio.imagen || servicio.image || imagenesServicios[index % imagenesServicios.length];
    };

    const getDescripcion = (servicio, lang) => {
      if (lang === 'en') {
        return servicio.descripcion_en || servicio.descripcion_es || servicio.descripcion || servicio.detalle || '';
      }
      return servicio.descripcion_es || servicio.descripcion_en || servicio.descripcion || servicio.detalle || '';
    };

    const formatPrice = (precio) => {
      const value = Number(precio);
      if (!Number.isFinite(value) || value <= 0) return null;
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0,
      }).format(value);
    };

    const normalizeVariants = (variantes) => {
      if (!variantes) return [];
      if (Array.isArray(variantes)) return variantes;
      if (typeof variantes === 'object') return Object.entries(variantes).map(([key, value]) => `${key}: ${value}`);
      if (typeof variantes === 'string') {
        try {
          const parsed = JSON.parse(variantes);
          return normalizeVariants(parsed);
        } catch (error) {
          return [variantes];
        }
      }
      return [];
    };

    const renderServicio = () => {
      if (!serviceDetail || !serviceDetailEmpty) return;
      // Usar la función de traducción global que está siempre disponible
      const t = window.t || window.__translate || ((key) => key);
      const lang = window.getCurrentLanguage ? window.getCurrentLanguage() : 'es';

      if (!servicioActual) {
        serviceDetail.style.display = 'none';
        serviceDetailEmpty.style.display = 'flex';
        return;
      }

      const nombre = servicioActual.nombre || servicioActual.titulo || t('services.defaultName');
      const descripcion = getDescripcion(servicioActual, lang) || t('services.defaultDesc');
      const precio = formatPrice(servicioActual.precio_base ?? servicioActual.precio ?? servicioActual.costo);
      
      // Obtener variantes del i18n con fallback a base de datos
      const variantsKey = `service.${servicioActual.id}.variants`;
      const variantsRaw = t(variantsKey) || servicioActual.variantes || '';
      const variantes = variantsRaw
        .split(/\r?\n|\s*;\s*|\s*,\s*/)
        .map(v => v.trim())
        .filter(v => v.length > 0);
      
      const estadoActivo = String(servicioActual.estado ?? '1') !== '0';
      const href = servicioActual.id ? `/newreservation?service_id=${servicioActual.id}` : '/newreservation';
      const index = servicioActual.__index ?? 0;

      serviceDetail.innerHTML = `
        <div class="service-detail-media">
          <img src="${getImagenServicio(servicioActual, index)}" alt="${nombre}" class="service-detail-image">
        </div>
        <div class="service-detail-content">
          <div class="service-detail-header">
            <h2 class="service-detail-title">${nombre}</h2>
            <span class="service-detail-status ${estadoActivo ? 'is-active' : 'is-inactive'}">
              ${estadoActivo ? t('newReservation.statusActive') : t('newReservation.statusInactive')}
            </span>
          </div>
          <p class="service-detail-description">${descripcion}</p>
          <div class="service-detail-price">
            <span class="price-amount">${precio || t('services.consult')}</span>
            ${precio ? `<span class="price-label">${t('services.from')}</span>` : ''}
          </div>
          <div class="service-detail-meta">
            <span class="meta-label">${t('newReservation.priceBaseLabel')}</span>
            <span class="meta-value">${precio || t('services.consult')}</span>
          </div>
          <div class="service-detail-variants">
            <span class="meta-label">${t('newReservation.variantsLabel')}</span>
            ${variantes.length ? `<ul class="variant-list">${variantes.map(item => `<li>${item}</li>`).join('')}</ul>` : `<p class="variant-empty">${t('newReservation.variantsEmpty')}</p>`}
          </div>
          <div class="service-detail-actions">
            <a href="${href}" class="btn-reservar">${t('newReservation.reserveNow')}</a>
          </div>
        </div>
      `;

      serviceDetail.style.display = 'grid';
      serviceDetailEmpty.style.display = 'none';
    };

    const cargarServicio = async () => {
      if (!serviceDetail || !serviceDetailEmpty) return;
      const params = new URLSearchParams(window.location.search);
      const serviceId = params.get('service_id');

      try {
        const res = await fetch(API_SERVICIOS, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        if (!res.ok) {
          renderServicio();
          return;
        }
        const data = await res.json();
        const servicios = Array.isArray(data.xservServicios) ? data.xservServicios : [];
        const activos = servicios.filter((servicio) => String(servicio.estado ?? '1') !== '0');
        const indexed = activos.map((servicio, index) => ({ ...servicio, __index: index }));
        if (serviceId) {
          servicioActual = indexed.find((servicio) => String(servicio.id) === String(serviceId)) || null;
        } else {
          servicioActual = indexed[0] || null;
        }
        renderServicio();
      } catch (error) {
        console.error('Error cargando servicio:', error);
        renderServicio();
      }
    };

    cargarServicio();
    window.addEventListener('languageChanged', renderServicio);
  </script>
  <script src="/js/header-loader.js" defer></script>
  <script src="/js/header-dynamic.js" defer></script>
  <script src="/js/i18n.js" defer></script>
</body>
</html>
