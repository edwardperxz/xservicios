<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservServiciosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservServiciosTable Test Case
 */
class XservServiciosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservServiciosTable
     */
    protected $XservServicios;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservServicios',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('XservServicios') ? [] : ['className' => XservServiciosTable::class];
        $this->XservServicios = $this->getTableLocator()->get('XservServicios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservServicios);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservServiciosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
