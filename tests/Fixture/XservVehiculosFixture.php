<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservVehiculosFixture
 */
class XservVehiculosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'tipo' => ['type' => 'string', 'length' => 255, 'null' => false],
        'nombre_unidad' => ['type' => 'string', 'length' => 50, 'null' => true],
        'capacidad_max' => ['type' => 'integer', 'length' => null, 'null' => false],
        'placa' => ['type' => 'string', 'length' => 20, 'null' => false],
        'anio' => ['type' => 'integer', 'length' => null, 'null' => true],
        'kilometraje_actual' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => 0],
        'estado_operativo' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'disponible'],
        'created_at' => ['type' => 'integer', 'length' => null, 'null' => false],
        'updated_at' => ['type' => 'integer', 'length' => null, 'null' => false],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
            'unique' => ['type' => 'unique', 'columns' => ['placa']],
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
                'tipo' => 'Lorem ipsum dolor sit amet',
                'nombre_unidad' => 'Lorem ipsum dolor sit amet',
                'capacidad_max' => 1,
                'placa' => 'Lorem ipsum dolor ',
                'anio' => 1,
                'kilometraje_actual' => 1,
                'estado_operativo' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1769555275,
                'updated_at' => 1769555275,
            ],
        ];
        parent::init();
    }
}
