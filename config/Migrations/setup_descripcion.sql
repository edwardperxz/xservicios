-- Agregar campo descripcion a xserv_servicios si no existe
ALTER TABLE xserv_servicios ADD COLUMN IF NOT EXISTS descripcion TEXT NULL COMMENT 'Descripción en español (traducible con i18n)' AFTER nombre;

-- Verificar estructura
DESCRIBE xserv_servicios;

-- Agregar descripciones en español de ejemplo a los servicios existentes
UPDATE xserv_servicios SET descripcion = 'Servicio de traslado desde la ciudad de David hasta el pueblo de Boquete. Transporte cómodo y seguro con choferes experimentados.' WHERE id = 1 AND descripcion IS NULL;

UPDATE xserv_servicios SET descripcion = 'Tour por plantaciones de café en las alturas de Boquete. Aprende sobre el proceso de producción desde la semilla hasta la taza. Incluye degustación de café premium.' WHERE id = 2 AND descripcion IS NULL;

UPDATE xserv_servicios SET descripcion = 'Ascenso al Volcán Barú en vehículo 4x4 hasta el punto más alto de Panamá. Vistas espectaculares de ambos océanos. Opciones de amanecer o nocturno disponibles.' WHERE id = 3 AND descripcion IS NULL;

UPDATE xserv_servicios SET descripcion = 'Tour relajante a las aguas termales de Caldera. Aguas termales naturales rodeadas de naturaleza tropical. Perfecto para desconectar y relajarse.' WHERE id = 4 AND descripcion IS NULL;

UPDATE xserv_servicios SET descripcion = 'Tour a la playa Las Lajas, una de las playas más largas de Centroamérica. Aguas cristalinas y arena blanca. Disfruta de un día inolvidable en el Pacífico.' WHERE id = 5 AND descripcion IS NULL;

UPDATE xserv_servicios SET descripcion = 'Servicio de transporte corporativo en la provincia de Chiriquí. Servicio profesional para eventos, conferencias y traslados diarios de negocios.' WHERE id = 6 AND descripcion IS NULL;

-- Verificar que se insertaron
SELECT id, nombre, LEFT(descripcion, 50) AS descripcion_preview FROM xserv_servicios;
