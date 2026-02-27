<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservServicio Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $descripcion_key
 * @property string $precio_base
 * @property string|null $variantes
 * @property string|null $estado
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 */
class XservServicio extends Entity
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
        'nombre' => true,
            'descripcion' => true,
            '_translations' => true,
        'descripcion_key' => true,
        'precio_base' => true,
        'variantes' => true,
        'estado' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
