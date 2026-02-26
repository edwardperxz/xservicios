/**
 * Header Loader - Xservicios
 * Inyecta dinámicamente el header reutilizable en páginas HTML estáticas
 */

(function() {
  'use strict';

  function getHeaderConfig() {
    const bodyData = document.body ? document.body.dataset : {};
    const config = window.xservHeaderConfig || {};

    const notificationCountRaw = config.notificationCount ?? bodyData.notificationCount ?? 0;
    const notificationCount = Number(notificationCountRaw);

    return {
      variant: config.variant || bodyData.headerVariant || 'default',
      activePage: config.activePage || bodyData.activePage || null,
      notificationCount: Number.isFinite(notificationCount) ? notificationCount : 0,
    };
  }

  // Determinar página activa basada en la URL
  function getActivePage(headerConfig) {
    if (headerConfig && headerConfig.activePage) {
      return headerConfig.activePage;
    }

    const path = window.location.pathname.toLowerCase();

    if (path.includes('requests')) return 'requests';
    if (path.includes('trips')) return 'trips';
    if (path.includes('messages')) return 'messages';
    if (path.includes('nosotros') || path.includes('about')) return 'about';
    if (path.includes('flota') || path.includes('fleet')) return 'fleet';
    if (path.includes('service')) return 'services';
    return 'home';
  }

  // Crear el HTML del header
  function createHeaderHTML(activePage, headerConfig) {
    const variant = headerConfig?.variant || 'default';
    const notificationCount = headerConfig?.notificationCount || 0;
    const isActive = (page) => page === activePage ? 'active' : '';

    const notificationBadgeClass = notificationCount > 0 ? '' : ' is-hidden';
    const notificationsButton = variant === 'driver' ? `
          <button class="xserv-notification-button" id="xservNotificationBtn" aria-label="Notificaciones">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            <span class="xserv-notification-count${notificationBadgeClass}" id="xservNotificationCount">${notificationCount}</span>
          </button>
        ` : '';

    const navDesktop = variant === 'driver' ? `
          <a href="/home" class="xserv-nav-item ${isActive('home')}">
            <span data-i18n="nav.home">Inicio</span>
          </a>
          <a href="/chofer/viajes" class="xserv-nav-item ${isActive('trips')}">
            <span data-i18n="nav.trips">Mis Viajes</span>
          </a>
        ` : `
          <a href="/home" class="xserv-nav-item ${isActive('home')}">
            <span data-i18n="nav.home">Inicio</span>
          </a>
          <!-- My Reservations (Desktop Only, Logged In Users) -->
          <a href="/myreservations" class="xserv-nav-item xserv-nav-item-auth is-hidden" id="xservNavMyReservations" data-i18n="profile.myReservations">Mis Reservas</a>
          <a href="/fleet" class="xserv-nav-item ${isActive('fleet')}">
            <span data-i18n="nav.fleet">Ver flota</span>
          </a>
          <a href="/services" class="xserv-nav-item ${isActive('services')}">
            <span data-i18n="nav.services">Servicios</span>
          </a>
          <a href="/about" class="xserv-nav-item ${isActive('about')}">
            <span data-i18n="nav.about">Nosotros</span>
          </a>
        `;

    const navMobile = variant === 'driver' ? `
            <a href="/home" class="xserv-nav-item-mobile ${isActive('home')}">
              <svg class="xserv-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
              </svg>
              <span data-i18n="nav.home">Inicio</span>
            </a>
            <a href="/chofer/viajes" class="xserv-nav-item-mobile ${isActive('trips')}">
              <svg class="xserv-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="22 16.13 2.97 16.13 2.97 5.74 22 5.74"/>
                <path d="M16 13l6-6m-6 6l-6-6" stroke="currentColor" fill="none"/>
              </svg>
              <span data-i18n="nav.trips">Mis Viajes</span>
            </a>
        ` : `
            <a href="/home" class="xserv-nav-item-mobile ${isActive('home')}">
              <svg class="xserv-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
              </svg>
              <span data-i18n="nav.home">Inicio</span>
            </a>
            <!-- My Reservations (Mobile Only, Logged In Users) -->
            <a href="/myreservations" class="xserv-nav-item-mobile xserv-nav-item-auth is-hidden" id="xservNavMyReservationsMobile">
              <svg class="xserv-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              <span data-i18n="profile.myReservations">Mis Reservas</span>
            </a>
            <a href="/fleet" class="xserv-nav-item-mobile ${isActive('fleet')}">
              <svg class="xserv-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 17h2v2h-2z"/>
                <path d="M9 17H7v2h2z"/>
                <path d="M20 16H4a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2z"/>
                <path d="M8 4h8v2H8z"/>
              </svg>
              <span data-i18n="nav.fleet">Ver flota</span>
            </a>
            <a href="/services" class="xserv-nav-item-mobile ${isActive('services')}">
              <svg class="xserv-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
              </svg>
              <span data-i18n="nav.services">Servicios</span>
            </a>
            <a href="/about" class="xserv-nav-item-mobile ${isActive('about')}">
              <svg class="xserv-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>
              </svg>
              <span data-i18n="nav.about">Nosotros</span>
            </a>
        `;

    return `
      <header class="xserv-header">
        <!-- Hamburger Menu Button -->
        <button class="xserv-hamburger-menu" id="menuToggle" aria-label="Menú">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>

        <!-- Logo -->
        <a href="/home" class="xserv-logo">
          <span class="xserv-logo-x">X</span><span class="xserv-logo-text">SERVICIOS</span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="xserv-nav-menu">
          ${navDesktop}
        </nav>

        <!-- Mobile Sidebar -->
        <nav class="xserv-nav-menu-mobile" id="navSidebar">
          <!-- Sidebar Header with Close Button -->
          <div class="xserv-sidebar-header">
            <span class="xserv-sidebar-title">Menú</span>
            <button class="xserv-sidebar-close" id="sidebarCloseBtn" aria-label="Cerrar menú">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>

          <!-- Navigation Items -->
          <div class="xserv-sidebar-nav">
            ${navMobile}
          </div>

          <!-- Sidebar Footer Section -->
          <div class="xserv-sidebar-footer">
            <!-- Language Button (Mobile Only) -->
            <button class="xserv-lang-button xserv-lang-button-mobile" id="langToggleMobile" aria-label="Cambiar idioma">
              <svg class="lang-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
              </svg>
              <span class="lang-code">EN</span>
            </button>

            <!-- Login Button (Mobile Only) -->
            <a class="xserv-auth-button xserv-auth-button-mobile" href="/login" id="xservLoginBtnMobile" data-i18n="auth.login">Iniciar Sesión</a>

            <!-- User Profile (Mobile Only) -->
            <div class="xserv-user-profile-mobile is-hidden" id="xservUserProfileMobile">
              <a href="/profile" class="xserv-user-info-mobile">
                <div class="xserv-user-avatar-mobile" id="xservUserAvatarMobile">US</div>
                <span class="xserv-user-name-mobile" id="xservUserNameMobile">Usuario</span>
              </a>
              <div class="xserv-user-menu-mobile">
                <a href="/settings" class="xserv-user-menu-item">
                  <svg viewBox="7 0 54 54" stroke-width="3.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M45,14.67l-2.76,2a1,1,0,0,1-1,.11L37.65,15.3a1,1,0,0,1-.61-.76l-.66-3.77a1,1,0,0,0-1-.84H30.52a1,1,0,0,0-1,.77l-.93,3.72a1,1,0,0,1-.53.65l-3.3,1.66a1,1,0,0,1-1-.08l-3-2.13a1,1,0,0,0-1.31.12l-3.65,3.74a1,1,0,0,0-.13,1.26l1.87,2.88a1,1,0,0,1,.1.89L16.34,27a1,1,0,0,1-.68.63l-3.85,1.06a1,1,0,0,0-.74,1v4.74a1,1,0,0,0,.8,1l3.9.8a1,1,0,0,1,.72.57l1.42,3.15a1,1,0,0,1-.05.92l-2.13,3.63a1,1,0,0,0,.17,1.24L19.32,49a1,1,0,0,0,1.29.09L23.49,47a1,1,0,0,1,1-.1l3.74,1.67a1,1,0,0,1,.59.75l.66,3.79a1,1,0,0,0,1,.84h4.89a1,1,0,0,0,1-.86l.58-4a1,1,0,0,1,.58-.77l3.58-1.62a1,1,0,0,1,1,.09l3.14,2.12a1,1,0,0,0,1.3-.15L50,45.06a1,1,0,0,0,.09-1.27l-2.08-3a1,1,0,0,1-.09-1l1.48-3.43a1,1,0,0,1,.71-.59L53.77,35a1,1,0,0,0,.8-1V29.42a1,1,0,0,0-.8-1l-3.72-.78a1,1,0,0,1-.73-.62l-1.45-3.65a1,1,0,0,1,.11-.94l2.15-3.14A1,1,0,0,0,50,18l-3.71-3.25A1,1,0,0,0,45,14.67Z"/>
                  </svg>
                  <span data-i18n="profile.settings">Configuración</span>
                </a>
                <button class="xserv-user-menu-item danger" id="xservLogoutBtnMobile" type="button">
                  <svg viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                  </svg>
                  <span data-i18n="profile.logout">Cerrar Sesión</span>
                </button>
              </div>
            </div>
          </div>
        </nav>

        <!-- Sidebar Overlay -->
        <div class="xserv-sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Right Actions -->
        <div class="xserv-user-actions">
          ${notificationsButton}
          <!-- Language Button (Desktop Only) -->
          <button class="xserv-lang-button" id="langToggle" aria-label="Cambiar idioma">
            <svg class="lang-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            <span class="lang-code">EN</span>
          </button>

          <!-- Login Button -->
          <a class="xserv-auth-button" href="/login" id="xservLoginBtn" data-i18n="auth.login">Iniciar Sesión</a>

          <!-- User Profile Link -->
          <div class="xserv-user-profile-wrapper is-hidden" id="xservUserProfileWrapper">
            <button class="xserv-user-profile" id="xservUserProfile" aria-label="Perfil de usuario">
              <div class="xserv-user-avatar" id="xservUserAvatar">US</div>
              <span class="xserv-user-name" id="xservUserName">Usuario</span>
              <svg class="xserv-dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div class="xserv-dropdown-menu">
              <a href="/profile" class="xserv-dropdown-item">
                <svg viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
                <span data-i18n="profile.myProfile">Mi Perfil</span>
              </a>
              <a href="/settings" class="xserv-dropdown-item">
                <svg viewBox="7 0 54 54" stroke-width="3.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M45,14.67l-2.76,2a1,1,0,0,1-1,.11L37.65,15.3a1,1,0,0,1-.61-.76l-.66-3.77a1,1,0,0,0-1-.84H30.52a1,1,0,0,0-1,.77l-.93,3.72a1,1,0,0,1-.53.65l-3.3,1.66a1,1,0,0,1-1-.08l-3-2.13a1,1,0,0,0-1.31.12l-3.65,3.74a1,1,0,0,0-.13,1.26l1.87,2.88a1,1,0,0,1,.1.89L16.34,27a1,1,0,0,1-.68.63l-3.85,1.06a1,1,0,0,0-.74,1v4.74a1,1,0,0,0,.8,1l3.9.8a1,1,0,0,1,.72.57l1.42,3.15a1,1,0,0,1-.05.92l-2.13,3.63a1,1,0,0,0,.17,1.24L19.32,49a1,1,0,0,0,1.29.09L23.49,47a1,1,0,0,1,1-.1l3.74,1.67a1,1,0,0,1,.59.75l.66,3.79a1,1,0,0,0,1,.84h4.89a1,1,0,0,0,1-.86l.58-4a1,1,0,0,1,.58-.77l3.58-1.62a1,1,0,0,1,1,.09l3.14,2.12a1,1,0,0,0,1.3-.15L50,45.06a1,1,0,0,0,.09-1.27l-2.08-3a1,1,0,0,1-.09-1l1.48-3.43a1,1,0,0,1,.71-.59L53.77,35a1,1,0,0,0,.8-1V29.42a1,1,0,0,0-.8-1l-3.72-.78a1,1,0,0,1-.73-.62l-1.45-3.65a1,1,0,0,1,.11-.94l2.15-3.14A1,1,0,0,0,50,18l-3.71-3.25A1,1,0,0,0,45,14.67Z"/>
                </svg>
                <span data-i18n="profile.settings">Configuración</span>
              </a>
              <button class="xserv-dropdown-item danger" id="xservLogoutBtn" type="button">
                <svg viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor">
                  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                  <polyline points="16 17 21 12 16 7"/>
                  <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                <span data-i18n="profile.logout">Cerrar Sesión</span>
              </button>
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

      /* Prevent content from being hidden under fixed header */
      body {
        padding-top: 80px;
      }

      .xserv-header {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 1.5rem;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 100;
        min-height: 70px;
        box-sizing: border-box;
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
        left: 1.5rem;
        flex-shrink: 0;
      }

      .xserv-logo-text {
        font-size: 0.85rem;
        letter-spacing: 1px;
        margin-left: 0.3rem;
        display: inline;
      }

      .xserv-logo-x {
        color: var(--gold);
        font-size: 1.8rem;
        font-weight: 700;
      }

      .xserv-nav-menu {
        display: flex;
        align-items: center;
        gap: 1.8rem;
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
        padding: 0.5rem 0;
      }

      .xserv-nav-item:hover,
      .xserv-nav-item.active {
        color: var(--gold);
      }

      /* Hamburger Button */
      .xserv-hamburger-menu {
        display: none;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0.4rem;
        color: var(--text-white);
        transition: all 0.3s;
        position: relative;
      }

      .xserv-hamburger-menu:hover {
        color: var(--gold);
      }

      .xserv-hamburger-menu svg {
        width: 24px;
        height: 24px;
        transition: opacity 0.3s ease, transform 0.3s ease;
      }

      /* Sidebar Overlay */
      .xserv-sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease;
      }

      .xserv-sidebar-overlay.active {
        display: block;
        opacity: 1;
      }

      /* Sidebar Navigation */
      .xserv-nav-menu-mobile {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        height: 100vh;
        background: var(--dark-bg);
        border-right: 1px solid rgba(201, 169, 98, 0.15);
        z-index: 1001;
        overflow-y: auto;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
      }

      .xserv-nav-menu-mobile.open {
        transform: translateX(0);
        box-shadow: 2px 0 15px rgba(0, 0, 0, 0.6);
      }

      /* Sidebar Header */
      .xserv-sidebar-header {
        padding: 1.2rem 1.5rem;
        background: rgba(13, 13, 13, 0.5);
        border-bottom: 1px solid rgba(201, 169, 98, 0.15);
        margin-bottom: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: sticky;
        top: 0;
        z-index: 10;
      }

      .xserv-sidebar-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--gold);
        text-transform: uppercase;
        letter-spacing: 1px;
        flex: 1;
      }

      .xserv-sidebar-close {
        background: transparent;
        border: none;
        color: var(--text-white);
        cursor: pointer;
        padding: 0.4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border-radius: 6px;
        flex-shrink: 0;
      }

      .xserv-sidebar-close:hover {
        color: var(--gold);
        background: rgba(201, 169, 98, 0.1);
      }

      .xserv-sidebar-close svg {
        width: 22px;
        height: 22px;
      }

      /* Sidebar Navigation Section */
      .xserv-sidebar-nav {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem 0;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
      }

      .xserv-nav-item-mobile {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.3rem 1.5rem;
        color: var(--text-gray);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
        position: relative;
        margin: 0 0.5rem;
        border-radius: 10px;
      }

      .xserv-nav-icon {
        width: 22px;
        height: 22px;
        stroke-width: 2;
        flex-shrink: 0;
        transition: stroke 0.2s ease;
        opacity: 0.8;
      }

      .xserv-nav-item-mobile:hover {
        background: rgba(201, 169, 98, 0.08);
        color: var(--text-white);
        border-left-color: rgba(201, 169, 98, 0.6);
      }

      .xserv-nav-item-mobile:hover .xserv-nav-icon {
        stroke: var(--gold);
        opacity: 1;
      }

      .xserv-nav-item-mobile.active {
        background: rgba(201, 169, 98, 0.15);
        color: var(--gold);
        border-left-color: var(--gold);
      }

      .xserv-nav-item-mobile.active .xserv-nav-icon {
        stroke: var(--gold);
        opacity: 1;
      }

      /* Sidebar Footer Section */
      .xserv-sidebar-footer {
        padding: 1.5rem;
        border-top: 1px solid rgba(201, 169, 98, 0.15);
        margin-top: auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        background: rgba(13, 13, 13, 0.5);
      }

      /* User Profile Mobile */
      .xserv-user-profile-mobile {
        display: flex;
        flex-direction: column;
        gap: 1rem;
      }

      .xserv-user-info-mobile {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: rgba(201, 169, 98, 0.08);
        border-radius: 10px;
        border: 1px solid rgba(201, 169, 98, 0.25);
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        cursor: pointer;
      }

      .xserv-user-info-mobile:hover {
        background: rgba(201, 169, 98, 0.15);
        border-color: rgba(201, 169, 98, 0.5);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 169, 98, 0.2);
      }

      .xserv-user-avatar-mobile {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark-bg);
        font-family: 'Inter', sans-serif;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(201, 169, 98, 0.3);
      }

      .xserv-user-name-mobile {
        color: var(--text-white);
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
      }

      .xserv-user-menu-mobile {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
      }

      .xserv-user-menu-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 0.75rem;
        color: var(--text-gray);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        background: rgba(255, 255, 255, 0.02);
        cursor: pointer;
        font-family: inherit;
        width: 100%;
        text-align: left;
        position: relative;
        box-sizing: border-box;
      }

      .xserv-user-menu-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: var(--gold);
        border-radius: 0 4px 4px 0;
        transform: scaleY(0);
        transform-origin: center;
        transition: transform 0.3s ease;
      }

      .xserv-user-menu-item:hover {
        background: rgba(201, 169, 98, 0.12);
        color: var(--text-white);
        border-color: rgba(201, 169, 98, 0.3);
        transform: translateY(-2px);
      }

      .xserv-user-menu-item:hover::before {
        transform: scaleY(1);
      }

      .xserv-user-menu-item svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        flex-shrink: 0;
        transition: stroke 0.3s ease;
      }

      .xserv-user-menu-item:hover svg {
        stroke: var(--gold);
      }

      .xserv-user-menu-item.danger {
        color: #f87171;
        border-color: rgba(248, 113, 113, 0.15);
      }

      .xserv-user-menu-item.danger:hover {
        background: rgba(239, 68, 68, 0.12);
        color: #fca5a5;
        border-color: rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
      }

      .xserv-user-menu-item.danger:hover svg {
        stroke: #fca5a5;
      }

      .xserv-user-menu-item.danger::before {
        background: #f87171;
      }

      .xserv-user-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        position: absolute;
        right: 1.5rem;
        flex-shrink: 0;
      }

      .xserv-notification-button {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: 1px solid rgba(201, 169, 98, 0.35);
        background: rgba(201, 169, 98, 0.12);
        color: var(--text-white);
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
      }

      .xserv-notification-button:hover {
        border-color: var(--gold);
        color: var(--gold);
        background: rgba(201, 169, 98, 0.2);
        transform: translateY(-2px);
      }

      .xserv-notification-button svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
      }

      .xserv-notification-count {
        position: absolute;
        top: -6px;
        right: -6px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        border-radius: 999px;
        background: #ef4444;
        color: #ffffff;
        font-size: 0.7rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.35);
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

      .xserv-lang-button-mobile {
        display: none;
        width: 100%;
        padding: 1rem 1.25rem;
        gap: 0.75rem;
        justify-content: center;
        align-items: center;
        border: 1px solid rgba(201, 169, 98, 0.3);
        background: rgba(201, 169, 98, 0.08);
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-white);
        transition: all 0.3s ease;
        cursor: pointer;
      }

      .xserv-lang-button-mobile:hover {
        background: rgba(201, 169, 98, 0.15);
        border-color: rgba(201, 169, 98, 0.5);
        color: var(--gold);
        transform: translateY(-2px);
      }

      .xserv-lang-button-mobile .lang-icon {
        width: 20px;
        height: 20px;
        stroke: currentColor;
      }

      .xserv-lang-button-mobile .lang-code {
        color: var(--gold);
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
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

      /* Hide login button mobile by default (desktop view) */
      .xserv-auth-button-mobile {
        display: none;
      }

      .xserv-user-profile {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        cursor: pointer;
        padding: 0.5rem 0.9rem;
        background: linear-gradient(135deg, rgba(201, 169, 98, 0.12), rgba(201, 169, 98, 0.08));
        border: 1px solid rgba(201, 169, 98, 0.35);
        border-radius: 25px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        color: inherit;
        font-family: 'Inter', sans-serif;
        font-size: inherit;
        overflow: hidden;
      }

      .xserv-user-profile::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(201, 169, 98, 0.2), rgba(201, 169, 98, 0.1));
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
      }

      .xserv-user-profile:hover {
        background: linear-gradient(135deg, rgba(201, 169, 98, 0.18), rgba(201, 169, 98, 0.12));
        border-color: rgba(201, 169, 98, 0.5);
        box-shadow: 0 4px 16px rgba(201, 169, 98, 0.15);
        transform: translateY(-2px);
      }

      .xserv-user-profile:hover::before {
        opacity: 1;
      }

      .xserv-user-profile:active {
        transform: translateY(0);
      }

      .xserv-user-profile-wrapper {
        position: relative;
        display: flex;
        align-items: center;
      }

      .xserv-user-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--dark-bg);
        font-family: 'Inter', sans-serif;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(201, 169, 98, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
      }

      .xserv-user-name {
        color: var(--text-white);
        font-size: 0.9rem;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
      }

      .xserv-dropdown-icon {
        width: 16px;
        height: 16px;
        stroke: rgba(201, 169, 98, 0.6);
        fill: none;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), stroke 0.3s ease;
      }

      .xserv-user-profile-wrapper.open .xserv-dropdown-icon {
        transform: rotate(180deg);
        stroke: var(--gold);
      }

      .xserv-user-profile:hover .xserv-dropdown-icon {
        stroke: var(--gold);
      }

      .xserv-dropdown-menu {
        position: absolute;
        top: calc(100% + 0.75rem);
        right: 0;
        background: linear-gradient(135deg, rgba(26, 26, 26, 0.98), rgba(42, 42, 42, 0.95));
        border: 1px solid rgba(201, 169, 98, 0.4);
        border-radius: 12px;
        min-width: 220px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6), 0 0 20px rgba(201, 169, 98, 0.1);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-12px);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
        backdrop-filter: blur(10px);
      }

      .xserv-user-profile-wrapper.open .xserv-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
      }

      .xserv-dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 0.95rem 1.25rem;
        color: var(--text-gray);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(201, 169, 98, 0.08);
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        position: relative;
        background: transparent;
        width: 100%;
        text-align: left;
        border: none;
      }

      .xserv-dropdown-item:last-child {
        border-bottom: none;
      }

      .xserv-dropdown-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: var(--gold);
        transform: scaleY(0);
        transform-origin: center;
        transition: transform 0.2s ease;
      }

      .xserv-dropdown-item:hover {
        background: rgba(201, 169, 98, 0.12);
        color: var(--gold);
        padding-left: 1.4rem;
      }

      .xserv-dropdown-item:hover::before {
        transform: scaleY(1);
      }

      .xserv-dropdown-item svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        flex-shrink: 0;
        transition: stroke 0.2s ease;
      }

      .xserv-dropdown-item:hover svg {
        stroke: var(--gold);
      }

      .xserv-dropdown-item.danger {
        color: #f87171;
      }

      .xserv-dropdown-item.danger:hover {
        background: rgba(239, 68, 68, 0.12);
        color: #fca5a5;
        padding-left: 1.4rem;
      }

      .xserv-dropdown-item.danger:hover svg {
        stroke: #fca5a5;
      }

      .xserv-dropdown-item.danger::before {
        background: #f87171;
      }

      .is-hidden {
        display: none !important;
      }

      /* Tablet */
      @media (max-width: 1024px) {
        .xserv-nav-menu {
          gap: 1.2rem;
        }

        .xserv-logo {
          width: 36px;
          height: 36px;
          font-size: 0.75rem;
        }

        .xserv-logo-text {
          font-size: 0.75rem;
          letter-spacing: 1px;
          display: none;
        }
      }

      /* Mobile: 768px - 1115px */
      @media (max-width: 1115px) {
        .xserv-header {
          padding: 1.2rem 1.5rem;
          min-height: 75px;
        }

        .xserv-header.driver-variant {
          padding: 1.3rem 1.5rem;
          min-height: 80px;
        }

        .xserv-hamburger-menu {
          display: block;
          position: absolute;
          left: 1.5rem;
          z-index: 102;
          width: 32px;
          height: 28px;
        }

        .xserv-header.driver-variant .xserv-hamburger-menu {
          left: 1.5rem;
        }

        .xserv-logo {
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          width: 42px;
          height: 42px;
          font-size: 1.4rem;
        }

        .xserv-header.driver-variant .xserv-logo {
          width: 48px;
          height: 48px;
          font-size: 1.5rem;
        }

        .xserv-logo-x {
          font-size: 1.68rem;
        }

        .xserv-header.driver-variant .xserv-logo-x {
          font-size: 1.8rem;
        }

        .xserv-logo-text {
          display: none;
        }

        .xserv-nav-menu {
          display: none;
        }

        .xserv-nav-menu-mobile {
          display: flex;
          flex-direction: column;
          gap: 0;
        }

        .xserv-nav-menu-mobile.driver-variant {
          gap: 0;
          padding-top: 0.5rem;
        }

        .xserv-lang-button:not(.xserv-lang-button-mobile) {
          display: none;
        }

        .xserv-lang-button-mobile {
          display: flex;
          width: 100%;
          padding: 1.25rem 1.25rem;
          gap: 0.75rem;
          justify-content: center;
          align-items: center;
          border: 1px solid rgba(201, 169, 98, 0.3);
          background: rgba(201, 169, 98, 0.08);
          border-radius: 10px;
          font-size: 0.95rem;
          font-weight: 600;
          color: var(--text-white);
          transition: all 0.3s ease;
          cursor: pointer;
        }

        .xserv-lang-button-mobile:hover {
          background: rgba(201, 169, 98, 0.15);
          border-color: rgba(201, 169, 98, 0.5);
          color: var(--gold);
          transform: translateY(-2px);
        }

        .xserv-lang-button-mobile .lang-icon {
          width: 20px;
          height: 20px;
          stroke: currentColor;
        }

        .xserv-lang-button-mobile .lang-code {
          color: var(--gold);
          font-family: 'Inter', sans-serif;
          font-size: 0.9rem;
        }

        .xserv-auth-button-mobile {
          display: flex;
          width: 100%;
          padding: 1.25rem 1.25rem;
          background: linear-gradient(135deg, var(--gold), var(--gold-dark));
          color: var(--dark-bg);
          font-weight: 700;
          font-size: 0.95rem;
          border: none;
          border-radius: 10px;
          transition: all 0.3s ease;
          cursor: pointer;
          box-shadow: 0 4px 12px rgba(201, 169, 98, 0.25);
          align-items: center;
          justify-content: center;
        }

        .xserv-auth-button-mobile:hover {
          background: linear-gradient(135deg, var(--gold-light), var(--gold));
          transform: translateY(-2px);
          box-shadow: 0 6px 16px rgba(201, 169, 98, 0.35);
        }

        /* Hide desktop login button in mobile */
        #xservLoginBtn {
          display: none !important;
        }

        /* Hide desktop user profile in mobile */
        .xserv-user-profile-wrapper {
          display: none !important;
        }

        .xserv-user-actions {
          position: absolute;
          right: 1.5rem;
          gap: 0.75rem;
        }

        .xserv-header.driver-variant .xserv-user-actions {
          right: 1.5rem;
        }

        .xserv-user-name {
          display: none;
        }

        .xserv-auth-button:not(.xserv-auth-button-mobile) {
          padding: 0.5rem 0.8rem;
          min-width: auto;
          font-size: 0.75rem;
          height: 36px;
          width: 36px;
          border-radius: 8px;
        }

        .xserv-user-avatar {
          width: 36px;
          height: 36px;
          font-size: 0.7rem;
          border-radius: 8px;
        }

        .xserv-notification-button {
          width: 42px;
          height: 42px;
        }

        .xserv-header.driver-variant .xserv-notification-button {
          width: 44px;
          height: 44px;
        }

        .xserv-notification-button svg {
          width: 20px;
          height: 20px;
        }

        .xserv-header.driver-variant .xserv-notification-button svg {
          width: 22px;
          height: 22px;
        }
      }

      /* Small Mobile: < 768px */
      @media (max-width: 768px) {
        .xserv-header {
          padding: 1rem 1.2rem;
          min-height: 70px;
        }

        .xserv-header.driver-variant {
          padding: 1.1rem 1.2rem;
          min-height: 75px;
        }

        .xserv-hamburger-menu {
          left: 1.2rem;
          width: 30px;
          height: 26px;
        }

        .xserv-header.driver-variant .xserv-hamburger-menu {
          left: 1.2rem;
        }

        .xserv-logo {
          width: 38px;
          height: 38px;
          font-size: 1.2rem;
          left: 50%;
          transform: translateX(-50%);
        }

        .xserv-header.driver-variant .xserv-logo {
          width: 42px;
          height: 42px;
          font-size: 1.35rem;
        }

        .xserv-logo-x {
          font-size: 1.44rem;
        }

        .xserv-header.driver-variant .xserv-logo-x {
          font-size: 1.62rem;
        }

        .xserv-logo-text {
          font-size: 0.6rem;
          display: none;
        }

        .xserv-lang-button-mobile {
          display: flex;
          width: 100%;
          padding: 1.25rem 1.25rem;
          gap: 0.75rem;
          justify-content: center;
          align-items: center;
          border: 1px solid rgba(201, 169, 98, 0.3);
          background: rgba(201, 169, 98, 0.08);
          border-radius: 10px;
          font-size: 0.9rem;
          font-weight: 600;
          color: var(--text-white);
          transition: all 0.3s ease;
          cursor: pointer;
        }

        .xserv-lang-button-mobile:hover {
          background: rgba(201, 169, 98, 0.15);
          border-color: rgba(201, 169, 98, 0.5);
          color: var(--gold);
          transform: translateY(-2px);
        }

        .xserv-lang-button-mobile .lang-icon {
          width: 20px;
          height: 20px;
          stroke: currentColor;
        }

        .xserv-lang-button-mobile .lang-code {
          color: var(--gold);
          font-family: 'Inter', sans-serif;
          font-size: 0.9rem;
        }

        .xserv-auth-button-mobile {
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 1.25rem 1.25rem;
          font-size: 0.9rem;
          width: 100%;
          border-radius: 10px;
          background: linear-gradient(135deg, var(--gold), var(--gold-dark));
          color: var(--dark-bg);
          font-weight: 700;
          border: none;
          transition: all 0.3s ease;
          cursor: pointer;
          box-shadow: 0 4px 12px rgba(201, 169, 98, 0.25);
        }

        .xserv-auth-button-mobile:hover {
          background: linear-gradient(135deg, var(--gold-light), var(--gold));
          transform: translateY(-2px);
          box-shadow: 0 6px 16px rgba(201, 169, 98, 0.35);
        }

        .xserv-user-menu-item {
          display: flex;
          padding: 0.85rem 0.75rem;
          font-size: 0.875rem;
          gap: 0.75rem;
          align-items: center;
          color: var(--text-gray);
          text-decoration: none;
          font-weight: 500;
          transition: all 0.3s ease;
          border-radius: 10px;
          border: 1px solid rgba(255, 255, 255, 0.05);
          background: rgba(255, 255, 255, 0.02);
          cursor: pointer;
          font-family: inherit;
          width: 100%;
          text-align: left;
          position: relative;
          box-sizing: border-box;
        }

        .xserv-user-menu-item::before {
          content: '';
          position: absolute;
          left: 0;
          top: 0;
          bottom: 0;
          width: 3px;
          background: var(--gold);
          border-radius: 0 4px 4px 0;
          transform: scaleY(0);
          transform-origin: center;
          transition: transform 0.3s ease;
        }

        .xserv-user-menu-item:hover {
          background: rgba(201, 169, 98, 0.12);
          color: var(--text-white);
          border-color: rgba(201, 169, 98, 0.3);
          transform: translateY(-2px);
        }

        .xserv-user-menu-item:hover::before {
          transform: scaleY(1);
        }

        .xserv-user-menu-item svg {
          width: 18px;
          height: 18px;
          stroke: currentColor;
          flex-shrink: 0;
          transition: stroke 0.3s ease;
        }

        .xserv-user-menu-item:hover svg {
          stroke: var(--gold);
        }

        .xserv-user-menu-item.danger {
          color: #f87171;
          border-color: rgba(248, 113, 113, 0.15);
        }

        .xserv-user-menu-item.danger:hover {
          background: rgba(239, 68, 68, 0.12);
          color: #fca5a5;
          border-color: rgba(239, 68, 68, 0.4);
          transform: translateY(-2px);
        }

        .xserv-user-menu-item.danger:hover svg {
          stroke: #fca5a5;
        }

        .xserv-user-menu-item.danger::before {
          background: #f87171;
        }

        .xserv-user-actions {
          right: 1.2rem;
          gap: 0.6rem;
        }

        .xserv-header.driver-variant .xserv-user-actions {
          right: 1.2rem;
        }

        .xserv-auth-button:not(.xserv-auth-button-mobile) {
          width: 32px;
          height: 32px;
          padding: 0.4rem;
          font-size: 0.65rem;
        }

        .xserv-user-avatar {
          width: 32px;
          height: 32px;
          font-size: 0.6rem;
        }

        .xserv-notification-button {
          width: 38px;
          height: 38px;
        }

        .xserv-header.driver-variant .xserv-notification-button {
          width: 40px;
          height: 40px;
        }

        .xserv-notification-button svg {
          width: 18px;
          height: 18px;
        }

        .xserv-header.driver-variant .xserv-notification-button svg {
          width: 20px;
          height: 20px;
        }
      }
          width: 32px;
          height: 32px;
        }

        .xserv-notification-button svg {
          width: 16px;
          height: 16px;
        }
      }

      /* Desktop: Hide mobile user profile */
      @media (min-width: 1116px) {
        .xserv-user-profile-mobile {
          display: none !important;
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
    const headerConfig = getHeaderConfig();
    const activePage = getActivePage(headerConfig);

    // Crear HTML del header
    const headerHTML = createHeaderHTML(activePage, headerConfig);

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
      const headerConfig = getHeaderConfig();
      const isDriver = headerConfig.variant === 'driver';
      
      // Los choferes no necesitan esperar i18n (todo está en español)
      if (isDriver) {
        console.log('✅ Header cargado (chofer - sin i18n)');
        const event = new CustomEvent('headerLoaded', { 
          detail: { timestamp: Date.now() } 
        });
        document.dispatchEvent(event);
        return;
      }
      
      if (window.i18n) {
        // Traducir el contenido del header
        window.i18n.translatePage();
        // Re-adjuntar event listeners del header (importante hacerlo después del DOM)
        window.i18n.attachLanguageButtons();
        // Actualizar estado visual de los botones
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
    
    // Iniciar inmediatamente si i18n ya está listo, sino esperar
    if (window.i18n) {
      initializeI18n();
    } else {
      setTimeout(initializeI18n, 100);
    }

    console.log('✅ Header reutilizable cargado correctamente');
  }

  // Inicializar cuando el DOM esté listo
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadHeader);
  } else {
    loadHeader();
  }

})();
