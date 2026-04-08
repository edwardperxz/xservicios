(function () {
  'use strict';

  const STORAGE_KEY = 'xservicios_demo_state';
  const DEMO_USER_KEY = 'xservicios_demo_user';

  const defaultState = () => ({
    user: {
      id: 101,
      nombre: 'Edward',
      apellidos: 'Perx',
      email: 'demo@xservicios.com',
      rol: 'cliente'
    },
    services: [
      {
        id: 1,
        nombre: 'Traslado Ejecutivo',
        precio_base: 45,
        estado: 'activo',
        descripcion_es: 'Transporte privado para ciudad y aeropuerto.',
        descripcion_en: 'Private transfer for city and airport trips.',
        variantes: 'Viaje ejecutivo;Chofer profesional;Aire acondicionado',
        imagen: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200&h=900&fit=crop'
      },
      {
        id: 2,
        nombre: 'Tour Montanero',
        precio_base: 78,
        estado: 'activo',
        descripcion_es: 'Ruta panoramica por las tierras altas de Chiriqui.',
        descripcion_en: 'Scenic route through the highlands of Chiriqui.',
        variantes: 'Paradas turisticas;Agua incluida;Asistencia personalizada',
        imagen: 'https://images.unsplash.com/photo-1473951574080-01fe63f7d0ed?w=1200&h=900&fit=crop'
      },
      {
        id: 3,
        nombre: 'Transfer Premium Playa',
        precio_base: 95,
        estado: 'activo',
        descripcion_es: 'Traslado exclusivo hacia costas y playas del pacifico.',
        descripcion_en: 'Exclusive transfer to the Pacific coast and beaches.',
        variantes: 'Puerta a puerta;Equipaje incluido;Chofer bilingue',
        imagen: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&h=900&fit=crop'
      }
    ],
    reservations: [
      {
        id: 1,
        codigo_reserva: 'XSV-2401',
        estado: 'confirmada',
        estado_pago: 'pendiente',
        fecha: '2026-04-08',
        hora: '08:30',
        punto_recogida: 'David',
        punto_destino: 'Boquete',
        pasajeros: 3,
        precio_pactado: 45,
        itbms_pactado: 3.15,
        observaciones: 'Demo de portafolio guardada en memoria local.',
        servicio: { nombre: 'Traslado Ejecutivo' }
      },
      {
        id: 2,
        codigo_reserva: 'XSV-2402',
        estado: 'pendiente',
        estado_pago: 'pendiente',
        fecha: '2026-04-10',
        hora: '11:00',
        punto_recogida: 'Albrook',
        punto_destino: 'Volcan',
        pasajeros: 2,
        precio_pactado: 78,
        itbms_pactado: 5.46,
        observaciones: 'Demo de portafolio guardada en memoria local.',
        servicio: { nombre: 'Tour Montanero' }
      },
      {
        id: 3,
        codigo_reserva: 'XSV-2403',
        estado: 'completada',
        estado_pago: 'pagado',
        fecha: '2026-04-12',
        hora: '15:30',
        punto_recogida: 'Aeropuerto',
        punto_destino: 'Boca Chica',
        pasajeros: 4,
        precio_pactado: 95,
        itbms_pactado: 6.65,
        observaciones: 'Demo de portafolio guardada en memoria local.',
        servicio: { nombre: 'Transfer Premium Playa' }
      }
    ],
    ratings: [
      {
        id: 1,
        xserv_reserva_id: 3,
        tipo: 'servicio',
        calificacion: 5,
        comentarios: 'Excelente experiencia.',
        created: '2026-04-12 12:00:00',
        xserv_reserva: {
          origen_ubicacion: 'Aeropuerto',
          destino_ubicacion: 'Boca Chica',
          fecha_viaje: '2026-04-12'
        }
      }
    ]
  });

  const responseHeaders = () => new Headers({ 'Content-Type': 'application/json; charset=utf-8' });

  const loadState = () => {
    try {
      const raw = localStorage.getItem(STORAGE_KEY);
      if (!raw) {
        const initialState = defaultState();
        localStorage.setItem(STORAGE_KEY, JSON.stringify(initialState));
        localStorage.setItem(DEMO_USER_KEY, JSON.stringify(initialState.user));
        return initialState;
      }

      const parsed = JSON.parse(raw);
      if (!parsed.user) {
        parsed.user = defaultState().user;
      }
      return parsed;
    } catch (error) {
      const initialState = defaultState();
      localStorage.setItem(STORAGE_KEY, JSON.stringify(initialState));
      localStorage.setItem(DEMO_USER_KEY, JSON.stringify(initialState.user));
      return initialState;
    }
  };

  let state = loadState();

  const saveState = () => {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
    localStorage.setItem(DEMO_USER_KEY, JSON.stringify(state.user));
  };

  const clone = (value) => JSON.parse(JSON.stringify(value));

  const jsonResponse = (payload, init = {}) => new Response(JSON.stringify(payload), {
    status: init.status || 200,
    headers: responseHeaders()
  });

  const normalizePath = (input) => {
    if (typeof input === 'string') return input;
    if (input instanceof Request) return input.url;
    return '';
  };

  const readJsonBody = async (input, init) => {
    if (input instanceof Request) {
      const contentType = input.headers.get('content-type') || '';
      if (contentType.includes('application/json')) {
        return await input.clone().json();
      }

      const formData = await input.clone().formData();
      return Object.fromEntries(formData.entries());
    }

    if (!init || init.body == null) {
      return {};
    }

    if (typeof init.body === 'string') {
      try {
        return JSON.parse(init.body);
      } catch (error) {
        return {};
      }
    }

    if (init.body instanceof FormData) {
      return Object.fromEntries(init.body.entries());
    }

    return {};
  };

  const buildReservationsByCategory = () => {
    const result = {
      pendientes: [],
      proximos: [],
      completadas: [],
      canceladas: []
    };

    state.reservations.forEach((reservation) => {
      const category = String(reservation.estado || 'pendiente').toLowerCase();
      if (category === 'completada' || category === 'completado') {
        result.completadas.push(clone(reservation));
      } else if (category === 'cancelada' || category === 'cancelado') {
        result.canceladas.push(clone(reservation));
      } else if (category === 'confirmada' || category === 'asignada') {
        result.proximos.push(clone(reservation));
      } else {
        result.pendientes.push(clone(reservation));
      }
    });

    return result;
  };

  const buildReservationsApi = () => ({ xservReservas: state.reservations.map((reservation) => ({
    id: reservation.id,
    codigo_reserva: reservation.codigo_reserva,
    estado: 'completado',
    origen_ubicacion: reservation.punto_recogida,
    destino_ubicacion: reservation.punto_destino,
    fecha_viaje: reservation.fecha,
    xserv_chofer: { nombre_completo: 'Chofer Demo' },
    xserv_vehiculo: { marca_modelo: 'Vehiculo Demo' }
  })) });

  const buildRatingsApi = () => ({ xservValoraciones: state.ratings.map((rating) => clone(rating)) });

  const createReservation = async (input, init) => {
    const body = await readJsonBody(input, init);
    const serviceId = Number(body.service_id || body.serviceId);
    const service = state.services.find((item) => Number(item.id) === serviceId);

    if (!service) {
      return jsonResponse({ success: false, message: 'Servicio no encontrado' }, { status: 404 });
    }

    const nextId = state.reservations.length ? Math.max(...state.reservations.map((item) => Number(item.id) || 0)) + 1 : 1;
    const code = `XSV-${String(2400 + nextId).slice(-4)}`;
    const today = new Date();
    const fecha = today.toISOString().slice(0, 10);
    const hora = today.toTimeString().slice(0, 5);

    const reservation = {
      id: nextId,
      codigo_reserva: code,
      estado: 'pendiente',
      estado_pago: 'pendiente',
      fecha,
      hora,
      punto_recogida: 'Por definir',
      punto_destino: 'Por definir',
      pasajeros: 1,
      precio_pactado: Number(service.precio_base) || 0,
      itbms_pactado: Number(service.precio_base || 0) * 0.07,
      observaciones: 'Reserva creada en modo demo.',
      servicio: { nombre: service.nombre }
    };

    state.reservations.unshift(reservation);
    saveState();

    return jsonResponse({
      success: true,
      message: 'Reserva creada exitosamente',
      reserva_id: reservation.id,
      codigo_reserva: reservation.codigo_reserva
    });
  };

  const addRating = async (input, init) => {
    const body = await readJsonBody(input, init);
    const reservationId = Number(body.xserv_reserva_id || body.reserva_id || body.reservaId);
    const nextId = state.ratings.length ? Math.max(...state.ratings.map((item) => Number(item.id) || 0)) + 1 : 1;

    const rating = {
      id: nextId,
      xserv_reserva_id: reservationId,
      tipo: String(body.tipo || 'servicio'),
      calificacion: Number(body.calificacion || 5),
      comentarios: String(body.comentarios || ''),
      created: new Date().toISOString().replace('T', ' ').slice(0, 19),
      xserv_reserva: {
        origen_ubicacion: 'Origen demo',
        destino_ubicacion: 'Destino demo',
        fecha_viaje: new Date().toISOString().slice(0, 10)
      }
    };

    state.ratings.unshift(rating);
    saveState();

    return jsonResponse({ success: true, message: 'Valoracion guardada' });
  };

  const originalFetch = window.fetch.bind(window);

  window.fetch = async function (input, init) {
    const url = normalizePath(input);

    if (url.includes('/xserv-usuarios/me')) {
      return jsonResponse({ success: true, user: clone(state.user) });
    }

    if (url.includes('/xserv-usuarios/logout')) {
      state.user = null;
      saveState();
      return jsonResponse({ success: true, message: 'Sesion cerrada' });
    }

    if (url.includes('/xserv-servicios/view/') && url.endsWith('.json')) {
      const match = url.match(/\/xserv-servicios\/view\/(\d+)\.json/);
      const service = match ? state.services.find((item) => Number(item.id) === Number(match[1])) : null;
      return service
        ? jsonResponse({ xservServicio: clone(service) })
        : jsonResponse({ success: false, message: 'Servicio no encontrado' }, { status: 404 });
    }

    if (url === '/xserv-servicios.json' || url.endsWith('/xserv-servicios.json')) {
      return jsonResponse({ xservServicios: clone(state.services) });
    }

    if (url === '/xserv-reservas.json' || url.endsWith('/xserv-reservas.json')) {
      return jsonResponse(buildReservationsApi());
    }

    if (url === '/xserv-valoraciones.json' || url.endsWith('/xserv-valoraciones.json')) {
      return jsonResponse(buildRatingsApi());
    }

    if (url.includes('/xserv-reservas/my-reservations.json')) {
      return jsonResponse({ success: true, reservations: buildReservationsByCategory() });
    }

    if (url.includes('/xserv-reservas/reserva-rapida') || url.includes('/xserv-reservas/quick-reserve')) {
      return createReservation(input, init);
    }

    if (url.includes('/xserv-valoraciones/add.json')) {
      return addRating(input, init);
    }

    return originalFetch(input, init);
  };

  document.addEventListener('click', (event) => {
    const target = event.target instanceof Element ? event.target.closest('a[href*="/xserv-valoraciones/add"]') : null;
    if (!target) {
      return;
    }

    event.preventDefault();
    window.location.href = '/rateservice';
  });

  window.XSERVICIOS_DEMO = true;
})();