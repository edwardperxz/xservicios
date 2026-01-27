<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservReservasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservReservasTable Test Case
 */
class XservReservasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservReservasTable
     */
    protected $XservReservas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservReservas',
        'app.Clientes',
        'app.Servicios',
        'app.Rutas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservReservas') ? [] : ['className' => XservReservasTable::class];
        $this->XservReservas = $this->getTableLocator()->get('XservReservas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservReservas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservReservasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservReservasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
