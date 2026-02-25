<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * XservNotificacion Entity
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property int|null $cliente_id
 * @property int|null $reserva_id
 * @property string $tipo_notificacion
 * @property string $medio
 * @property string $destinatario
 * @property string $contenido
 * @property string|null $estado_envio
 * @property string|null $error_log
 * @property \Cake\I18n\DateTime|null $enviado_at
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\XservCliente $cliente
 * @property \App\Model\Entity\Reserva $reserva
 */
class XservNotificacion extends Entity
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
        'cliente_id' => true,
        'reserva_id' => true,
        'tipo_notificacion' => true,
        'medio' => true,
        'destinatario' => true,
        'contenido' => true,
        'estado_envio' => true,
        'error_log' => true,
        'enviado_at' => true,
        'created_at' => true,
        'usuario' => true,
        'cliente' => true,
        'reserva' => true,
    ];
}
