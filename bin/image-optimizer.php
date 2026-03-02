<?php
/**
 * Image Optimization Script
 * Comprime imágenes JPEG a calidad 75 y crea versiones WebP
 * 
 * Uso: php bin/image-optimizer.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

$imgDir = ROOT . '/webroot/img';
$supportedExtensions = ['jpg', 'jpeg', 'png'];
$quality = 75;
$webpQuality = 75;

echo "🖼️  Xservicios Image Optimizer\n";
echo "================================\n\n";

// Verificar soporte de Imagick
if (!extension_loaded('imagick')) {
    echo "❌ Error: Imagick extension no está instalada.\n";
    echo "   Instala con: apt-get install php-imagick\n";
    exit(1);
}

// Función para optimizar una imagen
function optimizeImage($filePath, $quality = 75) {
    try {
        $image = new Imagick($filePath);
        
        // Obtener tamaño original
        $originalSize = filesize($filePath);
        
        // Comprimir JPEG
        if (strtolower($image->getImageFormat()) === 'JPEG') {
            $image->setImageCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality($quality);
            $image->writeImage($filePath);
            
            $newSize = filesize($filePath);
            $reduction = round((1 - $newSize / $originalSize) * 100);
            
            echo "✅ " . basename($filePath) . "\n";
            echo "   Antes: " . formatBytes($originalSize) . " → Después: " . formatBytes($newSize);
            echo " (Reducido: {$reduction}%)\n\n";
        }
        
        return true;
    } catch (Exception $e) {
        echo "❌ " . basename($filePath) . " - Error: " . $e->getMessage() . "\n";
        return false;
    }
}

// Función para crear WebP
function createWebP($sourceFile, $quality = 75) {
    try {
        $image = new Imagick($sourceFile);
        $image->setImageFormat("webp");
        $image->setImageCompressionQuality($quality);
        
        $webpFile = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $sourceFile);
        $image->writeImage($webpFile);
        
        $sourceSize = filesize($sourceFile);
        $webpSize = filesize($webpFile);
        $savings = round((1 - $webpSize / $sourceSize) * 100);
        
        echo "   🌐 WebP creado: " . basename($webpFile);
        echo " (" . formatBytes($webpSize) . ") - Ahorro: {$savings}%\n";
        
        return true;
    } catch (Exception $e) {
        echo "   ⚠️  WebP fallo: " . $e->getMessage() . "\n";
        return false;
    }
}

// Función helper para formatear bytes
function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB'];
    for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
        $bytes /= 1024;
    }
    return round($bytes, $precision) . ' ' . $units[$i];
}

// Procesar imágenes recursivamente
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($imgDir),
    RecursiveIteratorIterator::SELF_FIRST
);

$totalOriginal = 0;
$totalOptimized = 0;
$count = 0;

foreach ($files as $file) {
    if ($file->isFile()) {
        $ext = strtolower($file->getExtension());
        
        if (in_array($ext, $supportedExtensions)) {
            $count++;
            $totalOriginal += filesize($file->getPathname());
            
            optimizeImage($file->getPathname(), $quality);
            createWebP($file->getPathname(), $webpQuality);
            
            $totalOptimized += filesize($file->getPathname());
        }
    }
}

echo "\n================================\n";
echo "✅ Optimización Completada\n";
echo "================================\n";
echo "Imágenes procesadas: {$count}\n";
echo "Tamaño original: " . formatBytes($totalOriginal) . "\n";
echo "Tamaño optimizado: " . formatBytes($totalOptimized) . "\n";

if ($totalOriginal > 0) {
    $totalReduction = round((1 - $totalOptimized / $totalOriginal) * 100);
    echo "Reducción total: {$totalReduction}%\n";
}

echo "\n💡 Próximo paso: Actualiza las imágenes en HTML para usar WebP con fallback.\n";
echo "   Ejemplo:\n";
echo "   <picture>\n";
echo "     <source srcset=\"/img/car-concept.webp\" type=\"image/webp\">\n";
echo "     <img src=\"/img/car-concept.jpeg\" alt=\"Car\" loading=\"lazy\">\n";
echo "   </picture>\n";
?>
