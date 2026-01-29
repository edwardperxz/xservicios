<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservAsignacione Entity
 *
 * @property int $id
 * @property int $reserva_id
 * @property int $chofer_id
 * @property int $vehiculo_id
 * @property int $asignado_por_id
 * @property \Cake\I18n\DateTime $fecha_inicio_pactada
 * @property \Cake\I18n\DateTime $fecha_fin_pactada
 * @property string|null $estado_asignacion
 * @property string|null $observaciones_chofer
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 *
 * @property \App\Model\Entity\Reserva $reserva
 * @property \App\Model\Entity\Chofer $chofer
 * @property \App\Model\Entity\Vehiculo $vehiculo
 * @property \App\Model\Entity\AsignadoPor $asignado_por
 */
class XservAsignacione extends Entity
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
        'reserva_id' => true,
        'chofer_id' => true,
        'vehiculo_id' => true,
        'asignado_por_id' => true,
        'fecha_inicio_pactada' => true,
        'fecha_fin_pactada' => true,
        'estado_asignacion' => true,
        'observaciones_chofer' => true,
        'created_at' => true,
        'updated_at' => true,
        'reserva' => true,
        'chofer' => true,
        'vehiculo' => true,
        'asignado_por' => true,
    ];
}
