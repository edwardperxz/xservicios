CREATE DATABASE IF NOT EXISTS xservicios_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE xservicios_db;

--  Tabla Usuarios (para accesos internos: admin, operador, chofer)
CREATE TABLE xserv_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  --  Hasheado
    rol ENUM('admin', 'operador', 'chofer') NOT NULL,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--  Tabla Choferes (perfil detallado, FK a usuarios si rol=chofer)
CREATE TABLE xserv_choferes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,  --  Opcional, si chofer tiene login
    nombre VARCHAR(100) NOT NULL,
    identificacion VARCHAR(50) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL,
    correo VARCHAR(100) NULL,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_ingreso DATE NOT NULL,
    tipo_licencia VARCHAR(50) NULL,
    disponibilidad ENUM('disponible', 'no_disponible', 'asignado') DEFAULT 'disponible',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES xserv_usuarios(id) ON DELETE SET NULL
);

--  Tabla Vehiculos (flota)
CREATE TABLE xserv_vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('coaster', 'bus_15') NOT NULL,
    nombre_unidad VARCHAR(50),
    capacidad_max INT NOT NULL,
    placa VARCHAR(20) NOT NULL UNIQUE,
    anio INT,
    kilometraje_actual INT DEFAULT 0,
    estado_operativo ENUM('disponible', 'mantenimiento', 'asignado') DEFAULT 'disponible',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--  Tabla Servicios (catálogo parametrizable)
CREATE TABLE xserv_servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion_es TEXT NOT NULL,
    descripcion_en TEXT NOT NULL,
    precio_base DECIMAL(10,2) NOT NULL,
    variantes TEXT NULL,  --  JSON o comma-separated para "con/sin taxi acuático"
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Ubicaciones físicas (Crucial para aeropuertos y hoteles)
CREATE TABLE IF NOT EXISTS xserv_ubicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL, --  Ej: 'Aeropuerto Internacional de Tocumen (PTY)'
    EN_PROVINCIAS ENUM('Chiriquí', 'Panamá', 'Coclé', 'Veraguas', 'Colón', 'Los Santos', 'Herrera', 'Bocas del Toro', 'Darién') NOT NULL,
    direccion_gps VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--  tabla Destinos para que sea una "extensión" de Ubicaciones
CREATE TABLE xserv_destinos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ubicacion_id INT NOT NULL, --  La "llave" que une ambos mundos
    descripcion_es TEXT NOT NULL,
    descripcion_en TEXT NOT NULL,
    es_popular TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ubicacion_id) REFERENCES xserv_ubicaciones(id) ON DELETE CASCADE
);

--  La tabla intermedia ahora tiene mucho más sentido

CREATE TABLE xserv_servicios_destinos (
    servicio_id INT NOT NULL,
    destino_id INT NOT NULL,
    orden_visita INT DEFAULT 1, --  Importante para el itinerario del chofer
    PRIMARY KEY (servicio_id, destino_id),
    FOREIGN KEY (servicio_id) REFERENCES xserv_servicios(id) ON DELETE CASCADE,
    FOREIGN KEY (destino_id) REFERENCES xserv_destinos(id) ON DELETE CASCADE
);

--  Rutas y Precios (Relaciona origen-destino con costo)
CREATE TABLE IF NOT EXISTS xserv_rutas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    origen_id INT NOT NULL,
    destino_id INT NOT NULL,
    precio_base DECIMAL(10,2) NOT NULL,
    tiempo_estimado_min INT COMMENT 'Para cálculos de disponibilidad',
    FOREIGN KEY (origen_id) REFERENCES xserv_ubicaciones(id),
    FOREIGN KEY (destino_id) REFERENCES xserv_ubicaciones(id)
);

--  Tabla clientes Original
CREATE TABLE xserv_clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    idioma_preferido ENUM('es', 'en') DEFAULT 'es',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--  Ajustes realizados posteriormente para facturación
ALTER TABLE xserv_clientes 
    ADD COLUMN identificacion_fiscal VARCHAR(50) NULL COMMENT 'Cédula o Pasaporte' AFTER nombre,
    ADD COLUMN direccion_facturacion TEXT NULL AFTER telefono;

--  Tabla reservas (nucleo del sistema)
CREATE TABLE xserv_reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    servicio_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    pasajeros INT NOT NULL,
    punto_recogida VARCHAR(255) NOT NULL,
    punto_destino VARCHAR(255) NOT NULL,
    observaciones TEXT NULL,
    estado ENUM('pendiente', 'confirmada', 'asignada', 'completada', 'cancelada') DEFAULT 'pendiente',
    chofer_id INT NULL,
    vehiculo_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES xserv_clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (servicio_id) REFERENCES xserv_servicios(id) ON DELETE RESTRICT,
    FOREIGN KEY (chofer_id) REFERENCES xserv_choferes(id) ON DELETE SET NULL,
    FOREIGN KEY (vehiculo_id) REFERENCES xserv_vehiculos(id) ON DELETE SET NULL
);

--  Ajuste CRÍTICO en Reservas: Integridad de Precios y Trazabilidad
--  Añadimos código de reserva único para el cliente (Ej: XSERV-1025)
ALTER TABLE xserv_reservas 
    ADD COLUMN codigo_reserva VARCHAR(20) UNIQUE NOT NULL AFTER id,
    ADD COLUMN ruta_id INT NULL AFTER servicio_id,
    ADD COLUMN precio_pactado DECIMAL(10,2) NOT NULL AFTER pasajeros,
    ADD COLUMN itbms_pactado DECIMAL(10,2) DEFAULT 0.07 AFTER precio_pactado,
    ADD COLUMN estado_pago ENUM('pendiente', 'parcial', 'pagado', 'reembolsado') DEFAULT 'pendiente' AFTER estado,
    ADD CONSTRAINT fk_reserva_ruta FOREIGN KEY (ruta_id) REFERENCES xserv_rutas(id);
--  Tabla Valoraciones
CREATE TABLE xserv_valoraciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reserva_id INT NOT NULL UNIQUE,
    calificacion INT NOT NULL CHECK (calificacion BETWEEN 1 AND 5),
    comentarios TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reserva_id) REFERENCES xserv_reservas(id) ON DELETE CASCADE
);


--  AJUSTE EN VERIFICACIÓN DE FUNCIONALIDAD - SE ESTABLECERÁ TABLA DE ASIGNACIONES, SE MODIFICA TABLA DE RESERVAS PARA EVITAR REDUNDANCIAS
ALTER TABLE xserv_reservas DROP FOREIGN KEY xserv_reservas_ibfk_3; --  FK a choferes
ALTER TABLE xserv_reservas DROP FOREIGN KEY xserv_reservas_ibfk_4; --  FK a vehiculos
ALTER TABLE xserv_reservas 
    DROP COLUMN chofer_id,
    DROP COLUMN vehiculo_id;

-- TABLA DE ASIGNACIONES (EL SCHEDULER)
CREATE TABLE IF NOT EXISTS xserv_asignaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reserva_id INT NOT NULL,
    chofer_id INT NOT NULL,
    vehiculo_id INT NOT NULL,
    asignado_por_id INT NOT NULL COMMENT 'ID del admin/operador que hizo la asignación',
    --  Tiempos operativos (Crucial para el tráfico de la Interamericana)
    fecha_inicio_pactada DATETIME NOT NULL,
    fecha_fin_pactada DATETIME NOT NULL COMMENT 'Hora estimada de liberación del recurso',
    estado_asignacion ENUM('programada', 'en_curso', 'finalizada', 'cancelada') DEFAULT 'programada',
    observaciones_chofer TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (reserva_id) REFERENCES xserv_reservas(id) ON DELETE CASCADE,
    FOREIGN KEY (chofer_id) REFERENCES xserv_choferes(id) ON DELETE RESTRICT,
    FOREIGN KEY (vehiculo_id) REFERENCES xserv_vehiculos(id) ON DELETE RESTRICT,
    FOREIGN KEY (asignado_por_id) REFERENCES xserv_usuarios(id) ON DELETE RESTRICT
);

-- AJUSTES EN VALORACIONES 
ALTER TABLE xserv_valoraciones 
    --  Añadimos anonimato opcional por si el cliente no quiere que su nombre salga en la web
    ADD COLUMN mostrar_en_web TINYINT(1) DEFAULT 1 AFTER comentarios,
    --  Estado de moderación (Vital para un sitio bilingüe de lujo)
    ADD COLUMN estado_moderacion ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente' AFTER mostrar_en_web,
    --  Campos de métricas específicas (Opcional, pero recomendado por el cliente)
    ADD COLUMN puntuacion_limpieza INT CHECK (puntuacion_limpieza BETWEEN 1 AND 5) AFTER calificacion,
    ADD COLUMN puntuacion_puntualidad INT CHECK (puntuacion_puntualidad BETWEEN 1 AND 5) AFTER puntuacion_limpieza;
--  Aseguramos que la fecha sea la de creación del registro


-- TABLAS DE HISTORIALES 

-- Bitacora general de viajes
CREATE TABLE xserv_ejecucion_viajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asignacion_id INT NOT NULL,
    --  Tiempos Reales (Diferentes a los pactados)
    hora_inicio_real DATETIME NULL,
    hora_fin_real DATETIME NULL,
    --  Control de Odómetro (Vital para mantenimiento en Panamá
    km_inicio INT NULL,
    km_fin INT NULL,
    --  Geolocalización (Puntos clave)
    lat_inicio DECIMAL(10, 8) NULL,
    lng_inicio DECIMAL(11, 8) NULL,
    lat_fin DECIMAL(10, 8) NULL,
    lng_fin DECIMAL(11, 8) NULL,
    estado_ejecucion ENUM('en_espera', 'en_progreso', 'completado', 'detenido_incidencia') DEFAULT 'en_espera',
    observaciones_finales TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (asignacion_id) REFERENCES xserv_asignaciones(id) ON DELETE CASCADE
);

-- Bitacora de Incidencias
CREATE TABLE xserv_incidencias_viaje (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ejecucion_id INT NOT NULL,
    tipo_incidencia ENUM('mecanica', 'trafico', 'clima', 'cliente', 'otros') NOT NULL,
    descripcion TEXT NOT NULL,
    latitud_incidencia DECIMAL(10, 8) NULL,
    longitud_incidencia DECIMAL(11, 8) NULL,
    severidad ENUM('baja', 'media', 'alta', 'critica') DEFAULT 'baja',
    resuelto TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ejecucion_id) REFERENCES xserv_ejecucion_viajes(id) ON DELETE CASCADE
);

-- Tabla de notificaciones
CREATE TABLE xserv_notificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    --  A quién se le envió (puede ser cliente o empleado)
    usuario_id INT NULL COMMENT 'Referencia a xserv_usuarios si tiene cuenta',
    cliente_id INT NULL COMMENT 'Referencia a xserv_clientes si es externo',
    --  El contexto (opcional, para saber de qué trata)
    reserva_id INT NULL,
    tipo_notificacion ENUM('confirmacion_reserva', 'asignacion_chofer', 'actualización_estado', 'recordatorio') NOT NULL,
    medio ENUM('correo', 'whatsapp', 'sistema') NOT NULL,
    destinatario VARCHAR(100) NOT NULL COMMENT 'Correo o Teléfono al que se envió',
    contenido TEXT NOT NULL,
    --  Trazabilidad de entrega
    estado_envio ENUM('pendiente', 'enviado', 'fallido') DEFAULT 'pendiente',
    error_log TEXT NULL COMMENT 'Captura el error de la API si falla',
    enviado_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES xserv_usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (cliente_id) REFERENCES xserv_clientes(id) ON DELETE SET NULL,
    FOREIGN KEY (reserva_id) REFERENCES xserv_reservas(id) ON DELETE CASCADE
);

--  Tabla de Configuraciones OPTIMIZADA
CREATE TABLE IF NOT EXISTS xserv_configuraciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(100) NOT NULL UNIQUE, 
    valor TEXT NOT NULL,
    tipo_dato ENUM('string', 'numeric', 'json', 'boolean') DEFAULT 'string',
    grupo ENUM('notificaciones', 'tarifas', 'sistema', 'interfaz') NOT NULL,
    descripcion_parametro VARCHAR(255), --  Para que el admin sepa qué está editando
    editable_por_admin TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


--  Para búsquedas operativas (Ej: ¿Qué viajes hay hoy y en qué estado?)
CREATE INDEX idx_reservas_operativo ON xserv_reservas(fecha, estado);

--  Para el Login y Seguridad (CakePHP busca por username)
CREATE INDEX idx_usuarios_auth ON xserv_usuarios(username, estado);

--  Para el historial de viajes (Optimiza la vista del Chofer)
CREATE INDEX idx_asignaciones_chofer_estado ON xserv_asignaciones(chofer_id, estado_asignacion);

--  Tu índice de tiempo (Mantenlo, es perfecto)
CREATE INDEX idx_agenda_tiempo ON xserv_asignaciones (fecha_inicio_pactada, fecha_fin_pactada);

--  Para la búsqueda de clientes (Por cédula/pasaporte o correo)
CREATE INDEX idx_clientes_id_fiscal ON xserv_clientes(identificacion_fiscal);
