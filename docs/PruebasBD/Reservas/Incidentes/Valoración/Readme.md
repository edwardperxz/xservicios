# Documentación de Pruebas de Funcionalidad: Ciclo de Vida del Servicio

## Fase 1: Configuración y Reserva (El Origen)

En esta etapa, el sistema utiliza las tablas de catálogo y configuración para registrar la intención de compra del cliente.

### Tablas involucradas

- `xserv_clientes`
- `xserv_servicios`
- `xserv_reservas`

### Funcionalidad

Se crea un registro único con un `codigo_reserva` (XSERV-1001). El sistema separa el precio base del precio pactado para proteger la rentabilidad si los precios suben a futuro.

### Resultado

Se crea un registro único con un `codigo_reserva` (XSERV-1001). El sistema separa el precio base del precio pactado para proteger la rentabilidad si los precios suben a futuro.

## Tour de Café y un Traslado al Aeropuerto

```sql
-- 1. Configuraciones Básicas
INSERT INTO xserv_configuraciones (clave, valor, tipo_dato, grupo, descripcion_parametro) VALUES
('porcentaje_itbms', '0.07', 'numeric', 'tarifas', 'Impuesto de transferencia'),
('whatsapp_template_confirmacion', 'Hola {cliente}, su reserva {codigo} está confirmada.', 'string', 'notificaciones', 'Plantilla de WhatsApp');

-- 2. Usuarios y Personal (Un Admin y un Chofer)
INSERT INTO xserv_usuarios (username, password, rol, estado) VALUES
('admin_chiriqui', 'hash_secure_123', 'admin', 'activo'),
('chofer_juan', 'hash_secure_456', 'chofer', 'activo');

INSERT INTO xserv_choferes (usuario_id, nombre, identificacion, telefono, correo, fecha_ingreso) VALUES
(2, 'Juan Pérez', '4-777-888', '+507 6666-0000', 'juan@xservicios.com', '2024-01-15');

-- 3. Vehículos (La flota de 4 que mencionó el cliente)
INSERT INTO xserv_vehiculos (nombre_unidad, tipo, capacidad_max, placa, estado_operativo) VALUES
('Coaster VIP 01', 'coaster', 25, 'BC1234', 'disponible'),
('Van Lujo 01', 'bus_15', 15, 'AV5678', 'disponible');

-- 4. Ubicaciones y Destinos (Geografía de Chiriquí)
INSERT INTO xserv_ubicaciones (nombre, EN_PROVINCIAS, direccion_gps) VALUES
('Aeropuerto Enrique Malek (DAV)', 'Chiriquí', '8.3916,-82.4351'),
('Boquete Centro', 'Chiriquí', '8.7712,-82.4331'),
('Finca Lérida', 'Chiriquí', '8.8145,-82.4689');

INSERT INTO xserv_destinos (ubicacion_id, descripcion_es, descripcion_en, es_popular) VALUES
(3, 'Tour de café histórico y catación.', 'Historic coffee tour and tasting.', 1);

-- 5. Catálogo de Servicios
INSERT INTO xserv_servicios (nombre, descripcion_es, descripcion_en, precio_base) VALUES
('Traslado Aeropuerto-Hotel', 'Transporte privado desde DAV.', 'Private transport from DAV.', 45.00),
('Tour de Altura Boquete', 'Visita a fincas y miradores.', 'Visit to farms and viewpoints.', 120.00);

-- Relacionar el Tour con su Destino (Itinerario)
INSERT INTO xserv_servicios_destinos (servicio_id, destino_id, orden_visita) VALUES
(2, 1, 1); -- El Tour de Altura visita Finca Lérida primero

-- 6. El Cliente
INSERT INTO xserv_clientes (nombre, identificacion_fiscal, correo, telefono, idioma_preferido) VALUES
('John Doe', 'N-22-12345', 'j.doe@email.com', '+1 555-999', 'en');

-- 7. La Reserva (El evento detonante)
INSERT INTO xserv_reservas (codigo_reserva, cliente_id, servicio_id, fecha, hora, pasajeros, precio_pactado, punto_recogida, punto_destino) VALUES
('XSERV-1001', 1, 2, '2026-02-10', '09:00:00', 4, 120.00, 'Hotel Panamonte', 'Finca Lérida');

-- 8. La Asignación (Logística)
INSERT INTO xserv_asignaciones (reserva_id, chofer_id, vehiculo_id, asignado_por_id, fecha_inicio_pactada, fecha_fin_pactada) VALUES
(1, 1, 2, 1, '2026-02-10 08:30:00', '2026-02-10 13:00:00');

```

## Prueba Operativa

El chofer verifica la información desde el app

```sql
SELECT
    r.codigo_reserva,
    c.nombre AS cliente,
    v.nombre_unidad AS vehiculo,
    s.nombre AS servicio,
    a.fecha_inicio_pactada AS 'Hora de Salida',
    d.descripcion_es AS 'Destino a visitar'
FROM xserv_asignaciones a
JOIN xserv_reservas r ON a.reserva_id = r.id
JOIN xserv_clientes c ON r.cliente_id = c.id
JOIN xserv_vehiculos v ON a.vehiculo_id = v.id
JOIN xserv_servicios s ON r.servicio_id = s.id
LEFT JOIN xserv_servicios_destinos sd ON s.id = sd.servicio_id
LEFT JOIN xserv_destinos d ON sd.destino_id = d.id
WHERE a.chofer_id = 1 AND a.estado_asignacion = 'programada';
```

## Qué se genera:

- Integridad: El sistema sabe que Juan Pérez (chofer) tiene una asignación para John Doe (cliente).

- Sinergia: El servicio "Tour de Altura" jaló automáticamente la descripción del destino "Finca Lérida" a través de la tabla intermedia.

- Disponibilidad: Si intentaras insertar otra asignación para el mismo vehículo en ese horario, tu lógica de backend (que definimos antes) daría error.

## Fase 2: Planificación Logística (Asignación)

Aquí es donde el operador de Chiriquí decide quién y qué vehículo hará el trabajo.

### Tablas involucradas

- `xserv_asignaciones`
- `xserv_choferes`
- `xserv_vehiculos`

### Funcionalidad

Se desacopla la reserva de la operación. La tabla asignaciones actúa como un scheduler.

**Punto clave para el PM:** Permite cambiar al chofer o el bus a último minuto sin alterar la reserva original del cliente, manteniendo la integridad del contrato.

```sql
-- 1. CREAR el registro de ejecución primero (esto genera el id = 1)
-- Nota: Asegúrate de que la asignacion_id = 1 exista realmente.
INSERT INTO xserv_ejecucion_viajes (asignacion_id, estado_ejecucion) 
VALUES (1, 'en_espera');

-- 2. Ahora que ya existe el registro, el chofer marca el INICIO
UPDATE xserv_ejecucion_viajes 
SET hora_inicio_real = NOW(), 
    km_inicio = 45020, 
    estado_ejecucion = 'en_progreso'
WHERE asignacion_id = 1;

-- 3. ¡AHORA SÍ! Registramos la INCIDENCIA vinculada a esa ejecución
-- Usamos (SELECT id FROM xserv_ejecucion_viajes WHERE asignacion_id = 1) 
-- para asegurar que traemos el ID correcto.
INSERT INTO xserv_incidencias_viaje (ejecucion_id, tipo_incidencia, descripcion, severidad, latitud_incidencia, longitud_incidencia)
VALUES (
    (SELECT id FROM xserv_ejecucion_viajes WHERE asignacion_id = 1 LIMIT 1), 
    'trafico', 
    'Cierre de vía por mantenimiento en Bajo Boquete.', 
    'media', 
    8.7780, 
    -82.4340
);
```

## Fase 3: Ejecución y Bitácora "Caja Negra"

Esta es la fase de auditoría operativa en tiempo real.

### Tablas involucradas

- `xserv_ejecucion_viajes`

### Funcionalidad

Al iniciar el viaje, se crea la "hoja de ruta real". Se capturan los kilómetros iniciales y la hora exacta.

**Auditoría:** Esto permite comparar lo que planeamos (pactado) vs. lo que realmente ocurrió (real).

```sql

UPDATE xserv_ejecucion_viajes 
SET hora_fin_real = '2026-02-10 14:15:00', -- Simulamos que llegó a esta hora
    km_fin = 45085,                         -- Simulamos kilometraje final
    estado_ejecucion = 'completado'
WHERE asignacion_id = 1;
```

## Fase 4: Gestión de Crisis (Incidencias)

El sistema está preparado para la realidad de las carreteras panameñas.

### Tablas involucradas

- `xserv_incidencias_viaje`

### Funcionalidad

Ante un evento externo (tráfico en Boquete), se registra una incidencia vinculada a la ejecución.

**Valor para el PM:** Proporciona pruebas documentales (descripción y GPS) que justifican retrasos ante el cliente o el seguro, evitando penalizaciones injustas al chofer.

```sql
SELECT 
    r.codigo_reserva,
    a.fecha_fin_pactada AS 'Hora Pactada',
    e.hora_fin_real AS 'Hora Real Llegada',
    TIMEDIFF(e.hora_fin_real, a.fecha_fin_pactada) AS 'Retraso Total',
    i.descripcion AS 'Motivo del Retraso',
    (e.km_fin - e.km_inicio) AS 'Kilómetros Recorridos'
FROM xserv_reservas r
JOIN xserv_asignaciones a ON r.id = a.reserva_id
JOIN xserv_ejecucion_viajes e ON a.id = e.asignacion_id
LEFT JOIN xserv_incidencias_viaje i ON e.id = i.ejecucion_id
WHERE r.codigo_reserva = 'XSERV-1001';
```


## Fase 5: Cierre y Control de Calidad (Valoración)

El ciclo se cierra cuando el servicio termina y el cliente da su veredicto.

### Tablas involucradas

- `xserv_valoraciones`

### Funcionalidad

El cliente califica no solo el servicio general, sino puntos específicos como la limpieza.

```sql
INSERT INTO xserv_valoraciones (
    reserva_id, 
    calificacion, 
    puntuacion_limpieza, 
    puntuacion_puntualidad, 
    comentarios, 
    mostrar_en_web, 
    estado_moderacion
) VALUES (
    (SELECT id FROM xserv_reservas WHERE codigo_reserva = 'XSERV-1001'), 
    5, -- Calificación general
    5, -- Limpieza
    4, -- Puntualidad (le pusimos 4 por el retraso en la vía)
    'Excellent service! Even with the road closure, the driver was professional and the bus was spotless.', 
    1, -- Permitir mostrar en la web
    'aprobado' -- El admin ya lo revisó y aprobó
);
```

**Sinergia de Marketplace:** Las valoraciones aprobadas alimentan automáticamente la reputación de los servicios en la web bilingüe, permitiendo un marketing basado en testimonios reales.

```sql
SELECT 
    r.codigo_reserva,
    c.nombre AS Cliente,
    ch.nombre AS Chofer,
    v.nombre_unidad AS Vehiculo,
    e.estado_ejecucion AS 'Estado Final',
    vlr.calificacion AS 'Estrellas',
    vlr.comentarios AS 'Feedback Cliente',
    i.tipo_incidencia AS 'Incidencia Reportada'
FROM xserv_reservas r
JOIN xserv_clientes c ON r.cliente_id = c.id
JOIN xserv_asignaciones a ON r.id = a.reserva_id
JOIN xserv_choferes ch ON a.chofer_id = ch.id
JOIN xserv_vehiculos v ON a.vehiculo_id = v.id
JOIN xserv_ejecucion_viajes e ON a.id = e.asignacion_id
LEFT JOIN xserv_incidencias_viaje i ON e.id = i.ejecucion_id
LEFT JOIN xserv_valoraciones vlr ON r.id = vlr.reserva_id
WHERE r.codigo_reserva = 'XSERV-1001';
```

