<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservEjecucionViaje Entity
 *
 * @property int $id
 * @property int $asignacion_id
 * @property \Cake\I18n\DateTime|null $hora_inicio_real
 * @property \Cake\I18n\DateTime|null $hora_fin_real
 * @property int|null $km_inicio
 * @property int|null $km_fin
 * @property string|null $lat_inicio
 * @property string|null $lng_inicio
 * @property string|null $lat_fin
 * @property string|null $lng_fin
 * @property string|null $estado_ejecucion
 * @property string|null $observaciones_finales
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 *
 * @property \App\Model\Entity\XservAsignacion $asignacion
 */
class XservEjecucionViaje extends Entity
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
        'asignacion_id' => true,
        'hora_inicio_real' => true,
        'hora_fin_real' => true,
        'km_inicio' => true,
        'km_fin' => true,
        'lat_inicio' => true,
        'lng_inicio' => true,
        'lat_fin' => true,
        'lng_fin' => true,
        'estado_ejecucion' => true,
        'observaciones_finales' => true,
        'created_at' => true,
        'updated_at' => true,
        'asignacion' => true,
    ];
}
