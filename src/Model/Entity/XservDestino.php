<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservDestino Entity
 *
 * @property int $id
 * @property int $ubicacion_id
 * @property string $descripcion_es
 * @property string $descripcion_en
 * @property bool|null $es_popular
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Ubicacion $ubicacion
 */
class XservDestino extends Entity
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
        'ubicacion_id' => true,
        'descripcion_es' => true,
        'descripcion_en' => true,
        'es_popular' => true,
        'created_at' => true,
        'ubicacion' => true,
    ];
}
