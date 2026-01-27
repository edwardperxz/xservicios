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
