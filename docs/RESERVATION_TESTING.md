# Reservation Testing Scenarios

## Escenarios de Prueba del Flujo de Reservas

Guía completa para probar el ciclo de vida de una reserva en el sistema.

---

## Fase 1: Creación de Reserva

El cliente registra su intención de compra.

### Setup Inicial

```sql
-- 1. Configuraciones del sistema
INSERT INTO xserv_configuraciones (clave, valor, tipo_dato, grupo) VALUES
('porcentaje_itbms', '0.07', 'numeric', 'tarifas'),
('tiempo_confirmacion_min', '2', 'numeric', 'reservas');

-- 2. Cliente
INSERT INTO xserv_clientes (nombre, identificacion_fiscal, correo, telefono) VALUES
('John Doe', 'N-12345', 'john@email.com', '+1-555-1234');
-- Obtén ID: 1

-- 3. Servicio
INSERT INTO xserv_servicios (nombre, descripcion, precio_base) VALUES
('Tour Boquete', 'Visit to coffee farms', 120.00);
-- Obtén ID: 1

-- 4. Crear Reserva
INSERT INTO xserv_reservas (codigo_reserva, cliente_id, servicio_id, fecha, hora, pasajeros, precio_pactado, punto_recogida, punto_destino) 
VALUES ('XSERV-2026-001', 1, 1, '2026-03-15', '09:00:00', 4, 120.00, 'Hotel Central', 'Finca Lérida');
-- Obtén ID: 1
```

### Verificación

```sql
SELECT * FROM xserv_reservas WHERE codigo_reserva = 'XSERV-2026-001';
```

**Resultado esperado:**
- ✅ Código de reserva único
- ✅ Cliente asociado
- ✅ Servicio asociado
- ✅ Precio pactado guardado
- ✅ Fecha y hora confirmadas

---

## Fase 2: Asignación Logística

El operador asigna chofer y vehículo.

### Setup

```sql
-- 1. Chofer
INSERT INTO xserv_choferes (usuario_id, nombre, identificacion, telefono) VALUES
(2, 'Juan Pérez', '4-888-999', '6666-0000');
-- Obtén ID: 1

-- 2. Vehículo
INSERT INTO xserv_vehiculos (nombre_unidad, tipo, capacidad_max, placa, estado_operativo) VALUES
('Bus VIP 01', 'bus_25', 25, 'AV1234', 'disponible');
-- Obtén ID: 1

-- 3. Asignación
INSERT INTO xserv_asignaciones (reserva_id, chofer_id, vehiculo_id, asignado_por_id, fecha_inicio_pactada, fecha_fin_pactada, estado_asignacion)
VALUES (1, 1, 1, 1, '2026-03-15 08:30:00', '2026-03-15 13:00:00', 'programada');
-- Obtén ID: 1
```

### Verificación

```sql
SELECT 
    r.codigo_reserva,
    c.nombre AS cliente,
    ch.nombre AS chofer,
    v.nombre_unidad AS vehiculo,
    a.fecha_inicio_pactada
FROM xserv_asignaciones a
JOIN xserv_reservas r ON a.reserva_id = r.id
JOIN xserv_choferes ch ON a.chofer_id = ch.id
JOIN xserv_vehiculos v ON a.vehiculo_id = v.id
WHERE r.codigo_reserva = 'XSERV-2026-001';
```

**Resultado esperado:**
- ✅ Chofer asignado
- ✅ Vehículo asignado
- ✅ Horarios pactados
- ✅ Estado = 'programada'

---

## Fase 3: Ejecución del Viaje

El chofer inicia y completa el viaje.

### Inicio

```sql
-- Crear registro de ejecución (Importante: ANTES de incidencias)
INSERT INTO xserv_ejecucion_viajes (asignacion_id, estado_ejecucion)
VALUES (1, 'en_espera');
-- Obtén ID: 1

-- Chofer marca INICIO
UPDATE xserv_ejecucion_viajes 
SET hora_inicio_real = '2026-03-15 08:45:00',
    km_inicio = 45020,
    estado_ejecucion = 'en_progreso'
WHERE asignacion_id = 1;
```

### Si Hay Incidencia

```sql
-- Registrar problema durante el viaje
INSERT INTO xserv_incidencias_viaje (ejecucion_id, tipo_incidencia, descripcion, severidad, latitud_incidencia, longitud_incidencia)
VALUES (
    (SELECT id FROM xserv_ejecucion_viajes WHERE asignacion_id = 1),
    'trafico',
    'Cierre de ruta por mantenimiento en Boquete',
    'media',
    8.7780,
    -82.4340
);
```

### Finalización

```sql
-- Chofer completa el viaje
UPDATE xserv_ejecucion_viajes 
SET hora_fin_real = '2026-03-15 14:15:00',
    km_fin = 45085,
    estado_ejecucion = 'completado'
WHERE asignacion_id = 1;
```

### Verificación

```sql
SELECT 
    r.codigo_reserva,
    a.fecha_fin_pactada AS 'Hora Pactada',
    e.hora_fin_real AS 'Hora Real',
    SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.fecha_fin_pactada, e.hora_fin_real)) AS 'Retraso',
    (e.km_fin - e.km_inicio) AS 'KM Recorridos',
    i.descripcion AS 'Incidencia'
FROM xserv_reservas r
JOIN xserv_asignaciones a ON r.id = a.reserva_id
JOIN xserv_ejecucion_viajes e ON a.id = e.asignacion_id
LEFT JOIN xserv_incidencias_viaje i ON e.id = i.ejecucion_id
WHERE r.codigo_reserva = 'XSERV-2026-001';
```

**Resultado esperado:**
- ✅ Hora de inicio real registrada
- ✅ Hora de finalización real
- ✅ Kilometraje completo
- ✅ Incidencia documentada (si aplica)
- ✅ Estado = 'completado'

---

## Fase 4: Valoración del Cliente

El cliente califica el servicio.

### Inserción

```sql
INSERT INTO xserv_valoraciones (reserva_id, calificacion, puntuacion_limpieza, puntuacion_puntualidad, comentarios, mostrar_en_web, estado_moderacion)
VALUES (
    (SELECT id FROM xserv_reservas WHERE codigo_reserva = 'XSERV-2026-001'),
    5,          -- Calificación general
    5,          -- Limpieza
    4,          -- Puntualidad (retraso por tráfico)
    'Excelente servicio!',
    1,          -- Mostrar en web
    'aprobado'  -- Pre-aprobado
);
```

### Verificación Completa

```sql
SELECT 
    r.codigo_reserva,
    c.nombre AS Cliente,
    ch.nombre AS Chofer,
    v.nombre_unidad AS Vehiculo,
    s.nombre AS Servicio,
    e.estado_ejecucion AS 'Estado Final',
    vlr.calificacion AS 'Estrellas',
    vlr.puntuacion_limpieza AS 'Limpieza',
    vlr.puntuacion_puntualidad AS 'Puntualidad',
    vlr.comentarios AS 'Feedback'
FROM xserv_reservas r
JOIN xserv_clientes c ON r.cliente_id = c.id
JOIN xserv_asignaciones a ON r.id = a.reserva_id
JOIN xserv_choferes ch ON a.chofer_id = ch.id
JOIN xserv_vehiculos v ON a.vehiculo_id = v.id
JOIN xserv_servicios s ON r.servicio_id = s.id
JOIN xserv_ejecucion_viajes e ON a.id = e.asignacion_id
LEFT JOIN xserv_valoraciones vlr ON r.id = vlr.reserva_id
WHERE r.codigo_reserva = 'XSERV-2026-001';
```

**Resultado esperado:**
- ✅ Ciclo completo de reserva
- ✅ Todas las etapas documentadas
- ✅ Auditoría: pactado vs real
- ✅ Feedback del cliente
- ✅ Disponible para estadísticas

---

## Flujo de Validación Integral

Verifica que NO haya conflictos:

### Test 1: Doble Asignación

```sql
-- Intenta asignar el mismo vehículo en mismo horario
-- DEBE FALLAR ❌

INSERT INTO xserv_asignaciones (reserva_id, chofer_id, vehiculo_id, asignado_por_id, 
                                 fecha_inicio_pactada, fecha_fin_pactada)
VALUES (2, 2, 1, 1, '2026-03-15 10:00:00', '2026-03-15 12:00:00');
-- Error esperado: Vehículo no disponible
```

### Test 2: Cambio Last-Minute

```sql
-- El operador cambia chofer sin alterar reserva
-- DEBE FUNCIONAR ✅

UPDATE xserv_asignaciones 
SET chofer_id = 3, 
    fecha_actualizacion = NOW()
WHERE id = 1 AND estado_asignacion = 'programada';

-- Verifica que reserva original sigue igual
SELECT * FROM xserv_reservas WHERE id = 1;
```

### Test 3: Cancelación

```sql
-- Cancelar reserva
UPDATE xserv_reservas 
SET estado = 'cancelada'
WHERE codigo_reserva = 'XSERV-2026-001';

-- Liberar recursos
UPDATE xserv_asignaciones 
SET estado_asignacion = 'cancelada'
WHERE reserva_id = 1;
```

---

## Checklist de Pruebas

- [ ] Reserva creada correctamente
- [ ] Asignación de chofer y vehículo
- [ ] Chofer puede ver detalles
- [ ] Inicio de viaje registrado
- [ ] Incidencias se registran con GPS
- [ ] Final de viaje registrado
- [ ] Comparación pactado vs real
- [ ] Valoración registrada
- [ ] Datos disponibles para reportes
- [ ] Auditoría completa del ciclo

---

## Base de Datos Test

Población inicial recomendada:

```bash
# Crear datos de prueba
mysql xservicios_db < test_setup.sql

# Verificar estado
mysql -e "SELECT COUNT(*) as Reservas FROM xservicios_db.xserv_reservas;"
```

---

**Última actualización**: Marzo 2, 2026
