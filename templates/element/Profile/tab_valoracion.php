<?php
/**
 * @var \App\View\AppView $this
 * @var array $reservasFinalizadas Reservas finalizadas del usuario
 */
?>

<style>
  .tab-valoracion {
    background: linear-gradient(135deg, rgba(201, 169, 98, 0.05) 0%, rgba(201, 169, 98, 0.02) 100%);
    border-radius: 16px;
    padding: 2rem;
    border: 1px solid var(--border-color);
  }

  .valoracion-empty {
    text-align: center;
    padding: 3rem 2rem;
    color: var(--text-gray);
  }

  .valoracion-empty svg {
    width: 64px;
    height: 64px;
    margin: 0 auto 1rem;
    opacity: 0.5;
  }

  .reserva-valoracion {
    background: var(--dark-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
  }

  .reserva-valoracion:hover {
    border-color: var(--gold);
    box-shadow: 0 8px 24px rgba(201, 169, 98, 0.15);
  }

  .reserva-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 1.5rem;
    gap: 1rem;
  }

  .reserva-info {
    flex: 1;
  }

  .reserva-codigo {
    font-size: 0.875rem;
    color: var(--gold);
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .reserva-ruta {
    font-size: 1.125rem;
    font-weight: 500;
    color: var(--text-white);
    margin-bottom: 0.5rem;
  }

  .reserva-detalles {
    display: grid;
    grid-template-columns: auto auto;
    gap: 1rem;
    font-size: 0.875rem;
    color: var(--text-gray);
  }

  .detalle-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .detalle-item svg {
    width: 16px;
    height: 16px;
    color: var(--gold);
  }

  .reserva-estado {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    text-transform: uppercase;
    display: inline-block;
  }

  .estado-finalizada {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
  }

  .valoracion-form {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 1.5rem;
    margin-top: 1rem;
  }

  .valor-row {
    margin-bottom: 1.5rem;
  }

  .valor-row:last-child {
    margin-bottom: 0;
  }

  .valor-label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.75rem;
    color: var(--text-white);
  }

  .valor-required {
    color: var(--error-color);
  }

  .rating-container {
    display: flex;
    gap: 0.75rem;
    align-items: center;
  }

  .rating-stars {
    display: flex;
    gap: 0.5rem;
  }

  .star-btn {
    background: none;
    border: none;
    font-size: 2rem;
    cursor: pointer;
    transition: all 0.2s ease;
    padding: 0;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .star-btn:hover {
    transform: scale(1.1);
  }

  .star-btn svg {
    width: 32px;
    height: 32px;
    fill: currentColor;
  }

  .star-btn.inactive {
    color: var(--text-gray);
    opacity: 0.5;
  }

  .star-btn.active {
    color: var(--gold);
  }

  .rating-value {
    font-weight: 600;
    color: var(--gold);
    min-width: 40px;
    text-align: center;
  }

  .comentarios-input {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 0.75rem;
    color: var(--text-white);
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    width: 100%;
    resize: vertical;
    transition: all 0.3s ease;
  }

  .comentarios-input:focus {
    outline: none;
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(201, 169, 98, 0.1);
    background: rgba(255, 255, 255, 0.08);
  }

  .texto-ayuda {
    font-size: 0.75rem;
    color: var(--text-gray);
    margin-top: 0.5rem;
  }

  .form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
  }

  .btn-enviar {
    background: var(--gold);
    color: var(--dark-bg);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .btn-enviar:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(201, 169, 98, 0.3);
  }

  .btn-enviar:disabled {
    background: var(--text-gray);
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
  }

  .btn-cancelar {
    background: transparent;
    color: var(--text-white);
    border: 1px solid var(--border-color);
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .btn-cancelar:hover {
    border-color: var(--gold);
    color: var(--gold);
  }

  .valoracion-enviada {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 8px;
    padding: 1rem;
    margin-top: 1rem;
    color: #10b981;
  }

  .valoracion-enviada svg {
    width: 24px;
    height: 24px;
    flex-shrink: 0;
  }

  .loading {
    display: inline-block;
    opacity: 0.6;
  }

  .chofer-info {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
    font-size: 0.875rem;
    color: var(--text-gray);
  }

  .chofer-nombre {
    color: var(--text-white);
    font-weight: 500;
  }

  .chofer-rating {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
  }

  .chofer-rating svg {
    width: 16px;
    height: 16px;
    fill: var(--gold);
  }

  @media (max-width: 768px) {
    .reserva-header {
      flex-direction: column;
    }

    .reserva-detalles {
      grid-template-columns: 1fr;
    }

    .rating-container {
      flex-direction: column;
      align-items: flex-start;
    }

    .form-actions {
      flex-direction: column-reverse;
    }

    .form-actions button {
      width: 100%;
    }
  }
</style>

<div class="tab-valoracion">
  <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 24px; height: 24px; display: inline-block; margin-right: 0.75rem; vertical-align: middle;">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
    </svg>
    Valoraciones
  </h3>

  <?php if (empty($reservasFinalizadas)): ?>
    <div class="valoracion-empty">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
      <p data-i18n="valoracion.noReservas">No tienes reservas finalizadas para valorar</p>
    </div>
  <?php else: ?>
    <?php foreach ($reservasFinalizadas as $reserva): ?>
      <div class="reserva-valoracion" data-reserva-id="<?= $reserva->id ?>">
        <div class="reserva-header">
          <div class="reserva-info">
            <div class="reserva-codigo"><?= h($reserva->codigo_reserva) ?></div>
            <div class="reserva-ruta">
              <?= h($reserva->punto_recogida) ?> → <?= h($reserva->punto_destino) ?>
            </div>
            <div class="reserva-detalles">
              <div class="detalle-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span><?= $reserva->fecha->format('d/m/Y') ?></span>
              </div>
              <div class="detalle-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span><?= $reserva->hora->format('H:i') ?></span>
              </div>
            </div>
          </div>
          <div>
            <span class="reserva-estado estado-finalizada">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px; height: 14px; display: inline-block; margin-right: 0.4rem;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
              Finalizada
            </span>
          </div>
        </div>

        <?php if ($reserva->valoracion && !empty($reserva->valoracion->id)): ?>
          <!-- Valoración ya existe -->
          <div class="valoracion-enviada">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
              <div data-i18n="valoracion.yaValuada">Esta reserva ya ha sido valorada</div>
              <div class="chofer-info">
                <div>
                  <span data-i18n="valoracion.chofer">Chofer:</span>
                  <span class="chofer-nombre">
                    <?php
                    // Obtener información del chofer a través de la asignación
                    if (!empty($reserva->asignaciones) && count($reserva->asignaciones) > 0) {
                      echo h($reserva->asignaciones[0]->choferes->nombre ?? 'N/A');
                    } else {
                      echo 'N/A';
                    }
                    ?>
                  </span>
                </div>
                <div class="chofer-rating">
                  <svg viewBox="0 0 24 24">
                    <path d="M12 1.27l3.82 7.75h8.51l-6.88 5 2.63 8.63-7.38-5.36-7.38 5.36 2.63-8.63-6.88-5h8.51L12 1.27z"/>
                  </svg>
                  <span><?= number_format($reserva->valoracion->calificacion ?? 0, 1) ?>/5</span>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <!-- Formulario de valoración -->
          <form class="valoracion-form" data-reserva-id="<?= $reserva->id ?>" method="POST">
            <?= $this->Form->hidden('reserva_id', ['value' => $reserva->id]) ?>
            <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]) ?>

            <!-- Chofer info -->
            <div class="chofer-info">
              <div>
                <span data-i18n="valoracion.valorandoChofer">Valorando conductor:</span>
                <span class="chofer-nombre">
                  <?php
                  if (!empty($reserva->asignaciones) && count($reserva->asignaciones) > 0) {
                    echo h($reserva->asignaciones[0]->choferes->nombre ?? 'N/A');
                  } else {
                    echo 'N/A';
                  }
                  ?>
                </span>
              </div>
            </div>

            <!-- Puntuación Limpieza -->
            <div class="valor-row">
              <label class="valor-label">
                <span data-i18n="valoracion.limpieza">Limpieza</span>
                <span class="valor-required">*</span>
              </label>
              <div class="rating-container">
                <div class="rating-stars" data-field="puntuacion_limpieza">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <button type="button" class="star-btn inactive" data-value="<?= $i ?>" title="<?= $i ?> estrellas">
                      <svg viewBox="0 0 24 24">
                        <path d="M12 1.27l3.82 7.75h8.51l-6.88 5 2.63 8.63-7.38-5.36-7.38 5.36 2.63-8.63-6.88-5h8.51L12 1.27z"/>
                      </svg>
                    </button>
                  <?php endfor; ?>
                </div>
                <input type="hidden" name="puntuacion_limpieza" value="0" class="rating-value-input">
                <span class="rating-value">0</span>
              </div>
            </div>

            <!-- Puntuación Puntualidad -->
            <div class="valor-row">
              <label class="valor-label">
                <span data-i18n="valoracion.puntualidad">Puntualidad</span>
                <span class="valor-required">*</span>
              </label>
              <div class="rating-container">
                <div class="rating-stars" data-field="puntuacion_puntualidad">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <button type="button" class="star-btn inactive" data-value="<?= $i ?>" title="<?= $i ?> estrellas">
                      <svg viewBox="0 0 24 24">
                        <path d="M12 1.27l3.82 7.75h8.51l-6.88 5 2.63 8.63-7.38-5.36-7.38 5.36 2.63-8.63-6.88-5h8.51L12 1.27z"/>
                      </svg>
                    </button>
                  <?php endfor; ?>
                </div>
                <input type="hidden" name="puntuacion_puntualidad" value="0" class="rating-value-input">
                <span class="rating-value">0</span>
              </div>
            </div>

            <!-- Calificación General -->
            <div class="valor-row">
              <label class="valor-label">
                <span data-i18n="valoracion.calificacionGeneral">Calificación General</span>
                <span class="valor-required">*</span>
              </label>
              <div class="rating-container">
                <div class="rating-stars" data-field="calificacion">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <button type="button" class="star-btn inactive" data-value="<?= $i ?>" title="<?= $i ?> estrellas">
                      <svg viewBox="0 0 24 24">
                        <path d="M12 1.27l3.82 7.75h8.51l-6.88 5 2.63 8.63-7.38-5.36-7.38 5.36 2.63-8.63-6.88-5h8.51L12 1.27z"/>
                      </svg>
                    </button>
                  <?php endfor; ?>
                </div>
                <input type="hidden" name="calificacion" value="0" class="rating-value-input">
                <span class="rating-value">0</span>
              </div>
            </div>

            <!-- Comentarios -->
            <div class="valor-row">
              <label class="valor-label" data-i18n="valoracion.comentarios">Comentarios (opcional)</label>
              <textarea class="comentarios-input" name="comentarios" placeholder="Comparte tu experiencia..." maxlength="500" rows="4"></textarea>
              <div class="texto-ayuda" data-i18n="valoracion.maxCaracteres">Máximo 500 caracteres</div>
            </div>

            <!-- Acciones -->
            <div class="form-actions">
              <button type="button" class="btn-cancelar btn-reset" data-i18n="common.cancelar">Cancelar</button>
              <button type="submit" class="btn-enviar btn-submit" data-i18n="valoracion.enviarValoracion">Enviar Valoración</button>
            </div>
          </form>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Manejar click en estrellas
  document.querySelectorAll('.rating-stars').forEach(container => {
    const field = container.dataset.field;
    const stars = container.querySelectorAll('.star-btn');
    const form = container.closest('form');
    if (!form) return;

    const inputField = form.querySelector(`input[name="${field}"]`);
    const valueDisplay = form.querySelector(`[data-field="${field}"] ~ .rating-container .rating-value`);

    stars.forEach(star => {
      star.addEventListener('click', function(e) {
        e.preventDefault();
        const value = parseInt(this.dataset.value);
        inputField.value = value;

        // Actualizar visualización
        stars.forEach((s, index) => {
          if (index < value) {
            s.classList.remove('inactive');
            s.classList.add('active');
          } else {
            s.classList.remove('active');
            s.classList.add('inactive');
          }
        });

        // Actualizar valor mostrado
        if (valueDisplay) {
          valueDisplay.textContent = value;
        }
      });

      // Hover effect
      star.addEventListener('mouseover', function() {
        const value = parseInt(this.dataset.value);
        stars.forEach((s, index) => {
          if (index < value) {
            s.style.transform = 'scale(1.1)';
          } else {
            s.style.transform = 'scale(1)';
          }
        });
      });
    });

    container.addEventListener('mouseleave', function() {
      stars.forEach(s => s.style.transform = 'scale(1)');
    });
  });

  // Manejar envío del formulario
  document.querySelectorAll('.valoracion-form').forEach(form => {
    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      const reservaId = this.dataset.reservaId;
      const limpieza = this.querySelector('input[name="puntuacion_limpieza"]').value;
      const puntualidad = this.querySelector('input[name="puntuacion_puntualidad"]').value;
      const calificacion = this.querySelector('input[name="calificacion"]').value;
      const comentarios = this.querySelector('textarea[name="comentarios"]').value;
      const csrfToken = this.querySelector('input[name="_csrfToken"]').value;

      // Validación
      if (!limpieza || !puntualidad || !calificacion) {
        alert('Por favor califica Limpieza, Puntualidad y Calificación General');
        return;
      }

      const submitBtn = this.querySelector('.btn-submit');
      const originalText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.textContent = '...';

      try {
        const response = await fetch('/profile/save-valoracion', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': csrfToken
          },
          body: JSON.stringify({
            reserva_id: reservaId,
            puntuacion_limpieza: limpieza,
            puntuacion_puntualidad: puntualidad,
            calificacion: calificacion,
            comentarios: comentarios
          })
        });

        if (response.ok) {
          const result = await response.json();
          if (result.success) {
            // Mostrar mensaje de éxito y recargar
            location.reload();
          } else {
            alert(result.message || 'Error al guardar la valoración');
          }
        } else {
          alert('Error al guardar la valoración');
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Error al procesar la solicitud');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      }
    });

    // Manejar click en cancelar
    form.querySelector('.btn-reset').addEventListener('click', function() {
      if (confirm('¿Descartar cambios?')) {
        form.reset();
        form.querySelectorAll('.star-btn').forEach(star => {
          star.classList.remove('active');
          star.classList.add('inactive');
        });
        form.querySelectorAll('.rating-value').forEach(val => val.textContent = '0');
      }
    });
  });
});
</script>
