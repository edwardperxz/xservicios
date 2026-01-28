<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * XservUsuariosFixture
 */
class XservUsuariosFixture extends TestFixture
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
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'rol' => 'Lorem ipsum dolor sit amet',
                'estado' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2026-01-27 20:20:56',
                'updated_at' => '2026-01-27 20:20:56',
            ],
        ];
        parent::init();
    }
}