<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservReservasFixture
 */
class XservReservasFixture extends TestFixture
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
                'codigo_reserva' => 'Lorem ipsum dolor ',
                'cliente_id' => 1,
                'servicio_id' => 1,
                'ruta_id' => 1,
                'fecha' => '2026-01-27',
                'hora' => '23:07:23',
                'pasajeros' => 1,
                'precio_pactado' => 1.5,
                'itbms_pactado' => 1.5,
                'punto_recogida' => 'Lorem ipsum dolor sit amet',
                'punto_destino' => 'Lorem ipsum dolor sit amet',
                'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'estado' => 'Lorem ipsum dolor sit amet',
                'estado_pago' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1769555243,
                'updated_at' => 1769555243,
            ],
        ];
        parent::init();
    }
}
