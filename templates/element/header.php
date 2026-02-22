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
    --dark-bg: #0d0d0d;
    --dark-card: #1a1a1a;
    --dark-lighter: #2a2a2a;
    --text-white: #ffffff;
    --text-gray: #a0a0a0;
    --green: #4ade80;
    --orange: #f59e0b;
  }

  /* Header */
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

  .xserv-header-right {
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

  /* Responsive */
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
  }
</style>

<!-- Header Structure -->
<header class="xserv-header">
  <a href="/home" class="xserv-logo">
    <span class="xserv-logo-x">X</span>SERVICIOS
  </a>
  
  <nav class="xserv-nav-menu">
    <a href="/home" class="xserv-nav-item <?= $activePage === 'home' ? 'active' : '' ?>" data-i18n="nav.home">Inicio</a>
    <a href="/fleet" class="xserv-nav-item <?= $activePage === 'fleet' ? 'active' : '' ?>" data-i18n="nav.fleet">Ver flota</a>
    <a href="/services" class="xserv-nav-item <?= $activePage === 'services' ? 'active' : '' ?>" data-i18n="nav.services">Servicios</a>
    <a href="/about" class="xserv-nav-item <?= $activePage === 'about' ? 'active' : '' ?>" data-i18n="nav.about">Nosotros</a>
  </nav>

  <div class="xserv-header-right">
    <button class="xserv-lang-button" id="langToggle" aria-label="Change language">
      <svg class="lang-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
      </svg>
      <span class="lang-code">EN</span>
    </button>
    <?= $this->Html->link('Iniciar Sesión', '/xserv-usuarios/login', ['class' => 'xserv-auth-button', 'data-i18n' => 'auth.login']) ?>
  </div>
</header>

<!-- Cargar Google Fonts si no están cargados -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="/js/i18n.js"></script>
