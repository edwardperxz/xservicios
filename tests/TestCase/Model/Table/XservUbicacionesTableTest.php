<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservUbicacionesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservUbicacionesTable Test Case
 */
class XservUbicacionesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservUbicacionesTable
     */
    protected $XservUbicaciones;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservUbicaciones',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservUbicaciones') ? [] : ['className' => XservUbicacionesTable::class];
        $this->XservUbicaciones = $this->getTableLocator()->get('XservUbicaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservUbicaciones);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservUbicacionesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
