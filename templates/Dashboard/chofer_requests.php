<?php
$this->assign('title', 'Xservicios - Solicitudes');
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

  .driver-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-top: 1.8rem;
  }

  .driver-stat-card {
    background: var(--dark-card);
    border-radius: 14px;
    padding: 1.2rem 1.4rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    align-items: center;
    gap: 0.85rem;
  }

  .driver-stat-icon {
    width: 38px;
    height: 38px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(201, 169, 98, 0.12);
    color: var(--gold);
  }

  .driver-stat-icon svg {
    width: 20px;
    height: 20px;
    stroke: currentColor;
  }

  .driver-stat-label {
    color: var(--text-gray);
    font-size: 0.78rem;
  }

  .driver-stat-value {
    font-size: 1.15rem;
    font-weight: 600;
  }

  .driver-tabs {
    display: flex;
    gap: 0.5rem;
    margin-top: 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .driver-tab {
    padding: 1rem 1.5rem;
    background: none;
    border: none;
    color: var(--text-gray);
    font-weight: 500;
    font-size: 0.95rem;
    cursor: pointer;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
  }

  .driver-tab:hover {
    color: var(--gold);
  }

  .driver-tab.active {
    color: var(--gold);
    border-bottom-color: var(--gold);
  }

  .driver-tab-content {
    display: none;
    margin-top: 1.5rem;
  }

  .driver-tab-content.active {
    display: block;
  }

  .driver-requests {
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
  }

  .driver-request-card {
    background: var(--dark-card-strong);
    border-radius: 16px;
    padding: 1.4rem;
    border: 1px solid rgba(255, 255, 255, 0.06);
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 1.2rem;
    align-items: start;
    transition: all 0.3s ease;
  }

  .driver-request-card:hover {
    border-color: rgba(201, 169, 98, 0.3);
    background: rgba(28, 28, 28, 0.8);
  }

  .driver-request-profile {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .driver-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold), var(--gold-dark));
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #0d0d0d;
    font-size: 1rem;
    flex-shrink: 0;
  }

  .driver-request-info {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
  }

  .driver-name {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-white);
  }

  .driver-meta {
    font-size: 0.8rem;
    color: var(--text-gray);
  }

  .driver-request-details {
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
  }

  .driver-route {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--text-gray);
  }

  .driver-route-line {
    display: flex;
    align-items: center;
    gap: 0.4rem;
  }

  .driver-route-line svg {
    width: 20px;
    height: 5px;
    stroke: var(--gold);
    opacity: 0.6;
  }

  .driver-route-time {
    font-size: 0.85rem;
    color: var(--gold);
    font-weight: 500;
  }

  .driver-request-state {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .driver-request-state.programada {
    background: rgba(74, 222, 128, 0.15);
    color: var(--green);
  }

  .driver-request-state.completada {
    background: rgba(56, 189, 248, 0.15);
    color: var(--blue);
  }

  .driver-request-state.cancelada {
    background: rgba(248, 113, 113, 0.15);
    color: var(--red);
  }

  .driver-request-actions {
    display: flex;
    gap: 0.6rem;
    align-items: center;
  }

  .driver-action-btn {
    padding: 0.65rem 1.2rem;
    border-radius: 10px;
    border: none;
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
  }

  .driver-action-btn.accept {
    background: var(--green);
    color: #0d0d0d;
  }

  .driver-action-btn.accept:hover {
    background: #3ed86f;
    transform: translateY(-2px);
  }

  .driver-action-btn.decline {
    background: rgba(248, 113, 113, 0.2);
    color: var(--red);
    border: 1px solid rgba(248, 113, 113, 0.4);
  }

  .driver-action-btn.decline:hover {
    background: rgba(248, 113, 113, 0.3);
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

  /* Responsive */
  @media (max-width: 1080px) {
    .driver-shell {
      padding: 2rem 2rem 3rem;
    }

    .driver-request-card {
      grid-template-columns: auto 1fr;
      gap: 1rem;
    }

    .driver-request-actions {
      grid-column: 1 / -1;
      margin-top: 0.5rem;
    }

    .driver-stats {
      grid-template-columns: repeat(2, 1fr);
    }
  }

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

    .driver-tabs {
      margin-top: 1.5rem;
    }
  }

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
    }

    .driver-stats {
      grid-template-columns: 1fr;
      gap: 0.8rem;
    }

    .driver-stat-card {
      padding: 1rem 1.2rem;
    }

    .driver-tab {
      padding: 0.8rem 1rem;
      font-size: 0.85rem;
    }

    .driver-request-card {
      padding: 1rem;
      gap: 0.8rem;
    }

    .driver-avatar {
      width: 40px;
      height: 40px;
      font-size: 0.9rem;
    }

    .driver-name {
      font-size: 0.9rem;
    }

    .driver-meta,
    .driver-route {
      font-size: 0.75rem;
    }

    .driver-action-btn {
      padding: 0.5rem 0.9rem;
      font-size: 0.75rem;
    }

    .driver-requests {
      gap: 0.9rem;
    }
  }
</style>
<?php $this->end(); ?>

<?php 
  // Inicializar variable si no existe
  if (!isset($asignaciones)) {
    $asignaciones = [];
  }
?>

<section class="driver-shell">
  <div class="driver-hero">
    <div>
      <p class="driver-overline">Panel de Chofer</p>
      <h1 class="driver-title">Solicitudes</h1>
      <p class="driver-subtitle">Gestiona tus solicitudes de viaje y asignaciones.</p>
    </div>
  </div>

  <div class="driver-stats">
    <div class="driver-stat-card">
      <div class="driver-stat-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"/>
          <path d="M12 6v6l4 2"/>
        </svg>
      </div>
      <div>
        <div class="driver-stat-label">Viajes este mes</div>
        <div class="driver-stat-value" id="statsTrips">0</div>
      </div>
    </div>

    <div class="driver-stat-card">
      <div class="driver-stat-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
        </svg>
      </div>
      <div>
        <div class="driver-stat-label">Calificación promedio</div>
        <div class="driver-stat-value" id="statsRating">0.0</div>
      </div>
    </div>

    <div class="driver-stat-card">
      <div class="driver-stat-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
      </div>
      <div>
        <div class="driver-stat-label">Solicitudes pendientes</div>
        <div class="driver-stat-value" id="statsPending">0</div>
      </div>
    </div>
  </div>

  <div class="driver-tabs" id="requestTabs">
    <button class="driver-tab active" data-tab="solicitudes">Solicitudes</button>
    <button class="driver-tab" data-tab="historial">Historial</button>
    <button class="driver-tab" data-tab="valoraciones">Valoraciones</button>
  </div>

  <div class="driver-tab-content active" id="tab-solicitudes">
    <div class="driver-requests" id="solicitudesList">
      <?php 
        $solicitudes = array_filter((array)$asignaciones, function($a) { 
          return $a->estado === 'programada'; 
        });
        
        if (empty($solicitudes)): 
      ?>
        <div class="empty-state">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
            <path d="M12 12v-5m0 8h.01"/>
          </svg>
          <h3>Sin solicitudes pendientes</h3>
          <p>No tienes solicitudes de viaje disponibles en este momento</p>
        </div>
      <?php else: ?>
        <?php foreach ($solicitudes as $asig): ?>
          <?php
            $origen = $asig->ruta?->origen ?? 'Origen desconocido';
            $destino = $asig->ruta?->destino ?? 'Destino desconocido';
            $fecha = new DateTime($asig->fecha_programada);
            $fechaFormato = $fecha->format('d/m/Y');
            $horaFormato = $fecha->format('H:i');
            $avatar = substr((string)$asig->cliente?->nombre ?? 'C', 0, 1);
            $clienteNombre = $asig->cliente?->nombre ?? 'Cliente desconocido';
            $servicioNombre = $asig->servicio?->nombre ?? 'Servicio';
          ?>
          <div class="driver-request-card">
            <div class="driver-request-profile">
              <div class="driver-avatar"><?= strtoupper($avatar) ?></div>
              <div class="driver-request-info">
                <div class="driver-name"><?= h($clienteNombre) ?></div>
                <div class="driver-meta"><?= h($servicioNombre) ?></div>
              </div>
            </div>
            
            <div class="driver-request-details">
              <div class="driver-route">
                <div class="driver-route-line">
                  <span><?= h($origen) ?></span>
                  <svg viewBox="0 0 20 4" fill="none" stroke="currentColor">
                    <line x1="0" y1="2" x2="20" y2="2"/>
                    <path d="M18 0l2 2-2 2"/>
                  </svg>
                  <span><?= h($destino) ?></span>
                </div>
              </div>
              <div class="driver-route-time"><?= $fechaFormato ?> a las <?= $horaFormato ?></div>
            </div>

            <div class="driver-request-actions">
              <button class="driver-action-btn accept" onclick="acceptAsignacion(<?= $asig->id ?>)">Aceptar</button>
              <button class="driver-action-btn decline" onclick="declineAsignacion(<?= $asig->id ?>)">Rechazar</button>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="driver-tab-content" id="tab-historial">
    <div class="driver-requests" id="historialList">
      <?php 
        $historial = array_filter((array)$asignaciones, function($a) { 
          return $a->estado === 'completada' || $a->estado === 'cancelada'; 
        });
        
        if (empty($historial)): 
      ?>
        <div class="empty-state">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 6v6l4 2"/>
          </svg>
          <h3>Sin historial</h3>
          <p>Tu historial de viajes completados aparecerá aquí</p>
        </div>
      <?php else: ?>
        <?php foreach ($historial as $asig): ?>
          <?php
            $origen = $asig->ruta?->origen ?? 'Origen desconocido';
            $destino = $asig->ruta?->destino ?? 'Destino desconocido';
            $fecha = new DateTime($asig->fecha_programada);
            $fechaFormato = $fecha->format('d/m/Y');
            $avatar = substr((string)$asig->cliente?->nombre ?? 'C', 0, 1);
            $clienteNombre = $asig->cliente?->nombre ?? 'Cliente desconocido';
            $estadoClass = strtolower($asig->estado);
            $estadoLabel = $asig->estado === 'completada' ? 'Completado' : 'Cancelado';
          ?>
          <div class="driver-request-card">
            <div class="driver-request-profile">
              <div class="driver-avatar"><?= strtoupper($avatar) ?></div>
              <div class="driver-request-info">
                <div class="driver-name"><?= h($clienteNombre) ?></div>
                <div class="driver-meta"><?= $fechaFormato ?></div>
              </div>
            </div>
            
            <div class="driver-request-details">
              <div class="driver-route">
                <div class="driver-route-line">
                  <span><?= h($origen) ?></span>
                  <svg viewBox="0 0 20 4" fill="none" stroke="currentColor">
                    <line x1="0" y1="2" x2="20" y2="2"/>
                    <path d="M18 0l2 2-2 2"/>
                  </svg>
                  <span><?= h($destino) ?></span>
                </div>
              </div>
              <div class="driver-request-state <?= $estadoClass ?>"><?= $estadoLabel ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="driver-tab-content" id="tab-valoraciones">
    <div class="driver-requests" id="valoracionesList">
      <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
        </svg>
        <h3>Sin valoraciones</h3>
        <p>Las valoraciones de tus viajes se mostrarán aquí</p>
      </div>
    </div>
  </div>
</section>

<script>
  window.xservHeaderConfig = {
    variant: 'driver',
    activePage: 'requests',
    notificationCount: 0
  };

  // Tabs functionality
  document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.driver-tab');
    const tabContents = document.querySelectorAll('.driver-tab-content');

    tabs.forEach(tab => {
      tab.addEventListener('click', function() {
        const tabName = this.getAttribute('data-tab');
        
        // Remove active from all tabs and contents
        tabs.forEach(t => t.classList.remove('active'));
        tabContents.forEach(c => c.classList.remove('active'));
        
        // Add active to clicked tab and corresponding content
        this.classList.add('active');
        document.getElementById('tab-' + tabName).classList.add('active');
        
        // Load data based on tab
        loadTabData(tabName);
      });
    });

    // Load initial data
    loadAsignaciones();
  });

  async function loadAsignaciones() {
    try {
      const response = await fetch('/api/chofer/asignaciones');
      const data = await response.json();
      
      if (data.success) {
        renderSolicitudes(data.asignaciones);
        updateStats(data.stats);
      }
    } catch (error) {
      console.error('Error loading asignaciones:', error);
    }
  }

  function renderSolicitudes(asignaciones) {
    const lista = document.getElementById('solicitudesList');
    
    const solicitudes = asignaciones.filter(a => a.estado === 'programada');
    
    if (solicitudes.length === 0) {
      lista.innerHTML = `
        <div class="empty-state">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
            <path d="M12 12v-5m0 8h.01"/>
          </svg>
          <h3>Sin solicitudes pendientes</h3>
          <p>No tienes solicitudes de viaje disponibles en este momento</p>
        </div>
      `;
      return;
    }

    lista.innerHTML = solicitudes.map(asig => {
      const origen = asig.ruta?.origen || 'Origen desconocido';
      const destino = asig.ruta?.destino || 'Destino desconocido';
      const fecha = new Date(asig.fecha_programada).toLocaleDateString('es-ES');
      const hora = new Date(asig.fecha_programada).toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
      const avatar = asig.cliente?.nombre.charAt(0).toUpperCase() || 'C';

      return `
        <div class="driver-request-card">
          <div class="driver-request-profile">
            <div class="driver-avatar">${avatar}</div>
            <div class="driver-request-info">
              <div class="driver-name">${asig.cliente?.nombre || 'Cliente'}</div>
              <div class="driver-meta">${asig.servicio?.nombre || 'Servicio'}</div>
            </div>
          </div>
          
          <div class="driver-request-details">
            <div class="driver-route">
              <div class="driver-route-line">
                <span>${origen}</span>
                <svg viewBox="0 0 20 4" fill="none" stroke="currentColor">
                  <line x1="0" y1="2" x2="20" y2="2"/>
                  <path d="M18 0l2 2-2 2"/>
                </svg>
                <span>${destino}</span>
              </div>
            </div>
            <div class="driver-route-time">${fecha} a las ${hora}</div>
          </div>

          <div class="driver-request-actions">
            <button class="driver-action-btn accept" onclick="acceptAsignacion(${asig.id})">Aceptar</button>
            <button class="driver-action-btn decline" onclick="declineAsignacion(${asig.id})">Rechazar</button>
          </div>
        </div>
      `;
    }).join('');
  }

  function renderHistorial(asignaciones) {
    const lista = document.getElementById('historialList');
    
    const historial = asignaciones.filter(a => a.estado === 'completada' || a.estado === 'cancelada');
    
    if (historial.length === 0) {
      lista.innerHTML = `
        <div class="empty-state">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 6v6l4 2"/>
          </svg>
          <h3>Sin historial</h3>
          <p>Tu historial de viajes completados aparecerá aquí</p>
        </div>
      `;
      return;
    }

    lista.innerHTML = historial.map(asig => {
      const origen = asig.ruta?.origen || 'Origen desconocido';
      const destino = asig.ruta?.destino || 'Destino desconocido';
      const fecha = new Date(asig.fecha_programada).toLocaleDateString('es-ES');
      const avatar = asig.cliente?.nombre.charAt(0).toUpperCase() || 'C';
      const estadoClass = asig.estado;
      const estadoLabel = asig.estado === 'completada' ? 'Completado' : 'Cancelado';

      return `
        <div class="driver-request-card">
          <div class="driver-request-profile">
            <div class="driver-avatar">${avatar}</div>
            <div class="driver-request-info">
              <div class="driver-name">${asig.cliente?.nombre || 'Cliente'}</div>
              <div class="driver-meta">${fecha}</div>
            </div>
          </div>
          
          <div class="driver-request-details">
            <div class="driver-route">
              <div class="driver-route-line">
                <span>${origen}</span>
                <svg viewBox="0 0 20 4" fill="none" stroke="currentColor">
                  <line x1="0" y1="2" x2="20" y2="2"/>
                  <path d="M18 0l2 2-2 2"/>
                </svg>
                <span>${destino}</span>
              </div>
            </div>
            <div class="driver-request-state ${estadoClass}">${estadoLabel}</div>
          </div>
        </div>
      `;
    }).join('');
  }

  function updateStats(stats) {
    document.getElementById('statsTrips').textContent = stats?.viajes || 0;
    document.getElementById('statsRating').textContent = (stats?.rating || 0).toFixed(1);
    document.getElementById('statsPending').textContent = stats?.pendientes || 0;
  }

  async function acceptAsignacion(id) {
    try {
      const response = await fetch(`/api/chofer/asignaciones/${id}/accept`, {
        method: 'POST',
        credentials: 'same-origin'
      });
      
      if (response.ok) {
        loadAsignaciones();
      }
    } catch (error) {
      console.error('Error accepting asignacion:', error);
    }
  }

  async function declineAsignacion(id) {
    try {
      const response = await fetch(`/api/chofer/asignaciones/${id}/decline`, {
        method: 'POST',
        credentials: 'same-origin'
      });
      
      if (response.ok) {
        loadAsignaciones();
      }
    } catch (error) {
      console.error('Error declining asignacion:', error);
    }
  }

  function loadTabData(tabName) {
    if (tabName === 'solicitudes' || tabName === 'historial') {
      loadAsignaciones();
    }
  }
</script>
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>
