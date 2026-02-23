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
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'ejecucion_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'tipo_incidencia' => ['type' => 'string', 'length' => 255, 'null' => false],
        'descripcion' => ['type' => 'text', 'null' => false],
        'latitud_incidencia' => ['type' => 'decimal', 'length' => 10, 'precision' => 8, 'null' => true],
        'longitud_incidencia' => ['type' => 'decimal', 'length' => 11, 'precision' => 8, 'null' => true],
        'severidad' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'baja'],
        'resuelto' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => false],
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
