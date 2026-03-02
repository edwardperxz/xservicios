<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservAsignacionesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservAsignacionesTable Test Case
 */
class XservAsignacionesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservAsignacionesTable
     */
    protected $XservAsignaciones;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservAsignaciones',
        'app.Reservas',
        'app.Choferes',
        'app.Vehiculos',
        'app.AsignadoPors',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservAsignaciones') ? [] : ['className' => XservAsignacionesTable::class];
        $this->XservAsignaciones = $this->getTableLocator()->get('XservAsignaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservAsignaciones);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservAsignacionesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservAsignacionesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
