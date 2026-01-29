<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservRutasFixture
 */
class XservRutasFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'origen_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'destino_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'precio_base' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'null' => false],
        'tiempo_estimado_min' => ['type' => 'integer', 'length' => null, 'null' => true],
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
                'origen_id' => 1,
                'destino_id' => 1,
                'precio_base' => 1.5,
                'tiempo_estimado_min' => 1,
            ],
        ];
        parent::init();
    }
}
