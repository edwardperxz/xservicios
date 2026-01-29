-- ==========================================================
-- ESTRATEGIA DE INDEXACIÓN PARA XSERVICIOS CHIRIQUÍ
-- ==========================================================

-- 1. Optimización para el Módulo de Autenticación (Login rápido)
CREATE INDEX idx_usuarios_auth ON xserv_usuarios(username, estado);

-- 2. Índices de Llaves Foráneas (Vital para los JOINs de CakePHP)
-- El ORM de CakePHP usa 'contain' constantemente, estos índices son obligatorios.
CREATE INDEX idx_fk_chofer_usuario ON xserv_choferes(usuario_id);
CREATE INDEX idx_fk_reserva_cliente ON xserv_reservas(cliente_id);
CREATE INDEX idx_fk_reserva_servicio ON xserv_reservas(servicio_id);
CREATE INDEX idx_fk_asignacion_reserva ON xserv_asignaciones(reserva_id);
CREATE INDEX idx_fk_ejecucion_asignacion ON xserv_ejecucion_viajes(asignacion_id);

-- 3. Índices de Búsqueda Operativa (Filtros del Administrador)
-- Optimiza la búsqueda de reservas por fecha y su estado actual.
CREATE INDEX idx_reservas_reportes ON xserv_reservas(fecha, estado);

-- 4. Índices de Disponibilidad y Tiempo (El Calendario)
-- Este es el más importante para evitar colisiones de horario.
CREATE INDEX idx_agenda_operativa ON xserv_asignaciones(fecha_inicio_pactada, fecha_fin_pactada);

-- 5. Búsqueda de Clientes y Auditoría
CREATE INDEX idx_clientes_busqueda ON xserv_clientes(identificacion_fiscal, correo);

-- Optimizando la búsqueda por vehículo (Historial de unidad)
CREATE INDEX idx_fk_asignacion_vehiculo ON xserv_asignaciones(vehiculo_id);

-- Optimizando la búsqueda por chofer (Agenda del empleado)
-- Nota: Ya lo teníamos, pero lo reforzamos para cumplir el punto exacto de "driver_id"
CREATE INDEX idx_fk_asignacion_chofer ON xserv_asignaciones(chofer_id);