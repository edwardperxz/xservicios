<?php
// Script para poblar descripciones en español e inglés
require dirname(__DIR__, 2) . '/vendor/autoload.php';
require dirname(__DIR__, 2) . '/config/bootstrap.php';

use Cake\Datasource\ConnectionManager;

try {
    $connection = ConnectionManager::get('default');
    
    echo "Agregando descripciones en espanol...\n\n";
    
    // Agregar descripciones en español a la tabla principal
    $descripciones = [
        1 => 'Servicio de traslado desde la ciudad de David hasta el pueblo de Boquete. Transporte cómodo y seguro con choferes experimentados.',
        2 => 'Tour por plantaciones de café en las alturas de Boquete. Aprende sobre el proceso de producción desde la semilla hasta la taza. Incluye degustación de café premium.',
        3 => 'Ascenso al Volcán Barú en vehículo 4x4 hasta el punto más alto de Panamá. Vistas espectaculares de ambos océanos. Opciones de amanecer o nocturno disponibles.',
        4 => 'Tour relajante a las aguas termales de Caldera. Aguas termales naturales rodeadas de naturaleza tropical. Perfecto para desconectar y relajarse.',
        5 => 'Tour a la playa Las Lajas, una de las playas más largas de Centroamérica. Aguas cristalinas y arena blanca. Disfruta de un día inolvidable en el Pacífico.',
        6 => 'Servicio de transporte corporativo en la provincia de Chiriquí. Servicio profesional para eventos, conferencias y traslados diarios de negocios.',
    ];
    
    foreach ($descripciones as $id => $descripcion) {
        $connection->execute("
            UPDATE xserv_servicios 
            SET descripcion = ?
            WHERE id = ? AND (descripcion IS NULL OR descripcion = '')
        ", [$descripcion, $id]);
        echo "  Servicio $id actualizado\n";
    }
    
    echo "\nAgregando traducciones en ingles...\n\n";
    
    // Agregar traducciones en inglés a la tabla i18n
    $traducciones = [
        1 => 'Transfer service from David city to Boquete town. Comfortable and safe transportation with experienced drivers.',
        2 => 'Coffee plantation tour in the highlands of Boquete. Learn about the coffee production process from seed to cup. Includes premium coffee tasting.',
        3 => 'Volcano Barú 4x4 ascent to the highest point in Panama. Spectacular views of both oceans. Sunrise or night options available.',
        4 => 'Relaxing hot springs tour in Caldera. Natural thermal waters surrounded by tropical nature. Perfect for unwinding and relaxation.',
        5 => 'Beach tour to Las Lajas, one of the longest beaches in Central America. Crystal clear waters and white sand. Enjoy an unforgettable day in the Pacific.',
        6 => 'Corporate transportation service in Chiriquí province. Professional service for events, conferences, and daily business transfers.',
    ];
    
    foreach ($traducciones as $id => $content) {
        // Verificar si ya existe
        $exists = $connection->execute("
            SELECT id FROM i18n 
            WHERE locale = 'en' AND model = 'XservServicios' AND foreign_key = ? AND field = 'descripcion'
        ", [$id])->fetch('assoc');
        
        if (!$exists) {
            $connection->execute("
                INSERT INTO i18n (locale, model, foreign_key, field, content)
                VALUES ('en', 'XservServicios', ?, 'descripcion', ?)
            ", [$id, $content]);
            echo "  Traduccion agregada para servicio $id\n";
        } else {
            echo "  Traduccion ya existe para servicio $id\n";
        }
    }
    
    echo "\nTodas las descripciones y traducciones agregadas exitosamente\n";
    echo "\nResumen:\n";
    
    $countEs = $connection->execute("SELECT COUNT(*) as c FROM xserv_servicios WHERE descripcion IS NOT NULL AND descripcion != ''")->fetch('assoc');
    $countEn = $connection->execute("SELECT COUNT(*) as c FROM i18n WHERE locale = 'en' AND model = 'XservServicios'")->fetch('assoc');
    
    echo "  - Servicios con descripcion en espanol: {$countEs['c']}\n";
    echo "  - Traducciones en ingles: {$countEn['c']}\n";
    
    echo "\nSistema listo para usar\n";
    echo "  - Visita cualquier servicio y agrega ?lang=en para ver en ingles\n";
    echo "  - Por defecto veras en espanol\n\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
