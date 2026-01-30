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
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'null' => false, 'default' => null, 'autoIncrement' => true],
        'username' => ['type' => 'string', 'length' => 50, 'null' => false],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false],
        'rol' => ['type' => 'string', 'length' => 255, 'null' => false],
        'estado' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => 'activo'],
        'created_at' => ['type' => 'timestamp', 'null' => false],
        'updated_at' => ['type' => 'timestamp', 'null' => false],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
            'unique' => ['type' => 'unique', 'columns' => ['username']],
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