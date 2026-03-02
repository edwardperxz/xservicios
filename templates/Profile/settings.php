<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $usuario
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrfToken" content="<?= $this->request->getAttribute('csrfToken') ?>">
  <title>Configuración - Xservicios</title>
  
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
      --text-light-gray: #707070;
      --border-color: rgba(201, 169, 98, 0.2);
      --success-color: #10b981;
      --error-color: #ef4444;
      --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.3);
      --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.4);
    }

    body {
      background-color: var(--dark-bg);
      color: var(--text-white);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      line-height: 1.6;
      background-attachment: fixed;
      background-image: 
        radial-gradient(circle at 20% 50%, rgba(201, 169, 98, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(201, 169, 98, 0.05) 0%, transparent 50%);
    }

    /* Container */
    .settings-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 1.5rem 2rem 2rem;
      width: 100%;
      animation: fadeInUp 0.8s ease-out;
      padding-top: 6rem;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Header */
    .settings-header {
      background: linear-gradient(135deg, rgba(201, 169, 98, 0.15) 0%, rgba(201, 169, 98, 0.05) 100%);
      border: 1px solid var(--border-color);
      border-radius: 20px;
      padding: 1.5rem 2rem;
      margin-bottom: 1.5rem;
      box-shadow: var(--shadow-lg);
    }

    .settings-header h1 {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 0.3rem;
      background: linear-gradient(135deg, #d4b978, #c9a962);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .settings-header p {
      color: var(--text-gray);
      font-size: 0.9rem;
    }

    /* Settings Card */
    .settings-card {
      background: linear-gradient(135deg, rgba(26, 26, 26, 0.8) 0%, rgba(26, 26, 26, 0.5) 100%);
      border: 1px solid var(--border-color);
      border-radius: 16px;
      padding: 2rem;
      box-shadow: var(--shadow-md);
    }

    /* Settings Section */
    .settings-section {
      margin-bottom: 2rem;
    }

    .settings-section:not(:first-child) {
      padding-top: 1.5rem;
      border-top: 1px solid var(--border-color);
    }

    .settings-section h2 {
      display: flex;
      align-items: center;
      gap: 1rem;
      font-size: 1.15rem;
      font-weight: 600;
      margin-bottom: 1.2rem;
      color: var(--text-white);
    }

    .settings-section svg {
      width: 28px;
      height: 28px;
      color: var(--gold);
      stroke-width: 2;
    }

    /* Setting Item */
    .setting-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.2rem;
      margin-bottom: 0.8rem;
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid var(--border-color);
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .setting-item:hover {
      background: rgba(255, 255, 255, 0.05);
      border-color: rgba(201, 169, 98, 0.4);
    }

    .setting-item-info h3 {
      font-size: 0.95rem;
      font-weight: 600;
      margin-bottom: 0.2rem;
      color: var(--text-white);
    }

    .setting-item-info p {
      font-size: 0.85rem;
      color: var(--text-light-gray);
    }

    /* Toggle Switch */
    .toggle-switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .toggle-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .toggle-slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: var(--dark-lighter);
      transition: 0.3s;
      border-radius: 34px;
      border: 2px solid var(--border-color);
    }

    .toggle-slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 2px;
      bottom: 2px;
      background-color: var(--text-white);
      transition: 0.3s;
      border-radius: 50%;
    }

    input:checked + .toggle-slider {
      background-color: var(--gold);
      border-color: var(--gold);
    }

    input:checked + .toggle-slider:before {
      transform: translateX(26px);
    }

    /* Form Actions */
    .settings-actions {
      display: flex;
      gap: 1rem;
      justify-content: center;
      padding-top: 1.5rem;
      border-top: 1px solid var(--border-color);
      margin-top: 2rem;
      flex-wrap: wrap;
    }

    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.6rem;
      padding: 0.8rem 2rem;
      border: none;
      border-radius: 12px;
      font-size: 0.9rem;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
      white-space: nowrap;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      min-width: 140px;
    }

    .btn svg {
      width: 20px;
      height: 20px;
      stroke-width: 2;
    }

    .btn-primary {
      background: linear-gradient(135deg, #d4b978 0%, #c9a962 100%);
      color: #0d0d0d;
      box-shadow: 0 8px 24px rgba(201, 169, 98, 0.3);
      border: 2px solid #c9a962;
    }

    .btn-primary:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 36px rgba(201, 169, 98, 0.4);
    }

    .btn-primary:active {
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: transparent;
      color: var(--gold);
      border: 2px solid var(--gold);
    }

    .btn-secondary:hover {
      background: rgba(201, 169, 98, 0.1);
      box-shadow: 0 8px 24px rgba(201, 169, 98, 0.2);
      transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .settings-container {
        padding: 1.5rem 1rem 2rem;
        padding-top: 6rem;
      }

      .settings-header {
        padding: 1.5rem 1rem;
        margin-bottom: 1.5rem;
      }

      .settings-header h1 {
        font-size: 1.5rem;
      }

      .settings-card {
        padding: 1.5rem;
      }

      .setting-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }

      .settings-actions {
        flex-direction: column;
        gap: 1rem;
      }

      .btn {
        width: 100%;
        min-width: unset;
      }
    }

    @media (max-width: 480px) {
      .settings-container {
        padding: 1.2rem 0.8rem 1.5rem;
        padding-top: 6rem;
      }

      .settings-header {
        padding: 1.2rem 0.8rem;
      }

      .settings-header h1 {
        font-size: 1.3rem;
      }

      .settings-card {
        padding: 1.2rem;
      }

      .setting-item {
        padding: 1rem;
      }

      .setting-item-info h3 {
        font-size: 0.9rem;
      }

      .btn {
        padding: 0.7rem 1.5rem;
        font-size: 0.85rem;
      }
    }
  </style>
</head>
<body>

<div class="settings-container">
    <!-- Header -->
    <div class="settings-header">
        <h1>Configuración</h1>
        <p>Personaliza tus preferencias y notificaciones</p>
    </div>

    <!-- Settings Form -->
    <div class="settings-card">
        <?= $this->Form->create($usuario, ['method' => 'post']) ?>

        <!-- Notificaciones Section -->
        <div class="settings-section">
            <h2>
                <svg fill="none" viewBox="0 0 24 24">
                    <path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                Notificaciones
            </h2>

            <div class="setting-item">
                <div class="setting-item-info">
                    <h3>Notificaciones Activadas</h3>
                    <p>Recibe notificaciones de solicitudes de viaje y actualizaciones</p>
                </div>
                <label class="toggle-switch">
                    <?= $this->Form->hidden('notificaciones_activadas', ['value' => 0]) ?>
                    <?= $this->Form->checkbox('notificaciones_activadas', [
                        'value' => 1,
                        'checked' => (bool)$usuario->notificaciones_activadas ?? false
                    ]) ?>
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <div class="setting-item">
                <div class="setting-item-info">
                    <h3>Recibir Ofertas</h3>
                    <p>Recibe ofertas especiales y promociones</p>
                </div>
                <label class="toggle-switch">
                    <?= $this->Form->hidden('recibir_ofertas', ['value' => 0]) ?>
                    <?= $this->Form->checkbox('recibir_ofertas', [
                        'value' => 1,
                        'checked' => (bool)$usuario->recibir_ofertas ?? false
                    ]) ?>
                    <span class="toggle-slider"></span>
                </label>
            </div>
        </div>

        <!-- Ubicación Section -->
        <div class="settings-section">
            <h2>
                <svg fill="none" viewBox="0 0 24 24">
                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Ubicación
            </h2>

            <div class="setting-item">
                <div class="setting-item-info">
                    <h3>Compartir Ubicación</h3>
                    <p>Permite que los clientes vean tu ubicación en tiempo real durante los viajes</p>
                </div>
                <label class="toggle-switch">
                    <?= $this->Form->hidden('compartir_ubicacion', ['value' => 0]) ?>
                    <?= $this->Form->checkbox('compartir_ubicacion', [
                        'value' => 1,
                        'checked' => (bool)$usuario->compartir_ubicacion ?? false
                    ]) ?>
                    <span class="toggle-slider"></span>
                </label>
            </div>
        </div>

        <!-- Disponibilidad Section -->
        <div class="settings-section">
            <h2>
                <svg fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 6v6l4 2"/>
                </svg>
                Disponibilidad
            </h2>

            <div class="setting-item">
                <div class="setting-item-info">
                    <h3>Modo Disponible</h3>
                    <p>Activa o desactiva tu disponibilidad para recibir solicitudes de viaje</p>
                </div>
                <label class="toggle-switch">
                    <?= $this->Form->hidden('modo_disponible', ['value' => 0]) ?>
                    <?= $this->Form->checkbox('modo_disponible', [
                        'value' => 1,
                        'checked' => (bool)$usuario->modo_disponible ?? false
                    ]) ?>
                    <span class="toggle-slider"></span>
                </label>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="settings-actions">
            <?= $this->Form->button(
                'Guardar Cambios',
                [
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'escape' => false
                ]
            ) ?>
            <?= $this->Html->link(
                'Cancelar',
                ['action' => 'index'],
                [
                    'class' => 'btn btn-secondary',
                    'escape' => false
                ]
            ) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>

<script>
  window.xservHeaderConfig = {
    variant: 'driver',
    activePage: 'settings'
  };
</script>
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>

</body>
</html>
