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
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'reserva_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'chofer_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'vehiculo_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'asignado_por_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'fecha_inicio_pactada' => ['type' => 'datetime', 'null' => false],
        'fecha_fin_pactada' => ['type' => 'datetime', 'null' => false],
        'estado_asignacion' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'programada'],
        'observaciones_chofer' => ['type' => 'text', 'null' => true],
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
