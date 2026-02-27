-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2026 a las 02:51:07
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `xservicios_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_asignaciones`
--

CREATE TABLE `xserv_asignaciones` (
  `id` int(11) NOT NULL,
  `reserva_id` int(11) NOT NULL,
  `chofer_id` int(11) NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `asignado_por_id` int(11) NOT NULL COMMENT 'ID del admin/operador que hizo la asignación',
  `fecha_inicio_pactada` datetime NOT NULL,
  `fecha_fin_pactada` datetime NOT NULL COMMENT 'Hora estimada de liberación del recurso',
  `estado_asignacion` enum('programada','en_curso','finalizada','cancelada') DEFAULT 'programada',
  `observaciones_chofer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_choferes`
--

CREATE TABLE `xserv_choferes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_ingreso` date NOT NULL,
  `tipo_licencia` varchar(50) DEFAULT NULL,
  `disponibilidad` enum('disponible','no_disponible','asignado') DEFAULT 'disponible',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_clientes`
--

CREATE TABLE `xserv_clientes` (
  `id` int(11) NOT NULL,
  `identificacion_fiscal` varchar(50) DEFAULT NULL COMMENT 'Cédula o Pasaporte',
  `direccion_facturacion` text DEFAULT NULL,
  `idioma_preferido` enum('es','en') DEFAULT 'es',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `xserv_clientes`
--

INSERT INTO `xserv_clientes` (`id`, `identificacion_fiscal`, `direccion_facturacion`, `idioma_preferido`, `created_at`, `updated_at`, `usuario_id`) VALUES
(1, '', '', 'es', '2026-02-26 01:38:00', '2026-02-26 01:38:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_configuraciones`
--

CREATE TABLE `xserv_configuraciones` (
  `id` int(11) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `valor` text NOT NULL,
  `tipo_dato` enum('string','numeric','json','boolean') DEFAULT 'string',
  `grupo` enum('notificaciones','tarifas','sistema','interfaz') NOT NULL,
  `descripcion_parametro` varchar(255) DEFAULT NULL,
  `editable_por_admin` tinyint(1) DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_destinos`
--

CREATE TABLE `xserv_destinos` (
  `id` int(11) NOT NULL,
  `ubicacion_id` int(11) NOT NULL,
  `descripcion_es` text NOT NULL,
  `descripcion_en` text NOT NULL,
  `es_popular` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_ejecucion_viajes`
--

CREATE TABLE `xserv_ejecucion_viajes` (
  `id` int(11) NOT NULL,
  `asignacion_id` int(11) NOT NULL,
  `hora_inicio_real` datetime DEFAULT NULL,
  `hora_fin_real` datetime DEFAULT NULL,
  `km_inicio` int(11) DEFAULT NULL,
  `km_fin` int(11) DEFAULT NULL,
  `lat_inicio` decimal(10,8) DEFAULT NULL,
  `lng_inicio` decimal(11,8) DEFAULT NULL,
  `lat_fin` decimal(10,8) DEFAULT NULL,
  `lng_fin` decimal(11,8) DEFAULT NULL,
  `estado_ejecucion` enum('en_espera','en_progreso','completado','detenido_incidencia') DEFAULT 'en_espera',
  `observaciones_finales` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_incidencias_viaje`
--

CREATE TABLE `xserv_incidencias_viaje` (
  `id` int(11) NOT NULL,
  `ejecucion_id` int(11) NOT NULL,
  `tipo_incidencia` enum('mecanica','trafico','clima','cliente','otros') NOT NULL,
  `descripcion` text NOT NULL,
  `latitud_incidencia` decimal(10,8) DEFAULT NULL,
  `longitud_incidencia` decimal(11,8) DEFAULT NULL,
  `severidad` enum('baja','media','alta','critica') DEFAULT 'baja',
  `resuelto` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_notificaciones`
--

CREATE TABLE `xserv_notificaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL COMMENT 'Referencia a xserv_usuarios si tiene cuenta',
  `cliente_id` int(11) DEFAULT NULL COMMENT 'Referencia a xserv_clientes si es externo',
  `reserva_id` int(11) DEFAULT NULL,
  `tipo_notificacion` enum('confirmacion_reserva','asignacion_chofer','actualización_estado','recordatorio') NOT NULL,
  `medio` enum('correo','whatsapp','sistema') NOT NULL,
  `destinatario` varchar(100) NOT NULL COMMENT 'Correo o Teléfono al que se envió',
  `contenido` text NOT NULL,
  `estado_envio` enum('pendiente','enviado','fallido') DEFAULT 'pendiente',
  `error_log` text DEFAULT NULL COMMENT 'Captura el error de la API si falla',
  `enviado_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `xserv_notificaciones`
--

INSERT INTO `xserv_notificaciones` (`id`, `usuario_id`, `cliente_id`, `reserva_id`, `tipo_notificacion`, `medio`, `destinatario`, `contenido`, `estado_envio`, `error_log`, `enviado_at`, `created_at`) VALUES
(1, 3, NULL, NULL, 'confirmacion_reserva', 'whatsapp', 'edwardplay25@gmail.com', 'a', 'enviado', '', NULL, '2026-02-25 06:16:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_reservas`
--

CREATE TABLE `xserv_reservas` (
  `id` int(11) NOT NULL,
  `codigo_reserva` varchar(20) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `ruta_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `pasajeros` int(11) NOT NULL,
  `precio_pactado` decimal(10,2) NOT NULL,
  `itbms_pactado` decimal(10,2) DEFAULT 0.07,
  `punto_recogida` varchar(255) NOT NULL,
  `punto_destino` varchar(255) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` enum('pendiente','confirmada','asignada','completada','cancelada') DEFAULT 'pendiente',
  `estado_pago` enum('pendiente','parcial','pagado','reembolsado') DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_rutas`
--

CREATE TABLE `xserv_rutas` (
  `id` int(11) NOT NULL,
  `origen_id` int(11) NOT NULL,
  `destino_id` int(11) NOT NULL,
  `precio_base` decimal(10,2) NOT NULL,
  `tiempo_estimado_min` int(11) DEFAULT NULL COMMENT 'Para cálculos de disponibilidad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_servicios`
--

CREATE TABLE `xserv_servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion_es` text NOT NULL,
  `descripcion_en` text NOT NULL,
  `precio_base` decimal(10,2) NOT NULL,
  `variantes` text DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `xserv_servicios`
--

INSERT INTO `xserv_servicios` (`id`, `nombre`, `descripcion_es`, `descripcion_en`, `precio_base`, `variantes`, `estado`, `created_at`, `updated_at`) VALUES
(0, 'hola', 'a', 'a', 99999999.99, 'a', 'activo', '2026-02-26 01:36:59', '2026-02-26 01:36:59'),
(1, 'Traslado Urbano', 'Traslado dentro de la ciudad con chofer profesional.', 'City transfer with a professional driver.', 25.00, NULL, 'activo', '2026-02-23 00:04:39', '2026-02-23 00:04:39'),
(2, 'Traslado Aeropuerto', 'Servicio puerta a puerta al aeropuerto.', 'Door-to-door airport service.', 45.00, NULL, 'activo', '2026-02-23 00:04:39', '2026-02-23 00:04:39'),
(3, 'Tour a la Montaña', 'Excursion guiada a destinos de montaña.', 'Guided excursion to mountain destinations.', 120.00, NULL, 'activo', '2026-02-23 00:04:39', '2026-02-23 00:04:39'),
(4, 'Transporte Corporativo', 'Servicio para eventos y viajes de empresa.', 'Corporate transport for events and business trips.', 80.00, NULL, 'activo', '2026-02-23 00:04:39', '2026-02-23 00:04:39'),
(5, 'Transporte Escolar', 'Ruta escolar segura y puntual.', 'Safe and punctual school route.', 60.00, NULL, 'activo', '2026-02-23 00:04:39', '2026-02-23 00:04:39'),
(6, 'Tour Costero', 'Recorrido por playas y puntos panoramicos.', 'Coastal tour of beaches and viewpoints.', 150.00, NULL, 'activo', '2026-02-23 00:04:39', '2026-02-23 00:04:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_servicios_destinos`
--

CREATE TABLE `xserv_servicios_destinos` (
  `servicio_id` int(11) NOT NULL,
  `destino_id` int(11) NOT NULL,
  `orden_visita` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_ubicaciones`
--

CREATE TABLE `xserv_ubicaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `EN_PROVINCIAS` enum('Chiriquí','Panamá','Coclé','Veraguas','Colón','Los Santos','Herrera','Bocas del Toro','Darién') NOT NULL,
  `direccion_gps` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_usuarios`
--

CREATE TABLE `xserv_usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','operador','chofer') NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `correo` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `identificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `xserv_usuarios`
--

INSERT INTO `xserv_usuarios` (`id`, `username`, `password`, `rol`, `estado`, `created_at`, `updated_at`, `correo`, `nombre`, `telefono`, `identificacion`) VALUES
(1, 'edward2', '$2y$10$Ji59kqS1tOmsOUuENQZTjuV70UEBmWBNxvYNCTPyNbqSlmPEyd5n6', 'operador', 'activo', '2026-02-22 21:06:59', '2026-02-26 01:43:31', 'edward@gmail.com', 'Edward Perez', '6000-0000', NULL),
(2, 'edward', '$2y$10$Xsnb68FeqX.YQfxpUJUslOdhbPxBwGmMDFqsH4WzoLcStyB9uyEN6', 'admin', 'activo', '2026-02-23 04:06:57', '2026-02-24 22:39:39', '', '', '', NULL),
(3, 'edwardchofer', '$2y$10$jPN6KyTDLoEIFxYfFGiZtOqvAhZa9c.iGApNX39SYr4YZOQrIqMKi', 'chofer', 'activo', '2026-02-24 23:14:12', '2026-02-24 23:14:12', 'edwardchofer@gmail.com', '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_valoraciones`
--

CREATE TABLE `xserv_valoraciones` (
  `id` int(11) NOT NULL,
  `reserva_id` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `puntuacion_limpieza` int(11) DEFAULT NULL,
  `puntuacion_puntualidad` int(11) DEFAULT NULL,
  `comentarios` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mostrar_en_web` tinyint(1) DEFAULT 1,
  `estado_moderacion` enum('pendiente','aprobado','rechazado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xserv_vehiculos`
--

CREATE TABLE `xserv_vehiculos` (
  `id` int(11) NOT NULL,
  `tipo` enum('coaster','bus_15') NOT NULL,
  `nombre_unidad` varchar(50) DEFAULT NULL,
  `capacidad_max` int(11) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `kilometraje_actual` int(11) DEFAULT 0,
  `estado_operativo` enum('disponible','mantenimiento','asignado') DEFAULT 'disponible',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `xserv_asignaciones`
--
ALTER TABLE `xserv_asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reserva_id` (`reserva_id`),
  ADD KEY `chofer_id` (`chofer_id`),
  ADD KEY `vehiculo_id` (`vehiculo_id`),
  ADD KEY `asignado_por_id` (`asignado_por_id`);

--
-- Indices de la tabla `xserv_clientes`
--
ALTER TABLE `xserv_clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_cliente_usuario` (`usuario_id`);

--
-- Indices de la tabla `xserv_configuraciones`
--
ALTER TABLE `xserv_configuraciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indices de la tabla `xserv_destinos`
--
ALTER TABLE `xserv_destinos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ubicacion_id` (`ubicacion_id`);

--
-- Indices de la tabla `xserv_ejecucion_viajes`
--
ALTER TABLE `xserv_ejecucion_viajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignacion_id` (`asignacion_id`);

--
-- Indices de la tabla `xserv_incidencias_viaje`
--
ALTER TABLE `xserv_incidencias_viaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ejecucion_id` (`ejecucion_id`);

--
-- Indices de la tabla `xserv_notificaciones`
--
ALTER TABLE `xserv_notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `reserva_id` (`reserva_id`);

--
-- Indices de la tabla `xserv_reservas`
--
ALTER TABLE `xserv_reservas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_reserva` (`codigo_reserva`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `servicio_id` (`servicio_id`),
  ADD KEY `fk_reserva_ruta` (`ruta_id`);

--
-- Indices de la tabla `xserv_rutas`
--
ALTER TABLE `xserv_rutas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `origen_id` (`origen_id`),
  ADD KEY `destino_id` (`destino_id`);

--
-- Indices de la tabla `xserv_servicios`
--
ALTER TABLE `xserv_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `xserv_servicios_destinos`
--
ALTER TABLE `xserv_servicios_destinos`
  ADD PRIMARY KEY (`servicio_id`,`destino_id`),
  ADD KEY `destino_id` (`destino_id`);

--
-- Indices de la tabla `xserv_ubicaciones`
--
ALTER TABLE `xserv_ubicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `xserv_usuarios`
--
ALTER TABLE `xserv_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `xserv_valoraciones`
--
ALTER TABLE `xserv_valoraciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reserva_id` (`reserva_id`);

--
-- Indices de la tabla `xserv_vehiculos`
--
ALTER TABLE `xserv_vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `xserv_asignaciones`
--
ALTER TABLE `xserv_asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `xserv_clientes`
--
ALTER TABLE `xserv_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `xserv_configuraciones`
--
ALTER TABLE `xserv_configuraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `xserv_destinos`
--
ALTER TABLE `xserv_destinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `xserv_ejecucion_viajes`
--
ALTER TABLE `xserv_ejecucion_viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `xserv_incidencias_viaje`
--
ALTER TABLE `xserv_incidencias_viaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `xserv_notificaciones`
--
ALTER TABLE `xserv_notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `xserv_reservas`
--
ALTER TABLE `xserv_reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
