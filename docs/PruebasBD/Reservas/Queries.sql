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


