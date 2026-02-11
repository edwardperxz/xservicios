(function () {
  const existingHeader = document.querySelector('header.header');
  const header = existingHeader || document.createElement('header');

  if (!existingHeader) {
    header.className = 'header';
    document.body.insertBefore(header, document.body.firstChild);
  }

  const path = window.location.pathname.toLowerCase();
  const isHome = path === '/' || path.includes('home') || path.includes('index');
  const isFleet = path.includes('flota') || path.includes('fleet');
  const isServices = path.includes('servicios');
  const isAbout = path.includes('nosotros') || path.includes('about');

  const navItemClass = (active) => `nav-item${active ? ' active' : ''}`;

  header.innerHTML = `
    <div class="logo">
      <span class="logo-x">X</span>SERVICIOS
    </div>
    <nav class="nav-menu">
      <a href="/home" class="${navItemClass(isHome)}">
        <svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        Inicio
      </a>
      <a href="/fleet" class="${navItemClass(isFleet)}">
        <svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2">
          <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9L18 10l-1.9-4.6c-.3-.7-1-1.4-1.8-1.4H9.7c-.8 0-1.5.5-1.8 1.2L6 10l-2.5 1.1C2.7 11.3 2 12.1 2 13v3c0 .6.4 1 1 1h2"/>
          <circle cx="7" cy="17" r="2"/>
          <circle cx="17" cy="17" r="2"/>
        </svg>
        Ver flota
      </a>
      <a href="/services" class="${navItemClass(isServices)}">
        <svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2">
          <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
        </svg>
        Servicios
      </a>
      <a href="/about" class="${navItemClass(isAbout)}">
        <svg class="nav-icon" viewBox="0 0 24 24" stroke-width="2">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
          <circle cx="9" cy="7" r="4"/>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        Nosotros
      </a>
    </nav>
    <div class="header-right">
      <div class="lang-selector">
        <span class="active">ES</span>
        <span>|</span>
        <span>EN</span>
      </div>
      <svg class="header-icon" viewBox="0 0 24 24" stroke-width="2">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
      </svg>
      <a class="auth-button" href="/login">Iniciar sesion</a>
      <div class="user-profile is-hidden">
        <div class="user-avatar" id="userAvatar">US</div>
        <span class="user-name" id="userName">Usuario</span>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="6 9 12 15 18 9"/>
        </svg>
      </div>
    </div>
  `;
})();
