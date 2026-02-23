<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.rateService">Xservicios - Valorar Servicio</title>
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

    html, body {
      height: 100%;
      overflow: hidden;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-deep);
      color: var(--text-white);
      min-height: 100vh;
    }

    .scrollbar-custom::-webkit-scrollbar {
      width: 6px;
    }

    .scrollbar-custom::-webkit-scrollbar-track {
      background: #1a1a1a;
      border-radius: 3px;
    }

    .scrollbar-custom::-webkit-scrollbar-thumb {
      background: #c9a962;
      border-radius: 3px;
    }

    textarea {
      resize: none;
      font-family: 'Inter', sans-serif;
    }

    textarea:focus, input:focus {
      outline: none;
      border-color: #c9a962;
    }

    /* Header Principal */
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

    /* Sub-Header */
    .sub-header {
      display: flex;
      align-items: center;
      gap: 2rem;
      padding: 1rem 2.5rem;
      background: rgba(26, 26, 26, 0.8);
      border-bottom: 1px solid rgba(201, 169, 98, 0.2);
      margin-top: 80px;
    }

    .back-btn {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background: transparent;
      border: 1px solid rgba(201, 169, 98, 0.3);
      color: var(--gold);
      padding: 0.5rem 1rem;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.85rem;
      transition: all 0.3s;
    }

    .back-btn:hover {
      background: var(--gold);
      color: var(--dark-bg);
    }

    .back-btn svg {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      fill: none;
    }

    .sub-nav {
      display: flex;
      gap: 2rem;
    }

    .sub-nav-item {
      color: var(--text-gray);
      text-decoration: none;
      font-size: 0.9rem;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid transparent;
      transition: all 0.3s;
    }

    .sub-nav-item:hover {
      color: var(--gold);
    }

    .sub-nav-item.active {
      color: var(--gold);
      border-bottom-color: var(--gold);
    }

    /* Main Container */
    .main-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      padding: calc(2rem + 80px) 2.5rem 2rem;
      height: 100vh;
      overflow: hidden;
    }

    /* Columna Izquierda - Valorar Servicio */
    .left-column {
      background: rgba(26, 26, 26, 0.6);
      border-radius: 12px;
      border: 1px solid rgba(201, 169, 98, 0.2);
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
    }

    .column-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.5rem;
    }

    .column-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--gold);
    }

    .filter-buttons {
      display: flex;
      gap: 0.5rem;
    }

    .filter-btn {
      padding: 0.4rem 0.75rem;
      background: rgba(42, 42, 42, 0.8);
      color: var(--text-gray);
      border: none;
      border-radius: 4px;
      font-size: 0.75rem;
      cursor: pointer;
      transition: all 0.3s;
    }

    .filter-btn.active {
      background: var(--gold);
      color: #050505;
    }

    .filter-btn:hover {
      border-color: var(--gold);
    }

    .viajes-pending {
      color: var(--text-gray);
      font-size: 0.85rem;
      margin-bottom: 1rem;
    }

    .viajes-list {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .viaje-card {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
      background: rgba(42, 42, 42, 0.5);
      border-radius: 10px;
      border: 1px solid rgba(201, 169, 98, 0.2);
      cursor: pointer;
      transition: all 0.3s;
    }

    .viaje-card:hover {
      border-color: var(--gold);
    }

    .viaje-card.selected {
      background: rgba(201, 169, 98, 0.1);
      border-color: var(--gold);
    }

    .viaje-imagen {
      width: 70px;
      height: 50px;
      object-fit: cover;
      border-radius: 6px;
      border: 2px solid var(--gold);
    }

    .viaje-info {
      flex: 1;
    }

    .viaje-ruta {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 0.25rem;
    }

    .viaje-ruta span {
      color: var(--text-white);
      font-size: 0.9rem;
    }

    .viaje-ruta svg {
      width: 16px;
      height: 16px;
      stroke: var(--gold);
      fill: none;
    }

    .viaje-detalles {
      color: var(--text-gray);
      font-size: 0.75rem;
    }

    .viaje-fecha {
      text-align: center;
    }

    .viaje-dia {
      color: var(--gold);
      font-size: 1.25rem;
      font-weight: 600;
    }

    .viaje-mes {
      color: var(--text-gray);
      font-size: 0.75rem;
    }

    .viaje-expandbtn {
      padding: 0.5rem;
      background: rgba(201, 169, 98, 0.2);
      border-radius: 50%;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .viaje-expandbtn svg {
      width: 16px;
      height: 16px;
      stroke: var(--gold);
      fill: none;
    }

    /* Panel de Valoración */
    .valoracion-panel {
      margin-top: 1rem;
      padding: 1.5rem;
      background: linear-gradient(135deg, rgba(26, 26, 26, 0.9), rgba(42, 42, 42, 0.8));
      border-radius: 12px;
      border: 1px solid rgba(201, 169, 98, 0.3);
      display: none;
    }

    .viaje-card.expanded ~ .valoracion-panel {
      display: block;
    }

    .panel-header {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .panel-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      color: var(--gold);
      margin-bottom: 0.5rem;
    }

    .panel-subtitle {
      color: var(--text-gray);
      font-size: 0.85rem;
    }

    .valoracion-item {
      padding: 1rem;
      background: rgba(42, 42, 42, 0.5);
      border-radius: 8px;
      margin-bottom: 1rem;
      border: 1px solid rgba(201, 169, 98, 0.2);
    }

    .valoracion-item-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 0.75rem;
    }

    .valoracion-item-label {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .valoracion-item-label-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
    }

    .stars-container {
      display: flex;
      gap: 0.25rem;
    }

    .star {
      width: 20px;
      height: 20px;
      cursor: pointer;
      transition: transform 0.2s;
      stroke: var(--gold);
      fill: transparent;
      stroke-width: 1.5;
    }

    .star:hover {
      transform: scale(1.2);
    }

    .star.filled {
      fill: var(--gold);
    }

    .star.half {
      fill: url(#gradientHalf);
    }

    .comentario-textarea {
      width: 100%;
      padding: 0.75rem;
      background: rgba(26, 26, 26, 0.8);
      border: 1px solid rgba(201, 169, 98, 0.2);
      border-radius: 6px;
      color: var(--text-white);
      font-size: 0.85rem;
      min-height: 60px;
      margin-bottom: 0.75rem;
    }

    .comentario-textarea::placeholder {
      color: var(--text-gray);
    }

    .enviar-btn {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 6px;
      font-size: 0.8rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      color: #050505;
    }

    .enviar-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .finalizar-btn {
      width: 100%;
      padding: 0.75rem;
      background: linear-gradient(135deg, #2d7a5f, #236349);
      color: var(--text-white);
      border: none;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 0.5rem;
      transition: all 0.3s;
    }

    .finalizar-btn:hover {
      transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 3rem;
      color: var(--text-gray);
    }

    .empty-state svg {
      width: 48px;
      height: 48px;
      stroke: var(--gold);
      fill: none;
      stroke-width: 1.5;
      margin: 0 auto 1rem;
    }

    /* Columna Derecha - Valoraciones Pasadas */
    .right-column {
      background: rgba(26, 26, 26, 0.6);
      border-radius: 12px;
      border: 1px solid rgba(201, 169, 98, 0.2);
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
    }

    .valoraciones-list {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .pagination-actions {
      display: flex;
      justify-content: flex-end;
      margin-top: 1rem;
    }

    .pagination-btn {
      padding: 0.5rem 1rem;
      border-radius: 6px;
      border: 1px solid rgba(201, 169, 98, 0.3);
      background: rgba(201, 169, 98, 0.15);
      color: var(--gold);
      font-size: 0.8rem;
      cursor: pointer;
      transition: all 0.3s;
    }

    .pagination-btn:hover {
      background: var(--gold);
      color: var(--dark-bg);
    }

    .valoracion-card {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
      background: rgba(42, 42, 42, 0.5);
      border-radius: 10px;
      border: 1px solid rgba(201, 169, 98, 0.2);
      cursor: pointer;
      transition: all 0.3s;
    }

    .valoracion-card:hover {
      border-color: var(--gold);
    }

    .valoracion-card.expanded {
      background: rgba(201, 169, 98, 0.1);
      border-color: var(--gold);
    }

    .valoracion-imagen {
      width: 60px;
      height: 45px;
      object-fit: cover;
      border-radius: 6px;
      border: 2px solid var(--gold);
    }

    .valoracion-ruta {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 0.25rem;
    }

    .valoracion-ruta span {
      color: var(--text-white);
      font-size: 0.85rem;
    }

    .valoracion-badges {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-top: 0.25rem;
    }

    .valoracion-badge {
      padding: 0.2rem 0.5rem;
      border-radius: 4px;
      font-size: 0.7rem;
      font-weight: 600;
    }

    .valoracion-stars {
      display: flex;
      align-items: center;
      gap: 0.3rem;
      margin-left: 0.5rem;
    }

    .mini-star {
      width: 14px;
      height: 14px;
      stroke: var(--gold);
      fill: var(--gold);
      stroke-width: 1;
    }

    .rating-value {
      color: var(--gold);
      font-size: 0.8rem;
      font-weight: 600;
    }

    /* Detalle de Valoración */
    .valoracion-detalle {
      margin-top: 0.75rem;
      padding: 1.25rem;
      background: linear-gradient(135deg, rgba(26, 26, 26, 0.9), rgba(42, 42, 42, 0.8));
      border-radius: 10px;
      border: 1px solid rgba(201, 169, 98, 0.3);
      display: none;
    }

    .valoracion-card.expanded ~ .valoracion-detalle {
      display: block;
    }

    .detalle-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1rem;
      padding-bottom: 0.75rem;
      border-bottom: 1px solid rgba(201, 169, 98, 0.2);
    }

    .detalle-info {
      text-align: left;
    }

    .detalle-tipo {
      color: var(--gold);
      font-size: 1rem;
      margin-bottom: 0.25rem;
    }

    .detalle-fecha {
      color: var(--text-gray);
      font-size: 0.75rem;
    }

    .detalle-stars {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .comentario-box {
      margin-top: 1rem;
    }

    .comentario-label {
      color: var(--text-gray);
      font-size: 0.75rem;
      margin-bottom: 0.5rem;
    }

    .comentario-text {
      color: var(--text-white);
      font-size: 0.85rem;
      line-height: 1.5;
      padding: 0.75rem;
      background: rgba(42, 42, 42, 0.5);
      border-radius: 6px;
      border-left: 3px solid var(--gold);
    }

    .comentario-empty {
      color: #666;
      font-size: 0.85rem;
      font-style: italic;
    }

    @media (max-width: 1024px) {
      .main-container {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      .header {
        padding-left: 1rem;
        padding-right: 1rem;
      }

      .nav-menu {
        display: none;
      }

      .main-container {
        padding-left: 1rem;
        padding-right: 1rem;
      }
    }
  </style>
  <link rel="stylesheet" href="/css/header-auth.css">
</head>
<body>
  <!-- SVG Gradients -->
  <svg style="display: none;">
    <defs>
      <linearGradient id="gradientHalf" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="50%" style="stop-color:#c9a962;stop-opacity:1" />
        <stop offset="50%" style="stop-color:transparent;stop-opacity:0" />
      </linearGradient>
    </defs>
  </svg>

  <!-- Header será cargado dinámicamente por header-loader.js -->

  <!-- Main Content -->
  <div class="main-container">
    <!-- Columna Izquierda -->
    <div class="left-column">
      <div class="column-header">
        <h2 class="column-title" data-i18n="rate.title">Valorar Servicio</h2>
        <div class="filter-buttons">
          <button class="filter-btn active" data-filter="todos" onclick="setFiltro('todos')" data-i18n="rate.filterAll">Todos</button>
          <button class="filter-btn" data-filter="chofer" onclick="setFiltro('chofer')" data-i18n="rate.filterDrivers">Choferes</button>
          <button class="filter-btn" data-filter="bus" onclick="setFiltro('bus')" data-i18n="rate.filterBuses">Buses</button>
          <button class="filter-btn" data-filter="servicio" onclick="setFiltro('servicio')" data-i18n="rate.filterService">Servicio</button>
        </div>
      </div>

      <p class="viajes-pending" id="viajes-count" data-i18n="rate.pendingTrips">0</p>

      <div class="viajes-list" id="viajes-list"></div>
      <div class="pagination-actions" id="viajes-pagination"></div>
    </div>

    <!-- Columna Derecha -->
    <div class="right-column">
      <div class="column-header">
        <h2 class="column-title" data-i18n="rate.pastRatings">Valoraciones Pasadas</h2>
        <span style="padding: 0.4rem 0.75rem; background: rgba(201, 169, 98, 0.2); color: var(--gold); border-radius: 20px; font-size: 0.8rem;" id="valoraciones-count" data-i18n="rate.ratingsCount">0</span>
      </div>

      <div class="valoraciones-list" id="valoraciones-list"></div>
      <div class="pagination-actions" id="valoraciones-pagination"></div>
    </div>
  </div>

  <script>
    // Variables globales
    let viajesSinValorar = [];
    let valoracionesPasadas = [];
    let viajeSeleccionado = null;
    let valoracionExpandida = null;
    let filtro = 'todos';
    const PAGE_SIZE = 5;
    let pageViajes = 0;
    let pageValoraciones = 0;
    let ratings = { chofer: 0, bus: 0, servicio: 0 };
    let comentarios = { chofer: '', bus: '', servicio: '' };
    let viajesConValoraciones = new Set(); // Para rastrear qué reservas ya tienen valoraciones

    // Configuración de API
    const API_BASE = '';  // Mismo dominio
    const API_RESERVAS = `${API_BASE}/xserv-reservas.json`;
    const API_VALORACIONES = `${API_BASE}/xserv-valoraciones.json`;
    const API_ADD_VALORACION = `${API_BASE}/xserv-valoraciones/add.json`;

    // Cargar datos desde la API
    async function cargarDatos() {
      try {
        // Cargar reservas completadas
        const resReservas = await fetch(API_RESERVAS, {
          headers: {
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });
        
        if (!resReservas.ok) throw new Error('Error al cargar reservas');
        const dataReservas = await resReservas.json();
        
        // Cargar valoraciones existentes
        const resValoraciones = await fetch(API_VALORACIONES, {
          headers: {
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });
        
        if (!resValoraciones.ok) throw new Error('Error al cargar valoraciones');
        const dataValoraciones = await resValoraciones.json();
        
        // Procesar valoraciones para saber cuáles reservas ya tienen valoración
        if (dataValoraciones.xservValoraciones) {
          dataValoraciones.xservValoraciones.forEach(val => {
            if (val.xserv_reserva_id) {
              viajesConValoraciones.add(val.xserv_reserva_id);
            }
          });
          valoracionesPasadas = dataValoraciones.xservValoraciones.map(val => ({
            id: val.id,
            viajeId: val.xserv_reserva_id,
            origen: val.xserv_reserva?.origen_ubicacion || 'Origen',
            destino: val.xserv_reserva?.destino_ubicacion || 'Destino',
            fecha: val.xserv_reserva?.fecha_viaje || new Date().toISOString().split('T')[0],
            imagen: getImagenAleatoraPropia(),
            tipo: val.tipo || 'servicio',
            estrellas: parseInt(val.calificacion) || 0,
            comentario: val.comentarios || '',
            fechaValoracion: val.created?.split(' ')[0] || new Date().toISOString().split('T')[0]
          }));
        }
        
        // Procesar reservas (solo las completadas y sin valoración)
        if (dataReservas.xservReservas) {
          viajesSinValorar = dataReservas.xservReservas
            .filter(res => {
              // Filtrar reservas completadas sin valoración
              return res.estado === 'completado' && !viajesConValoraciones.has(res.id);
            })
            .map(res => ({
              id: res.id,
              origen: res.origen_ubicacion || 'Origen',
              destino: res.destino_ubicacion || 'Destino',
              fecha: res.fecha_viaje || new Date().toISOString().split('T')[0],
              imagen: getImagenAleatoriaPropia(),
              chofer: res.xserv_chofer?.nombre_completo || 'Chofer',
              bus: res.xserv_vehiculo?.marca_modelo || 'Bus'
            }));
        }
        
        renderViajesSinValorar();
        renderValoracionesPasadas();
      } catch (error) {
        console.error('Error al cargar datos:', error);
        // Mantener datos de demostración si hay error
        renderViajesSinValorar();
        renderValoracionesPasadas();
      }
    }

    function getImagenAleatoriaPropia() {
      const imagenes = [
        'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=300&h=200&fit=crop',
        'https://images.unsplash.com/photo-1559128010-7c1ad6e1b6a5?w=300&h=200&fit=crop',
        'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=300&h=200&fit=crop',
        'https://images.unsplash.com/photo-1519046904884-53103b34b206?w=300&h=200&fit=crop',
        'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe3e?w=300&h=200&fit=crop'
      ];
      return imagenes[Math.floor(Math.random() * imagenes.length)];
    }

    function formatearFecha(fecha) {
      const [year, month, day] = fecha.split('-');
      const lang = window.getCurrentLanguage ? window.getCurrentLanguage() : 'es';
      const meses = {
        es: ["", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        en: ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      };
      const lista = meses[lang] || meses.es;
      return { dia: day, mes: lista[parseInt(month)] };
    }

    function formatearFechaCompleta(fecha) {
      const date = new Date(fecha);
      const lang = window.getCurrentLanguage ? window.getCurrentLanguage() : 'es';
      const locale = lang === 'en' ? 'en-US' : 'es-ES';
      return date.toLocaleDateString(locale, { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    }

    function renderStar(rating, position, onChange) {
      const isFilled = position <= rating;
      return `<svg class="star ${isFilled ? 'filled' : ''}" viewBox="0 0 24 24" onclick="event.stopPropagation(); ${onChange}(${position})">
        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
      </svg>`;
    }

    function renderViajesSinValorar() {
      const t = window.translate ? window.translate : (key) => key;
      const totalPages = Math.ceil(viajesSinValorar.length / PAGE_SIZE);
      if (pageViajes >= totalPages) pageViajes = 0;

      const start = pageViajes * PAGE_SIZE;
      const visibleViajes = viajesSinValorar.slice(start, start + PAGE_SIZE);

      const html = visibleViajes.map((viaje, idx) => {
        const originalIndex = start + idx;
        const fecha = formatearFecha(viaje.fecha);
        const isExpanded = viajeSeleccionado === originalIndex;
        return `
          <div>
            <div class="viaje-card ${isExpanded ? 'expanded' : ''}" onclick="toggleViaje(${originalIndex})">
              <img src="${viaje.imagen}" alt="${viaje.destino}" class="viaje-imagen" />
              <div class="viaje-info">
                <div class="viaje-ruta">
                  <span>${viaje.origen}</span>
                  <svg viewBox="0 0 24 24" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                  </svg>
                  <span>${viaje.destino}</span>
                </div>
                <p class="viaje-detalles">${t('rate.driver')}: ${viaje.chofer} | ${t('rate.bus')}: ${viaje.bus}</p>
              </div>
              <div class="viaje-fecha">
                <div class="viaje-dia">${fecha.dia}</div>
                <div class="viaje-mes">${fecha.mes}</div>
              </div>
              <button class="viaje-expandbtn"onclick="event.stopPropagation()">
                <svg viewBox="0 0 24 24" stroke-width="2">
                  <polyline points="6 9 12 15 18 9" />
                </svg>
              </button>
            </div>
            ${isExpanded ? renderValoracionPanel(viaje, originalIndex) : ''}
          </div>
        `;
      }).join('');
      document.getElementById('viajes-list').innerHTML = html || `<div class="empty-state"><svg viewBox="0 0 24 24" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01" /></svg><p>${t('rate.emptyPending')}</p></div>`;
      document.getElementById('viajes-count').textContent = t('rate.pendingTrips').replace('{count}', viajesSinValorar.length);

      const pagination = document.getElementById('viajes-pagination');
      if (pagination) {
        if (viajesSinValorar.length > PAGE_SIZE) {
          pagination.innerHTML = `<button class="pagination-btn" onclick="nextViajesPage()">${t('rate.nextPage')}</button>`;
        } else {
          pagination.innerHTML = '';
        }
      }
    }

    function renderValoracionPanel(viaje, idx) {
      const t = window.translate ? window.translate : (key) => key;
      return `
        <div class="valoracion-panel">
          <div class="panel-header">
            <h3 class="panel-title">${t('rate.thanks')}</h3>
            <p class="panel-subtitle">${t('rate.opinionHelp')}</p>
          </div>
          <div class="valoracion-item" style="border-color: rgba(74, 222, 128, 0.2);">
            <div class="valoracion-item-header">
              <div class="valoracion-item-label">
                <div class="valoracion-item-label-dot" style="background: #4ade80;"></div>
                ${t('rate.rateDriver')} (${viaje.chofer})
              </div>
              <div class="stars-container" id="stars-chofer-${idx}"></div>
            </div>
            <textarea class="comentario-textarea" id="comentario-chofer-${idx}" placeholder="Escribe tu comentario sobre el chofer (opcional)..." data-i18n-placeholder="rate.commentDriver"></textarea>
            <button class="enviar-btn" style="background: #4ade80;" onclick="enviarValoracion(${idx}, 'chofer')">${t('rate.sendDriver')}</button>
          </div>
          <div class="valoracion-item" style="border-color: rgba(96, 165, 250, 0.2);">
            <div class="valoracion-item-header">
              <div class="valoracion-item-label">
                <div class="valoracion-item-label-dot" style="background: #60a5fa;"></div>
                ${t('rate.rateBus')} (${viaje.bus})
              </div>
              <div class="stars-container" id="stars-bus-${idx}"></div>
            </div>
            <textarea class="comentario-textarea" id="comentario-bus-${idx}" placeholder="Escribe tu comentario sobre el bus (opcional)..." data-i18n-placeholder="rate.commentBus"></textarea>
            <button class="enviar-btn" style="background: #60a5fa;" onclick="enviarValoracion(${idx}, 'bus')">${t('rate.sendBus')}</button>
          </div>
          <div class="valoracion-item" style="border-color: rgba(201, 169, 98, 0.2);">
            <div class="valoracion-item-header">
              <div class="valoracion-item-label">
                <div class="valoracion-item-label-dot" style="background: var(--gold);"></div>
                ${t('rate.rateService')}
              </div>
              <div class="stars-container" id="stars-servicio-${idx}"></div>
            </div>
            <textarea class="comentario-textarea" id="comentario-servicio-${idx}" placeholder="Escribe tu comentario sobre el servicio (opcional)..." data-i18n-placeholder="rate.commentService"></textarea>
            <button class="enviar-btn" style="background: var(--gold); color: #050505;" onclick="enviarValoracion(${idx}, 'servicio')">${t('rate.sendService')}</button>
          </div>
          <button class="finalizar-btn" onclick="finalizarValoracion(${idx})">${t('rate.finishTrip')}</button>
        </div>
      `;
    }

    function toggleViaje(idx) {
      viajeSeleccionado = viajeSeleccionado === idx ? null : idx;
      renderViajesSinValorar();
      if (viajeSeleccionado === idx) {
        // Render stars después del DOM
        setTimeout(() => {
          for (let tipo of ['chofer', 'bus', 'servicio']) {
            const container = document.getElementById(`stars-${tipo}-${idx}`);
            if (container) {
              container.innerHTML = [1,2,3,4,5].map(i => renderStar(ratings[tipo], i, `setRating.bind(null, ${idx}, '${tipo}')`)).join('');
            }
          }
        }, 0);
      }
    }

    function setRating(idx, tipo, valor) {
      ratings[tipo] = valor;
      setTimeout(() => {
        const container = document.getElementById(`stars-${tipo}-${idx}`);
        if (container) {
          container.innerHTML = [1,2,3,4,5].map(i => renderStar(ratings[tipo], i, `setRating.bind(null, ${idx}, '${tipo}')`)).join('');
        }
      }, 0);
    }

    function enviarValoracion(idx, tipo) {
      const t = window.translate ? window.translate : (key) => key;
      const rating = ratings[tipo];
      const comentario = document.getElementById(`comentario-${tipo}-${idx}`).value;
      
      if (rating === 0) {
        alert(t('rate.selectRating'));
        return;
      }
      
      const viaje = viajesSinValorar[idx];
      const formData = new FormData();
      formData.append('xserv_reserva_id', viaje.id);
      formData.append('tipo', tipo);
      formData.append('calificacion', rating);
      formData.append('comentarios', comentario);
      formData.append('mostrar_en_web', 'true');
      
      // Mostrar indicador de carga
      const button = event.target;
      const buttonText = button.textContent;
      button.disabled = true;
      button.textContent = t('rate.sending');
      
      fetch(API_ADD_VALORACION, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
      })
      .then(response => {
        if (!response.ok) throw new Error(t('rate.saveError'));
        return response.json();
      })
      .then(data => {
        button.textContent = t('rate.sent');
        setTimeout(() => {
          ratings[tipo] = 0;
          document.getElementById(`comentario-${tipo}-${idx}`).value = '';
          button.disabled = false;
          button.textContent = buttonText;
        }, 1500);
      })
      .catch(error => {
        console.error('Error:', error);
        alert(t('rate.sendError'));
        button.disabled = false;
        button.textContent = buttonText;
      });
    }

    async function finalizarValoracion(idx) {
      const t = window.translate ? window.translate : (key) => key;
      const viaje = viajesSinValorar[idx];
      
      // Verificar que al menos una valoración fue enviada
      if (!viajesConValoraciones.has(viaje.id)) {
        alert(t('rate.sendOneBeforeFinish'));
        return;
      }
      
      // Recargar datos para reflejar los cambios
      viajesSinValorar.splice(idx, 1);
      viajeSeleccionado = null;
      ratings = { chofer: 0, bus: 0, servicio: 0 };
      renderViajesSinValorar();
      
      // Recargar valoraciones desde la API
      cargarValoracionesActualizadas();
    }

    async function cargarValoracionesActualizadas() {
      try {
        const response = await fetch(API_VALORACIONES, {
          headers: {
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });
        
        if (!response.ok) throw new Error('Error al cargar valoraciones');
        const data = await response.json();
        
        if (data.xservValoraciones) {
          valoracionesPasadas = data.xservValoraciones.map(val => ({
            id: val.id,
            viajeId: val.xserv_reserva_id,
            origen: val.xserv_reserva?.origen_ubicacion || 'Origen',
            destino: val.xserv_reserva?.destino_ubicacion || 'Destino',
            fecha: val.xserv_reserva?.fecha_viaje || new Date().toISOString().split('T')[0],
            imagen: getImagenAleatoriaPropia(),
            tipo: val.tipo || 'servicio',
            estrellas: parseInt(val.calificacion) || 0,
            comentario: val.comentarios || '',
            fechaValoracion: val.created?.split(' ')[0] || new Date().toISOString().split('T')[0]
          }));
          renderValoracionesPasadas();
        }
      } catch (error) {
        console.error('Error al recargar valoraciones:', error);
      }
    }

    function renderValoracionesPasadas() {
      const filtered = filtro === 'todos' ? valoracionesPasadas : valoracionesPasadas.filter(v => v.tipo === filtro);
      const t = window.translate ? window.translate : (key) => key;

      const totalPages = Math.ceil(filtered.length / PAGE_SIZE);
      if (pageValoraciones >= totalPages) pageValoraciones = 0;
      const start = pageValoraciones * PAGE_SIZE;
      const visibleValoraciones = filtered.slice(start, start + PAGE_SIZE);

      const html = visibleValoraciones.map((val, idx) => {
        const originalIndex = start + idx;
        const isExpanded = valoracionExpandida === idx;
        const tiposColor = { chofer: '#4ade80', bus: '#60a5fa', servicio: 'var(--gold)' };
        const tiposLabel = {
          chofer: t('rate.driver'),
          bus: t('rate.bus'),
          servicio: t('rate.service'),
        };
        return `
          <div>
            <div class="valoracion-card ${isExpanded ? 'expanded' : ''}" onclick="toggleValoracion(${originalIndex})">
              <img src="${val.imagen}" alt="${val.destino}" class="valoracion-imagen" />
              <div class="viaje-info">
                <div class="valoracion-ruta">
                  <span>${val.origen}</span>
                  <svg viewBox="0 0 24 24" stroke-width="2" style="width: 14px; height: 14px; stroke: var(--gold); fill: none;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  <span>${val.destino}</span>
                </div>
                <div class="valoracion-badges">
                  <span class="valoracion-badge" style="background: ${tiposColor[val.tipo]}20; color: ${tiposColor[val.tipo]};">${tiposLabel[val.tipo]}</span>
                  <div class="valoracion-stars">
                    ${[1,2,3,4,5].map(i => `<svg class="mini-star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" style="fill: ${i <= val.estrellas ? tiposColor[val.tipo] : 'transparent'}; stroke: ${tiposColor[val.tipo]};"/></svg>`).join('')}
                    <span class="rating-value">${val.estrellas}.0</span>
                  </div>
                </div>
              </div>
              <div class="viaje-fecha">
                <div class="viaje-dia">${formatearFecha(val.fecha).dia}</div>
                <div class="viaje-mes">${formatearFecha(val.fecha).mes}</div>
              </div>
              <button class="viaje-expandbtn" onclick="event.stopPropagation()">
                <svg viewBox="0 0 24 24" stroke-width="2"><polyline points="6 9 12 15 18 9" /></svg>
              </button>
            </div>
            ${isExpanded ? `
              <div class="valoracion-detalle">
                <div class="detalle-header">
                  <div class="detalle-info">
                    <div class="detalle-tipo">${t('rate.ratingOf')} ${tiposLabel[val.tipo]}</div>
                    <p class="detalle-fecha">${t('rate.ratedOn')} ${formatearFechaCompleta(val.fechaValoracion)}</p>
                  </div>
                  <div class="detalle-stars">
                    ${[1,2,3,4,5].map(i => `<svg class="mini-star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" style="fill: ${i <= val.estrellas ? tiposColor[val.tipo] : 'transparent'}; stroke: ${tiposColor[val.tipo]};"/></svg>`).join('')}
                    <span class="rating-value">${val.estrellas}.0</span>
                  </div>
                </div>
                <div style="margin-bottom: 1rem;">
                  <p class="detalle-fecha">${t('rate.tripLabel')}</p>
                  <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <span style="color: var(--text-white); font-size: 0.9rem;">${val.origen}</span>
                    <div style="flex: 1; height: 2px; background: linear-gradient(to right, transparent, var(--gold), transparent);"></div>
                    <span style="color: var(--text-white); font-size: 0.9rem;">${val.destino}</span>
                  </div>
                </div>
                ${val.comentario ? `
                  <div class="comentario-box">
                    <p class="comentario-label">${t('rate.commentLabel')}</p>
                    <p class="comentario-text">"${val.comentario}"</p>
                  </div>
                ` : `
                  <div class="comentario-box">
                    <p class="comentario-label">${t('rate.commentLabel')}</p>
                    <p class="comentario-empty">${t('rate.noComment')}</p>
                  </div>
                `}
              </div>
            ` : ''}
          </div>
        `;
      }).join('');
      
      document.getElementById('valoraciones-list').innerHTML = html || `<div class="empty-state"><svg viewBox="0 0 24 24" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg><p>${t('rate.emptyRatings')}</p></div>`;
      document.getElementById('valoraciones-count').textContent = t('rate.ratingsCount').replace('{count}', filtered.length);

      const pagination = document.getElementById('valoraciones-pagination');
      if (pagination) {
        if (filtered.length > PAGE_SIZE) {
          pagination.innerHTML = `<button class="pagination-btn" onclick="nextValoracionesPage()">${t('rate.nextPage')}</button>`;
        } else {
          pagination.innerHTML = '';
        }
      }
    }

    function toggleValoracion(idx) {
      const filtered = filtro === 'todos' ? valoracionesPasadas : valoracionesPasadas.filter(v => v.tipo === filtro);
      valoracionExpandida = valoracionExpandida === idx ? null : idx;
      renderValoracionesPasadas();
    }

    function setFiltro(f) {
      filtro = f;
      pageValoraciones = 0;
      document.querySelectorAll('.filter-btn').forEach((btn, i) => {
        btn.classList.toggle('active', btn.dataset.filter === f);
      });
      valoracionExpandida = null;
      renderValoracionesPasadas();
    }

    function nextViajesPage() {
      const totalPages = Math.ceil(viajesSinValorar.length / PAGE_SIZE);
      if (totalPages <= 1) return;
      pageViajes = (pageViajes + 1) % totalPages;
      renderViajesSinValorar();
    }

    function nextValoracionesPage() {
      const filtered = filtro === 'todos' ? valoracionesPasadas : valoracionesPasadas.filter(v => v.tipo === filtro);
      const totalPages = Math.ceil(filtered.length / PAGE_SIZE);
      if (totalPages <= 1) return;
      pageValoraciones = (pageValoraciones + 1) % totalPages;
      renderValoracionesPasadas();
    }

    // Inicializar
    cargarDatos();

    window.addEventListener('languageChanged', () => {
      renderViajesSinValorar();
      renderValoracionesPasadas();
    });
  </script>
  <script src="/js/i18n.js"></script>
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
</body>
</html>
