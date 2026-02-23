/**
 * Header Loader - Xservicios
 * Inyecta dinámicamente el header reutilizable en páginas HTML estáticas
 */

(function() {
  'use strict';

  // Determinar página activa basada en la URL
  function getActivePage() {
    const path = window.location.pathname.toLowerCase();
    
    if (path.includes('nosotros') || path.includes('about')) return 'about';
    if (path.includes('flota') || path.includes('fleet')) return 'fleet';
    if (path.includes('service')) return 'services';
    return 'home';
  }

  // Crear el HTML del header
  function createHeaderHTML(activePage) {
    const isActive = (page) => page === activePage ? 'active' : '';

    return `
      <header class="xserv-header">
        <a href="/home" class="xserv-logo">
          <span class="xserv-logo-x">X</span>SERVICIOS
        </a>
        
        <nav class="xserv-nav-menu">
          <a href="/home" class="xserv-nav-item ${isActive('home')}">
            <span data-i18n="nav.home">Inicio</span>
          </a>
          <a href="/fleet" class="xserv-nav-item ${isActive('fleet')}">
            <span data-i18n="nav.fleet">Ver flota</span>
          </a>
          <a href="/services" class="xserv-nav-item ${isActive('services')}">
            <span data-i18n="nav.services">Servicios</span>
          </a>
          <a href="/about" class="xserv-nav-item ${isActive('about')}">
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
          <a class="xserv-auth-button" href="/login" id="xservLoginBtn" data-i18n="auth.login">Iniciar Sesión</a>

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
    `;
  }

  // Crear los estilos CSS necesarios
  function createHeaderStyles() {
    const style = document.createElement('style');
    style.textContent = `
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

      @media (max-width: 1024px) {
        .xserv-nav-menu {
          gap: 1.5rem;
        }
      }

      @media (max-width: 768px) {
        .xserv-header {
          padding: 1rem 1.5rem;
        }

        .xserv-nav-menu {
          gap: 1rem;
        }

        .xserv-nav-item span {
          display: none;
        }

        .xserv-user-name {
          display: none;
        }
      }
    `;
    return style;
  }

  // Cargar el header dinámicamente
  function loadHeader() {
    // Buscar header existente
    const existingHeader = document.querySelector('.header');
    
    // Determinar página activa
    const activePage = getActivePage();

    // Crear HTML del header
    const headerHTML = createHeaderHTML(activePage);

    if (existingHeader) {
      // Reemplazar header existente
      existingHeader.outerHTML = headerHTML;
    } else {
      // Insertar header al inicio del body
      const tempDiv = document.createElement('div');
      tempDiv.innerHTML = headerHTML;
      document.body.insertBefore(tempDiv.firstElementChild, document.body.firstChild);
    }

    // Agregar estilos si no existen
    if (!document.getElementById('xserv-header-styles')) {
      const styles = createHeaderStyles();
      styles.id = 'xserv-header-styles';
      document.head.appendChild(styles);
    }

    // Reinicializar el sistema i18n después de cargar el header
    function initializeI18n() {
      if (window.i18n) {
        window.i18n.translatePage();
        window.i18n.attachLanguageButtons();
        window.i18n.updateActiveLanguage();
        console.log('✅ Sistema i18n inicializado en header');
        
        // Emitir evento de que el header está completamente cargado
        const event = new CustomEvent('headerLoaded', { 
          detail: { timestamp: Date.now() } 
        });
        document.dispatchEvent(event);
      } else {
        // Si i18n aún no está disponible, esperar un poco más
        console.log('⏳ Esperando i18n...');
        setTimeout(initializeI18n, 50);
      }
    }
    
    // Iniciar después de un delay para asegurar que i18n esté cargado
    setTimeout(initializeI18n, 100);

    console.log('✅ Header reutilizable cargado correctamente');
  }

  // Inicializar cuando el DOM esté listo
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadHeader);
  } else {
    loadHeader();
  }

})();
