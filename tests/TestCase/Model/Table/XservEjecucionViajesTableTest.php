<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservEjecucionViajesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservEjecucionViajesTable Test Case
 */
class XservEjecucionViajesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservEjecucionViajesTable
     */
    protected $XservEjecucionViajes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservEjecucionViajes',
        'app.Asignacions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservEjecucionViajes') ? [] : ['className' => XservEjecucionViajesTable::class];
        $this->XservEjecucionViajes = $this->getTableLocator()->get('XservEjecucionViajes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservEjecucionViajes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservEjecucionViajesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservEjecucionViajesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
