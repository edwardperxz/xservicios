<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservAsignacionesFixture
 */
class XservAsignacionesFixture extends TestFixture
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
                'reserva_id' => 1,
                'chofer_id' => 1,
                'vehiculo_id' => 1,
                'asignado_por_id' => 1,
                'fecha_inicio_pactada' => '2026-01-27 23:07:20',
                'fecha_fin_pactada' => '2026-01-27 23:07:20',
                'estado_asignacion' => 'Lorem ipsum dolor sit amet',
                'observaciones_chofer' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created_at' => 1769555240,
                'updated_at' => 1769555240,
            ],
        ];
        parent::init();
    }
}
