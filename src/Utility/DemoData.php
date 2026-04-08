<?php
declare(strict_types=1);

namespace App\Utility;

use function Cake\Core\env;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

class DemoData
{
    public static function isEnabled(): bool
    {
        return filter_var((string)env('DEMO_MODE', 'false'), FILTER_VALIDATE_BOOLEAN);
    }

    public static function demoUser(): object
    {
        return (object)[
            'id' => 101,
            'nombre' => 'Demo',
            'apellidos' => '',
            'email' => 'demo@xservicios.com',
            'rol' => 'cliente',
        ];
    }

    public static function homeVehicles(): array
    {
        return [
            self::vehicle(1, 'Coaster Executive', 15, 'coaster', '../img/vehiculos/coaster_xservicios.png'),
            self::vehicle(2, 'Luxury Bus 15', 15, 'bus_15', '../img/vehiculos/bus15_xservicios.png'),
            self::vehicle(3, 'SUV Premium', 5, 'suv', 'https://images.unsplash.com/photo-1549399542-7e3f8d39a7d0?w=900&h=600&fit=crop'),
            self::vehicle(4, 'Van VIP', 10, 'van', 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=900&h=600&fit=crop'),
        ];
    }

    public static function homeDrivers(): array
    {
        return [
            self::driver(1, 'Ana', 'Mendoza', 'Licencia profesional', '2022-03-14', '../img/choferes/1772491842_choferana.webp', 4.9, 28),
            self::driver(2, 'Isaí', 'Ríos', 'Licencia turística', '2021-08-09', '../img/choferes/1772491836_chofer1.webp', 4.8, 19),
            self::driver(3, 'Fredy', 'López', 'Licencia profesional', '2020-11-20', '../img/choferes/1772491848_chofer2.avif', 5.0, 34),
            self::driver(4, 'Carlos', 'Soto', 'Licencia turística', '2023-01-06', '../img/choferes/1772491853_chofer4.avif', 4.7, 16),
            self::driver(5, 'Marcos', 'Vega', 'Licencia profesional', '2019-05-12', '../img/choferes/1772491878_chofer5.jpg', 4.8, 22),
        ];
    }

    public static function homeReservations(): array
    {
        return [
            self::reservation('XSV-2401', 'Traslado Ejecutivo', 'David', 'Boquete', '2026-04-08', '08:30:00', 'confirmada', 45.00, 3.15),
            self::reservation('XSV-2402', 'Tour Montanero', 'Albrook', 'Volcan', '2026-04-10', '11:00:00', 'pendiente', 78.00, 5.46),
            self::reservation('XSV-2403', 'Transfer Premium Playa', 'Aeropuerto', 'Boca Chica', '2026-04-12', '15:30:00', 'completada', 95.00, 6.65),
        ];
    }

    public static function fleetVehicles(): array
    {
        return self::homeVehicles();
    }

    public static function fleetDrivers(): array
    {
        return self::homeDrivers();
    }

    public static function fleetRatings(): array
    {
        return [
            1 => ['promedio' => 4.9, 'total' => 28],
            2 => ['promedio' => 4.8, 'total' => 19],
            3 => ['promedio' => 5.0, 'total' => 34],
            4 => ['promedio' => 4.7, 'total' => 16],
            5 => ['promedio' => 4.8, 'total' => 22],
        ];
    }

    public static function services(): array
    {
        return [
            self::service(1, 'Traslado Ejecutivo', 45, 'activo', 'Transporte privado para ciudad y aeropuerto', 'Private transport for city and airport trips', 'Viaje ejecutivo;Chofer profesional;Aire acondicionado', 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200&h=900&fit=crop'),
            self::service(2, 'Tour Montanero', 78, 'activo', 'Ruta panoramica por las tierras altas de Chiriqui', 'Scenic route through the highlands of Chiriqui', 'Paradas turisticas;Agua incluida;Asistencia personalizada', 'https://images.unsplash.com/photo-1473951574080-01fe63f7d0ed?w=1200&h=900&fit=crop'),
            self::service(3, 'Transfer Premium Playa', 95, 'activo', 'Traslado exclusivo hacia costas y playas del pacifico', 'Exclusive transfer to the Pacific coast and beaches', 'Puerta a puerta;Equipaje incluido;Chofer bilingue', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&h=900&fit=crop'),
            self::service(4, 'Ruta Gourmet', 110, 'activo', 'Experiencia premium con paradas gastronomicas', 'Premium experience with gourmet stops', 'Degustaciones;Itinerario personalizado;Wi-Fi', 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&h=900&fit=crop'),
            self::service(5, 'Tour Familiar', 65, 'activo', 'Traslado seguro y comodo para grupos familiares', 'Safe and comfortable transfer for families', 'Capacidad ampliada;Sillas infantiles;Paradas flexibles', 'https://images.unsplash.com/photo-1519999482648-25049ddd37b1?w=1200&h=900&fit=crop'),
        ];
    }

    public static function serviceById(int $id): ?object
    {
        foreach (self::services() as $service) {
            if ((int)$service->id === $id) {
                return $service;
            }
        }

        return null;
    }

    public static function reservationsApi(): array
    {
        return [
            self::apiReservation(1, 'XSV-2401', 'completado', 'David', 'Boquete', '2026-04-02', 'Ana Mendoza', 'Coaster Executive'),
            self::apiReservation(2, 'XSV-2402', 'completado', 'Aeropuerto', 'Boquete', '2026-04-04', 'Isaí Ríos', 'Luxury Bus 15'),
            self::apiReservation(3, 'XSV-2403', 'completado', 'Volcan', 'Boca Chica', '2026-04-06', 'Fredy López', 'SUV Premium'),
        ];
    }

    public static function valoracionesApi(): array
    {
        return [
            self::rating(1, 1, 'chofer', 5, 'Excelente trato y puntualidad.', 'David', 'Boquete', '2026-04-02'),
            self::rating(2, 2, 'bus', 5, 'Vehiculo impecable y muy comodo.', 'Aeropuerto', 'Boquete', '2026-04-04'),
        ];
    }

    private static function vehicle(int $id, string $name, int $capacity, string $type, string $image): object
    {
        return (object)[
            'id' => $id,
            'nombre_unidad' => $name,
            'capacidad_max' => $capacity,
            'tipo' => $type,
            'foto_url' => $image,
        ];
    }

    private static function driver(int $id, string $name, string $lastName, string $license, string $since, string $image, float $rating, int $reviews): object
    {
        return (object)[
            'id' => $id,
            'foto_url' => $image,
            'tipo_licencia' => $license,
            'fecha_ingreso' => new FrozenDate($since),
            'usuario' => (object)[
                'nombre' => $name,
                'apellidos' => $lastName,
            ],
            'rating' => $rating,
            'reviews' => $reviews,
        ];
    }

    private static function reservation(string $code, string $serviceName, string $origin, string $destination, string $date, string $time, string $status, float $price, float $tax): object
    {
        return (object)[
            'codigo_reserva' => $code,
            'servicio' => (object)['nombre' => $serviceName],
            'fecha' => new FrozenDate($date),
            'hora' => new FrozenTime($time),
            'estado' => $status,
            'estado_pago' => $status === 'completada' ? 'pagado' : 'pendiente',
            'punto_recogida' => $origin,
            'punto_destino' => $destination,
            'pasajeros' => 3,
            'precio_pactado' => $price,
            'itbms_pactado' => $tax,
            'observaciones' => 'Demo de portafolio guardada en memoria local.',
        ];
    }

    private static function service(int $id, string $name, float $price, string $status, string $descEs, string $descEn, string $variants, string $image): object
    {
        return (object)[
            'id' => $id,
            'nombre' => $name,
            'precio_base' => $price,
            'estado' => $status,
            'descripcion_es' => $descEs,
            'descripcion_en' => $descEn,
            'variantes' => $variants,
            'imagen' => $image,
        ];
    }

    private static function apiReservation(int $id, string $code, string $status, string $origin, string $destination, string $date, string $driver, string $vehicle): object
    {
        return (object)[
            'id' => $id,
            'codigo_reserva' => $code,
            'estado' => $status,
            'origen_ubicacion' => $origin,
            'destino_ubicacion' => $destination,
            'fecha_viaje' => $date,
            'xserv_chofer' => (object)['nombre_completo' => $driver],
            'xserv_vehiculo' => (object)['marca_modelo' => $vehicle],
        ];
    }

    private static function rating(int $id, int $reservationId, string $type, int $score, string $comment, string $origin, string $destination, string $date): object
    {
        return (object)[
            'id' => $id,
            'xserv_reserva_id' => $reservationId,
            'tipo' => $type,
            'calificacion' => $score,
            'comentarios' => $comment,
            'created' => $date . ' 12:00:00',
            'xserv_reserva' => (object)[
                'origen_ubicacion' => $origin,
                'destino_ubicacion' => $destination,
                'fecha_viaje' => $date,
            ],
        ];
    }
}