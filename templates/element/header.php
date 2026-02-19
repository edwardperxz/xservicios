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
      <?= $this->Html->link('Iniciar Sesión', '/xserv-usuarios/login', ['class' => 'btn-primary']) ?>
    </div>
  </header>