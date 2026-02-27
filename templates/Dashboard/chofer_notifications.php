<?php
$this->assign('title', 'Xservicios - Notificaciones');
$this->Html->css('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap', ['block' => true]);
?>
<?php $this->start('css'); ?>
<style>
  :root {
    --gold: #c9a962;
    --gold-light: #d4b978;
    --gold-dark: #a88b4a;
    --dark-bg: #0b0b0b;
    --dark-card: #161616;
    --dark-card-strong: #1c1c1c;
    --dark-lighter: #262626;
    --text-white: #ffffff;
    --text-gray: #9da3ae;
    --green: #4ade80;
    --red: #f87171;
    --blue: #38bdf8;
  }

  body {
    font-family: 'Inter', sans-serif;
    background: radial-gradient(circle at top, rgba(201, 169, 98, 0.14), transparent 45%),
      linear-gradient(180deg, rgba(11, 11, 11, 0.96), rgba(11, 11, 11, 1));
    color: var(--text-white);
    min-height: 100vh;
  }

  .driver-shell {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2.5rem 2.5rem 4rem;
  }

  .driver-hero {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    background: linear-gradient(135deg, rgba(201, 169, 98, 0.14), rgba(201, 169, 98, 0.02));
    border: 1px solid rgba(201, 169, 98, 0.2);
    border-radius: 18px;
    padding: 2.25rem 2.5rem;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
  }

  .driver-overline {
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 0.7rem;
    color: var(--gold-light);
    margin-bottom: 0.5rem;
  }

  .driver-title {
    font-family: 'Inter', sans-serif;
    font-size: 2.4rem;
    font-weight: 600;
    margin-bottom: 0.6rem;
  }

  .driver-subtitle {
    color: var(--text-gray);
    line-height: 1.6;
    font-size: 0.95rem;
  }

  .driver-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    padding: 0.5rem 1rem;
    border-radius: 999px;
    background: rgba(201, 169, 98, 0.16);
    color: var(--gold);
    font-weight: 600;
    font-size: 0.8rem;
  }

  .driver-pill span {
    display: inline-flex;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--gold);
  }

  .empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 4rem 2rem;
    text-align: center;
  }

  .empty-state svg {
    width: 80px;
    height: 80px;
    stroke: var(--text-gray);
    opacity: 0.3;
    margin-bottom: 1.5rem;
  }

  .empty-state h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-white);
    margin-bottom: 0.5rem;
  }

  .empty-state p {
    font-size: 0.9rem;
    color: var(--text-gray);
    max-width: 320px;
  }

  .driver-requests {
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
  }

  .notification-card {
    background: var(--dark-card-strong);
    border-radius: 16px;
    padding: 1.4rem;
    border: 1px solid rgba(255, 255, 255, 0.06);
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 1.2rem;
    align-items: start;
    transition: all 0.3s ease;
  }

  .notification-card:hover {
    border-color: rgba(201, 169, 98, 0.3);
    background: rgba(28, 28, 28, 0.8);
  }

  .notification-icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .notification-icon-wrapper svg {
    width: 24px;
    height: 24px;
    stroke-width: 2;
  }

  .notification-icon-default {
    background: rgba(56, 189, 248, 0.15);
    color: var(--blue);
  }

  .notification-icon-success {
    background: rgba(74, 222, 128, 0.15);
    color: var(--green);
  }

  .notification-icon-info {
    background: rgba(201, 169, 98, 0.15);
    color: var(--gold);
  }

  .notification-icon-warning {
    background: rgba(251, 146, 60, 0.15);
    color: #fb923c;
  }

  .notification-content {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    min-width: 0;
  }

  .notification-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
  }

  .notification-type {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-white);
    text-transform: capitalize;
  }

  .notification-time {
    font-size: 0.8rem;
    color: var(--text-gray);
    flex-shrink: 0;
  }

  .notification-body {
    color: var(--text-gray);
    line-height: 1.6;
    font-size: 0.9rem;
  }

  .notification-footer {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .notification-medium {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.8rem;
    color: var(--gold);
    font-weight: 500;
  }

  .notification-medium svg {
    width: 16px;
    height: 16px;
  }

  /* Responsive adjustments */
  @media (max-width: 1080px) {
    .driver-shell {
      padding: 2rem 2rem 3rem;
    }

    .notification-card {
      grid-template-columns: auto 1fr;
      gap: 1rem;
      padding: 1.2rem;
    }

    .notification-icon-wrapper {
      width: 44px;
      height: 44px;
    }

    .notification-icon-wrapper svg {
      width: 22px;
      height: 22px;
    }
  }

  /* Mobile: 768px - 1024px */
  @media (max-width: 1024px) {
    .driver-hero {
      flex-direction: column;
      align-items: flex-start;
      gap: 1.5rem;
      padding: 1.75rem 2rem;
    }

    .driver-title {
      font-size: 1.8rem;
    }

    .driver-pill {
      align-self: flex-start;
    }

    .driver-requests {
      margin-top: 1.5rem;
    }
  }

  /* Small Mobile: < 768px */
  @media (max-width: 768px) {
    .driver-shell {
      padding: 1.5rem 1.2rem 2.5rem;
    }

    .driver-hero {
      padding: 1.5rem 1.5rem;
      gap: 1rem;
    }

    .driver-title {
      font-size: 1.6rem;
    }

    .driver-subtitle {
      font-size: 0.85rem;
      line-height: 1.5;
    }

    .driver-requests {
      margin-top: 1.2rem;
      gap: 0.9rem;
    }

    .notification-card {
      padding: 1.1rem;
      gap: 0.9rem;
    }

    .notification-icon-wrapper {
      width: 40px;
      height: 40px;
    }

    .notification-icon-wrapper svg {
      width: 20px;
      height: 20px;
    }

    .notification-type {
      font-size: 0.9rem;
    }

    .notification-body {
      font-size: 0.85rem;
    }

    .notification-footer {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.5rem;
    }

    .notification-time,
    .notification-medium {
      font-size: 0.75rem;
    }

    .empty-state svg {
      width: 60px;
      height: 60px;
      margin-bottom: 1rem;
    }

    .empty-state h3 {
      font-size: 1.1rem;
    }

    .empty-state p {
      font-size: 0.85rem;
    }
  }
</style>
<?php $this->end(); ?>

<?php 
  // Inicializar variable si no existe
  if (!isset($notificaciones)) {
    $notificaciones = [];
  }
?>

<section class="driver-shell">
  <div class="driver-requests" id="driverNotifications">
    <?php 
      $notificacionesArray = is_object($notificaciones) ? $notificaciones->toArray() : (array)$notificaciones;
      $hayNotificaciones = count($notificacionesArray) > 0;
    ?>
    <?php if (!$hayNotificaciones): ?>
      <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        <h3>No tienes notificaciones aún</h3>
        <p>Cuando recibas actualizaciones sobre tus viajes aparecerán aquí</p>
      </div>
    <?php else: ?>
      <?php foreach ($notificaciones as $notif): ?>
        <?php
          // Determinar icono y color según tipo de notificación
          $iconClass = 'notification-icon-default';
          $iconSvg = '<path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>';
          
          switch ($notif->tipo_notificacion) {
            case 'confirmacion_reserva':
              $iconClass = 'notification-icon-success';
              $iconSvg = '<path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
              break;
            case 'asignacion_chofer':
              $iconClass = 'notification-icon-info';
              $iconSvg = '<path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>';
              break;
            case 'actualizacion_estado':
            case 'actualización_estado':
              $iconClass = 'notification-icon-warning';
              $iconSvg = '<path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>';
              break;
            case 'recordatorio':
              $iconClass = 'notification-icon-default';
              $iconSvg = '<path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>';
              break;
          }
          
          // Formatear fecha relativa
          $ahora = new DateTime();
          $creacion = new DateTime($notif->created_at->format('Y-m-d H:i:s'));
          $diff = $ahora->diff($creacion);
          
          if ($diff->y > 0) {
            $fechaFormateada = $diff->y . ' año' . ($diff->y > 1 ? 's' : '');
          } elseif ($diff->m > 0) {
            $fechaFormateada = $diff->m . ' mes' . ($diff->m > 1 ? 'es' : '');
          } elseif ($diff->d > 0) {
            $fechaFormateada = $diff->d . ' día' . ($diff->d > 1 ? 's' : '');
          } elseif ($diff->h > 0) {
            $fechaFormateada = $diff->h . ' hora' . ($diff->h > 1 ? 's' : '');
          } elseif ($diff->i > 0) {
            $fechaFormateada = $diff->i . ' minuto' . ($diff->i > 1 ? 's' : '');
          } else {
            $fechaFormateada = 'Ahora';
          }
          
          // Icono de medio
          $medioIcono = '';
          switch ($notif->medio) {
            case 'correo':
              $medioIcono = '<svg viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>';
              break;
            case 'whatsapp':
              $medioIcono = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>';
              break;
            case 'sistema':
              $medioIcono = '<svg viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/></svg>';
              break;
          }
        ?>
        
        <div class="notification-card">
          <div class="notification-icon-wrapper <?= $iconClass ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <?= $iconSvg ?>
            </svg>
          </div>
          
          <div class="notification-content">
            <div class="notification-header">
              <div class="notification-type"><?= h(ucfirst(str_replace('_', ' ', $notif->tipo_notificacion))) ?></div>
              <div class="notification-time"><?= $fechaFormateada ?></div>
            </div>
            
            <div class="notification-body">
              <?= h($notif->contenido) ?>
            </div>
            
            <div class="notification-footer">
              <span class="notification-medium">
                <?= $medioIcono ?>
                <?= h(ucfirst($notif->medio)) ?>
              </span>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<script>
  window.xservHeaderConfig = {
    variant: 'driver',
    activePage: 'notifications',
    notificationCount: 0
  };
</script>
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>
