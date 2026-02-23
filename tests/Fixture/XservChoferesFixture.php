<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservChoferesFixture
 */
class XservChoferesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'usuario_id' => ['type' => 'integer', 'length' => null, 'null' => true],
        'nombre' => ['type' => 'string', 'length' => 100, 'null' => false],
        'identificacion' => ['type' => 'string', 'length' => 50, 'null' => false],
        'telefono' => ['type' => 'string', 'length' => 20, 'null' => false],
        'correo' => ['type' => 'string', 'length' => 100, 'null' => true],
        'estado' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'activo'],
        'fecha_ingreso' => ['type' => 'date', 'null' => false],
        'tipo_licencia' => ['type' => 'string', 'length' => 50, 'null' => true],
        'disponibilidad' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'disponible'],
        'created_at' => ['type' => 'integer', 'length' => null, 'null' => false],
        'updated_at' => ['type' => 'integer', 'length' => null, 'null' => false],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
            'unique' => ['type' => 'unique', 'columns' => ['identificacion']],
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
                'usuario_id' => 1,
                'nombre' => 'Lorem ipsum dolor sit amet',
                'identificacion' => 'Lorem ipsum dolor sit amet',
                'telefono' => 'Lorem ipsum dolor ',
                'correo' => 'Lorem ipsum dolor sit amet',
                'estado' => 'Lorem ipsum dolor sit amet',
                'fecha_ingreso' => '2026-01-27',
                'tipo_licencia' => 'Lorem ipsum dolor sit amet',
                'disponibilidad' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1769555240,
                'updated_at' => 1769555240,
            ],
        ];
        parent::init();
    }
}
