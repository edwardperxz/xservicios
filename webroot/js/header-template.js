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
      <a href="/home" class="${navItemClass(isHome)}">Inicio</a>
      <a href="/fleet" class="${navItemClass(isFleet)}">Ver flota</a>
      <a href="/services" class="${navItemClass(isServices)}">Servicios</a>
      <a href="/about" class="${navItemClass(isAbout)}">Nosotros</a>
    </nav>
    <div class="header-right">
      <div class="lang-selector">
        <span class="active">ES</span>
        <span>|</span>
        <span>EN</span>
      </div>
      <a class="auth-button" href="/login">Iniciar Sesión</a>
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
