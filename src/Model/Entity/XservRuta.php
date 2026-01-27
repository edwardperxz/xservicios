<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservRuta Entity
 *
 * @property int $id
 * @property int $origen_id
 * @property int $destino_id
 * @property string $precio_base
 * @property int|null $tiempo_estimado_min
 *
 * @property \App\Model\Entity\Origen $origen
 * @property \App\Model\Entity\Destino $destino
 */
class XservRuta extends Entity
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
        'origen_id' => true,
        'destino_id' => true,
        'precio_base' => true,
        'tiempo_estimado_min' => true,
        'origen' => true,
        'destino' => true,
    ];
}
