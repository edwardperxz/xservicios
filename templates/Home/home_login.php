<?php
/** @var \App\View\AppView $this */
/** @var \App\Model\Entity\XservUsuario|null $user */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Xservicios - Transporte Turístico de Lujo en Chiriquí</title>
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
      --dark-bg: #0d0d0d;
      --dark-card: #1a1a1a;
      --dark-lighter: #2a2a2a;
      --text-white: #ffffff;
      --text-gray: #a0a0a0;
      --green: #4ade80;
      --orange: #f59e0b;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-bg);
      color: var(--text-white);
      min-height: 100vh;
    }

    /* Header */
    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 2.5rem;
      background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.25rem;
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      font-size: 1.5rem;
      letter-spacing: 2px;
      color: var(--text-white);
    }

    .logo-x {
      color: var(--gold);
      font-size: 1.8rem;
      font-weight: 700;
    }

    .nav-menu {
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-gray);
      text-decoration: none;
      font-size: 0.875rem;
      transition: color 0.3s;
    }

    .nav-item:hover,
    .nav-item.active {
      color: var(--gold);
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }

    .lang-selector {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-gray);
      font-size: 0.875rem;
    }

    .lang-selector span.active {
      color: var(--text-white);
    }

    .header-icon {
      width: 20px;
      height: 20px;
      stroke: var(--gold);
      fill: none;
      cursor: pointer;
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      cursor: pointer;
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.875rem;
      font-weight: 600;
    }

    .user-name {
      font-size: 0.875rem;
      color: var(--text-white);
    }

    /* User Menu Dropdown */
    .user-menu {
      position: relative;
    }

    .user-menu-trigger {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      cursor: pointer;
      padding: 0.5rem;
      border-radius: 8px;
      transition: background 0.3s;
    }

    .user-menu-trigger:hover {
      background: rgba(201, 169, 98, 0.1);
    }

    .user-menu-trigger.active {
      background: rgba(201, 169, 98, 0.15);
    }

    .dropdown-menu {
      position: absolute;
      top: 100%;
      right: 0;
      background: var(--dark-card);
      border: 1px solid var(--dark-lighter);
      border-radius: 8px;
      min-width: 200px;
      margin-top: 0.5rem;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s ease;
      z-index: 1000;
    }

    .dropdown-menu.active {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .dropdown-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.875rem 1.25rem;
      color: var(--text-gray);
      text-decoration: none;
      font-size: 0.9rem;
      transition: all 0.3s;
      border: none;
      background: none;
      cursor: pointer;
      width: 100%;
      text-align: left;
    }

    .dropdown-item:first-child {
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

    .dropdown-item:last-child {
      border-bottom-left-radius: 8px;
      border-bottom-right-radius: 8px;
    }

    .dropdown-item:hover {
      background: rgba(201, 169, 98, 0.15);
      color: var(--gold);
    }

    .dropdown-item-icon {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    .dropdown-divider {
      height: 1px;
      background: var(--dark-lighter);
      margin: 0.5rem 0;
    }

    .dropdown-item.danger {
      color: #ef4444;
    }

    .dropdown-item.danger:hover {
      background: rgba(239, 68, 68, 0.15);
      color: #ef4444;
    }

    /* Hero Section */
    .hero {
      position: relative;
      height: 480px;
      background-image: url('/img/login-bg.jpeg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      align-items: center;
      padding: 0 3rem;
    }

    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.2) 100%);
    }

    .hero-content {
      position: relative;
      z-index: 10;
      max-width: 500px;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 3.25rem;
      font-weight: 400;
      line-height: 1.15;
      margin-bottom: 1.25rem;
      font-style: italic;
    }

    .hero-description {
      font-size: 1rem;
      color: var(--text-gray);
      line-height: 1.6;
      margin-bottom: 2rem;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 1rem 2.5rem;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      color: var(--dark-bg);
      font-weight: 600;
      font-size: 1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, var(--gold-light), var(--gold));
      transform: translateY(-2px);
    }

    /* Tabs Section */
    .tabs-section {
      padding: 2rem 3rem;
    }

    .tabs-nav {
      display: flex;
      align-items: center;
      gap: 3rem;
      margin-bottom: 1.5rem;
      border-bottom: 1px solid var(--dark-lighter);
      padding-bottom: 1rem;
    }

    .tab-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 1rem;
      color: var(--text-gray);
      cursor: pointer;
      transition: color 0.3s;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid transparent;
      margin-bottom: -1rem;
    }

    .tab-item.active {
      color: var(--text-white);
      border-bottom-color: var(--gold);
    }

    .tab-item:hover {
      color: var(--gold);
    }

    /* Content Card */
    .content-card {
      background: var(--dark-card);
      border-radius: 12px;
      padding: 1.5rem;
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .date-display {
      display: flex;
      align-items: baseline;
      gap: 0.5rem;
    }

    .date-day {
      font-size: 2rem;
      font-weight: 600;
      color: var(--gold);
    }

    .date-month {
      font-size: 1.125rem;
      color: var(--text-white);
    }

    .btn-history {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.75rem 1.25rem;
      background: var(--dark-lighter);
      color: var(--text-white);
      border: 1px solid var(--dark-lighter);
      border-radius: 8px;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-history:hover {
      border-color: var(--gold);
      background: rgba(201, 169, 98, 0.1);
    }

    .empty-message {
      color: var(--text-gray);
      text-align: center;
      padding: 2rem;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <?= $this->element('header_auth') ?>


  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title">Transporte turístico de lujo en Chiriquí</h1>
      <p class="hero-description">Reserva un traslado seguro, puntual y de alta calidad con Xservicios.</p>
      <a href="/newreservation" class="btn-primary">Nueva Reserva</a>
    </div>
  </section>

  <!-- Tabs Section -->
  <section class="tabs-section">
    <nav class="tabs-nav">
      <div class="tab-item active">
        <span>Resumen Rápido</span>
      </div>
      <div class="tab-item">
        <span>Nueva Reserva</span>
      </div>
      <div class="tab-item">
        <span>Mis Reservas</span>
      </div>
      <div class="tab-item">
        <span>Valorar Servicio</span>
      </div>
    </nav>

    <!-- Content Card -->
    <div class="content-card">
    <!-- RESUMEN -->
    <div class="tab-content active" id="tab-resumen">
      <div class="card-header">
        <div class="date-display">
          <span class="date-day"><?= date('d') ?></span>
          <span class="date-month"><?= strftime('%B %Y', time()) ?></span>
        </div>
        <button class="btn-history">
          Historial de Servicios
        </button>
      </div>

      <p class="empty-message">No hay reservas recientes.</p>
    </div>

    <!-- MIS RESERVAS -->
    <div class="tab-content" id="tab-reservas">

    <h3 style="margin-bottom:1.5rem;">Mis Reservas</h3>

    <?php if (!empty($misReservas) && count($misReservas) > 0): ?>

    <table class="reservas-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Pasajeros</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($misReservas as $reserva): ?>
            <tr>
                <td><strong><?= h($reserva->codigo_reserva) ?></strong></td>
                <td><?= h($reserva->servicio->nombre ?? 'N/A') ?></td>
                <td><?= h($reserva->fecha->format('d/m/Y')) ?></td>
                <td><?= h($reserva->hora->format('H:i')) ?></td>
                <td><?= h($reserva->pasajeros) ?></td>
                <td>
                    <span class="badge <?= h(str_replace('_','-',$reserva->estado)) ?>">
                        <?= h(ucfirst(str_replace('_',' ',$reserva->estado))) ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php else: ?>

    <div class="empty-state">
        <p>No tienes reservas registradas.</p>
    </div>

    <?php endif; ?>

    </div>


  </div>

  </section>

  <script>
    // Toggle user menu dropdown
    function toggleUserMenu(event) {
      event.stopPropagation();
      const dropdown = document.getElementById('userDropdown');
      const trigger = event.currentTarget;
      
      dropdown.classList.toggle('active');
      trigger.classList.toggle('active');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById('userDropdown');
      const userMenu = document.querySelector('.user-menu');
      
      if (!userMenu.contains(event.target)) {
        dropdown.classList.remove('active');
        document.querySelector('.user-menu-trigger').classList.remove('active');
      }
    });

    // Close dropdown when clicking on an item
    document.querySelectorAll('.dropdown-item').forEach(item => {
      item.addEventListener('click', function(event) {
        if (this.onclick) {
          // Button logout
          return;
        }
        // Close dropdown for links
        document.getElementById('userDropdown').classList.remove('active');
        document.querySelector('.user-menu-trigger').classList.remove('active');
      });
    });
  </script>

  <script>
  const tabs = document.querySelectorAll('.tab-item');
  const contents = {
    0: 'tab-resumen',
    2: 'tab-reservas'
  };

  tabs.forEach((tab, index) => {
    tab.addEventListener('click', () => {

      // quitar active de todos
      tabs.forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.tab-content')
              .forEach(c => c.classList.remove('active'));

      // activar el clickeado
      tab.classList.add('active');

      if (contents[index]) {
        document.getElementById(contents[index])
                .classList.add('active');
      }
    });
  });
</script>

</body>
</html>
