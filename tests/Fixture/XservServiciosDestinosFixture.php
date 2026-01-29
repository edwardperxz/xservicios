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
