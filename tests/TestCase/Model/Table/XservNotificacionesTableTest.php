<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservNotificacionesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservNotificacionesTable Test Case
 */
class XservNotificacionesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservNotificacionesTable
     */
    protected $XservNotificaciones;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservNotificaciones',
        'app.Usuarios',
        'app.Clientes',
        'app.Reservas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservNotificaciones') ? [] : ['className' => XservNotificacionesTable::class];
        $this->XservNotificaciones = $this->getTableLocator()->get('XservNotificaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservNotificaciones);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservNotificacionesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservNotificacionesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
