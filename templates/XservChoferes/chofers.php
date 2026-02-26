<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservChofere> $xservChoferes
 */
?>

<?php foreach ($xservChoferes as $chofer): ?>

<div class="ficha-card">
  <div class="ficha-inner">

    <!-- Header -->
    <div class="ficha-header">
      <div>
        <div class="ficha-logo">
          <span class="ficha-logo-text">
            <span class="ficha-logo-x">X</span>
            <span class="ficha-logo-servicios">SERVICIOS</span>
          </span>
        </div>
        <div class="ficha-subtitle">Credencial de Conductor</div>
      </div>

      <?php
        $categoria = strtolower($chofer->categoria ?? '');
        $badgeClass = 'badge-profesional';

        if (str_contains($categoria, 'senior')) {
            $badgeClass = 'badge-senior';
        } elseif (str_contains($categoria, 'junior')) {
            $badgeClass = 'badge-junior';
        }
      ?>
      <div class="ficha-badge <?= $badgeClass ?>">
        <?= h($chofer->categoria) ?>
      </div>
    </div>

    <!-- Contenido -->
    <div class="ficha-content">
      
      <!-- Imagen -->
      <div class="ficha-image-container">
        <img 
          class="ficha-image"
          src="<?= h($chofer->usuario->foto_url ?? '/img/default-user.png') ?>" 
          alt="<?= h($chofer->nombre) ?>"
        >
      </div>

      <!-- Detalles -->
      <div class="ficha-details">

        <div class="ficha-name">
          <?= h($chofer->nombre) ?>
        </div>

        <div class="ficha-row">
          <span class="ficha-label">Edad:</span>
          <span class="ficha-value"><?= h($chofer->edad) ?> años</span>
        </div>

        <div class="ficha-row">
          <span class="ficha-label">Experiencia:</span>
          <span class="ficha-value highlight"><?= h($chofer->experiencia) ?> años</span>
        </div>

        <div class="ficha-row">
          <span class="ficha-label">Licencia:</span>
          <span class="ficha-value"><?= h($chofer->tipo_licencia) ?></span>
        </div>

        <div class="ficha-row">
          <span class="ficha-label">Unidad:</span>
          <span class="ficha-value"><?= h($chofer->unidad_asig) ?></span>
        </div>

        <!-- Stats -->
        <div class="ficha-stats">
          <div class="stat-item">
            <div class="stat-value"><?= number_format($chofer->viajes) ?></div>
            <div class="stat-label">Viajes</div>
          </div>

          <div class="stat-item">
            <div class="stat-value"><?= h($chofer->incidentes) ?></div>
            <div class="stat-label">Incidentes</div>
          </div>

          <div class="stat-item">
            <div class="stat-value"><?= h($chofer->puntualidad) ?>%</div>
            <div class="stat-label">Puntualidad</div>
          </div>
        </div>

        <!-- Rating -->
        <div class="rating-section">
          <span class="rating-label">Calificación:</span>
          <div class="rating-stars">
            <?php
              $rating = (float) $chofer->calificacion;
              for ($i = 1; $i <= 5; $i++):
            ?>
              <svg class="star <?= $i <= $rating ? 'star-filled' : 'star-empty' ?>" viewBox="0 0 24 24">
                <path d="M12 .587l3.668 7.568L24 9.423l-6 5.857 1.416 8.263L12 18.897l-7.416 4.646L6 15.28 0 9.423l8.332-1.268z"/>
              </svg>
            <?php endfor; ?>
          </div>
          <span class="rating-number"><?= number_format($rating, 1) ?></span>
        </div>

      </div>
    </div>

    <!-- Footer -->
    <div class="ficha-footer">

      <div class="ficha-status">
        <div class="status-indicator status-active"></div>
        <span class="status-text"><?= h($chofer->estado ?? 'Activo') ?></span>
      </div>

      <div class="ficha-id">
        ID: CHF-<?= str_pad($chofer->id, 4, '0', STR_PAD_LEFT) ?>
      </div>

    </div>

  </div>
</div>

<?php endforeach; ?>