<?php
$this->assign('title', 'Xservicios - Mis Viajes');
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
    --orange: #fb923c;
    --purple: #a78bfa;
  }

  body {
    font-family: 'Inter', sans-serif;
    background: radial-gradient(circle at top, rgba(201, 169, 98, 0.14), transparent 45%),
      linear-gradient(180deg, rgba(11, 11, 11, 0.96), rgba(11, 11, 11, 1));
    color: var(--text-white);
    min-height: 100vh;
  }

  .trips-shell {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2.5rem 2.5rem 4rem;
  }

  .trips-hero {
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

  .trips-overline {
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 0.7rem;
    color: var(--gold-light);
    margin-bottom: 0.5rem;
  }

  .trips-title {
    font-family: 'Inter', sans-serif;
    font-size: 2.4rem;
    font-weight: 600;
    margin-bottom: 0.6rem;
  }

  .trips-subtitle {
    color: var(--text-gray);
    line-height: 1.6;
    font-size: 0.95rem;
  }

  .trips-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    padding: 0.5rem 1rem;
    border-radius: 999px;
    background: rgba(74, 222, 128, 0.16);
    color: var(--green);
    font-weight: 600;
    font-size: 0.8rem;
  }

  .trips-pill span {
    display: inline-flex;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--green);
  }

  .trips-tabs {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-top: 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    padding-bottom: 0.75rem;
  }

  .trips-tab {
    border: none;
    background: transparent;
    color: var(--text-gray);
    font-size: 0.95rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    cursor: pointer;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
  }

  .trips-tab:hover {
    color: var(--gold-light);
  }

  .trips-tab.active {
    color: var(--text-white);
    border-bottom-color: var(--gold);
  }

  .trips-tab-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 26px;
    height: 24px;
    border-radius: 999px;
    background: rgba(201, 169, 98, 0.2);
    color: var(--gold);
    font-size: 0.75rem;
  }

  .trips-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-top: 1.8rem;
  }

  .trips-stat-card {
    background: var(--dark-card);
    border-radius: 14px;
    padding: 1.2rem 1.4rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    align-items: center;
    gap: 0.85rem;
    transition: all 0.3s ease;
  }

  .trips-stat-card:hover {
    border-color: rgba(201, 169, 98, 0.3);
    transform: translateY(-2px);
  }

  .trips-stat-icon {
    width: 38px;
    height: 38px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(201, 169, 98, 0.12);
    color: var(--gold);
  }

  .trips-stat-icon.green { background: rgba(74, 222, 128, 0.12); color: var(--green); }
  .trips-stat-icon.blue { background: rgba(56, 189, 248, 0.12); color: var(--blue); }
  .trips-stat-icon.orange { background: rgba(251, 146, 60, 0.12); color: var(--orange); }

  .trips-stat-icon svg {
    width: 20px;
    height: 20px;
    stroke: currentColor;
  }

  .trips-stat-label {
    color: var(--text-gray);
    font-size: 0.78rem;
  }

  .trips-stat-value {
    font-size: 1.15rem;
    font-weight: 600;
  }

  .trips-list {
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }

  .trip-card {
    background: var(--dark-card-strong);
    border-radius: 12px;
    padding: 1rem 1.2rem;
    border: 1px solid rgba(255, 255, 255, 0.06);
    transition: all 0.3s ease;
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 1rem;
    align-items: center;
    cursor: pointer;
  }

  .trip-card:hover {
    border-color: rgba(201, 169, 98, 0.3);
    transform: translateX(4px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
  }

  .trip-header {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
  }

  .trip-id {
    font-size: 0.75rem;
    color: var(--text-gray);
    font-weight: 500;
  }

  .trip-status {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.3rem 0.7rem;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 600;
    width: fit-content;
  }

  .trip-status.programada { background: rgba(56, 189, 248, 0.15); color: var(--blue); }
  .trip-status.en-curso { background: rgba(251, 146, 60, 0.15); color: var(--orange); }
  .trip-status.finalizada { background: rgba(74, 222, 128, 0.15); color: var(--green); }
  .trip-status.cancelada { background: rgba(248, 113, 113, 0.15); color: var(--red); }

  .trip-status span {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: currentColor;
  }

  .trip-client {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .trip-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold), var(--gold-dark));
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #0d0d0d;
    font-size: 0.8rem;
    flex-shrink: 0;
  }

  .trip-client-info {
    flex: 1;
    min-width: 0;
  }

  .trip-client-name {
    font-size: 0.9rem;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .trip-service {
    font-size: 0.75rem;
    color: var(--text-gray);
    margin-top: 0.15rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .trip-route {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    min-width: 0;
  }

  .trip-route-line {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    font-size: 0.85rem;
  }

  .trip-route-line svg {
    width: 20px;
    height: 5px;
    fill: var(--gold);
    flex-shrink: 0;
  }

  .trip-route-point {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    flex: 1;
    min-width: 0;
  }

  .trip-route-time {
    color: var(--text-gray);
    font-size: 0.7rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
  }

  .trip-route-time svg {
    width: 12px;
    height: 12px;
    flex-shrink: 0;
  }

  .trip-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: flex-end;
  }

  .trip-meta-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.75rem;
    color: var(--text-gray);
    white-space: nowrap;
  }

  .trip-meta-item svg {
    width: 14px;
    height: 14px;
    stroke: var(--gold);
    flex-shrink: 0;
  }

  .trip-meta-value {
    color: var(--text-white);
    font-weight: 500;
  }

  .empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: var(--text-gray);
  }

  .empty-state svg {
    width: 80px;
    height: 80px;
    stroke: var(--gold);
    opacity: 0.3;
    margin-bottom: 1rem;
  }

  .empty-state h3 {
    font-size: 1.2rem;
    color: var(--text-white);
    margin-bottom: 0.5rem;
  }

  /* Responsive */
  @media (max-width: 1024px) {
    .trips-shell {
      padding: 2rem 2rem 3rem;
    }

    .trips-stats {
      grid-template-columns: repeat(2, 1fr);
    }

    .trip-card {
      grid-template-columns: 1fr;
      gap: 0.75rem;
    }

    .trip-header {
      order: 1;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
    }

    .trip-client {
      order: 2;
    }

    .trip-route {
      order: 3;
    }

    .trip-meta {
      order: 4;
      flex-direction: row;
      flex-wrap: wrap;
      align-items: flex-start;
    }
  }

  @media (max-width: 768px) {
    .trips-shell {
      padding: 1.5rem 1.2rem 2.5rem;
    }

    .trips-hero {
      flex-direction: column;
      align-items: flex-start;
      padding: 1.5rem;
    }

    .trips-title {
      font-size: 1.8rem;
    }

    .trips-tabs {
      gap: 1rem;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    .trips-tab {
      white-space: nowrap;
      flex-shrink: 0;
      font-size: 0.85rem;
    }

    .trips-stats {
      grid-template-columns: 1fr;
    }

    .trip-card {
      padding: 1rem;
    }

    .trip-client-name,
    .trip-service,
    .trip-route-point {
      font-size: 0.85rem;
    }

    .trip-meta-item {
      font-size: 0.7rem;
    }
  }

  @media (max-width: 480px) {
    .trips-shell {
      padding: 1rem 0.8rem 2rem;
    }

    .trips-hero {
      padding: 1.2rem;
    }

    .trips-title {
      font-size: 1.5rem;
    }

    .trip-card {
      padding: 0.8rem;
      gap: 0.6rem;
    }

    .trip-avatar {
      width: 32px;
      height: 32px;
      font-size: 0.7rem;
    }

    .trip-route-line {
      font-size: 0.8rem;
    }

    .trip-meta {
      gap: 0.4rem;
    }

    .trip-meta-item svg {
      width: 12px;
      height: 12px;
    }
  }
</style>
<?php $this->end(); ?>

<section class="trips-shell">
  <div class="trips-hero">
    <div>
      <p class="trips-overline">Panel de Chofer</p>
      <h1 class="trips-title">Mis Viajes</h1>
      <p class="trips-subtitle">Revisa tu historial completo de viajes, asignaciones activas y estadísticas de rendimiento.</p>
    </div>
    <div class="trips-pill"><span></span>Chofer activo</div>
  </div>

  <div class="trips-tabs">
    <button class="trips-tab active" type="button" data-tab="todos">
      Todos <span class="trips-tab-count" id="countTodos">0</span>
    </button>
    <button class="trips-tab" type="button" data-tab="en-curso">
      En Curso <span class="trips-tab-count" id="countEnCurso">0</span>
    </button>
    <button class="trips-tab" type="button" data-tab="finalizados">
      Finalizados <span class="trips-tab-count" id="countFinalizados">0</span>
    </button>
    <button class="trips-tab" type="button" data-tab="cancelados">
      Cancelados <span class="trips-tab-count" id="countCancelados">0</span>
    </button>
  </div>

  <div class="trips-stats">
    <div class="trips-stat-card">
      <div class="trips-stat-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
        </svg>
      </div>
      <div>
        <div class="trips-stat-label">Total de viajes</div>
        <div class="trips-stat-value" id="statTotal">0</div>
      </div>
    </div>
    <div class="trips-stat-card">
      <div class="trips-stat-icon green">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
      </div>
      <div>
        <div class="trips-stat-label">Completados</div>
        <div class="trips-stat-value" id="statCompletados">0</div>
      </div>
    </div>
    <div class="trips-stat-card">
      <div class="trips-stat-icon orange">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"/>
          <polyline points="12 6 12 12 16 14"/>
        </svg>
      </div>
      <div>
        <div class="trips-stat-label">En curso</div>
        <div class="trips-stat-value" id="statActivos">0</div>
      </div>
    </div>
    <div class="trips-stat-card">
      <div class="trips-stat-icon blue">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polygon points="12 2 15 8.5 22 9 17 14 18.5 21 12 17.5 5.5 21 7 14 2 9 9 8.5"/>
        </svg>
      </div>
      <div>
        <div class="trips-stat-label">Rating promedio</div>
        <div class="trips-stat-value" id="statRating">0.0</div>
      </div>
    </div>
  </div>

  <div class="trips-list" id="tripsList">
    <div class="empty-state">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="12"/>
        <line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
      <h3>Cargando viajes...</h3>
      <p>Obteniendo tu historial de viajes</p>
    </div>
  </div>
</section>

<script>
  window.xservHeaderConfig = {
    variant: 'driver',
    activePage: 'trips',
    notificationCount: 0
  };

  // Obtener iniciales del nombre
  function getInitials(nombre) {
    if (!nombre) return 'US';
    const parts = nombre.trim().split(/\s+/).slice(0, 2);
    return parts.map(p => p.charAt(0).toUpperCase()).join('');
  }

  // Formatear fecha
  function formatDate(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    const dias = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    
    const dia = dias[date.getDay()];
    const num = date.getDate();
    const mes = meses[date.getMonth()];
    const año = date.getFullYear();
    const hora = date.toLocaleTimeString('es-PA', { hour: '2-digit', minute: '2-digit' });
    
    return `${dia}, ${num} ${mes} ${año} - ${hora}`;
  }

  // Formatear solo fecha
  function formatDateShort(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    const num = date.getDate();
    const mes = meses[date.getMonth()];
    return `${num} ${mes}`;
  }

  // Obtener clase de estado
  function getStatusClass(estado) {
    const map = {
      'programada': 'programada',
      'en_curso': 'en-curso',
      'finalizada': 'finalizadas',
      'cancelada': 'cancelada'
    };
    return map[estado] || 'programada';
  }

  // Obtener texto de estado
  function getStatusText(estado) {
    const map = {
      'programada': 'Programada',
      'en_curso': 'En Curso',
      'finalizada': 'Finalizada',
      'cancelada': 'Cancelada'
    };
    return map[estado] || estado;
  }

  // Renderizar viajes
  let todosViajes = [];
  function openTripDetail(viajeId) {
    const parsedId = Number(viajeId);
    if (!Number.isFinite(parsedId) || parsedId <= 0) {
      console.warn('ID de viaje inválido para detalle:', viajeId);
      return;
    }

    window.location.href = `/chofer/viajes/detalle/${parsedId}`;
  }

  function renderViajes(viajes, filtro = 'todos') {
    const container = document.getElementById('tripsList');
    
    let filtered = viajes;
    if (filtro !== 'todos') {
      if (filtro === 'en-curso') {
        filtered = viajes.filter(v => v.estado_asignacion === 'en_curso');
      } else if (filtro === 'finalizados') {
        filtered = viajes.filter(v => v.estado_asignacion === 'finalizada');
      } else if (filtro === 'cancelados') {
        filtered = viajes.filter(v => v.estado_asignacion === 'cancelada');
      }
    }

    if (filtered.length === 0) {
      container.innerHTML = `
        <div class="empty-state">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M16 16s-1.5-2-4-2-4 2-4 2"/>
            <line x1="9" y1="9" x2="9.01" y2="9"/>
            <line x1="15" y1="9" x2="15.01" y2="9"/>
          </svg>
          <h3>No hay viajes en esta categoría</h3>
          <p>Los viajes aparecerán aquí cuando estén disponibles</p>
        </div>
      `;
      return;
    }

    container.innerHTML = filtered.map(viaje => {
      const reserva = viaje.reserva || {};
      const cliente = reserva.cliente || {};
      const usuario = cliente.usuario || {};
      const servicio = reserva.servicio || {};
      const vehiculo = viaje.vehiculo || {};
      
      const nombreCliente = usuario.nombre || usuario.username || 'Cliente';
      const iniciales = getInitials(nombreCliente);
      const origen = reserva.punto_recogida || 'Origen no especificado';
      const destino = reserva.punto_destino || 'Destino no especificado';
      const servicioNombre = servicio.nombre || 'Servicio';
      const vehiculoTipo = vehiculo.tipo ? (vehiculo.tipo === 'coaster' ? 'Coaster' : 'Bus 15') : '';
      const vehiculoNombre = vehiculo.placa ? `${vehiculoTipo} ${vehiculo.nombre_unidad || ''} - ${vehiculo.placa}`.trim().replace(/\s+/g, ' ') : 'Vehículo no asignado';
      
      const fechaInicio = formatDate(viaje.fecha_inicio_pactada);
      const fechaFin = viaje.fecha_fin_pactada ? formatDateShort(viaje.fecha_fin_pactada) : 'N/A';
      const statusClass = getStatusClass(viaje.estado_asignacion);
      const statusText = getStatusText(viaje.estado_asignacion);

      const viajeId = Number(viaje.id || 0);

      return `
        <div class="trip-card" role="button" tabindex="0" onclick="openTripDetail(${viajeId})" onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();openTripDetail(${viajeId});}">
          <div class="trip-client">
            <div class="trip-avatar">${iniciales}</div>
            <div class="trip-client-info">
              <div class="trip-client-name">${nombreCliente}</div>
              <div class="trip-service">${servicioNombre}</div>
            </div>
          </div>

          <div class="trip-route">
            <div class="trip-header">
              <div class="trip-id">Viaje #${viaje.id} • Reserva #${reserva.id || 'N/A'}</div>
              <div class="trip-status ${statusClass}">
                <span></span>
                ${statusText}
              </div>
            </div>
            <div class="trip-route-line">
              <span class="trip-route-point">${origen}</span>
              <svg viewBox="0 0 24 6">
                <line x1="0" y1="3" x2="18" y2="3" stroke="currentColor" stroke-width="2"/>
                <polygon points="16,0 24,3 16,6"/>
              </svg>
              <span class="trip-route-point">${destino}</span>
            </div>
            <div class="trip-route-time">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              ${fechaInicio}
            </div>
          </div>

          <div class="trip-meta">
            <div class="trip-meta-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 17h2v2h-2z"/>
                <path d="M9 17H7v2h2z"/>
                <path d="M20 16H4a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2z"/>
              </svg>
              <span class="trip-meta-value">${vehiculoNombre}</span>
            </div>
            <div class="trip-meta-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              <span class="trip-meta-value">Fin: ${fechaFin}</span>
            </div>
          </div>
        </div>
      `;
    }).join('');
  }

  // Cargar viajes
  async function loadViajes() {
    try {
      const res = await fetch('/api/chofer/asignaciones', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      
      if (!res.ok) throw new Error('Error al cargar viajes');
      
      const data = await res.json();
      console.log('Datos recibidos de la API:', data);
      
      if (data.success && data.asignaciones) {
        todosViajes = data.asignaciones;
        
        // Log de estructura para debugging
        if (todosViajes.length > 0) {
          console.log('Estructura del primer viaje:', todosViajes[0]);
        }
        
        // Actualizar estadísticas
        const total = todosViajes.length;
        const enCurso = todosViajes.filter(v => v.estado_asignacion === 'en_curso').length;
        const finalizados = todosViajes.filter(v => v.estado_asignacion === 'finalizada').length;
        const cancelados = todosViajes.filter(v => v.estado_asignacion === 'cancelada').length;
        
        document.getElementById('statTotal').textContent = total;
        document.getElementById('statCompletados').textContent = finalizados;
        document.getElementById('statActivos').textContent = enCurso;
        
        // Actualizar contadores de tabs
        document.getElementById('countTodos').textContent = total;
        document.getElementById('countEnCurso').textContent = enCurso;
        document.getElementById('countFinalizados').textContent = finalizados;
        document.getElementById('countCancelados').textContent = cancelados;
        
        // Renderizar viajes
        renderViajes(todosViajes, 'todos');
      }
    } catch (error) {
      console.error('Error cargando viajes:', error);
      document.getElementById('tripsList').innerHTML = `
        <div class="empty-state">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="15" y1="9" x2="9" y2="15"/>
            <line x1="9" y1="9" x2="15" y2="15"/>
          </svg>
          <h3>Error al cargar viajes</h3>
          <p>Por favor, intenta recargar la página</p>
        </div>
      `;
    }
  }

  // Cargar estadísticas adicionales
  async function loadStats() {
    try {
      const res = await fetch('/api/chofer/stats', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      
      if (!res.ok) return;
      
      const data = await res.json();
      if (data.success && data.stats) {
        document.getElementById('statRating').textContent = `${data.stats.ratingPromedio || 0.0}`;
      }
    } catch (error) {
      console.error('Error cargando estadísticas:', error);
    }
  }

  // Tabs
  document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.trips-tab');
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        
        const tabName = tab.getAttribute('data-tab');
        renderViajes(todosViajes, tabName);
      });
    });

    // Cargar datos
    loadViajes();
    loadStats();
  });
</script>
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>
