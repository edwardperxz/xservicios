<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservRutasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservRutasTable Test Case
 */
class XservRutasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservRutasTable
     */
    protected $XservRutas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservRutas',
        'app.Origens',
        'app.Destinos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservRutas') ? [] : ['className' => XservRutasTable::class];
        $this->XservRutas = $this->getTableLocator()->get('XservRutas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservRutas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservRutasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservRutasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
