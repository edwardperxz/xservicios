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
