<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservClientesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservClientesTable Test Case
 */
class XservClientesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservClientesTable
     */
    protected $XservClientes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservClientes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservClientes') ? [] : ['className' => XservClientesTable::class];
        $this->XservClientes = $this->getTableLocator()->get('XservClientes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservClientes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservClientesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
