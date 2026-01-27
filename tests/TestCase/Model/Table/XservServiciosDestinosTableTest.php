<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\XservServiciosDestinosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\XservServiciosDestinosTable Test Case
 */
class XservServiciosDestinosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\XservServiciosDestinosTable
     */
    protected $XservServiciosDestinos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.XservServiciosDestinos',
        'app.Servicios',
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
        $config = $this->getTableLocator()->exists('XservServiciosDestinos') ? [] : ['className' => XservServiciosDestinosTable::class];
        $this->XservServiciosDestinos = $this->getTableLocator()->get('XservServiciosDestinos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->XservServiciosDestinos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\XservServiciosDestinosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\XservServiciosDestinosTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
