<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservConfiguracion Entity
 *
 * @property int $id
 * @property string $clave
 * @property string $valor
 * @property string|null $tipo_dato
 * @property string $grupo
 * @property string|null $descripcion_parametro
 * @property bool|null $editable_por_admin
 * @property \Cake\I18n\DateTime|null $updated_at
 */
class XservConfiguracion extends Entity
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
        'clave' => true,
        'valor' => true,
        'tipo_dato' => true,
        'grupo' => true,
        'descripcion_parametro' => true,
        'editable_por_admin' => true,
        'updated_at' => true,
    ];
}
