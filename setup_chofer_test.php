<?php
/**
 * Script para crear datos de prueba para el panel de chofer
 */

// Bootstrap de CakePHP
require 'vendor/autoload.php';
require 'config/bootstrap.php';

use Cake\Datasource\ConnectionManager;

$conn = ConnectionManager::get('default');

echo "=== VERIFICANDO DATOS EXISTENTES ===\n\n";

// 1. Verificar usuario chofer
$usuarios = $conn->execute('SELECT id, username, rol FROM xserv_usuarios WHERE rol = "chofer"')->fetchAll('assoc');
echo "USUARIOS CHOFER:\n";
if (empty($usuarios)) {
    echo "  ❌ No hay usuarios con rol chofer\n";
    exit();
} else {
    foreach($usuarios as $u) {
        echo "  ✓ ID: {$u['id']}, Username: {$u['username']}\n";
    }
}
$usuarioChoferId = $usuarios[0]['id'];

// 2. Verificar/Crear registro en xserv_choferes
$choferes = $conn->execute("SELECT * FROM xserv_choferes WHERE usuario_id = {$usuarioChoferId}")->fetchAll('assoc');
echo "\nCHOFER PROFILE:\n";
if (empty($choferes)) {
    echo "  ⚠ No existe perfil de chofer, creando...\n";
    $conn->execute("INSERT INTO xserv_choferes (usuario_id, estado, fecha_ingreso, tipo_licencia, disponibilidad, created_at, updated_at) 
                    VALUES ({$usuarioChoferId}, 'activo', CURDATE(), 'Tipo E', 'disponible', NOW(), NOW())");
    $choferId = $conn->execute("SELECT LAST_INSERT_ID() as id")->fetch('assoc')['id'];
    echo "  ✓ Chofer creado con ID: {$choferId}\n";
} else {
    $choferId = $choferes[0]['id'];
    echo "  ✓ Chofer ID: {$choferId}\n";
}

// 3. Verificar/Crear vehículo
$vehiculos = $conn->execute("SELECT * FROM xserv_vehiculos LIMIT 1")->fetchAll('assoc');
echo "\nVEHÍCULOS:\n";
if (empty($vehiculos)) {
    echo "  ⚠ No hay vehículos, creando uno...\n";
    $conn->execute("INSERT INTO xserv_vehiculos (tipo, nombre_unidad, capacidad_max, placa, anio, kilometraje_actual, estado_operativo, created_at, updated_at) 
                    VALUES ('coaster', 'Coaster 01', 30, 'ABC-123', 2020, 50000, 'disponible', NOW(), NOW())");
    $vehiculoId = $conn->execute("SELECT LAST_INSERT_ID() as id")->fetch('assoc')['id'];
    echo "  ✓ Vehículo creado con ID: {$vehiculoId}, Placa: ABC-123\n";
} else {
    $vehiculoId = $vehiculos[0]['id'];
    echo "  ✓ Vehículo ID: {$vehiculoId}, Placa: {$vehiculos[0]['placa']}\n";
}

// 4. Verificar/Crear cliente
$clientes = $conn->execute("SELECT * FROM xserv_clientes LIMIT 1")->fetchAll('assoc');
echo "\nCLIENTES:\n";
if (empty($clientes)) {
    echo "  ⚠ No hay clientes, creando uno...\n";
    $conn->execute("INSERT INTO xserv_clientes (identificacion_fiscal, direccion_facturacion, idioma_preferido, created_at, updated_at) 
                    VALUES ('8-888-8888', 'Ciudad de Panamá', 'es', NOW(), NOW())");
    $clienteId = $conn->execute("SELECT LAST_INSERT_ID() as id")->fetch('assoc')['id'];
    echo "  ✓ Cliente creado con ID: {$clienteId}\n";
} else {
    $clienteId = $clientes[0]['id'];
    echo "  ✓ Cliente ID: {$clienteId}\n";
}

// 5. Crear reserva de prueba
echo "\nCREANDO RESERVA DE PRUEBA:\n";
$codigoReserva = 'TEST-' . date('Ymd-His');
$fecha = date('Y-m-d', strtotime('+1 day'));
$hora = '08:00:00';

$conn->execute("INSERT INTO xserv_reservas (codigo_reserva, cliente_id, servicio_id, fecha, hora, pasajeros, precio_pactado, itbms_pactado, punto_recogida, punto_destino, observaciones, estado, estado_pago, created_at, updated_at) 
                VALUES ('{$codigoReserva}', {$clienteId}, 1, '{$fecha}', '{$hora}', 15, 250.00, 0.07, 'Hotel Continental, Vía España', 'Aeropuerto Internacional de Tocumen', 'Viaje de prueba para panel chofer', 'confirmada', 'pendiente', NOW(), NOW())");
$reservaId = $conn->execute("SELECT LAST_INSERT_ID() as id")->fetch('assoc')['id'];
echo "  ✓ Reserva creada: {$codigoReserva}\n";
echo "  ✓ Fecha: {$fecha} {$hora}\n";
echo "  ✓ ID: {$reservaId}\n";

// 6. Crear asignación
echo "\nCREANDO ASIGNACIÓN:\n";
$fechaInicio = "{$fecha} 07:45:00";
$fechaFin = "{$fecha} 09:30:00";

// Obtener un usuario admin para asignado_por
$admin = $conn->execute("SELECT id FROM xserv_usuarios WHERE rol = 'admin' LIMIT 1")->fetch('assoc');
$asignadoPorId = $admin['id'];

$conn->execute("INSERT INTO xserv_asignaciones (reserva_id, chofer_id, vehiculo_id, asignado_por_id, fecha_inicio_pactada, fecha_fin_pactada, estado_asignacion, observaciones_chofer, created_at, updated_at) 
                VALUES ({$reservaId}, {$choferId}, {$vehiculoId}, {$asignadoPorId}, '{$fechaInicio}', '{$fechaFin}', 'programada', NULL, NOW(), NOW())");
$asignacionId = $conn->execute("SELECT LAST_INSERT_ID() as id")->fetch('assoc')['id'];
echo "  ✓ Asignación creada con ID: {$asignacionId}\n";
echo "  ✓ Chofer: {$usuarios[0]['username']}\n";
echo "  ✓ Estado: programada\n";

echo "\n=== ✅ DATOS DE PRUEBA CREADOS EXITOSAMENTE ===\n\n";
echo "📍 Ahora puedes:\n";
echo "   1. Iniciar sesión como: {$usuarios[0]['username']}\n";
echo "   2. Ir a: /xserv-ejecucion-viajes/chofer-panel\n";
echo "   3. Verás la reserva {$codigoReserva} lista para iniciar\n";
echo "\n";
