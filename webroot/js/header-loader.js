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
        <!-- Hamburger Menu Button -->
        <button class="xserv-hamburger-menu" id="menuToggle" aria-label="Menú">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>

        <!-- Logo -->
        <a href="/home" class="xserv-logo">
          <span class="xserv-logo-x">X</span>SERVICIOS
        </a>

        <!-- Desktop Navigation -->
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
            <a href="/home" class="xserv-nav-item-mobile ${isActive('home')}">
              <svg class="xserv-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
              </svg>
              <span data-i18n="nav.home">Inicio</span>
            </a>
            <a href="/fleet" class="xserv-nav-item-mobile ${isActive('fleet')}">
              <svg class="xserv-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="8" width="18" height="10" rx="2"/>
                <circle cx="7" cy="21" r="1.5"/>
                <circle cx="17" cy="21" r="1.5"/>
                <path d="M3 8V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2"/>
                <line x1="7" y1="18" x2="7" y2="21"/>
                <line x1="17" y1="18" x2="17" y2="21"/>
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
                <a href="/myreservations" class="xserv-user-menu-item">
                  <svg viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
                  <span data-i18n="profile.myReservations">Mis Reservas</span>
                </a>
                <a href="/settings" class="xserv-user-menu-item">
                  <svg viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M12 1v6m0 6v6M5.6 5.6l4.2 4.2m4.2 4.2l4.2 4.2M1 12h6m6 0h6M5.6 18.4l4.2-4.2m4.2-4.2l4.2-4.2"/>
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
          <a href="/profile" class="xserv-user-profile is-hidden" id="xservUserProfile">
            <div class="xserv-user-avatar" id="xservUserAvatar">US</div>
            <span class="xserv-user-name" id="xservUserName">Usuario</span>
          </a>
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
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
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

      /* Hamburger Button */
      .xserv-hamburger-menu {
        display: none;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
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
        width: 300px;
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
        padding: 0.75rem 0;
      }

      .xserv-nav-item-mobile {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.9rem 1.5rem;
        color: var(--text-gray);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
        position: relative;
      }

      .xserv-nav-icon {
        width: 20px;
        height: 20px;
        stroke-width: 2;
        flex-shrink: 0;
        transition: stroke 0.2s ease;
        opacity: 0.8;
      }

      .xserv-nav-item-mobile:hover {
        background: rgba(201, 169, 98, 0.08);
        color: var(--text-white);
        border-left-color: rgba(201, 169, 98, 0.4);
        padding-left: 1.7rem;
      }

      .xserv-nav-item-mobile:hover .xserv-nav-icon {
        stroke: var(--gold);
        opacity: 1;
      }

      .xserv-nav-item-mobile.active {
        background: rgba(201, 169, 98, 0.12);
        color: var(--gold);
        border-left-color: var(--gold);
        padding-left: 1.7rem;
      }

      .xserv-nav-item-mobile.active .xserv-nav-icon {
        stroke: var(--gold);
        opacity: 1;
      }

      /* Sidebar Footer Section */
      .xserv-sidebar-footer {
        padding: 1.25rem 1.5rem;
        border-top: 1px solid rgba(201, 169, 98, 0.15);
        margin-top: auto;
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
        background: rgba(13, 13, 13, 0.3);
      }

      /* User Profile Mobile */
      .xserv-user-profile-mobile {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
      }

      .xserv-user-info-mobile {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        background: rgba(201, 169, 98, 0.08);
        border-radius: 8px;
        border: 1px solid rgba(201, 169, 98, 0.2);
        text-decoration: none;
        color: inherit;
        transition: all 0.2s ease;
        cursor: pointer;
      }

      .xserv-user-info-mobile:hover {
        background: rgba(201, 169, 98, 0.15);
        border-color: rgba(201, 169, 98, 0.4);
      }

      .xserv-user-avatar-mobile {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--dark-bg);
        font-family: 'Inter', sans-serif;
        flex-shrink: 0;
      }

      .xserv-user-name-mobile {
        color: var(--text-white);
        font-size: 0.95rem;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
      }

      .xserv-user-menu-mobile {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
      }

      .xserv-user-menu-item {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 0.75rem 1rem;
        color: var(--text-gray);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border-radius: 6px;
        border: 1px solid transparent;
        background: transparent;
        cursor: pointer;
        font-family: inherit;
        width: 100%;
        text-align: left;
      }

      .xserv-user-menu-item:hover {
        background: rgba(201, 169, 98, 0.1);
        color: var(--text-white);
        border-color: rgba(201, 169, 98, 0.3);
      }

      .xserv-user-menu-item svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        flex-shrink: 0;
      }

      .xserv-user-menu-item.danger {
        color: #ef4444;
      }

      .xserv-user-menu-item.danger:hover {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border-color: rgba(239, 68, 68, 0.3);
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

      .xserv-lang-button-mobile {
        display: none;
        width: 100%;
        padding: 0.8rem 1.25rem;
        gap: 0.75rem;
        justify-content: center;
        align-items: center;
        border: 1px solid rgba(201, 169, 98, 0.3);
        background: rgba(201, 169, 98, 0.05);
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-white);
        transition: all 0.3s ease;
        cursor: pointer;
      }

      .xserv-lang-button-mobile:hover {
        background: rgba(201, 169, 98, 0.12);
        border-color: rgba(201, 169, 98, 0.5);
        color: var(--gold);
      }

      .xserv-lang-button-mobile .lang-icon {
        width: 18px;
        height: 18px;
        stroke: currentColor;
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
        gap: 0.5rem;
        cursor: pointer;
        padding: 0.4rem 0.75rem;
        background: rgba(201, 169, 98, 0.1);
        border-radius: 25px;
        transition: background 0.3s;
        position: relative;
        text-decoration: none;
        color: inherit;
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

      /* Tablet */
      @media (max-width: 1024px) {
        .xserv-nav-menu {
          gap: 1.5rem;
        }
      }

      /* Mobile */
      @media (max-width: 768px) {
        .xserv-header {
          padding: 1rem 1.5rem;
        }

        .xserv-hamburger-menu {
          display: block;
          position: absolute;
          left: 1.5rem;
          z-index: 102;
        }

        .xserv-logo {
          position: static;
          left: auto;
          margin: 0 auto;
        }

        .xserv-nav-menu {
          display: none;
        }

        .xserv-nav-menu-mobile {
          display: flex;
          flex-direction: column;
          gap: 0;
        }

        .xserv-lang-button:not(.xserv-lang-button-mobile) {
          display: none;
        }

        .xserv-lang-button-mobile {
          display: flex;
        }

        .xserv-auth-button-mobile {
          display: flex;
          width: 100%;
          padding: 0.85rem 1.5rem;
          background: linear-gradient(135deg, var(--gold), var(--gold-dark));
          color: var(--dark-bg);
          font-weight: 600;
          font-size: 0.95rem;
          min-width: auto;
          border: none;
          border-radius: 8px;
          transition: all 0.3s ease;
        }

        .xserv-auth-button-mobile:hover {
          background: linear-gradient(135deg, var(--gold-light), var(--gold));
          transform: translateY(-2px);
        }

        /* Hide desktop login button in mobile */
        #xservLoginBtn {
          display: none !important;
        }

        /* Hide desktop user profile in mobile */
        .xserv-user-profile {
          display: none !important;
        }

        .xserv-user-actions {
          position: static;
          gap: 1rem;
        }

        .xserv-user-name {
          display: none;
        }

        .xserv-auth-button {
          padding: 0.5rem 1rem;
          min-width: auto;
          font-size: 0.8rem;
        }

        .xserv-user-avatar {
          width: 24px;
          height: 24px;
          font-size: 0.6rem;
        }
      }

      /* Desktop: Hide mobile user profile */
      @media (min-width: 769px) {
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
