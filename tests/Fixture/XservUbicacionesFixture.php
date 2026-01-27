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
