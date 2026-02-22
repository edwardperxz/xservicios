<!-- 
  Componente Header Reutilizable - Xservicios
  Uso: <?= $this->element('header', ['page' => 'home']) ?>
  Páginas válidas: 'home', 'fleet', 'services', 'about'
-->

<?php
// Determinar página activa
$activePage = $page ?? 'home';
?>

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
  }

  /* Header Styles */
  .xserv-header {
    display: flex;
    align-items: center;
    padding: 1rem 2.5rem;
    background: linear-gradient(to bottom, rgba(10, 10, 10, 0.98), rgba(5, 5, 5, 0.95));
    border-bottom: 1px solid rgba(201, 169, 98, 0.3);
    position: sticky;
    top: 0;
    z-index: 1000;
    backdrop-filter: blur(10px);
  }

  .xserv-logo {
    display: flex;
    align-items: center;
    gap: 0;
    flex-shrink: 0;
    text-decoration: none;
  }

  .xserv-logo-x {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gold);
    text-shadow: 0 0 10px rgba(201, 169, 98, 0.5);
  }

  .xserv-logo-text {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-white);
    letter-spacing: 0.5px;
  }

  .xserv-nav-menu {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-left: 4rem;
    margin-right: 4rem;
  }

  .xserv-nav-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    color: var(--text-gray);
    text-decoration: none;
    font-size: 0.85rem;
    transition: color 0.3s;
    white-space: nowrap;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  }

  .xserv-nav-item:hover,
  .xserv-nav-item.active {
    color: var(--gold);
  }

  .xserv-nav-icon {
    width: 16px;
    height: 16px;
    stroke: currentColor;
    fill: none;
    flex-shrink: 0;
  }

  .xserv-user-actions {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin-left: auto;
  }

  /* Language Selector */
  .xserv-lang-selector {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    color: var(--text-gray);
    font-size: 0.8rem;
  }

  .xserv-lang-icon {
    width: 16px;
    height: 16px;
    stroke: var(--gold);
    fill: none;
  }

  .xserv-lang-text {
    color: var(--text-gray);
    cursor: pointer;
    transition: all 0.3s;
    font-size: 0.8rem;
    font-weight: 500;
    padding: 0.3rem 0.6rem;
    border-radius: 4px;
    background: transparent;
    font-family: 'Inter', sans-serif;
    border: none;
    outline: none;
  }

  .xserv-lang-text:hover {
    color: var(--gold);
    background: rgba(201, 169, 98, 0.1);
  }

  .xserv-lang-text.active {
    color: var(--gold);
    background: rgba(201, 169, 98, 0.15);
    font-weight: 600;
  }

  .xserv-lang-divider {
    color: var(--dark-lighter);
  }

  /* Notification Icon */
  .xserv-notification-icon {
    cursor: pointer;
    transition: color 0.3s;
    position: relative;
  }

  .xserv-notification-icon svg {
    width: 18px;
    height: 18px;
    stroke: var(--text-gray);
    fill: none;
  }

  .xserv-notification-icon:hover svg {
    stroke: var(--gold);
  }

  /* Auth Button */
  .xserv-auth-button {
    padding: 0.5rem 1.1rem;
    border: 1px solid var(--gold);
    border-radius: 20px;
    color: var(--gold);
    font-size: 0.8rem;
    text-decoration: none;
    transition: all 0.3s;
    white-space: nowrap;
    font-family: 'Inter', sans-serif;
    background: transparent;
    cursor: pointer;
  }

  .xserv-auth-button:hover {
    background: rgba(201, 169, 98, 0.15);
    transform: translateY(-1px);
  }

  /* User Profile Dropdown */
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

  /* Dropdown Menu */
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

  /* Hidden state */
  .is-hidden {
    display: none !important;
  }

  /* Responsive */
  @media (max-width: 1024px) {
    .xserv-nav-menu {
      gap: 1.5rem;
      margin-left: 2rem;
      margin-right: 2rem;
    }
  }

  @media (max-width: 768px) {
    .xserv-header {
      padding: 1rem 1.5rem;
    }

    .xserv-nav-menu {
      margin-left: 1.5rem;
      margin-right: 1.5rem;
      gap: 1rem;
    }

    .xserv-nav-item span {
      display: none;
    }

    .xserv-user-name {
      display: none;
    }
  }
</style>

<!-- Header Structure -->
<header class="xserv-header">
  <a href="/home" class="xserv-logo">
    <span class="xserv-logo-x">X</span><span class="xserv-logo-text">SERVICIOS</span>
  </a>
  
  <nav class="xserv-nav-menu">
    <a href="/home" class="xserv-nav-item <?= $activePage === 'home' ? 'active' : '' ?>">
      <svg class="xserv-nav-icon" viewBox="0 0 24 24" strokeWidth="2">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
      </svg>
      <span data-i18n="nav.home">Inicio</span>
    </a>
    <a href="/fleet" class="xserv-nav-item <?= $activePage === 'fleet' ? 'active' : '' ?>">
      <svg class="xserv-nav-icon" viewBox="0 0 24 24" strokeWidth="2">
        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9L18 10l-1.9-4.6c-.3-.7-1-1.4-1.8-1.4H9.7c-.8 0-1.5.5-1.8 1.2L6 10l-2.5 1.1C2.7 11.3 2 12.1 2 13v3c0 .6.4 1 1 1h2"/>
        <circle cx="7" cy="17" r="2"/>
        <circle cx="17" cy="17" r="2"/>
      </svg>
      <span data-i18n="nav.fleet">Ver flota</span>
    </a>
    <a href="/services" class="xserv-nav-item <?= $activePage === 'services' ? 'active' : '' ?>">
      <svg class="xserv-nav-icon" viewBox="0 0 24 24" strokeWidth="2">
        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
      </svg>
      <span data-i18n="nav.services">Servicios</span>
    </a>
    <a href="/about" class="xserv-nav-item <?= $activePage === 'about' ? 'active' : '' ?>">
      <svg class="xserv-nav-icon" viewBox="0 0 24 24" strokeWidth="2">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
        <circle cx="9" cy="7" r="4"/>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
      </svg>
      <span data-i18n="nav.about">Nosotros</span>
    </a>
  </nav>

  <div class="xserv-user-actions">
    <!-- Language Selector -->
    <div class="xserv-lang-selector">
      <svg class="xserv-lang-icon" viewBox="0 0 24 24" strokeWidth="2">
        <circle cx="12" cy="12" r="10"/>
        <path d="M2 12h20"/>
        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
      </svg>
      <button class="xserv-lang-text active" data-lang="es">ES</button>
      <span class="xserv-lang-divider">|</span>
      <button class="xserv-lang-text" data-lang="en">EN</button>
    </div>

    <!-- Notification Icon -->
    <div class="xserv-notification-icon">
      <svg viewBox="0 0 24 24" strokeWidth="2">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
      </svg>
    </div>

    <!-- Login Button (shown when not authenticated) -->
    <a class="xserv-auth-button" href="/login" id="xservLoginBtn" data-i18n="auth.login">Iniciar sesión</a>

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
        <a href="/my-reservations" class="xserv-dropdown-item">
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

<!-- Cargar Google Fonts si no están cargados -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
