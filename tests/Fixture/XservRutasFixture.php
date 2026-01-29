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
