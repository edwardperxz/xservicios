<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservVehiculo Entity
 *
 * @property int $id
 * @property string $tipo
 * @property string|null $nombre_unidad
 * @property int $capacidad_max
 * @property string $placa
 * @property string|null $color
 * @property string|null $foto_url
 * @property int|null $anio
 * @property int|null $kilometraje_actual
 * @property string|null $estado_operativo
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 */
class XservVehiculo extends Entity
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
        'tipo' => true,
        'nombre_unidad' => true,
        'capacidad_max' => true,
        'placa' => true,
        'color' => true,
        'foto_url' => true,
        'anio' => true,
        'kilometraje_actual' => true,
        'estado_operativo' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
