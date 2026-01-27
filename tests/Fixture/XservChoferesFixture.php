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
