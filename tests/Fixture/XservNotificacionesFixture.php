<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservNotificacionesFixture
 */
class XservNotificacionesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'usuario_id' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => null],
        'cliente_id' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => null],
        'reserva_id' => ['type' => 'integer', 'length' => null, 'null' => true, 'default' => null],
        'tipo_notificacion' => ['type' => 'string', 'length' => 255, 'null' => false],
        'medio' => ['type' => 'string', 'length' => 255, 'null' => false],
        'destinatario' => ['type' => 'string', 'length' => 100, 'null' => false],
        'contenido' => ['type' => 'text', 'null' => false],
        'estado_envio' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'pendiente'],
        'error_log' => ['type' => 'text', 'null' => true],
        'enviado_at' => ['type' => 'integer', 'length' => null, 'null' => true],
        'created_at' => ['type' => 'integer', 'length' => null, 'null' => false],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
        ],
    ];

    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'usuario_id' => 1,
                'cliente_id' => 1,
                'reserva_id' => 1,
                'tipo_notificacion' => 'Lorem ipsum dolor sit amet',
                'medio' => 'Lorem ipsum dolor sit amet',
                'destinatario' => 'Lorem ipsum dolor sit amet',
                'contenido' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'estado_envio' => 'Lorem ipsum dolor sit amet',
                'error_log' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'enviado_at' => 1769555243,
                'created_at' => 1769555243,
            ],
        ];
        parent::init();
    }
}
