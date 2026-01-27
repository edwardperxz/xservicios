<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservIncidenciasViajeTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservIncidenciasViajeTable Test Case
 */
class XservIncidenciasViajeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservIncidenciasViajeTable
     */
    protected $XservIncidenciasViaje;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservIncidenciasViaje',
        'app.Ejecucions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservIncidenciasViaje') ? [] : ['className' => XservIncidenciasViajeTable::class];
        $this->XservIncidenciasViaje = $this->getTableLocator()->get('XservIncidenciasViaje', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservIncidenciasViaje);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservIncidenciasViajeTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservIncidenciasViajeTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
