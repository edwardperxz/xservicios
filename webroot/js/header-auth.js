// API endpoints
const API_ME = '/xserv-usuarios/me';
const API_RESERVAS = '/xserv-reservas?api=json';

// Load user data and reservations when page loads
document.addEventListener('DOMContentLoaded', function() {
  cargarReservas();
  configurarEventos();
});

async function cargarReservas() {
  try {
    const response = await fetch(API_RESERVAS, {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      },
      credentials: 'same-origin'
    });

    if (!response.ok) {
      console.warn('Error loading reservations:', response.status);
      mostrarMensajeVacio();
      return;
    }

    const contentType = response.headers.get('content-type');
    if (!contentType || !contentType.includes('application/json')) {
      console.warn('Response is not JSON');
      mostrarMensajeVacio();
      return;
    }

    const data = await response.json();
    
    if (data.reservas && Array.isArray(data.reservas) && data.reservas.length > 0) {
      renderizarReservas(data.reservas);
    } else {
      mostrarMensajeVacio();
    }
  } catch (error) {
    console.error('Error cargando reservas:', error);
    mostrarMensajeVacio();
  }
}

function renderizarReservas(reservas) {
  const serviceList = document.getElementById('serviceList');
  if (!serviceList) return;

  serviceList.innerHTML = '';
  
  reservas.forEach(reserva => {
    const estado = getEstadoReserva(reserva.estado);
    const fecha = new Date(reserva.fecha_viaje).toLocaleDateString('es-ES', {
      weekday: 'short',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });

    const html = `
      <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border-bottom: 1px solid var(--dark-lighter);">
        <div>
          <div style="font-weight: 500; margin-bottom: 0.25rem;">${reserva.origen || 'Origen no especificado'} → ${reserva.destino || 'Destino no especificado'}</div>
          <div style="font-size: 0.875rem; color: var(--text-gray);">${fecha}</div>
        </div>
        <div style="text-align: right;">
          <div style="padding: 0.25rem 0.75rem; border-radius: 4px; background: ${estado.bg}; color: ${estado.color}; font-size: 0.8rem; font-weight: 500; margin-bottom: 0.5rem;">
            ${estado.label}
          </div>
          <div style="font-weight: 600; color: var(--gold);">$${parseFloat(reserva.monto || 0).toFixed(2)}</div>
        </div>
      </div>
    `;
    
    serviceList.insertAdjacentHTML('beforeend', html);
  });
}

function mostrarMensajeVacio() {
  const serviceList = document.getElementById('serviceList');
  if (serviceList) {
    serviceList.innerHTML = '<p class="empty-message">No hay reservas recientes.</p>';
  }
}

function getEstadoReserva(estado) {
  const estados = {
    'pendiente': { label: 'Pendiente', color: '#f59e0b', bg: 'rgba(245, 158, 11, 0.15)' },
    'confirmada': { label: 'Confirmada', color: '#4ade80', bg: 'rgba(74, 222, 128, 0.15)' },
    'en_progreso': { label: 'En Progreso', color: '#3b82f6', bg: 'rgba(59, 130, 246, 0.15)' },
    'completada': { label: 'Completada', color: '#4ade80', bg: 'rgba(74, 222, 128, 0.15)' },
    'cancelada': { label: 'Cancelada', color: '#ef4444', bg: 'rgba(239, 68, 68, 0.15)' }
  };
  
  return estados[estado] || { label: estado, color: 'var(--text-gray)', bg: 'var(--dark-lighter)' };
}

function configurarEventos() {
  // Manejador para el botón de historial
  const btnHistorial = document.querySelector('.btn-history');
  if (btnHistorial) {
    btnHistorial.addEventListener('click', () => {
      window.location.href = '/myreservations';
    });
  }
}

function getCsrfToken() {
  const meta = document.querySelector('meta[name="csrfToken"], meta[name="csrf-token"]');
  return meta ? meta.getAttribute('content') : null;
}

// Logout functionality
function logout() {
  const csrfToken = getCsrfToken();
  fetch('/xserv-usuarios/logout', {
    method: 'POST',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      ...(csrfToken ? { 'X-CSRF-Token': csrfToken } : {})
    },
    credentials: 'same-origin'
  }).then(() => {
    window.location.href = '/home';
  }).catch(error => {
    console.error('Error logging out:', error);
    window.location.href = '/home';
  });
}
