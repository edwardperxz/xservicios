<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservReserva Entity
 *
 * @property int $id
 * @property string $codigo_reserva
 * @property int $cliente_id
 * @property int $servicio_id
 * @property int|null $ruta_id
 * @property \Cake\I18n\Date $fecha
 * @property \Cake\I18n\Time $hora
 * @property int $pasajeros
 * @property string $precio_pactado
 * @property string|null $itbms_pactado
 * @property string $punto_recogida
 * @property string $punto_destino
 * @property string|null $observaciones
 * @property string|null $estado
 * @property string|null $estado_pago
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 *
 * @property \App\Model\Entity\XservCliente $cliente
 * @property \App\Model\Entity\Servicio $servicio
 * @property \App\Model\Entity\Ruta $ruta
 */
class XservReserva extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'codigo_reserva' => true,
        'cliente_id' => true,
        'servicio_id' => true,
        'ruta_id' => true,
        'fecha' => true,
        'hora' => true,
        'pasajeros' => true,
        'precio_pactado' => true,
        'itbms_pactado' => true,
        'punto_recogida' => true,
        'punto_destino' => true,
        'observaciones' => true,
        'estado' => true,
        'estado_pago' => true,
        'created_at' => true,
        'updated_at' => true,
        'cliente' => true,
        'servicio' => true,
        'ruta' => true,
    ];
}
