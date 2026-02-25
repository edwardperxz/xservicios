<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservServicioDestino Entity
 *
 * @property int $servicio_id
 * @property int $destino_id
 * @property int|null $orden_visita
 *
 * @property \App\Model\Entity\XservServicio $servicio
 * @property \App\Model\Entity\XservDestino $destino
 */
class XservServicioDestino extends Entity
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
        'orden_visita' => true,
        'servicio' => true,
        'destino' => true,
    ];
}
