<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservUbicacionesFixture
 */
class XservUbicacionesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'nombre' => ['type' => 'string', 'length' => 150, 'null' => false],
        'EN_PROVINCIAS' => ['type' => 'string', 'length' => 255, 'null' => false],
        'direccion_gps' => ['type' => 'string', 'length' => 255, 'null' => true],
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
                'nombre' => 'Lorem ipsum dolor sit amet',
                'EN_PROVINCIAS' => 'Lorem ipsum dolor sit amet',
                'direccion_gps' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1769555244,
            ],
        ];
        parent::init();
    }
}
