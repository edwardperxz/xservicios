<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservIncidenciasViajeFixture
 */
class XservIncidenciasViajeFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'xserv_incidencias_viaje';
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
                'ejecucion_id' => 1,
                'tipo_incidencia' => 'Lorem ipsum dolor sit amet',
                'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'latitud_incidencia' => 1.5,
                'longitud_incidencia' => 1.5,
                'severidad' => 'Lorem ipsum dolor sit amet',
                'resuelto' => 1,
                'created_at' => 1769555243,
            ],
        ];
        parent::init();
    }
}
