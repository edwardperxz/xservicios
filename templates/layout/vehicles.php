<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Xservicios - Flota Vehicular</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <?= $this->Html->css('grid_bus') ?>
  <?= $this->Html->css('style') ?>
  <?= $this->Html->css('ficha_bus') ?>
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
      --chocolate: #3d2314;
      --chocolate-light: #5a3a2a;
      --dark-bg: #0a0a0a;
      --dark-deep: #050505;
      --text-white: #ffffff;
      --text-gray: #a0a0a0;
      --pearl: #f8f6f2;
      --pearl-dark: #efe9e0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-deep);
      color: var(--text-white);
      min-height: 100vh;
      padding: 2rem;
    }

    .page-title {
      text-align: center;
      margin-bottom: 3rem;
    }

    .page-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2.5rem;
      color: var(--gold);
      margin-bottom: 0.5rem;
    }

    .page-title p {
      color: var(--text-gray);
      font-size: 1rem;
    }

    .fichas-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
      gap: 2rem;
      max-width: 1400px;
      margin: 0 auto;
    }

    /* Ficha Card */
    .ficha-card {
      background: linear-gradient(145deg, var(--pearl), var(--pearl-dark));
      border-radius: 16px;
      padding: 4px;
      background: linear-gradient(135deg, var(--gold), var(--chocolate), var(--gold-dark), var(--chocolate-light), var(--gold));
      box-shadow: 
        0 10px 40px rgba(201, 169, 98, 0.2),
        0 0 20px rgba(201, 169, 98, 0.1);
    }

    .ficha-inner {
      background: linear-gradient(145deg, var(--pearl), var(--pearl-dark));
      border-radius: 13px;
      padding: 1.5rem;
      position: relative;
      overflow: hidden;
    }

    .ficha-inner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--gold), var(--chocolate), var(--gold));
    }

    /* Header de la ficha */
    .ficha-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 1.25rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid var(--gold);
    }

    .ficha-logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .ficha-logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      font-weight: 700;
    }

    .ficha-logo-x {
      color: var(--gold);
    }

    .ficha-logo-servicios {
      color: var(--chocolate);
    }

    .ficha-subtitle {
      font-size: 0.7rem;
      color: var(--chocolate-light);
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-top: 2px;
    }

    .ficha-badge {
      padding: 0.35rem 0.75rem;
      border-radius: 20px;
      font-size: 0.7rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .badge-senior {
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      color: var(--chocolate);
    }

    .badge-experimentado {
      background: linear-gradient(135deg, #2d7a5f, #1e5a43);
      color: white;
    }

    .badge-profesional {
      background: linear-gradient(135deg, #4a6fa5, #345a8a);
      color: white;
    }

    .badge-junior {
      background: linear-gradient(135deg, #7a5f2d, #5a4320);
      color: white;
    }

    /* Contenido de la ficha */
    .ficha-content {
      display: flex;
      gap: 1.25rem;
    }

    .ficha-image-container {
      flex-shrink: 0;
    }

    .ficha-image {
      width: 300px;
      height: 200px;
      border-radius: 10px;
      object-fit: cover;
      border: 3px solid var(--gold);
      box-shadow: 0 4px 15px rgba(61, 35, 20, 0.2);
    }

    .ficha-details {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 0.6rem;
    }

    .ficha-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem;
      font-weight: 700;
      color: var(--chocolate);
      line-height: 1.2;
      margin-bottom: 0.25rem;
    }

    .ficha-row {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .ficha-label {
      font-size: 0.75rem;
      color: var(--chocolate-light);
      font-weight: 500;
      min-width: 85px;
    }

    .ficha-value {
      font-size: 0.85rem;
      color: var(--chocolate);
      font-weight: 600;
    }

    .ficha-value.highlight {
      color: var(--gold-dark);
      font-weight: 700;
    }

    /* Sección de estadísticas */
    .ficha-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 0.75rem;
      margin-top: 0.75rem;
      padding-top: 0.75rem;
      border-top: 1px dashed var(--gold);
    }

    .stat-item {
      text-align: center;
      padding: 0.5rem;
      background: rgba(201, 169, 98, 0.1);
      border-radius: 8px;
    }

    .stat-value {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--gold-dark);
    }

    .stat-label {
      font-size: 0.65rem;
      color: var(--chocolate-light);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* Footer de la ficha */
    .ficha-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1.25rem;
      padding-top: 1rem;
      border-top: 2px solid var(--gold);
    }

    .ficha-status {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .status-indicator {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      animation: pulse 2s infinite;
    }

    .status-active {
      background: #2d7a5f;
      box-shadow: 0 0 8px rgba(45, 122, 95, 0.5);
    }

    .status-vacation {
      background: #f5a623;
      box-shadow: 0 0 8px rgba(245, 166, 35, 0.5);
    }

    .status-inactive {
      background: #c0392b;
      box-shadow: 0 0 8px rgba(192, 57, 43, 0.5);
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }

    .status-text {
      font-size: 0.75rem;
      color: var(--chocolate-light);
      font-weight: 500;
    }

    .ficha-id {
      font-family: 'Courier New', monospace;
      font-size: 0.7rem;
      color: var(--chocolate-light);
      background: rgba(201, 169, 98, 0.15);
      padding: 0.35rem 0.75rem;
      border-radius: 4px;
    }

    /* Rating Section */
    .rating-section {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-top: 0.5rem;
      padding: 0.75rem;
      background: linear-gradient(135deg, rgba(201, 169, 98, 0.15), rgba(61, 35, 20, 0.08));
      border-radius: 10px;
      border: 1px solid rgba(201, 169, 98, 0.3);
    }

    .rating-label {
      font-size: 0.8rem;
      color: var(--chocolate);
      font-weight: 600;
    }

    .rating-stars {
      display: flex;
      gap: 3px;
    }

    .star {
      width: 18px;
      height: 18px;
    }

    .star-filled {
      fill: var(--gold);
      filter: drop-shadow(0 1px 2px rgba(201, 169, 98, 0.4));
    }

    .star-half {
      fill: url(#half-gradient);
      filter: drop-shadow(0 1px 2px rgba(201, 169, 98, 0.4));
    }

    .star-empty {
      fill: #d4d4d4;
    }

    .rating-number {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--gold-dark);
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Responsive */
    @media (max-width: 500px) {
      .fichas-container {
        grid-template-columns: 1fr;
      }

      .ficha-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .ficha-details {
        align-items: center;
      }

      .ficha-row {
        justify-content: center;
      }

      .ficha-label {
        min-width: auto;
      }

      .rating-section {
        flex-direction: column;
        gap: 0.5rem;
      }
    }
  </style>
</head>
<body>
  <!-- SVG Definitions for half star -->
  <svg width="0" height="0" style="position: absolute;">
    <defs>
      <linearGradient id="half-gradient">
        <stop offset="50%" stopColor="#c9a962"/>
        <stop offset="50%" stopColor="#d4d4d4"/>
      </linearGradient>
    </defs>
  </svg>
  
  
  <div class="page-title">
    <h1>Fichas de Choferes</h1>
    <p>Credenciales oficiales del equipo de conductores de Xservicios</p>
  </div>

  <div class="fichas-container">
    <?= $this->fetch('content') ?>
  </div>


</body>
</html>