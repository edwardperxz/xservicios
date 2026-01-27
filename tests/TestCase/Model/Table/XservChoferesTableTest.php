<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservChoferesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservChoferesTable Test Case
 */
class XservChoferesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservChoferesTable
     */
    protected $XservChoferes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservChoferes',
        'app.Usuarios',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservChoferes') ? [] : ['className' => XservChoferesTable::class];
        $this->XservChoferes = $this->getTableLocator()->get('XservChoferes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservChoferes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservChoferesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservChoferesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
