<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservConfiguracionesFixture
 */
class XservConfiguracionesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'clave' => ['type' => 'string', 'length' => 100, 'null' => false],
        'valor' => ['type' => 'text', 'null' => false],
        'tipo_dato' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'string'],
        'grupo' => ['type' => 'string', 'length' => 255, 'null' => false],
        'descripcion_parametro' => ['type' => 'string', 'length' => 255, 'null' => true],
        'editable_por_admin' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => true],
        'updated_at' => ['type' => 'integer', 'length' => null, 'null' => false],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
            'unique' => ['type' => 'unique', 'columns' => ['clave']],
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
                'clave' => 'Lorem ipsum dolor sit amet',
                'valor' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'tipo_dato' => 'Lorem ipsum dolor sit amet',
                'grupo' => 'Lorem ipsum dolor sit amet',
                'descripcion_parametro' => 'Lorem ipsum dolor sit amet',
                'editable_por_admin' => 1,
                'updated_at' => 1769555241,
            ],
        ];
        parent::init();
    }
}
