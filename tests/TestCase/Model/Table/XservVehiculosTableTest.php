<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservVehiculosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservVehiculosTable Test Case
 */
class XservVehiculosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservVehiculosTable
     */
    protected $XservVehiculos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservVehiculos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservVehiculos') ? [] : ['className' => XservVehiculosTable::class];
        $this->XservVehiculos = $this->getTableLocator()->get('XservVehiculos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservVehiculos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservVehiculosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservVehiculosTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
