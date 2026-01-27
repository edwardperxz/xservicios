<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservDestinosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservDestinosTable Test Case
 */
class XservDestinosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservDestinosTable
     */
    protected $XservDestinos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservDestinos',
        'app.Ubicacions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservDestinos') ? [] : ['className' => XservDestinosTable::class];
        $this->XservDestinos = $this->getTableLocator()->get('XservDestinos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservDestinos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservDestinosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservDestinosTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
