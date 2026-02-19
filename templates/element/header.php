  <header class="header">
    <div class="logo">
      <span class="logo-x">X</span>SERVICIOS
    </div>

    <nav class="nav-menu">
      <a href="/home" class="nav-item active">Inicio</a>
      <a href="/fleet" class="nav-item">Ver flota</a>
      <a href="/services" class="nav-item">Servicios</a>
      <a href="/about" class="nav-item">Nosotros</a>
    </nav>

    <div class="header-right">
      <div class="lang-selector">
        <span class="active">ES</span>
        <span>|</span>
        <span>EN</span>
      </div>
      <div class="user-menu">
        <div class="user-menu-trigger" onclick="toggleUserMenu(event)">
          <div class="user-avatar"><?= substr($user->nombre ?? $user->username, 0, 2) ?></div>
          <span class="user-name"><?= h($user->nombre ?? $user->username) ?></span>
        </div>
        <div class="dropdown-menu" id="userDropdown">
          <a href="#" class="dropdown-item">
            <svg class="dropdown-item-icon" viewBox="0 0 24 24">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            Mi Perfil
          </a>
          <a href="/myreservations" class="dropdown-item">
            <svg class="dropdown-item-icon" viewBox="0 0 24 24">
              <path d="M6 9l6 6 6-6"></path>
              <path d="M6 3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path>
            </svg>
            Mis Reservas
          </a>
          <a href="/rateservice" class="dropdown-item">
            <svg class="dropdown-item-icon" viewBox="0 0 24 24">
              <polygon points="12 2 15.09 10.26 24 10.26 17.82 16.74 20.91 25 12 19.54 3.09 25 6.18 16.74 0 10.26 8.91 10.26 12 2"></polygon>
            </svg>
            Valorar Servicio
          </a>
          <div class="dropdown-divider"></div>
          <button onclick="logout()" class="dropdown-item danger">
            <svg class="dropdown-item-icon" viewBox="0 0 24 24">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            Cerrar Sesión
          </button>
        </div>
      </div>
    </div>
  </header>