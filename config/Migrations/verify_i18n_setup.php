<?php
// Script para ejecutar SQL y verificar la tabla i18n
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;

// Bootstrap CakePHP
require dirname(__DIR__, 2) . '/config/bootstrap.php';

try {
    $connection = ConnectionManager::get('default');
    
    echo "Verificando estructura de xserv_servicios...\n\n";
    
    // Verificar si existe la columna descripcion
    $columns = $connection->execute("DESCRIBE xserv_servicios")->fetchAll('assoc');
    $hasDescripcion = false;
    
    foreach ($columns as $column) {
        if ($column['Field'] === 'descripcion') {
            $hasDescripcion = true;
            echo "Columna 'descripcion' encontrada\n";
            break;
        }
    }
    
    if (!$hasDescripcion) {
        echo "Agregando columna 'descripcion'...\n";
        $connection->execute("ALTER TABLE xserv_servicios ADD COLUMN descripcion TEXT NULL COMMENT 'Descripción en español (traducible con i18n)' AFTER nombre");
        echo "Columna agregada exitosamente\n";
    }
    
    echo "\nVerificando tabla i18n...\n\n";
    
    // Verificar tabla i18n
    $tables = $connection->execute("SHOW TABLES LIKE 'i18n'")->fetchAll('assoc');
    if (empty($tables)) {
        echo "Tabla i18n no existe, creandola...\n";
        $connection->execute("
            CREATE TABLE i18n (
                id int NOT NULL auto_increment,
                locale varchar(6) NOT NULL,
                model varchar(255) NOT NULL,
                foreign_key int(10) NOT NULL,
                field varchar(255) NOT NULL,
                content text,
                PRIMARY KEY (id),
                UNIQUE INDEX I18N_LOCALE_FIELD(locale, model, foreign_key, field),
                INDEX I18N_FIELD(model, foreign_key, field)
            )
        ");
        echo "Tabla i18n creada\n";
    } else {
        echo "Tabla i18n existe\n";
    }
    
    // Verificar traducciones existentes
    $count = $connection->execute("SELECT COUNT(*) as c FROM i18n WHERE model = 'XservServicios'")->fetch('assoc');
    echo "\nTraducciones en i18n: {$count['c']}\n";
    
    if ($count['c'] == 0) {
        echo "\nNo hay traducciones. Ejecuta: mysql -u root xservicios_db < config/Migrations/i18n_servicios_seeds.sql\n";
    }
    
    echo "\nSistema de traduccion configurado correctamente\n";
    echo "\nLee la documentacion en: docs/I18N_TRANSLATION_SYSTEM.md\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
