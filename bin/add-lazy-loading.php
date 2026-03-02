<?php
/**
 * Lazy Loading Inject Script
 * Agrega loading="lazy" y decoding="async" a todas las etiquetas <img>
 * 
 * Uso: php bin/add-lazy-loading.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

$frontendDir = __DIR__ . '/../webroot/frontend';
if (!is_dir($frontendDir)) {
    echo "❌ Error: Directorio frontend no encontrado en: $frontendDir\n";
    exit(1);
}

$pattern = '#<img\s+([^>]*?)>#i';
$modified = 0;
$totalImages = 0;

echo "🖼️  Lazy Loading Injection Script\n";
echo "==================================\n\n";

// Función recursiva para procesar archivos
function processDirectory($dir, &$modified, &$totalImages) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($files as $file) {
        if ($file->isFile() && strtolower($file->getExtension()) === 'php') {
            processFile($file->getPathname(), $modified, $totalImages);
        }
    }
}

function processFile($filePath, &$modified, &$totalImages) {
    global $pattern;
    
    $content = file_get_contents($filePath);
    $originalContent = $content;
    
    $content = preg_replace_callback($pattern, function ($matches) use (&$totalImages) {
        $totalImages++;
        $attrs = $matches[1];
        
        // Saltar si ya tiene loading="lazy" o es template string/variable
        if (strpos($attrs, 'loading=') !== false || strpos($attrs, '${') !== false) {
            return $matches[0];
        }
        
        // Agregar loading="lazy" y decoding="async"
        $newAttrs = rtrim($attrs) . ' loading="lazy" decoding="async"';
        return '<img ' . $newAttrs . '>';
    }, $content);
    
    // Guardar si hay cambios
    if ($content !== $originalContent) {
        file_put_contents($filePath, $content);
        $modified++;
        echo "✅ " . basename($filePath) . "\n";
        return true;
    }
    
    return false;
}

// Procesar archivos
processDirectory($frontendDir, $modified, $totalImages);

echo "\n==================================\n";
echo "✅ Lazy Loading Inyectado\n";
echo "==================================\n";
echo "Archivos procesados: " . count(new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($frontendDir)
)) . "\n";
echo "Imágenes encontradas: {$totalImages}\n";
echo "Archivos modificados: {$modified}\n";

if ($modified > 0) {
    echo "\n✓ Todas las imágenes ahora cargan con lazy loading\n";
} else {
    echo "\n⚠️  No se encontraron imágenes para optimizar\n";
}

echo "\n💡 Las imágenes ahora:\n";
echo "  • Se cargan solo cuando están próximas al viewport\n";
echo "  • No bloquean el renderizado de la página\n";
echo "  • Mejoran significativamente el LCP\n";
?>
