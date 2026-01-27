<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
/**
 * XservValoracione Entity
 *
 * @property int $id
 * @property int $reserva_id
 * @property int $calificacion
 * @property int|null $puntuacion_limpieza
 * @property int|null $puntuacion_puntualidad
 * @property string|null $comentarios
 * @property int|null $mostrar_en_web
 * @property string|null $estado_moderacion
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\XservReserva $xserv_reserva
 */
class XservValoracione extends Entity
{
    protected array $_accessible = [
        'reserva_id' => true,
        'calificacion' => true,
        'puntuacion_limpieza' => true,
        'puntuacion_puntualidad' => true,
        'comentarios' => true,
        'mostrar_en_web' => true,
        'estado_moderacion' => true,
        'created_at' => true,
        'xserv_reserva' => true,
    ];
}