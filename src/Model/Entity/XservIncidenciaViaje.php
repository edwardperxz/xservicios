<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservIncidenciaViaje Entity
 *
 * @property int $id
 * @property int $ejecucion_id
 * @property string $tipo_incidencia
 * @property string $descripcion
 * @property string|null $latitud_incidencia
 * @property string|null $longitud_incidencia
 * @property string|null $severidad
 * @property bool|null $resuelto
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\XservEjecucionViaje $ejecucion
 */
class XservIncidenciaViaje extends Entity
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
        'ejecucion_id' => true,
        'tipo_incidencia' => true,
        'descripcion' => true,
        'latitud_incidencia' => true,
        'longitud_incidencia' => true,
        'severidad' => true,
        'resuelto' => true,
        'created_at' => true,
        'ejecucion' => true,
        'direccion_gps_incidencia' => true,
    ];
}
