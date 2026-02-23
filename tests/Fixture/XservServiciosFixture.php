<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservServiciosFixture
 */
class XservServiciosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'nombre' => ['type' => 'string', 'length' => 100, 'null' => false],
        'descripcion_es' => ['type' => 'text', 'null' => false],
        'descripcion_en' => ['type' => 'text', 'null' => false],
        'precio_base' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'null' => false],
        'variantes' => ['type' => 'text', 'null' => true],
        'estado' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'activo'],
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
                'descripcion_es' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'descripcion_en' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'precio_base' => 1.5,
                'variantes' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'estado' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1769555244,
                'updated_at' => 1769555244,
            ],
        ];
        parent::init();
    }
}
