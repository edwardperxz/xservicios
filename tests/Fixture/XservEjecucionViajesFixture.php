<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservEjecucionViajesFixture
 */
class XservEjecucionViajesFixture extends TestFixture
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
                'asignacion_id' => 1,
                'hora_inicio_real' => '2026-01-27 23:07:22',
                'hora_fin_real' => '2026-01-27 23:07:22',
                'km_inicio' => 1,
                'km_fin' => 1,
                'lat_inicio' => 1.5,
                'lng_inicio' => 1.5,
                'lat_fin' => 1.5,
                'lng_fin' => 1.5,
                'estado_ejecucion' => 'Lorem ipsum dolor sit amet',
                'observaciones_finales' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created_at' => 1769555242,
                'updated_at' => 1769555242,
            ],
        ];
        parent::init();
    }
}
