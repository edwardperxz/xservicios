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
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'asignacion_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'hora_inicio_real' => ['type' => 'datetime', 'null' => true],
        'hora_fin_real' => ['type' => 'datetime', 'null' => true],
        'km_inicio' => ['type' => 'integer', 'length' => null, 'null' => true],
        'km_fin' => ['type' => 'integer', 'length' => null, 'null' => true],
        'lat_inicio' => ['type' => 'decimal', 'length' => 10, 'precision' => 8, 'null' => true],
        'lng_inicio' => ['type' => 'decimal', 'length' => 11, 'precision' => 8, 'null' => true],
        'lat_fin' => ['type' => 'decimal', 'length' => 10, 'precision' => 8, 'null' => true],
        'lng_fin' => ['type' => 'decimal', 'length' => 11, 'precision' => 8, 'null' => true],
        'estado_ejecucion' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'en_espera'],
        'observaciones_finales' => ['type' => 'text', 'null' => true],
        'created_at' => ['type' => 'integer', 'length' => null, 'null' => false],
        'updated_at' => ['type' => 'integer', 'length' => null, 'null' => false],
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
