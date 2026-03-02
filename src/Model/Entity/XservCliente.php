<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservCliente Entity
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property string|null $identificacion_fiscal
 * @property string|null $direccion_facturacion
 * @property string|null $idioma_preferido
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 *
 * @property \App\Model\Entity\XservUsuario $usuario
 */
class XservCliente extends Entity
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
        'usuario_id' => true,
        'identificacion_fiscal' => true,
        'direccion_facturacion' => true,
        'idioma_preferido' => true,
        'created_at' => true,
        'updated_at' => true,
        'usuario' => true,
    ];
}
