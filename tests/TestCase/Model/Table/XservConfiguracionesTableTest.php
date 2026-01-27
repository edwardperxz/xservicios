<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservConfiguracionesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservConfiguracionesTable Test Case
 */
class XservConfiguracionesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservConfiguracionesTable
     */
    protected $XservConfiguraciones;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservConfiguraciones',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservConfiguraciones') ? [] : ['className' => XservConfiguracionesTable::class];
        $this->XservConfiguraciones = $this->getTableLocator()->get('XservConfiguraciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservConfiguraciones);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservConfiguracionesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservConfiguracionesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
