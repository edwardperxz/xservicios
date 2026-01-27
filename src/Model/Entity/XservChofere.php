<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservChofere Entity
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property string $nombre
 * @property string $identificacion
 * @property string $telefono
 * @property string|null $correo
 * @property string|null $estado
 * @property \Cake\I18n\Date $fecha_ingreso
 * @property string|null $tipo_licencia
 * @property string|null $disponibilidad
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 *
 * @property \App\Model\Entity\Usuario $usuario
 */
class XservChofere extends Entity
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
        'nombre' => true,
        'identificacion' => true,
        'telefono' => true,
        'correo' => true,
        'estado' => true,
        'fecha_ingreso' => true,
        'tipo_licencia' => true,
        'disponibilidad' => true,
        'created_at' => true,
        'updated_at' => true,
        'usuario' => true,
    ];
}
