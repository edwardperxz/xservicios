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
