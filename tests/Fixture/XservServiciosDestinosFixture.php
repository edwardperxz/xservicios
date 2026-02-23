<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservServiciosDestinosFixture
 */
class XservServiciosDestinosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'servicio_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'destino_id' => ['type' => 'integer', 'length' => null, 'null' => false],
        'orden_visita' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => 1],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['servicio_id', 'destino_id']],
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
                'servicio_id' => 1,
                'destino_id' => 1,
                'orden_visita' => 1,
            ],
        ];
        parent::init();
    }
}
