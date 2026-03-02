<?php
/**
 * @var \App\View\AppView $this
 * @var string $message
 * @var string $url
 */
use Cake\Core\Configure;

// Leer configuración
$debugMode = Configure::read('debug');

// Mostrar página personalizada SIEMPRE, excepto cuando debug esté explícitamente en true
// Esto ignora la configuración customErrorPages y solo depende de debug
$showCakePHPError = $debugMode === true;

// DEBUG: Descomentar la siguiente línea para ver qué valor tiene debug
// echo "<!-- DEBUG MODE: " . var_export($debugMode, true) . " | SHOW CAKEPHP: " . var_export($showCakePHPError, true) . " -->";

if ($showCakePHPError) :
    // Mostrar error detallado de CakePHP (solo en desarrollo)
    $this->setLayout('dev_error');
    $this->assign('title', $message);
    $this->assign('templateName', 'error400.php');
    $this->start('file');
    echo $this->element('auto_table_warning');
    $this->end();
?>
<h2><?= h($message) ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
</p>
<?php
else :
    // Pantalla de error 404 personalizada
    $this->setLayout(false);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Página No Encontrada | Xservicios</title>
  
  <!-- Pre-load language from localStorage to avoid flash -->
  <script src="/js/i18n-preload.js"></script>
  
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
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--dark-bg);
      color: var(--text-white);
      min-height: 100vh;
      padding-top: 80px;
      display: flex;
      flex-direction: column;
    }

    .error-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .error-content {
      max-width: 600px;
      text-align: center;
    }

    .error-code {
      font-family: 'Playfair Display', serif;
      font-size: 8rem;
      font-weight: 700;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      line-height: 1;
      margin-bottom: 1rem;
    }

    .error-title {
      font-family: 'Playfair Display', serif;
      font-size: 2.5rem;
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--text-white);
    }

    .error-message {
      font-size: 1.125rem;
      color: var(--text-gray);
      line-height: 1.6;
      margin-bottom: 2rem;
    }

    .error-url {
      display: inline-block;
      padding: 1rem 1.5rem;
      background: var(--dark-card);
      border: 1px solid var(--dark-lighter);
      border-radius: 8px;
      margin-bottom: 2rem;
      font-family: monospace;
      font-size: 0.9rem;
      color: var(--gold);
      word-break: break-all;
    }

    .error-actions {
      display: flex;
      gap: 1rem;
      justify-content: center;
      flex-wrap: wrap;
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

    .btn-secondary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 1rem 2rem;
      border: 1px solid var(--gold);
      color: var(--gold);
      font-weight: 600;
      font-size: 1rem;
      background: transparent;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s;
      text-decoration: none;
    }

    .btn-secondary:hover {
      background: rgba(201, 169, 98, 0.15);
      transform: translateY(-2px);
    }

    .error-icon {
      width: 120px;
      height: 120px;
      margin: 0 auto 2rem;
      opacity: 0.5;
    }

    @media (max-width: 768px) {
      .error-code {
        font-size: 5rem;
      }

      .error-title {
        font-size: 2rem;
      }

      .error-message {
        font-size: 1rem;
      }

      .error-actions {
        flex-direction: column;
      }

      .btn-primary,
      .btn-secondary {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <div class="error-container">
    <div class="error-content">
      <!-- Error Icon -->
      <svg class="error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <circle cx="12" cy="12" r="10" stroke="var(--gold)" />
        <path d="M12 8v4M12 16h.01" stroke="var(--gold)" stroke-linecap="round" />
      </svg>

      <!-- Error Code -->
      <div class="error-code">404</div>

      <!-- Error Title -->
      <h1 class="error-title" data-i18n="error.404.title">Página No Encontrada</h1>

      <!-- Error Message -->
      <p class="error-message" data-i18n="error.404.message">
        Lo sentimos, la página que buscas no existe o ha sido movida.
      </p>

      <!-- URL Display -->
      <?php if (!empty($url)): ?>
      <div class="error-url">
        <?= h($url) ?>
      </div>
      <?php endif; ?>

      <!-- Action Buttons -->
      <div class="error-actions">
        <a href="/" class="btn-primary" data-i18n="error.404.goHome">Volver al Inicio</a>
        <button onclick="history.back()" class="btn-secondary" data-i18n="error.404.goBack">Regresar</button>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="/js/i18n.js"></script>
  <script src="/js/header-loader.js"></script>
  <script src="/js/header-dynamic.js"></script>
</body>
</html>
<?php endif; ?>
