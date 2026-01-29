<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservClientesFixture
 */
class XservClientesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'nombre' => ['type' => 'string', 'length' => 100, 'null' => false],
        'identificacion_fiscal' => ['type' => 'string', 'length' => 50, 'null' => true],
        'correo' => ['type' => 'string', 'length' => 100, 'null' => false],
        'telefono' => ['type' => 'string', 'length' => 20, 'null' => false],
        'direccion_facturacion' => ['type' => 'text', 'null' => true],
        'idioma_preferido' => ['type' => 'string', 'length' => 2, 'null' => false, 'default' => 'es'],
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
                'nombre' => 'Lorem ipsum dolor sit amet',
                'identificacion_fiscal' => 'Lorem ipsum dolor sit amet',
                'correo' => 'Lorem ipsum dolor sit amet',
                'telefono' => 'Lorem ipsum dolor ',
                'direccion_facturacion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'idioma_preferido' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1769555241,
                'updated_at' => 1769555241,
            ],
        ];
        parent::init();
    }
}
